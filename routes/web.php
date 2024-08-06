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

// Authentication Routes
// Route for the root URL ('/') that points to the login method of AuthController
Route::get('/', [AuthController::class, 'login'])->name('login');

// Route to handle the login action, POST request
Route::post('actionlogin', [AuthController::class, 'actionlogin'])->name('actionlogin');

// Route to show the login form
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Route to handle user logout
Route::post('/logout', [AuthController::class, 'logout'])->name('actionlogout');

// Registration Routes
// Route to show the registration form
Route::get('/register', function () {
    return view('auth.register');
})->name('register');

// Route to handle registration form submission
Route::post('/register', [RegisterController::class, 'register']);

// Dashboard Routes
// Route to the home page, which is controlled by the DashboardController
Route::get('home', [DashboardController::class, 'index'])->name('home')->middleware('auth');

// Data Karyawan Routes
// Route to view employee data
Route::get('data-karyawan', [DataKaryawanController::class, 'index'])->name('data-karyawan')->middleware('auth');

// Route to store new employee data
Route::post('store-karyawan', [DataKaryawanController::class, 'store'])->name('store-karyawan');

// Route to delete an employee record by ID
Route::delete('delete-karyawan/{id}', [DataKaryawanController::class, 'destroy'])->name('delete-karyawan');

// Route to update an existing employee record
Route::put('update-karyawan', [DataKaryawanController::class, 'update'])->name('update-karyawan');

// API Routes
// Route to get employee names for use in APIs
Route::get('/api/nama-karyawan', [DataKaryawanController::class, 'getNamaKaryawan']);

// Overtime Calculation Routes
// Route to view overtime calculation
Route::get('perhitungan-lembur', [PerhitunganLemburController::class, 'index'])->name('perhitungan-lembur')->middleware('auth');

// Overtime Summary Routes
// Route to view overtime summary
Route::get('rekapitulasi-jam-lembur', [RekapitulasiJamLemburController::class, 'index'])->name('rekapitulasi-jam-lembur')->middleware('auth');

// Additional Route
// Route for the Lembur Index page
Route::get('/lembur', [PerhitunganLemburController::class, 'index'])->name('lembur.index');

// Add this to your web.php
Route::post('/store-lembur', [PerhitunganLemburController::class, 'store'])->name('store-lembur');

// Route to delete an employee record by ID
Route::delete('delete-lembur/{id}', [PerhitunganLemburController::class, 'destroy'])->name('delete-lembur');

// In routes/web.php or routes/api.php
Route::get('autocomplete/id-karyawan', [DataKaryawanController::class, 'autocomplete'])->name('autocomplete.id_karyawan');

// In routes/web.php or routes/api.php
Route::get('autocomplete/nama-lengkap', [DataKaryawanController::class, 'autocompleteNama'])->name('autocomplete.nama_lengkap');

Route::get('/get-gaji', [DataKaryawanController::class, 'getGaji']);

// Route to get lembur data by ID
Route::get('/get-lembur-data/{id}', [PerhitunganLemburController::class, 'getLemburData']);

// Route to update lembur data by ID
Route::put('/update-lembur/{id}', [PerhitunganLemburController::class, 'updateLemburData'])->name('update-lembur');


