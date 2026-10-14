<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\PesertaProfileController;
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

    Route::get('/dashboard', [AdminController::class, 'index'])->middleware(['auth', 'role:admin'])->name('dashboard');

    Route::get('/peserta/profile', [PesertaProfileController::class, 'index'])->name('peserta.profile');

    Route::get('/peserta/profile/edit', [PesertaProfileController::class, 'edit'])->name('peserta.profile.profile_edit');

    Route::put('/peserta/profile/{id}', [PesertaProfileController::class, 'update'])->name('peserta.profile.update');

    Route::get('/skema', [SkemaController::class, 'index'])->name('skema.index');
    Route::get('/peserta', [PesertaController::class, 'index'])->name('peserta.index');

    Route::get('/peserta/profile', [PesertaProfileController::class, 'index'])->name('peserta.profile');
    Route::put('/peserta/profile/{id}', [PesertaProfileController::class, 'update'])->name('peserta.profile.update');

});

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::patch('/admin/peserta/{id}/verifikasi', [AdminController::class, 'verifikasi'])->name('admin.peserta.verifikasi');

    Route::get('/skema/create', [SkemaController::class, 'create'])->name('skema.create');
    Route::post('/skema', [SkemaController::class, 'store'])->name('skema.store');

    Route::get('/skema/{skema}/edit', [SkemaController::class, 'edit'])->name('skema.edit');
    Route::put('/skema/{skema}', [SkemaController::class, 'update'])->name('skema.update');
    Route::delete('/skema/{skema}', [SkemaController::class, 'destroy'])->name('skema.destroy');

    Route::get('/peserta/create', [PesertaController::class, 'create'])->name('peserta.create');
    Route::post('/peserta', [PesertaController::class, 'store'])->name('peserta.store');

    Route::get('/peserta/{peserta}/edit', [PesertaController::class, 'edit'])->name('peserta.edit');
    Route::put('/peserta/{peserta}', [PesertaController::class, 'update'])->name('peserta.update');
    Route::delete('/peserta/{peserta}', [PesertaController::class, 'destroy'])->name('peserta.destroy');

});


Route::middleware('auth')->group(function () {
    Route::get('/skema/{skema}', [SkemaController::class, 'show'])->name('skema.show');
    Route::get('/peserta/{peserta}', [PesertaController::class, 'show'])->name('peserta.show');
});
