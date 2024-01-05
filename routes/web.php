<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\FasilitasController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\SesiController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('Dashboard.dashboard');
});

//Routes Login & Logout 
Route::get('logins',[AuthController::class,'index'])->name('logins.index');
Route::post('logins/auth',[AuthController::class,'login'])->name('logins.auth');
Route::get('logout',[AuthController::class,'logout'])->name('logins.logout');

//Routes pengguna

Route::get('pengguna',[PenggunaController::class,'index'])->name('pengguna.index');
Route::get('pengguna/create',[PenggunaController::class,'create'])->name('pengguna.create');
Route::post('pengguna',[PenggunaController::class,'store'])->name('pengguna.store');
Route::get('pengguna/{id}/edit',[PenggunaController::class,'edit'])->name('pengguna.edit');
Route::put('pengguna/{id}',[PenggunaController::class,'update'])->name('pengguna.update');
Route::delete('pengguna/{id}', [PenggunaController::class, 'destroy'])->name('pengguna.destroy');


//Routes fasilitas
Route::middleware(['auth.pengguna'])->group(function () {
    Route::get('fasilitas',[FasilitasController::class,'index'])->name('fasilitas.index');
    Route::get('fasilitas/create',[FasilitasController::class,'create'])->name('fasilitas.create');
    Route::post('fasilitas',[FasilitasController::class,'store'])->name('fasilitas.store');
    Route::get('fasilitas/{id}/edit',[FasilitasController::class,'edit'])->name('fasilitas.edit');
    Route::put('fasilitas/{id}',[FasilitasController::class,'update'])->name('fasilitas.update');
    Route::patch('fasilitas/{id}',[FasilitasController::class,'destroy'])->name('fasilitas.destroy');    
});

//Routes sesi
Route::middleware(['auth.pengguna'])->group(function () {
    Route::get('sesi',[SesiController::class,'index'])->name('sesi.index');
    Route::get('sesi/create',[SesiController::class,'create'])->name('sesi.create');
    Route::post('sesi',[SesiController::class,'store'])->name('sesi.store');
    Route::get('sesi/{id}/edit',[SesiController::class,'edit'])->name('sesi.edit');
    Route::put('sesi/{id}',[SesiController::class,'update'])->name('sesi.update');
    Route::delete('sesi/{id}',[SesiController::class,'destroy'])->name('sesi.destroy');    
});

//Routes barang
Route::middleware(['auth.pengguna'])->group(function () {
    Route::get('barang',[BarangController::class,'index'])->name('barang.index');
    Route::get('barang/create',[BarangController::class,'create'])->name('barang.create');
    Route::post('barang',[BarangController::class,'store'])->name('barang.store');
    Route::get('barang/{id}/edit',[BarangController::class,'edit'])->name('barang.edit');
    Route::put('barang/{id}',[BarangController::class,'update'])->name('barang.update');
    Route::delete('barang/{id}',[BarangController::class,'destroy'])->name('barang.destroy');    
});

//Routes ruangan
Route::middleware(['auth.pengguna'])->group(function () {
    Route::get('ruangan',[RuanganController::class,'index'])->name('ruangan.index');
    Route::get('ruangan/create',[RuanganController::class,'create'])->name('ruangan.create');
    Route::post('ruangan',[RuanganController::class,'store'])->name('ruangan.store');
    Route::get('ruangan/{id}/edit',[RuanganController::class,'edit'])->name('ruangan.edit');
    Route::put('ruangan/{id}',[RuanganController::class,'update'])->name('ruangan.update');
    Route::delete('ruangan/{id}',[RuanganController::class,'destroy'])->name('ruangan.destroy');    
});