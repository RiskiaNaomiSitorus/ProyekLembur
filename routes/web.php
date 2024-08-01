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

// Route for the root URL ('/') that points to the login method of AuthController
// This is usually the default landing page for users
Route::get('/', [AuthController::class, 'login'])->name('login');

// Route to handle the login action, POST request
// It uses the actionlogin method in AuthController to process user authentication
Route::post('actionlogin', [AuthController::class, 'actionlogin'])->name('actionlogin');

// Route to show the login form
// This route maps to the showLoginForm method of AuthController and is named 'login'
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Route to show the registration form
// This route returns the 'auth.register' view when accessed
// It does not require a controller as it directly returns a view
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// Route to handle registration form submission
// It uses the register method in RegisterController to create a new user
Route::post('/register', [RegisterController::class, 'register']);

// Route to the home page, which is controlled by the DashboardController
// It is protected by the 'auth' middleware to ensure only authenticated users can access it
Route::get('home', [DashboardController::class, 'index'])->name('home')->middleware('auth');

// Route to handle user logout
// This route maps to the logout method of AuthController and is named 'actionlogout'
Route::post('/logout', [AuthController::class, 'logout'])->name('actionlogout');

// Route to view employee data
// It is managed by DataKaryawanController and is protected by the 'auth' middleware
Route::get('data-karyawan', [DataKaryawanController::class, 'index'])->name('data-karyawan')->middleware('auth');

// Route to view overtime calculation
// It is managed by PerhitunganLemburController and is protected by the 'auth' middleware
Route::get('perhitungan-lembur', [PerhitunganLemburController::class, 'index'])->name('perhitungan-lembur')->middleware('auth');

// Route to view overtime summary
// It is managed by RekapitulasiJamLemburController and is protected by the 'auth' middleware
Route::get('rekapitulasi-jam-lembur', [RekapitulasiJamLemburController::class, 'index'])->name('rekapitulasi-jam-lembur')->middleware('auth');

// Route to store new employee data
// It uses the store method in DataKaryawanController to save employee information
Route::post('store-karyawan', [DataKaryawanController::class, 'store'])->name('store-karyawan');

// Route to delete an employee record by ID
// The ID is passed as a parameter in the URL
// It uses the destroy method in DataKaryawanController to remove the employee record
Route::delete('delete-karyawan/{id}', [DataKaryawanController::class, 'destroy'])->name('delete-karyawan');

// Route to update an existing employee record
// It uses the update method in DataKaryawanController to modify employee information
Route::put('update-karyawan', [DataKaryawanController::class, 'update'])->name('update-karyawan');

// In web.php or api.php
Route::get('/api/nama-karyawan', [DataKaryawanController::class, 'getNamaKaryawan']);

Route::get('/lembur', [PerhitunganLemburController::class, 'index'])->name('lembur.index');

