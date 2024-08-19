<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DataKaryawanController;
use App\Http\Controllers\PerhitunganLemburController;
use App\Http\Controllers\RekapitulasiJamLemburController;
use App\Exports\KaryawanExport;
use Maatwebsite\Excel\Facades\Excel;

// Public Routes
Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('actionlogin', [AuthController::class, 'actionlogin'])->name('actionlogin');
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('actionlogout');

Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::post('/register', [RegisterController::class, 'register']);

// Authenticated Routes
Route::middleware('auth')->group(function () {
    // Dashboard Routes
    Route::get('home', [DashboardController::class, 'index'])->name('home');
    
    // Data Karyawan Routes
    Route::get('data-karyawan', [DataKaryawanController::class, 'index'])->name('data-karyawan');
    Route::post('store-karyawan', [DataKaryawanController::class, 'store'])->name('store-karyawan');
    Route::delete('delete-karyawan/{id}', [DataKaryawanController::class, 'destroy'])->name('delete-karyawan');
    Route::put('update-karyawan', [DataKaryawanController::class, 'update'])->name('update-karyawan');
    Route::get('/api/nama-karyawan', [DataKaryawanController::class, 'getNamaKaryawan']);
    Route::get('autocomplete/id-karyawan', [DataKaryawanController::class, 'autocomplete'])->name('autocomplete.id_karyawan');
    Route::get('autocomplete/nama-lengkap', [DataKaryawanController::class, 'autocompleteNama'])->name('autocomplete.nama_lengkap');
    Route::get('/get-gaji', [DataKaryawanController::class, 'getGaji']);
    
    // Overtime Calculation Routes
    Route::get('/lembur', [PerhitunganLemburController::class, 'index'])->name('lembur.index');
    Route::post('/store-lembur', [PerhitunganLemburController::class, 'store'])->name('store-lembur');
    Route::delete('/lembur/{id}', [PerhitunganLemburController::class, 'destroy'])->name('lembur.destroy');
    Route::put('/perhitungan-lembur/update', [PerhitunganLemburController::class, 'update'])->name('perhitungan-lembur.update');
    Route::get('/export-excel', [PerhitunganLemburController::class, 'exportExcel'])->name('export.excel');
    // Printable View Route
    Route::get('/printable-view', [PerhitunganLemburController::class, 'printableView'])->name('printableView');
    
    // Overtime Summary Routes
    Route::get('rekapitulasi-jam-lembur', [RekapitulasiJamLemburController::class, 'index'])->name('rekapitulasi-jam-lembur');
    Route::get('print-filtered-data', [RekapitulasiJamLemburController::class, 'printFilteredData'])->name('print.filtered.data');
    Route::get('/export-excel2', [RekapitulasiJamLemburController::class, 'exportExcel'])->name('export.filtered.excel');
    Route::post('rekapitulasi-jam-lembur', [RekapitulasiJamLemburController::class, 'index'])->name('rekapitulasi-jam-lembur');
    

});
