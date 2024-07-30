<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;


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

Route::get('home', [DashboardController::class, 'index'])->name('home')->middleware('auth');
Route::get('actionlogout', [AuthController::class, 'actionlogout'])->name('actionlogout')->middleware('auth');
