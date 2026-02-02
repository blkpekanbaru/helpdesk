<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
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

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin-dashboard', [AdminController::class, 'index'])
        ->name('dashAdmin');

    Route::get('/admin-pekerjaan', [AdminController::class, 'pekerjaan'])
        ->name('ShowPekerjaan');

    Route::get('/admin-tambah-pekerjaan', [AdminController::class, 'tambahPekerjaan'])
        ->name('addPekerjaan');

    Route::post('/admin-simpan-pekerjaan', [AdminController::class, 'storePekerjaan'])
        ->name('storePekerjaan');

    Route::get('/pekerjaan/{id}', [AdminController::class, 'editPekerjaan'])
        ->name('editPekerjaan');

    Route::put('/pekerjaan/{id}', [AdminController::class, 'updatePekerjaan'])
        ->name('updatePekerjaan');

    Route::delete('/pekerjaan/{id}', [AdminController::class, 'destroyPekerjaan'])
        ->name('destroyPekerjaan');

    Route::post('/teknisi', [AdminController::class, 'storeTeknisi'])->name('storeTeknisi');
    Route::put('/teknisi/{id}', [AdminController::class, 'updateTeknisi'])->name('updateTeknisi');
    Route::delete('/teknisi/{id}', [AdminController::class, 'destroyTeknisi'])
        ->name('destroyTeknisi');


    Route::get('/admin-pelatihan', [AdminController::class, 'pelatihan'])
        ->name('ShowPelatihan');

    Route::get('/admin-laporan', [AdminController::class, 'laporan'])
        ->name('Laporan');

    Route::get('/laporan', [AdminController::class, 'laporan'])->name('laporan');
});

Route::get('/user-dashboard', function () {
    return view('kepala.dashboard');
})->name('dashKepala')->middleware('auth');


Route::get('/pengaduan', [IndexController::class, 'index']);
Route::post('/pengaduan', [IndexController::class, 'store_pengaduan'])->name('postPengaduan');
