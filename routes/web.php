<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EquipmentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\ReturnController;

Route::get('/', fn () => auth()->check()
    ? redirect()->route('dashboard')
    : view('welcome'))->name('home');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/alat', [EquipmentController::class, 'index'])->name('alat.index');

    Route::middleware('role:admin')->group(function () {
        Route::get('/alat/create', [EquipmentController::class, 'create'])->name('alat.create');
        Route::post('/alat', [EquipmentController::class, 'store'])->name('alat.store');
        Route::get('/alat/{equipment}/edit', [EquipmentController::class, 'edit'])->name('alat.edit');
        Route::put('/alat/{equipment}', [EquipmentController::class, 'update'])->name('alat.update');
        Route::patch('/alat/{equipment}', [EquipmentController::class, 'update']);
        Route::delete('/alat/{equipment}', [EquipmentController::class, 'destroy'])->name('alat.destroy');
    });

    Route::get('/alat/{equipment}', [EquipmentController::class, 'show'])->name('alat.show');
    Route::resource('peminjaman', LoanController::class)->parameters(['peminjaman' => 'loan'])
        ->only(['index', 'create', 'store', 'show', 'destroy']);

    Route::middleware('role:admin')->group(function () {
        Route::resource('pengguna', UserController::class)->parameters(['pengguna' => 'user']);
        Route::patch('/peminjaman/{loan}/status', [LoanController::class, 'updateStatus'])->name('peminjaman.status');
        Route::get('/pengembalian', [ReturnController::class, 'index'])->name('pengembalian.index');
        Route::get('/pengembalian/{loan}/create', [ReturnController::class, 'create'])->name('pengembalian.create');
        Route::post('/pengembalian/{loan}', [ReturnController::class, 'store'])->name('pengembalian.store');
        Route::patch('/alat/{equipment}/stock', [EquipmentController::class, 'updateStock'])->name('alat.stock');
    });
});
