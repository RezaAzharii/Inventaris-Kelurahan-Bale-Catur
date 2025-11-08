<?php

use App\Http\Controllers\AsetController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    //ASET
    Route::get('/aset', [AsetController::class, 'index'])->name('aset.index');
    Route::post('/aset', [AsetController::class, 'store'])->name('aset.store');
    Route::put('/aset/{id_aset}', [AsetController::class, 'edit'])->name('aset.edit');
    Route::delete('/aset/{id_aset}', [AsetController::class, 'destroy'])->name('aset.destroy');
    

    Route::get('/users', function () {
        return 'Users list';
    })->name('users.index');
    Route::get('/peminjamans', function () {
        return 'Peminjaman list';
    })->name('peminjamans.index');
    Route::get('/users/create', function () {
        return 'Add user form';
    })->name('users.create');
    Route::get('/reports', function () {
        return 'Reports page';
    })->name('reports.index');
});