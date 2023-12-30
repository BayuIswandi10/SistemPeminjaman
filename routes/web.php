<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\AuthController;

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

Route::middleware(['auth.pengguna'])->group(function () {
Route::get('pengguna',[PenggunaController::class,'index'])->name('pengguna.index');
Route::get('pengguna/create',[PenggunaController::class,'create'])->name('pengguna.create');
Route::post('pengguna',[PenggunaController::class,'store'])->name('pengguna.store');
Route::get('pengguna/{id}/edit',[PenggunaController::class,'edit'])->name('pengguna.edit');
Route::put('pengguna/{id}',[PenggunaController::class,'update'])->name('pengguna.update');
Route::patch('pengguna/{id}',[PenggunaController::class,'destroy'])->name('pengguna.destroy');
});
