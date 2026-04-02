<?php

namespace App\Http\Controllers;

use App\Models\SavingPlan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SavingPlanController extends Controller
{
    public function index(): View
    {
        $plans = SavingPlan::orderBy('weekly_amount')->paginate(10);

        return view('owner.page.saving-plans.index', compact('plans'));
    }

    public function create(): View
    {
        return view('owner.page.saving-plans.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'weekly_amount' => ['required', 'integer', 'min:1000', 'max:100000000', 'unique:saving_plans,weekly_amount'],
            'is_active' => ['nullable', 'boolean'],
        ]);

        SavingPlan::create([
            'name' => $validated['name'],
            'weekly_amount' => $validated['weekly_amount'],
            'is_active' => (bool) ($validated['is_active'] ?? true),
        ]);

        return redirect()->route('owner.saving-plans.index')
            ->with('success', 'Paket berhasil ditambahkan.');
    }

    public function edit(SavingPlan $savingPlan): View
    {
        return view('owner.page.saving-plans.edit', compact('savingPlan'));
    }

    public function update(Request $request, SavingPlan $savingPlan): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'weekly_amount' => ['required', 'integer', 'min:1000', 'max:100000000', 'unique:saving_plans,weekly_amount,' . $savingPlan->id],
            'is_active' => ['nullable', 'boolean'],
        ]);

        $isActive = (bool) ($validated['is_active'] ?? false);
        if (! $isActive && $savingPlan->is_active && SavingPlan::where('is_active', true)->count() <= 1) {
            return back()->withErrors([
                'is_active' => 'Minimal harus ada 1 paket aktif.',
            ])->withInput();
        }

        $savingPlan->update([
            'name' => $validated['name'],
            'weekly_amount' => $validated['weekly_amount'],
            'is_active' => $isActive,
        ]);

        return redirect()->route('owner.saving-plans.index')
            ->with('success', 'Paket berhasil diperbarui.');
    }

    public function toggleActive(SavingPlan $savingPlan): RedirectResponse
    {
        if ($savingPlan->is_active && SavingPlan::where('is_active', true)->count() <= 1) {
            return back()->withErrors([
                'saving_plan' => 'Minimal harus ada 1 paket aktif.',
            ]);
        }

        $savingPlan->is_active = ! $savingPlan->is_active;
        $savingPlan->save();

        return back()->with('success', 'Status paket berhasil diperbarui.');
    }

    public function destroy(SavingPlan $savingPlan): RedirectResponse
    {
        if ($savingPlan->users()->exists()) {
            return back()->withErrors([
                'saving_plan' => 'Paket tidak bisa dihapus karena masih dipakai pengguna.',
            ]);
        }

        if ($savingPlan->is_active && SavingPlan::where('is_active', true)->count() <= 1) {
            return back()->withErrors([
                'saving_plan' => 'Minimal harus ada 1 paket aktif.',
            ]);
        }

        $savingPlan->delete();

        return back()->with('success', 'Paket berhasil dihapus.');
    }
}
