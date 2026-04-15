<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AppSetting;
use App\Models\SetoranHistory;
use App\Models\Transaksi;
use App\Models\User;
use App\Models\WeeklyProgress;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function create(Request $request): JsonResponse
    {
        $request->validate([
            'week_count' => ['nullable', 'integer', 'in:1,2,3,4'],
        ]);

        $user = $request->user()->load(['savingPlan', 'assignedStaff']);
        $weeklyAmount = (int) ($user->savingPlan?->weekly_amount ?? 0);

        $globalStartDate = $this->globalSavingStartDate();

        if (! $globalStartDate || $globalStartDate->isFuture()) {
            return response()->json([
                'message' => 'Setoran belum dimulai. Menunggu owner menentukan tanggal mulai.',
            ], 422);
        }

        $missedWeeks = $this->missedWeeks($user);
        if (! $user->is_active || $missedWeeks >= 10) {
            if ($user->is_active && $missedWeeks >= 10) {
                $user->forceFill(['is_active' => false])->save();
            }

            return response()->json([
                'message' => 'Akun Anda diberhentikan karena tidak melakukan setoran selama 10 minggu berturut-turut.',
            ], 403);
        }

        if ($weeklyAmount <= 0) {
            return response()->json([
                'message' => 'Paket tabungan pengguna belum memiliki nominal mingguan.',
            ], 422);
        }

        $startWeek = $this->nextPayableWeek($user);
        if ($startWeek > 52) {
            return response()->json([
                'message' => 'Semua minggu pembayaran sudah berhasil tercatat.',
            ], 409);
        }

        $existingPending = Transaksi::query()
            ->where('user_id', $user->id)
            ->where('week_number', $startWeek)
            ->whereIn('transaction_status', ['pending', 'authorize'])
            ->latest()
            ->first();

        if ($existingPending) {
            return response()->json([
                'message' => 'Masih ada transaksi pembayaran yang sedang menunggu penyelesaian.',
                'data' => $this->transformTransaction($existingPending),
            ], 200);
        }

        $requestedWeekCount = (int) ($request->integer('week_count') ?: 1);
        $remainingWeeks = 53 - $startWeek;
        $weekCount = max(1, min($requestedWeekCount, min(4, $remainingWeeks)));
        $endWeek = min(52, $startWeek + $weekCount - 1);
        $grossAmount = $weeklyAmount * $weekCount;

        $orderId = sprintf(
            'TRX-%d-W%02d-%02d-%s',
            $user->id,
            $startWeek,
            $endWeek,
            now()->format('YmdHis')
        );

        $payload = [
            'payment_type' => 'qris',
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => $grossAmount,
            ],
            'item_details' => [[
                'id' => 'weekly-saving',
                'price' => $weeklyAmount,
                'quantity' => $weekCount,
                'name' => $weekCount === 1
                    ? 'Setoran Minggu ke-' . $startWeek
                    : 'Setoran Minggu ke-' . $startWeek . ' s/d ' . $endWeek,
            ]],
            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email,
                'phone' => $user->phone,
            ],
            'custom_field1' => 'user_id:' . $user->id,
            'custom_field2' => 'week_range:' . $startWeek . '-' . $endWeek,
            'custom_field3' => 'staff_id:' . ($user->assigned_staff_id ?? '-'),
            'metadata' => [
                'user_id' => $user->id,
                'start_week' => $startWeek,
                'end_week' => $endWeek,
                'week_count' => $weekCount,
                'staff_id' => $user->assigned_staff_id,
                'saving_plan_id' => $user->saving_plan_id,
            ],
        ];

        $http = Http::withBasicAuth(config('services.midtrans.server_key'), '')
            ->acceptJson();

        if (app()->environment('local')) {
            $http = $http->withoutVerifying();
        }

        $response = $http->post($this->midtransBaseUrl() . '/v2/charge', $payload);

        if ($response->failed()) {
            Log::warning('Midtrans charge failed', [
                'user_id' => $user->id,
                'start_week' => $startWeek,
                'week_count' => $weekCount,
                'status' => $response->status(),
                'body' => $response->json(),
            ]);

            return response()->json([
                'message' => 'Gagal membuat transaksi pembayaran ke Midtrans.',
                'errors' => $response->json(),
            ], 422);
        }

        $midtrans = $response->json();

        $transaksi = Transaksi::create([
            'user_id' => $user->id,
            'staff_id' => $user->assigned_staff_id,
            'saving_plan_id' => $user->saving_plan_id,
            'week_number' => $startWeek,
            'order_id' => $orderId,
            'gross_amount' => $grossAmount,
            'payment_type' => $midtrans['payment_type'] ?? 'qris',
            'transaction_status' => $midtrans['transaction_status'] ?? 'pending',
            'midtrans_transaction_id' => $midtrans['transaction_id'] ?? null,
            'fraud_status' => $midtrans['fraud_status'] ?? null,
            'expires_at' => isset($midtrans['expiry_time']) ? now()->parse($midtrans['expiry_time']) : null,
            'payment_payload' => array_merge($midtrans, [
                'metadata' => $payload['metadata'],
            ]),
        ]);

        return response()->json([
            'message' => 'Transaksi pembayaran berhasil dibuat.',
            'data' => $this->transformTransaction($transaksi),
        ], 201);
    }

    public function show(Request $request, Transaksi $transaksi): JsonResponse
    {
        abort_unless($transaksi->user_id === $request->user()->id, 403);

        if (in_array($transaksi->transaction_status, ['pending', 'authorize'], true)) {
            $this->refreshTransactionStatus($transaksi);
            $transaksi->refresh();
        }

        return response()->json([
            'data' => $this->transformTransaction($transaksi),
            'message' => 'Detail transaksi berhasil diambil.',
        ]);
    }

    public function notification(Request $request): JsonResponse
    {
        $payload = $request->all();

        if (! $this->isValidSignature($payload)) {
            Log::warning('Midtrans notification signature mismatch', $payload);

            return response()->json([
                'message' => 'Signature notification tidak valid.',
            ], 403);
        }

        $transaksi = Transaksi::query()
            ->where('order_id', $payload['order_id'] ?? '')
            ->first();

        if (! $transaksi) {
            Log::warning('Midtrans notification transaction not found', $payload);

            return response()->json([
                'message' => 'Transaksi tidak ditemukan.',
            ], 404);
        }

        $this->applyTransactionUpdate($transaksi, $payload);

        return response()->json([
            'message' => 'Notification berhasil diproses.',
        ]);
    }

    private function transformTransaction(Transaksi $transaksi): array
    {
        $payload = $transaksi->payment_payload ?? [];
        $actions = $payload['actions'] ?? [];
        $metadata = $payload['metadata'] ?? [];
        $qrAction = collect($actions)->firstWhere('name', 'generate-qr-code');
        $qrActionV2 = collect($actions)->firstWhere('name', 'generate-qr-code-v2');
        $deeplinkAction = collect($actions)->firstWhere('name', 'deeplink-redirect');
        $startWeek = (int) ($metadata['start_week'] ?? $transaksi->week_number ?? 1);
        $weekCount = (int) ($metadata['week_count'] ?? 1);
        $endWeek = (int) ($metadata['end_week'] ?? max($startWeek, $startWeek + $weekCount - 1));

        return [
            'id' => $transaksi->id,
            'order_id' => $transaksi->order_id,
            'week_number' => $startWeek,
            'start_week' => $startWeek,
            'end_week' => $endWeek,
            'week_count' => $weekCount,
            'gross_amount' => $transaksi->gross_amount,
            'payment_type' => $transaksi->payment_type,
            'transaction_status' => $transaksi->transaction_status,
            'paid_at' => $transaksi->paid_at,
            'expires_at' => $transaksi->expires_at,
            'actions' => $actions,
            'qr_url' => is_array($qrAction) ? ($qrAction['url'] ?? null) : null,
            'qr_url_v2' => is_array($qrActionV2) ? ($qrActionV2['url'] ?? null) : null,
            'qr_string' => $payload['qr_string'] ?? null,
            'deeplink_url' => is_array($deeplinkAction) ? ($deeplinkAction['url'] ?? null) : null,
            'payload' => $payload,
        ];
    }

    private function isValidSignature(array $payload): bool
    {
        $signature = $payload['signature_key'] ?? null;
        $orderId = $payload['order_id'] ?? '';
        $statusCode = $payload['status_code'] ?? '';
        $grossAmount = $payload['gross_amount'] ?? '';
        $serverKey = (string) config('services.midtrans.server_key');

        if (! $signature || ! $serverKey) {
            return false;
        }

        $expected = hash('sha512', $orderId . $statusCode . $grossAmount . $serverKey);

        return hash_equals($expected, $signature);
    }

    private function refreshTransactionStatus(Transaksi $transaksi): void
    {
        $http = Http::withBasicAuth(config('services.midtrans.server_key'), '')
            ->acceptJson();

        if (app()->environment('local')) {
            $http = $http->withoutVerifying();
        }

        $response = $http->get($this->midtransBaseUrl() . '/v2/' . $transaksi->order_id . '/status');

        if ($response->failed()) {
            Log::warning('Midtrans status check failed', [
                'order_id' => $transaksi->order_id,
                'status' => $response->status(),
                'body' => $response->json(),
            ]);

            return;
        }

        $this->applyTransactionUpdate($transaksi, $response->json());
    }

    private function applyTransactionUpdate(Transaksi $transaksi, array $payload): void
    {
        DB::transaction(function () use ($transaksi, $payload) {
            $status = $payload['transaction_status'] ?? $transaksi->transaction_status;
            $paidStatuses = ['settlement', 'capture'];
            $existingPayload = $transaksi->payment_payload ?? [];
            $metadata = $existingPayload['metadata'] ?? [];
            $startWeek = (int) ($metadata['start_week'] ?? $transaksi->week_number ?? 1);
            $weekCount = (int) ($metadata['week_count'] ?? 1);
            $endWeek = (int) ($metadata['end_week'] ?? max($startWeek, $startWeek + $weekCount - 1));

            $transaksi->update([
                'payment_type' => $payload['payment_type'] ?? $transaksi->payment_type,
                'transaction_status' => $status,
                'midtrans_transaction_id' => $payload['transaction_id'] ?? $transaksi->midtrans_transaction_id,
                'fraud_status' => $payload['fraud_status'] ?? $transaksi->fraud_status,
                'paid_at' => in_array($status, $paidStatuses, true)
                    ? ($transaksi->paid_at ?? now())
                    : $transaksi->paid_at,
                'expires_at' => isset($payload['expiry_time'])
                    ? now()->parse($payload['expiry_time'])
                    : $transaksi->expires_at,
                'payment_payload' => array_merge($existingPayload, $payload),
            ]);

            if (in_array($status, $paidStatuses, true)) {
                foreach (range($startWeek, $endWeek) as $week) {
                    WeeklyProgress::updateOrCreate(
                        [
                            'user_id' => $transaksi->user_id,
                            'week_number' => $week,
                        ],
                        [
                            'is_checked' => true,
                            'checked_at' => now()->toDateString(),
                        ]
                    );

                    SetoranHistory::firstOrCreate(
                        [
                            'transaksi_id' => $transaksi->id,
                            'week_number' => $week,
                        ],
                        [
                            'user_id' => $transaksi->user_id,
                            'staff_id' => $transaksi->staff_id,
                            'method' => 'transfer',
                            'action_type' => 'transfer_paid',
                            'recorded_at' => $transaksi->paid_at ?? now(),
                            'source_label' => 'Pembayaran transfer QRIS',
                        ]
                    );
                }
            }
        });
    }

    private function currentProgramWeek(User $user): int
    {
        $startedAt = $this->globalSavingStartDate();

        if (! $startedAt || $startedAt->isFuture()) {
            return 0;
        }

        $elapsedWeeks = (int) floor(
            $startedAt->startOfDay()->diffInWeeks(now()->startOfDay())
        );

        return min(52, max(1, $elapsedWeeks + 1));
    }

    private function nextPayableWeek(User $user): int
    {
        $user->loadMissing('weeklyProgress');

        for ($week = 1; $week <= 52; $week++) {
            $isCompleted = $user->weeklyProgress
                ->where('week_number', $week)
                ->where('is_checked', true)
                ->isNotEmpty();

            if (! $isCompleted) {
                return $week;
            }
        }

        return 53;
    }

    private function missedWeeks(User $user): int
    {
        $currentWeek = $this->currentProgramWeek($user);
        if ($currentWeek <= 0) {
            return 0;
        }

        $lastChecked = $user->weeklyProgress
            ->where('is_checked', true)
            ->where('week_number', '<=', 52)
            ->sortByDesc('week_number')
            ->first();

        $lastPaidWeek = $lastChecked?->week_number;

        return $lastPaidWeek
            ? max(0, $currentWeek - $lastPaidWeek)
            : $currentWeek;
    }

    private function midtransBaseUrl(): string
    {
        return config('services.midtrans.is_production')
            ? 'https://api.midtrans.com'
            : 'https://api.sandbox.midtrans.com';
    }

    private function globalSavingStartDate(): ?\Illuminate\Support\Carbon
    {
        $value = AppSetting::getValue('global_saving_started_at');

        return $value ? now()->parse($value) : null;
    }
}
