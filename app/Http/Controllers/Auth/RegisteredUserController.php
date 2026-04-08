<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\SavingPlan;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        $savingPlans = SavingPlan::where('is_active', true)
            ->orderBy('weekly_amount')
            ->get();

        return view('auth.register', compact('savingPlans'));
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'phone' => ['required', 'string', 'max:30', 'unique:users,phone'],
            'alamat' => ['required', 'string', 'max:1000'],
            'password' => ['required', 'confirmed', 'min:6'],
            'saving_plan_id' => ['nullable', 'exists:saving_plans,id'],
        ]);

        DB::transaction(function () use ($request) {
            $staff = User::where('role', 'staff')
                ->withCount('monitoredUsers')
                ->having('monitored_users_count', '<', 50)
                ->orderBy('monitored_users_count', 'asc')
                ->lockForUpdate()
                ->first();

            if (! $staff) {
                throw ValidationException::withMessages([
                    'email' => 'Semua staff sudah memegang 50 pengguna. Silakan hubungi owner.',
                ]);
            }

            $defaultPlanId = SavingPlan::where('is_active', true)
                ->orderBy('weekly_amount')
                ->value('id');

            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'alamat' => $request->alamat,
                'password' => Hash::make($request->password),
                'role' => 'pengguna',
                'status' => 'approved',
                'is_active' => true,
                'assigned_staff_id' => $staff->id,
                'saving_plan_id' => $request->saving_plan_id ?: $defaultPlanId,
            ]);
        });

        return back()->with('success', 'Akun telah dibuat, silakan login Transora Mobile di device mobile Anda.');
    }
}
