<?php

namespace App\Http\Controllers;

use App\Models\AppSetting;
use Illuminate\Http\Request;

class AppSettingController extends Controller
{
    public function updateGlobalSavingStart(Request $request)
    {
        $validated = $request->validate([
            'global_saving_started_at' => ['required', 'date'],
        ]);

        AppSetting::setValue('global_saving_started_at', $validated['global_saving_started_at']);

        return redirect()
            ->route('owner.users.index')
            ->with('success', 'Tanggal mulai setoran global berhasil disimpan.');
    }
}
