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
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/aset/{id_aset}', [AsetController::class, 'show'])->name('aset.show');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    //ASET
    Route::get('/aset', [AsetController::class, 'index'])->name('aset.index');
    Route::post('/aset', [AsetController::class, 'store'])->name('aset.store');
    Route::get('/aset/{id_aset}/edit', [AsetController::class, 'edit'])->name('aset.edit');
    Route::put('/aset/{id_aset}', [AsetController::class, 'update'])->name('aset.update');
    Route::delete('/aset/{id_aset}', [AsetController::class, 'destroy'])->name('aset.destroy');
    
   // PEMINJAMAN
    Route::get('/peminjamans', [PeminjamanController::class, 'index'])->name('peminjaman.index');
    Route::get('/peminjaman/create', [PeminjamanController::class, 'create'])->name('peminjaman.create');
    Route::post('/peminjaman', [PeminjamanController::class, 'store'])->name('peminjaman.store');

    Route::get('/peminjaman/{id}/edit', [PeminjamanController::class, 'edit'])->name('peminjaman.edit');   // BENAR
    Route::put('/peminjaman/{id}', [PeminjamanController::class, 'update'])->name('peminjaman.update');   // UPDATE

    Route::delete('/peminjaman/{id}', [PeminjamanController::class, 'destroy'])->name('peminjaman.destroy');

    // Peminjam
    // PEMINJAM - TAMPILKAN LIST
    Route::get('/peminjam', [PeminjamController::class, 'index'])
    ->name('peminjam.index');
    Route::get('/peminjam/create', [PeminjamController::class, 'create'])
    ->name('peminjam.create');

    // SIMPAN PEMINJAM BARU
    Route::post('/peminjam', [PeminjamController::class, 'store'])
    ->name('peminjam.store');

    // DETAIL PEMINJAM
    Route::get('/peminjam/{id}', [PeminjamController::class, 'show'])
    ->name('peminjam.show');

    // EDIT PEMINJAM
    Route::get('/peminjam/{id}/edit', [PeminjamController::class, 'edit'])
    ->name('peminjam.edit');

    // UPDATE PEMINJAM
    Route::put('/peminjam/{id}', [PeminjamController::class, 'update'])
    ->name('peminjam.update');

    // HAPUS PEMINJAM
    Route::delete('/peminjam/{id}', [PeminjamController::class, 'destroy'])
    ->name('peminjam.destroy');


    // Route::get('/users', function () {
    //     return 'Users list';
    // })->name('users.index');
    //Route::get('/peminjaman', function () {
    //    return view('peminjaman.index');
    //})->name('peminjaman.index');
    Route::get('/users/create', function () {
         return 'Add user form';
    })->name('users.create');
    Route::get('/reports', function () {
        return 'Reports page';
    })->name('reports.index');
});