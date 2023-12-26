<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PenggunaController;

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
    return view('welcome');
});

Route::get('pengguna',[PenggunaController::class,'index'])->name('pengguna.index');
Route::get('pengguna/create',[PenggunaController::class,'create'])->name('pengguna.create');
Route::post('pengguna',[PenggunaController::class,'store'])->name('pengguna.store');
Route::get('pengguna/{id}/edit',[PenggunaController::class,'edit'])->name('pengguna.edit');
Route::put('pengguna/{id}',[PenggunaController::class,'update'])->name('pengguna.update');
Route::patch('pengguna/{id}',[PenggunaController::class,'destroy'])->name('pengguna.destroy');
