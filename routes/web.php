<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SavingPlanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserVerificationController;
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

        Route::get('/dashboard', fn() => view('owner.dashboard'))
            ->name('dashboard');

        // Verifikasi user
        Route::get('/user-verifikasi', [UserVerificationController::class, 'index'])
            ->name('verifikasi-user');

        Route::post('/user-verifikasi/{id}/approve', [UserVerificationController::class, 'approve'])
            ->name('verifikasi.approve');

        Route::post('/user-verifikasi/{id}/reject', [UserVerificationController::class, 'reject'])
            ->name('verifikasi.reject');

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

        Route::get('/dashboard', fn() => view('staff.dashboard'))
            ->name('dashboard');
            Route::get('/monitoring', [MonitoringController::class, 'monitoring'])
    ->name('monitoring.index'); 
    Route::post('/monitoring/check', [MonitoringController::class, 'toggleWeek'])
    ->name('monitoring.check');

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
