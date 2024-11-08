<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SesiController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KonsumenController;

Route::get('/', function () {
    return view('/dashboard/welcome'); // Ganti 'welcome' dengan nama view yang ingin ditampilkan
});


Route::middleware(['guest'])->group(function () {  
    Route::get('/login', [SesiController::class, 'index'])->name('login');
    Route::post('/login', [SesiController::class, 'login']);
});

Route::middleware(['auth'])->group(function () {
    //admin
    Route::get('/admin', [AdminController::class, 'index']);
    Route::get('/admin/administrator', [AdminController::class, 'administrator'])
    ->middleware('userAkses:administrator')
    ->name('administrator');

    Route::get('/admin/petugas', [AdminController::class, 'petugas'])->middleware('userAkses:petugas');
    Route::get('/admin/pimpinan', [AdminController::class, 'pimpinan'])->middleware('userAkses:pimpinan');
   
    
    //logout
    Route::get('/logout', [SesiController::class, 'logout']);

    //Konsumen
    Route::get('/konsumen', [KonsumenController::class, 'index']);
    Route::post('/konsumen/store', [KonsumenController::class, 'store']);
    Route::post('/konsumen/edit', [KonsumenController::class, 'edit']);
    Route::post('/konsumen/{nama}/update', [KonsumenController::class, 'update'])->name('konsumen.update');
    Route::post('/konsumen/{nama}/delete', [KonsumenController::class, 'delete'])->name('konsumen.delete');



});