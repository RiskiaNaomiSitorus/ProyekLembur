<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DataKaryawanController;
use App\Http\Controllers\PerhitunganLemburController;
use App\Http\Controllers\RekapitulasiJamLemburController;

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

Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('actionlogin', [AuthController::class, 'actionlogin'])->name('actionlogin');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::get('/register', function () {
    return view('auth.register');
})->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('home', [DashboardController::class, 'index'])->name('home')->middleware('auth');
Route::post('/logout', [AuthController::class, 'logout'])->name('actionlogout');


// Define routes for the pages
Route::get('data-karyawan', [DataKaryawanController::class, 'index'])->name('data-karyawan')->middleware('auth');
Route::get('perhitungan-lembur', [PerhitunganLemburController::class, 'index'])->name('perhitungan-lembur')->middleware('auth');
Route::get('rekapitulasi-jam-lembur', [RekapitulasiJamLemburController::class, 'index'])->name('rekapitulasi-jam-lembur')->middleware('auth');
