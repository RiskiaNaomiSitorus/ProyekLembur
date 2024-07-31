<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\RegisterController;



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
// Add this route to handle the login page
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

Route::get('home', [DashboardController::class, 'index'])->name('home')->middleware('auth');
Route::get('actionlogout', [AuthController::class, 'actionlogout'])->name('actionlogout')->middleware('auth');

Route::get('/register', function () {
  return view('auth.register');
})->name('register');

// Route to handle form submission
Route::post('/register', [RegisterController::class, 'register']);