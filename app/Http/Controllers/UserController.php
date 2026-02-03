<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
         $users = User::latest()->paginate(10);
         return view('owner.page.users.index', compact('users'));
    }

    public function create()
    {
        return view('owner.page.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([

            'name' => 'required|string|max:225',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|string'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role
        ]);

        return redirect()->route('users.index')
        ->with('success', 'User berhasil ditambahkan');
    }

    public function edit(User $user)
    {
        return view('owner.page.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:225',
            'email' => 'required|email|unique:users,email'. $user->id,
            'password' => 'required|min:6',
            'role' => 'required|string'
        ]);

        $data = $request->only('name','email','role');

        if($request->has('password'))
        {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('users.index')
        ->with('success', 'User berhasil diperbarui');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index')
        ->with('success', 'User berhasil dihapus');
    }

    public function toggleActive($id)
{
    $user = User::findOrFail($id);

    // Cegah nonaktifkan owner (opsional tapi disarankan)
    if ($user->role === 'owner') {
        return response()->json([
            'message' => 'Owner tidak bisa dinonaktifkan'
        ], 403);
    }

    $user->is_active = !$user->is_active;
    $user->save();

    return response()->json([
        'status' => $user->is_active,
        'message' => 'Status berhasil diperbarui'
    ]);
}

}
