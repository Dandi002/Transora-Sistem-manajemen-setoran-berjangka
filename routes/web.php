<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AppSettingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SavingPlanController;
use App\Http\Controllers\SetoranHistoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MonitoringController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Landing Page
|--------------------------------------------------------------------------
*/
Route::get('/', fn() => view('landing.home'));
Route::get('/detail-sistem', fn() => view('landing.detail-sistem'))
    ->name('detail-sistem');
Route::get('/ketentuan', fn() => view('landing.ketentuan'))
    ->name('ketentuan');

/*
|--------------------------------------------------------------------------
| Dashboard Redirect
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->get('/dashboard', function () {
    return match (auth()->user()->role) {
        'owner' => redirect()->route('owner.dashboard'),
        'staff' => redirect()->route('staff.dashboard'),
        default => redirect('/'),
    };
})->name('dashboard');

/*
|--------------------------------------------------------------------------
| OWNER ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:owner'])
    ->prefix('owner')
    ->name('owner.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'owner'])
            ->name('dashboard');

        // CRUD users
        Route::resource('users', UserController::class);

        // Data staff
        Route::get('/staff', [UserController::class, 'staffIndex'])
            ->name('staff.index');

        Route::get('/staff/{id}', [UserController::class, 'staffShow'])
            ->name('staff.show');

        // Toggle active
        Route::post('/users/{id}/toggle-active', [UserController::class, 'toggleActive'])
            ->name('users.toggle-active');
        Route::post('/users/reset-deposits', [UserController::class, 'resetDeposits'])
            ->name('users.reset-deposits');
        Route::post('/settings/global-saving-start', [AppSettingController::class, 'updateGlobalSavingStart'])
            ->name('settings.global-saving-start');
        Route::get('/transaction-histories', [SetoranHistoryController::class, 'ownerIndex'])
            ->name('transaction-histories.index');

        // Master paket
        Route::get('/saving-plans', [SavingPlanController::class, 'index'])
            ->name('saving-plans.index');
        Route::get('/saving-plans/create', [SavingPlanController::class, 'create'])
            ->name('saving-plans.create');
        Route::post('/saving-plans', [SavingPlanController::class, 'store'])
            ->name('saving-plans.store');
        Route::get('/saving-plans/{savingPlan}/edit', [SavingPlanController::class, 'edit'])
            ->name('saving-plans.edit');
        Route::put('/saving-plans/{savingPlan}', [SavingPlanController::class, 'update'])
            ->name('saving-plans.update');
        Route::post('/saving-plans/{savingPlan}/toggle-active', [SavingPlanController::class, 'toggleActive'])
            ->name('saving-plans.toggle-active');
        Route::delete('/saving-plans/{savingPlan}', [SavingPlanController::class, 'destroy'])
            ->name('saving-plans.destroy');
    });

/*
|--------------------------------------------------------------------------
| STAFF ROUTES
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:staff'])
    ->prefix('staff')
    ->name('staff.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'staff'])
            ->name('dashboard');

        Route::get('/monitoring', [MonitoringController::class, 'monitoring'])
            ->name('monitoring.index');
        Route::post('/monitoring/check', [MonitoringController::class, 'toggleWeek'])
            ->name('monitoring.check');
        Route::get('/setoran-histories', [SetoranHistoryController::class, 'index'])
            ->name('setoran-histories.index');

        // Master paket (staff hanya lihat)
        Route::get('/saving-plans', [SavingPlanController::class, 'index'])
            ->name('saving-plans.index');
    });

/*
|--------------------------------------------------------------------------
| PROFILE
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/
Route::get('/user-register', [RegisterController::class, 'create'])
    ->name('user-register');

Route::post('/user-register', [RegisterController::class, 'store'])
    ->name('user-register.store');


require __DIR__ . '/auth.php';
