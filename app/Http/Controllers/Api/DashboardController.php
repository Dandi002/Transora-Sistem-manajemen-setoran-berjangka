<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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

        $currentWeek = ((int) now()->weekOfYear - 1) % 52 + 1;
        $completedWeeks = $user->weeklyProgress
            ->where('is_checked', true)
            ->count();
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
                    'progress_percent' => $progressPercent,
                    'estimated_total' => $weeklyAmount * 52,
                    'estimated_collected' => $weeklyAmount * $completedWeeks,
                ],
            ],
            'message' => 'Dashboard pengguna berhasil diambil.',
            'success' => true,
        ]);
    }
}
