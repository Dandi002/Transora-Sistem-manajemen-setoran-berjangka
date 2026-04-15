<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AppSetting;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function show(Request $request)
    {
        $user = $request->user()->load([
            'savingPlan:id,name,weekly_amount',
            'assignedStaff:id,name,email,phone',
            'weeklyProgress',
        ]);

        $globalStartDate = $this->globalSavingStartDate();
        $hasStarted = $globalStartDate !== null && ! $globalStartDate->isFuture();
        $currentWeek = $this->currentProgramWeek($user);
        $completedWeeks = $user->weeklyProgress
            ->where('is_checked', true)
            ->count();
        $hasCompleted = $completedWeeks >= 52;
        $lastChecked = $user->weeklyProgress
            ->where('is_checked', true)
            ->where('week_number', '<=', 52)
            ->sortByDesc('week_number')
            ->first();
        $lastPaidWeek = $lastChecked?->week_number;
        $missedWeeks = $hasStarted
            ? ($lastPaidWeek ? max(0, $currentWeek - $lastPaidWeek) : $currentWeek)
            : 0;

        if ($hasStarted && ! $hasCompleted && $missedWeeks >= 10 && $user->is_active) {
            $user->forceFill(['is_active' => false])->save();
            $user->refresh();
        }

        $remainingWeeks = max(0, 52 - $completedWeeks);
        $progressPercent = (int) round(($completedWeeks / 52) * 100);
        $weeklyAmount = (int) ($user->savingPlan?->weekly_amount ?? 0);

        return response()->json([
            'data' => [
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'alamat' => $user->alamat,
                    'role' => $user->role,
                    'status' => $user->status,
                    'is_active' => (bool) $user->is_active,
                    'has_started_saving' => $hasStarted,
                    'saving_started_at' => $globalStartDate?->toDateString(),
                    'profile_photo_url' => $user->profile_photo_path
                        ? url(\Illuminate\Support\Facades\Storage::url($user->profile_photo_path))
                        : null,
                ],
                'saving_plan' => [
                    'name' => $user->savingPlan?->name ?? '-',
                    'weekly_amount' => $weeklyAmount,
                ],
                'assigned_staff' => [
                    'name' => $user->assignedStaff?->name ?? '-',
                    'email' => $user->assignedStaff?->email,
                    'phone' => $user->assignedStaff?->phone,
                ],
                'progress' => [
                    'current_week' => $currentWeek,
                    'completed_weeks' => $completedWeeks,
                    'remaining_weeks' => $remainingWeeks,
                    'missed_weeks' => $missedWeeks,
                    'progress_percent' => $progressPercent,
                    'estimated_total' => $weeklyAmount * 52,
                    'estimated_collected' => $weeklyAmount * $completedWeeks,
                    'has_started' => $hasStarted,
                    'has_completed' => $hasCompleted,
                ],
            ],
            'message' => 'Dashboard pengguna berhasil diambil.',
            'success' => true,
        ]);
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

    private function globalSavingStartDate(): ?\Illuminate\Support\Carbon
    {
        $value = AppSetting::getValue('global_saving_started_at');

        return $value ? now()->parse($value) : null;
    }
}
