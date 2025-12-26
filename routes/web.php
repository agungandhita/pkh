<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\KriteriaController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\PengaturanController;
use App\Http\Controllers\Admin\PenilaianController;
use App\Http\Controllers\Admin\SawController;
use App\Http\Controllers\Admin\SubKriteriaController;
use App\Http\Controllers\Admin\WargaController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('admin.dashboard');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'create'])->name('login');
    Route::post('/login', [AuthController::class, 'store'])->name('login.store');
});

Route::post('/logout', [AuthController::class, 'destroy'])->middleware('auth')->name('logout');

Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('warga', WargaController::class)->except(['show']);
    Route::resource('kriteria', KriteriaController::class)->except(['show']);
    Route::resource('kriteria.sub-kriteria', SubKriteriaController::class)->shallow()->except(['show']);

    Route::get('penilaian', [PenilaianController::class, 'index'])->name('penilaian.index');
    Route::get('penilaian/{warga}', [PenilaianController::class, 'edit'])->name('penilaian.edit');
    Route::put('penilaian/{warga}', [PenilaianController::class, 'update'])->name('penilaian.update');

    Route::get('saw', [SawController::class, 'index'])->name('saw.index');
    Route::post('saw/hitung', [SawController::class, 'hitung'])->name('saw.hitung');

    Route::get('hasil', [SawController::class, 'hasil'])->name('hasil.index');

    Route::get('laporan', [LaporanController::class, 'index'])->name('laporan.index');
    Route::get('laporan/pdf', [LaporanController::class, 'pdf'])->name('laporan.pdf');

    Route::get('pengaturan', [PengaturanController::class, 'edit'])->name('pengaturan.edit');
    Route::put('pengaturan', [PengaturanController::class, 'update'])->name('pengaturan.update');
});
