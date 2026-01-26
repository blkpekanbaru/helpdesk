<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('Auth/login');
// });

//login
Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authentication'])->name('AuthLogin');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

//dashboard
Route::get('/admin-dashboard', [AdminController::class, 'index'])->name('dashAdmin');

//pekerjaan
Route::get('/admin-pekerjaan', [AdminController::class, 'pekerjaan'])->name('ShowPekerjaan');

//Agenda pelatihan
Route::get('/admin-pelatihan', [AdminController::class, 'pelatihan'])->name('ShowPelatihan');

//kalendar
// Route::get('/admin-kalendar', [AdminController::class, 'kalendar'])->name('Kalendar');

//laporan
Route::get('/admin-laporan', [AdminController::class, 'laporan'])->name('Laporan');