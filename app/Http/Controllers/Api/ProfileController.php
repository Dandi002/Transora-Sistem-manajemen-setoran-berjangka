<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        $user = $request->user()->load(['savingPlan:id,name,weekly_amount', 'assignedStaff:id,name,email,phone']);

        return response()->json([
            'data' => $this->transformUser($user),
            'message' => 'Profil pengguna berhasil diambil.',
            'success' => true,
        ]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'phone' => [
                'nullable',
                'string',
                'max:30',
                Rule::unique('users', 'phone')->ignore($request->user()->id),
            ],
            'alamat' => ['nullable', 'string', 'max:1000'],
            'avatar' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'remove_avatar' => ['nullable', 'boolean'],
        ]);

        $removeAvatar = (bool) ($validated['remove_avatar'] ?? false);
        unset($validated['avatar'], $validated['remove_avatar']);

        $user = $request->user();
        $user->fill($validated);

        if ($request->hasFile('avatar')) {
            if ($user->profile_photo_path) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }

            $user->profile_photo_path = $request->file('avatar')->store('avatars', 'public');
        } elseif ($removeAvatar && $user->profile_photo_path) {
            Storage::disk('public')->delete($user->profile_photo_path);
            $user->profile_photo_path = null;
        }

        $user->save();
        $user->load(['savingPlan:id,name,weekly_amount', 'assignedStaff:id,name,email,phone']);

        return response()->json([
            'data' => $this->transformUser($user),
            'message' => 'Profil berhasil diperbarui.',
            'success' => true,
        ]);
    }

    private function transformUser($user): array
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'phone' => $user->phone,
            'alamat' => $user->alamat,
            'role' => $user->role,
            'status' => $user->status,
            'is_active' => (bool) $user->is_active,
            'profile_photo_url' => $user->profile_photo_path
                ? url(Storage::url($user->profile_photo_path))
                : null,
            'saving_plan' => [
                'name' => $user->savingPlan?->name ?? '-',
                'weekly_amount' => (int) ($user->savingPlan?->weekly_amount ?? 0),
            ],
            'assigned_staff' => [
                'name' => $user->assignedStaff?->name ?? '-',
                'email' => $user->assignedStaff?->email,
                'phone' => $user->assignedStaff?->phone,
            ],
        ];
    }
}
