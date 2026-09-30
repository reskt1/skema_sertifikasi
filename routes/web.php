<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\SkemaController;
use Illuminate\Support\Facades\Route;

Route::get('/login',[AuthController::class,'showLogin'])->name('login');
Route::post('/login',[AuthController::class,'login'])->name('login.process');
Route::post('/logout',[AuthController::class,'logout'])->name('logout');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function() {
        $jumlahSkema = \App\Models\Skema::count();
        $jumlahPeserta = \App\Models\Peserta::count();

        return view('dashboard',compact('jumlahSkema','jumlahPeserta'));
    })->name('dashboard');

    Route::resource('/skema',SkemaController::class);
    Route::resource('/peserta',PesertaController::class)
        ->parameters([
            'peserta'=>'peserta'
        ]);

});

