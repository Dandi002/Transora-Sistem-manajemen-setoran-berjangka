<?php

// namespace App\Http\Controllers;

// use App\Models\User;

// class UserVerificationController extends Controller
// {
//     // tampilkan pending
//     public function index()
//     {
//         $users = User::where('role', 'pengguna')
//     ->where('status', 'pending')
//     ->get();
   

//         return view('owner.page.verifikasi-user.index', compact('users'));
//     }

//     // approve
//     public function approve($id)
//     {
//         $user = User::findOrFail($id);

//         $user->update([
//             'status' => 'approved',
//             'is_active' => true
//         ]);

//         return back()->with('success', 'User approved');
//     }

//     // reject
//     public function reject($id)
//     {
//         $user = User::findOrFail($id);

//         $user->update([
//             'status' => 'rejected'
//         ]);

//         return back()->with('success', 'User rejected');
//     }
// }

