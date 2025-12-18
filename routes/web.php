<?php

use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PeminjamController;
use App\Http\Controllers\AsetController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/password/reset', [AuthController::class, 'forgotPasswordForm'])->name('auth.passwords.email');
Route::post('/password/email', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/password/reset/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/reset', [AuthController::class, 'resetPassword'])->name('password.update');

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    //Profile User
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    //export excel
    Route::get('/peminjaman/export', [PeminjamanController::class, 'export'])
        ->name('peminjaman.export');
    Route::get('/peminjam/export', [PeminjamController::class, 'export'])
        ->name('peminjam.export');
    Route::get('/aset/export', [AsetController::class, 'export'])
        ->name('aset.export');


    Route::get('/profile/change-password', [AuthController::class, 'changePasswordForm'])->name('password.change');
    Route::post('/profile/change-password', [AuthController::class, 'updatePassword'])->name('password.update.profile');

    //ASET
    Route::get('/aset', [AsetController::class, 'index'])->name('aset.index');
    Route::post('/aset', [AsetController::class, 'store'])->name('aset.store');
    Route::get('/aset/{id_aset}/edit', [AsetController::class, 'edit'])->name('aset.edit');
    Route::put('/aset/{id_aset}', [AsetController::class, 'update'])->name('aset.update');
    Route::delete('/aset/{id_aset}', [AsetController::class, 'destroy'])->name('aset.destroy');
    Route::get('/aset/{id_aset}', [AsetController::class, 'show'])->name('aset.show');

    // Peminjaman
    Route::get('/peminjaman', [PeminjamanController::class, 'index'])
        ->name('peminjaman.index');
    Route::post('/peminjaman', [PeminjamanController::class, 'store'])
        ->name('peminjaman.store');
    Route::get('/peminjaman/{id}', [PeminjamanController::class, 'show'])
        ->name('peminjaman.show');
    Route::get('/peminjaman/{id}/edit', [PeminjamanController::class, 'edit'])
        ->name('peminjaman.edit');
    Route::put('/peminjaman/{id}', [PeminjamanController::class, 'update'])
        ->name('peminjaman.update');
    Route::delete('/peminjaman/{id}', [PeminjamanController::class, 'destroy'])
        ->name('peminjaman.destroy');

    // Peminjam
    Route::get('/peminjam', [PeminjamController::class, 'index'])
        ->name('peminjam.index');
    Route::get('/peminjam/create', [PeminjamController::class, 'create'])
        ->name('peminjam.create');
    Route::post('/peminjam', [PeminjamController::class, 'store'])
        ->name('peminjam.store');
    Route::get('/peminjam/{id}', [PeminjamController::class, 'show'])
        ->name('peminjam.show');
    Route::get('/peminjam/{id}/edit', [PeminjamController::class, 'edit'])
        ->name('peminjam.edit');
    Route::put('/peminjam/{id}', [PeminjamController::class, 'update'])
        ->name('peminjam.update');
    Route::delete('/peminjam/{id}', [PeminjamController::class, 'destroy'])
        ->name('peminjam.destroy');
});