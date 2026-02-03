<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function create()
    {
        return view('auth.register-pengguna');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'phone'    => 'required|unique:users',
            'alamat'   => 'required',
            'password' => 'required|min:6|confirmed',
        ]);

        User::create([
            'name'      => $request->name,
            'phone'     => $request->phone,
            'alamat'    => $request->alamat,
            'password'  => Hash::make($request->password),

            'role'      => 'user',
            'status'    => 'pending',
            'is_active' => true,
        ]);

        return back()->with('success', 'Akun berhasil dibuat, tunggu approval owner.');
    }
}

