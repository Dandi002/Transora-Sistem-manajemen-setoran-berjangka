<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WeeklyProgress; // ← ini yang kurang

class MonitoringController extends Controller
{
    public function monitoring(Request $request)
    {
        $staff = auth()->user();
        $search = trim((string) $request->query('search', ''));
        $currentWeekNum = ((int) now()->weekOfYear - 1) % 52 + 1;

        $users = $staff->monitoredUsers()
            ->with(['weeklyProgress', 'savingPlan'])
            ->when($search !== '', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->get()
            ->map(function ($user) use ($currentWeekNum) {
                $done = $user->weeklyProgress->where('is_checked', true)->count();
                $user->progress_percent = round(($done / 52) * 100);

                $lastChecked = $user->weeklyProgress
                    ->where('is_checked', true)
                    ->where('week_number', '<=', 52)
                    ->sortByDesc('week_number')
                    ->first();

                $lastWeek = $lastChecked?->week_number;
                $user->last_paid_week = $lastWeek;
                $user->weeks_ago = $lastWeek
                    ? ($currentWeekNum >= $lastWeek
                        ? ($currentWeekNum - $lastWeek)
                        : ((52 - $lastWeek) + $currentWeekNum))
                    : 52;

                if ($user->weeks_ago >= 5) {
                    $user->payment_status = 'Kritis';
                    $user->payment_status_class = 'critical';
                } elseif ($user->weeks_ago >= 2) {
                    $user->payment_status = 'Waspada';
                    $user->payment_status_class = 'warning';
                } else {
                    $user->payment_status = 'Lancar';
                    $user->payment_status_class = 'safe';
                }

                return $user;
            });

        return view('staff.monitoring.index', compact('users', 'search', 'currentWeekNum'));
    }

    public function toggleWeek(Request $request)
    {
        WeeklyProgress::updateOrCreate(
            [
                'user_id'     => $request->user_id,
                'week_number' => $request->week_number,
            ],
            [
                'is_checked' => $request->is_checked,
                'checked_at' => now(),
            ]
        );

        return redirect()->back(); // pakai redirect karena form biasa (bukan AJAX)
    }
}
