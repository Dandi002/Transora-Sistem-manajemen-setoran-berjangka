<?php

namespace App\Http\Controllers;

use App\Models\AppSetting;
use App\Models\SetoranHistory;
use App\Models\WeeklyProgress;
use Illuminate\Http\Request;

class MonitoringController extends Controller
{
    public function monitoring(Request $request)
    {
        $staff = auth()->user();
        $search = trim((string) $request->query('search', ''));
        $users = $staff->monitoredUsers()
            ->with(['weeklyProgress', 'savingPlan', 'transaksis'])
            ->when($search !== '', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->get()
            ->map(function ($user) {
                $currentWeekNum = $this->currentProgramWeek($user);
                $done = $user->weeklyProgress->where('is_checked', true)->count();
                $hasStartedSaving = $currentWeekNum > 0;
                $hasCompletedSaving = $done >= 52;
                $paidTransferWeeks = $user->transaksis
                    ->whereIn('transaction_status', ['settlement', 'capture'])
                    ->flatMap(function ($transaksi) {
                        $payload = $transaksi->payment_payload ?? [];
                        $metadata = $payload['metadata'] ?? [];
                        $startWeek = (int) ($metadata['start_week'] ?? $transaksi->week_number ?? 1);
                        $endWeek = (int) ($metadata['end_week'] ?? $startWeek);

                        return range($startWeek, $endWeek);
                    })
                    ->unique()
                    ->values()
                    ->all();

                $lastChecked = $user->weeklyProgress
                    ->where('is_checked', true)
                    ->where('week_number', '<=', 52)
                    ->sortByDesc('week_number')
                    ->first();

                $lastWeek = $lastChecked?->week_number;
                $weeksAgo = $lastWeek
                    ? max(0, $currentWeekNum - $lastWeek)
                    : $currentWeekNum;

                if ($hasStartedSaving && ! $hasCompletedSaving && $weeksAgo >= 10) {
                    if ($user->is_active) {
                        $user->update(['is_active' => false]);
                    }
                    $user->is_active = false;
                }

                $user->progress_percent = round(($done / 52) * 100);
                $user->current_week_num = $currentWeekNum;
                $user->has_started_saving = $hasStartedSaving;
                $user->has_completed_saving = $hasCompletedSaving;
                $user->paid_transfer_weeks = $paidTransferWeeks;
                $user->last_paid_week = $lastWeek;
                $user->weeks_ago = $weeksAgo;

                if ($hasCompletedSaving) {
                    $user->payment_status = 'Selesai';
                    $user->payment_status_class = 'complete';
                } elseif (! $user->is_active && $weeksAgo >= 10) {
                    $user->payment_status = 'Diberhentikan';
                    $user->payment_status_class = 'critical';
                } elseif (! $hasStartedSaving) {
                    $user->payment_status = 'Belum Dimulai';
                    $user->payment_status_class = 'warning';
                } elseif ($weeksAgo >= 7) {
                    $user->payment_status = 'Kritis';
                    $user->payment_status_class = 'critical';
                } elseif ($weeksAgo >= 4) {
                    $user->payment_status = 'Waspada';
                    $user->payment_status_class = 'warning';
                } else {
                    $user->payment_status = 'Lancar';
                    $user->payment_status_class = 'safe';
                }

                return $user;
            });

        $currentWeekNum = (int) ($users->max('current_week_num') ?? 1);

        return view('staff.monitoring.index', compact('users', 'search', 'currentWeekNum'));
    }

    public function toggleWeek(Request $request)
    {
        $progress = WeeklyProgress::updateOrCreate(
            [
                'user_id'     => $request->user_id,
                'week_number' => $request->week_number,
            ],
            [
                'is_checked' => $request->is_checked,
                'checked_at' => now(),
            ]
        );

        if ((bool) $request->is_checked) {
            SetoranHistory::create([
                'user_id' => $request->user_id,
                'staff_id' => auth()->id(),
                'transaksi_id' => null,
                'week_number' => $request->week_number,
                'method' => 'manual',
                'action_type' => 'manual_check',
                'recorded_at' => $progress->updated_at ?? now(),
                'source_label' => 'Checklist manual staff',
            ]);
        } else {
            SetoranHistory::create([
                'user_id' => $request->user_id,
                'staff_id' => auth()->id(),
                'transaksi_id' => null,
                'week_number' => $request->week_number,
                'method' => 'manual',
                'action_type' => 'manual_uncheck',
                'recorded_at' => $progress->updated_at ?? now(),
                'source_label' => 'Checklist manual dibatalkan',
            ]);
        }

        return redirect()->back();
    }

    private function currentProgramWeek($user): int
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

    private function globalSavingStartDate(): ?\Illuminate\Support\Carbon
    {
        $value = AppSetting::getValue('global_saving_started_at');

        return $value ? now()->parse($value) : null;
    }
}
