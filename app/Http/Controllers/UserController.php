<?php
namespace App\Http\Controllers;

use App\Models\AppSetting;
use App\Models\SavingPlan;
use App\Models\SetoranHistory;
use App\Models\Transaksi;
use App\Models\User;
use App\Models\WeeklyProgress;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function index()
    {
        $users = User::latest()->paginate(10);
        $globalSavingStartedAt = AppSetting::getValue('global_saving_started_at');

        return view('owner.page.users.index', compact('users', 'globalSavingStartedAt'));
    }

    public function create()
    {
        $savingPlans = SavingPlan::where('is_active', true)
            ->orderBy('weekly_amount')
            ->get();

        return view('owner.page.users.create', compact('savingPlans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:225',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role'     => 'required|string',
            'saving_plan_id' => 'nullable|required_if:role,pengguna|exists:saving_plans,id',
        ]);

        DB::transaction(function () use ($request) {
            $assignedStaffId = null;

            if ($request->role === 'pengguna') {
                $staff = User::where('role', 'staff')
                    ->withCount('monitoredUsers')
                    ->having('monitored_users_count', '<', 50)
                    ->orderBy('monitored_users_count', 'asc')
                    ->lockForUpdate()
                    ->first();

                if (! $staff) {
                    throw ValidationException::withMessages([
                        'role' => 'Semua staff sudah memegang 50 pengguna. Tambahkan staff baru terlebih dahulu.',
                    ]);
                }

                $assignedStaffId = $staff->id;
            }

            User::create([
                'name'              => $request->name,
                'email'             => $request->email,
                'password'          => Hash::make($request->password),
                'role'              => $request->role,
                'status'            => 'pending',
                'is_active'         => true,
                'assigned_staff_id' => $assignedStaffId,
                'saving_plan_id'    => $request->role === 'pengguna' ? $request->saving_plan_id : null,
            ]);
        });

        return redirect()->route('owner.users.index')
            ->with('success', 'User berhasil ditambahkan');
    }

    public function edit(User $user)
    {
        $savingPlans = SavingPlan::where('is_active', true)
            ->orderBy('weekly_amount')
            ->get();

        return view('owner.page.users.edit', compact('user', 'savingPlans'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'     => 'required|string|max:225',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
            'role'     => 'required|string',
            'saving_plan_id' => 'nullable|required_if:role,pengguna|exists:saving_plans,id',
        ]);

        $data = $request->only('name', 'email', 'role');
        $data['saving_plan_id'] = $request->role === 'pengguna' ? $request->saving_plan_id : null;

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('owner.users.index')
            ->with('success', 'User berhasil diperbarui');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('owner.users.index')
            ->with('success', 'User berhasil dihapus');
    }

    public function toggleActive($id)
    {
        $user = User::findOrFail($id);

        // Owner tidak bisa dinonaktifkan
        if ($user->role === 'owner') {
            return response()->json([
                'message' => 'Owner tidak bisa dinonaktifkan',
            ], 403);
        }

        $user->is_active = ! $user->is_active;
        $user->save();

        return response()->json([
            'status'  => $user->is_active,
            'message' => 'Status berhasil diperbarui',
        ]);
    }

    public function resetDeposits()
    {
        DB::transaction(function () {
            SetoranHistory::query()->delete();
            Transaksi::query()->delete();
            WeeklyProgress::query()->update([
                'is_checked' => false,
                'checked_at' => null,
            ]);
            AppSetting::setValue('global_saving_started_at', null);
        });

        return redirect()
            ->route('owner.users.index')
            ->with('success', 'Semua setoran dan tanggal mulai global berhasil direset untuk kebutuhan testing.');
    }

    public function staffIndex()
    {
        $staffs = User::where('role', 'staff')
            ->withCount('monitoredUsers')
            ->get();

        return view('owner.page.staff.index', compact('staffs'));
    }

    public function staffShow($id)
    {
        $staff = User::where('id', $id)
            ->where('role', 'staff')
            ->firstOrFail();

        $search = trim((string) request('search', ''));
        $status = (string) request('status', 'all');
        $activity = (string) request('activity', 'all');

        $users = $staff->monitoredUsers()
            ->with(['weeklyProgress', 'savingPlan'])
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($inner) use ($search) {
                    $inner->where('name', 'like', '%' . $search . '%')
                        ->orWhere('email', 'like', '%' . $search . '%');
                });
            })
            ->when(in_array($status, ['pending', 'approved', 'rejected'], true), function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->when($activity === 'active', function ($query) {
                $query->where('is_active', true);
            })
            ->when($activity === 'inactive', function ($query) {
                $query->where('is_active', false);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $allAssignedUsers = $staff->monitoredUsers()
            ->with(['weeklyProgress', 'savingPlan'])
            ->get();

        $stats = $this->buildStaffStats($allAssignedUsers);

        return view('owner.page.staff.show', compact(
            'staff',
            'users',
            'search',
            'status',
            'activity',
            'stats'
        ));
    }

    private function buildStaffStats(Collection $users): array
    {
        $currentWeekNum = now()->weekOfYear;
        $capacityLimit = 50;

        $totalProgress = 0;
        $lateCount = 0;

        foreach ($users as $user) {
            $done = $user->weeklyProgress->where('is_checked', true)->count();
            $totalProgress += round(($done / 52) * 100);

            $lastChecked = $user->weeklyProgress
                ->where('is_checked', true)
                ->where('week_number', '<=', $currentWeekNum)
                ->sortByDesc('week_number')
                ->first();

            $weeksAgo = $lastChecked ? ($currentWeekNum - $lastChecked->week_number) : $currentWeekNum;
            if ($weeksAgo > 2) {
                $lateCount++;
            }
        }

        $totalAssigned = $users->count();
        $avgProgress = $totalAssigned > 0 ? round($totalProgress / $totalAssigned) : 0;
        $capacityPercent = min(100, round(($totalAssigned / $capacityLimit) * 100));

        return [
            'total_assigned' => $totalAssigned,
            'avg_progress' => $avgProgress,
            'late_count' => $lateCount,
            'capacity_limit' => $capacityLimit,
            'capacity_percent' => $capacityPercent,
            'remaining_capacity' => max(0, $capacityLimit - $totalAssigned),
        ];
    }
}
 
