<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\View\View;
use App\Models\Transaksi;


class DashboardController extends Controller
{
    public function owner(): View
    {
        $currentWeek = ((int) now()->weekOfYear - 1) % 52 + 1;

        $totalPenggunaAktif = User::query()
            ->where('role', 'pengguna')
            ->where('is_active', true)
            ->count();

        $totalStaff = User::query()
            ->where('role', 'staff')
            ->where('is_active', true)
            ->count();

        $userMenunggak = User::query()
            ->where('role', 'pengguna')
            ->where('is_active', true)
            ->whereDoesntHave('weeklyProgress', function ($query) use ($currentWeek) {
                $query->where('week_number', $currentWeek)
                    ->where('is_checked', true);
            })
            ->count();

        $staffTerpadat = User::query()
            ->where('role', 'staff')
            ->where('is_active', true)
            ->withCount('monitoredUsers')
            ->orderByDesc('monitored_users_count')
            ->first();

        return view('owner.dashboard', [
            'kpi' => [
                'current_week' => $currentWeek,
                'total_pengguna_aktif' => $totalPenggunaAktif,
                'total_staff' => $totalStaff,
                'user_menunggak' => $userMenunggak,
                'staff_terpadat_nama' => $staffTerpadat?->name ?? '-',
                'staff_terpadat_total' => $staffTerpadat?->monitored_users_count ?? 0,
            ],
        ]);
    }

    public function staff(): View
    {
        $staff = auth()->user();
        $currentWeek = ((int) now()->weekOfYear - 1) % 52 + 1;

        $totalUserDipegang = $staff->monitoredUsers()
            ->where('is_active', true)
            ->count();

        $sudahSetorMingguIni = $staff->monitoredUsers()
            ->where('is_active', true)
            ->whereHas('weeklyProgress', function ($query) use ($currentWeek) {
                $query->where('week_number', $currentWeek)
                    ->where('is_checked', true);
            })
            ->count();
            
            $staff = auth()->user();

$totalSaldoDiterima = Transaksi::query()
    ->whereIn('transaction_status', ['settlement', 'capture'])
    ->whereHas('user', function ($query) use ($staff) {
        $query->where('assigned_staff_id', $staff->id);
    })
    ->sum('gross_amount');


        $belumSetorMingguIni = max(0, $totalUserDipegang - $sudahSetorMingguIni);
        $kapasitasMaksimal = 50;
        $kapasitasTerpakai = $kapasitasMaksimal > 0
            ? round(($totalUserDipegang / $kapasitasMaksimal) * 100)
            : 0;

        return view('staff.dashboard', [
            'kpi' => [
                'current_week' => $currentWeek,
                'total_user_dipegang' => $totalUserDipegang,
                'sudah_setor_minggu_ini' => $sudahSetorMingguIni,
                'belum_setor_minggu_ini' => $belumSetorMingguIni,
                'kapasitas_terpakai' => $kapasitasTerpakai,
                'kapasitas_maksimal' => $kapasitasMaksimal,
                'total_saldo_diterima' => $totalSaldoDiterima,

            ],
        ]);
        
    }
}

