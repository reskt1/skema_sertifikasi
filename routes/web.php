<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\SkemaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('halaman_welcome');
});

Route::get('/login',[AuthController::class,'showLogin'])->name('login');
Route::post('/login',[AuthController::class,'login'])->name('login.process');
Route::get('/register',[AuthController::class,'showRegister'])->name('register');
Route::post('/register',[AuthController::class,'register'])->name('register.process');
Route::post('/logout',[AuthController::class,'logout'])->name('logout');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function() {
        $jumlahSkema = \App\Models\Skema::count();
        $jumlahPeserta = \App\Models\Peserta::count();
        return view('dashboard', compact('jumlahSkema', 'jumlahPeserta'));
    })->name('dashboard');

    // 1. Rute Index (Daftar Data) - Taruh di atas
    Route::get('/skema', [SkemaController::class, 'index'])->name('skema.index');
    Route::get('/peserta', [PesertaController::class, 'index'])->name('peserta.index');

});

Route::middleware(['auth', 'role:admin'])->group(function () {

    // 2. Rute Tulis / Tambah Data (Tanpa kurung kurawal) - Taruh di tengah
    Route::get('/skema/create', [SkemaController::class, 'create'])->name('skema.create');
    Route::post('/skema', [SkemaController::class, 'store'])->name('skema.store');

    Route::get('/peserta/create', [PesertaController::class, 'create'])->name('peserta.create');
    Route::post('/peserta', [PesertaController::class, 'store'])->name('peserta.store');

    // 3. Rute Aksi Spesifik Admin (Menggunakan kurung kurawal)
    Route::get('/skema/{skema}/edit', [SkemaController::class, 'edit'])->name('skema.edit');
    Route::put('/skema/{skema}', [SkemaController::class, 'update'])->name('skema.update');
    Route::delete('/skema/{skema}', [SkemaController::class, 'destroy'])->name('skema.destroy');

    Route::get('/peserta/{peserta}/edit', [PesertaController::class, 'edit'])->name('peserta.edit');
    Route::put('/peserta/{peserta}', [PesertaController::class, 'update'])->name('peserta.update');
    Route::delete('/peserta/{peserta}', [PesertaController::class, 'destroy'])->name('peserta.destroy');

});


Route::middleware('auth')->group(function () {
    Route::get('/skema/{skema}', [SkemaController::class, 'show'])->name('skema.show');
    Route::get('/peserta/{peserta}', [PesertaController::class, 'show'])->name('peserta.show');
});
