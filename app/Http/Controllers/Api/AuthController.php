<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SavingPlan;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function savingPlans()
    {
        $plans = SavingPlan::where('is_active', true)
            ->orderBy('weekly_amount')
            ->get(['id', 'name', 'weekly_amount']);

        return response()->json([
            'data' => $plans,
            'message' => 'Daftar paket aktif berhasil diambil.',
            'success' => true,
        ]);
    }

    // REGISTER
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'phone' => ['required', 'string', 'max:30', 'unique:users,phone'],
            'alamat' => ['required', 'string', 'max:1000'],
            'password' => ['required', 'min:6', 'confirmed'],
            'saving_plan_id' => ['required', 'exists:saving_plans,id'],
        ]);

        $user = DB::transaction(function () use ($request) {
            $staff = User::where('role', 'staff')
                ->withCount('monitoredUsers')
                ->having('monitored_users_count', '<', 50)
                ->orderBy('monitored_users_count', 'asc')
                ->lockForUpdate()
                ->first();

            if (!$staff) {
                throw ValidationException::withMessages([
                    'email' => 'Semua staff sudah memegang 50 pengguna. Silakan hubungi owner.',
                ]);
            }

            return User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'alamat' => $request->alamat,
                'password' => Hash::make($request->password),
                'role' => 'pengguna',
                'status' => 'approved',
                'is_active' => true,
                'assigned_staff_id' => $staff->id,
                'saving_plan_id' => $request->saving_plan_id,
            ]);
        });

        $token = $user->createToken('mobile')->plainTextToken;

        return response()->json([
            'message' => 'Register berhasil.',
            'user' => $user,
            'token' => $token,
        ], 201);
    }


    // LOGIN
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Email / password salah'
            ], 401);
        }

        if ($user->role !== 'pengguna') {
            return response()->json([
                'message' => 'Login mobile hanya untuk akun pengguna.'
            ], 403);
        }

        if (!$user->is_active) {
            return response()->json([
                'message' => 'Akun Anda sedang dinonaktifkan.'
            ], 403);
        }

        $token = $user->createToken('mobile')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token
        ]);
    }


    // LOGOUT
    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout sukses'
        ]);
    }
}
