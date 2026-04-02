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

        $users = $staff->monitoredUsers()
            ->with(['weeklyProgress', 'savingPlan'])
            ->when($search !== '', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->get();

        return view('staff.monitoring.index', compact('users', 'search'));
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
