<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HospitalController;
use App\Http\Controllers\PatientController;
use App\Http\Middleware\Authenticate;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('login');

Route::post('/authenticate', [AuthController::class, 'authenticate'])->name('authenticate');

// Grup rute yang memerlukan autentikasi
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('hospitals', HospitalController::class);
    Route::resource('patients', PatientController::class);

    Route::get('/filter-pasien', [PatientController::class, 'filter']);

    // Jika kamu punya route logout
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});
