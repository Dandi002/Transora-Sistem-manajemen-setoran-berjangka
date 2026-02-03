<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\RegisterController;



/*
|--------------------------------------------------------------------------
| Landing Page (Publik)
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('landing.home');
});
Route::get('detail-sistem', function () {
    return view('landing.detail-sistem');
});


/*
|--------------------------------------------------------------------------
| Dashboard Redirect (Role Based)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    $role = auth()->user()->role;

    return match ($role) {
        'owner'  => redirect()->route('owner.dashboard'),
        'admin'  => redirect()->route('admin.dashboard'),
        'staff' => redirect()->route('seller.dashboard'),
       
    };
})->middleware('auth')->name('dashboard');

/*
|--------------------------------------------------------------------------
| Dashboard OWNER
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:owner'])
    ->prefix('owner')
    ->name('owner.')
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('owner.dashboard');
        })->name('dashboard');
    });


/*
|--------------------------------------------------------------------------
| Dashboard SELLER
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:staff'])
    ->prefix('seller')
    ->name('seller.')
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('seller.dashboard');
        })->name('dashboard');
    });

Route::resource('users', UserController::class);
Route::post('/users/{id}/toggle-active', [UserController::class, 'toggleActive'])
    ->name('users.toggle-active');

/*
|--------------------------------------------------------------------------
| Profile (Breeze)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Auth Routes (Login, Register, dll)
|--------------------------------------------------------------------------
*/
Route::get('/user-register', [RegisterController::class, 'create']);
Route::post('/user-register', [RegisterController::class, 'store']);
require __DIR__ . '/auth.php';

