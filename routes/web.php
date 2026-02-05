<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\TeknisiController;
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
Route::post('/update-password', [AuthController::class, 'update_password'])->name('UpdatePassword');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::get('/admin-dashboard', [AdminController::class, 'index'])
        ->name('dashAdmin');

    Route::post('/broadcast-wa', [AdminController::class, 'broadcast_pesan'])
        ->name('WABroadcast');

    Route::get('/admin-pengguna', [AdminController::class, 'pengguna'])
        ->name('ShowUser');
    Route::post('/admin-simpan-pengguna', [AdminController::class, 'store_pengguna'])
        ->name('StoreUser');
    Route::delete('/admin-delete-pengguna/{id}', [AdminController::class, 'destroy_pengguna'])
        ->name('DeleteUser');
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


    Route::get('/admin-lokasi', [AdminController::class, 'lokasi'])
        ->name('ShowLokasi');
    Route::post('/admin-tambah-lokasi', [AdminController::class, 'store_lokasi'])
        ->name('StoreLokasi');
    Route::put('/admin-edit-lokasi/{id}', [AdminController::class, 'update_lokasi'])
        ->name('UpdateLokasi');
    Route::delete('/admin-delete-lokasi/{id}', [AdminController::class, 'destroy_lokasi'])
        ->name('DeleteLokasi');
    Route::get('/admin/lokasi/{id}/qr', [AdminController::class, 'generateQr'])
        ->name('GenerateQR');

    Route::get('/admin-laporan', [AdminController::class, 'laporan'])
        ->name('Laporan');

    Route::get('/laporan', [AdminController::class, 'laporan'])->name('laporan');
    Route::get('/tampil-pesan/{id}', [AdminController::class, 'tampil_pesan'])->name('TampilPesan');
    Route::post('/kirim-pesan', [AdminController::class, 'kirim_pesan'])->name('kirim.pesan');
});


Route::middleware(['auth', 'role:teknisi'])->group(function () {
    Route::get('/dashboard-teknisi', [TeknisiController::class, 'index'])->name('dashTeknisi');

    Route::get('/tugas-teknisi', [TeknisiController::class, 'tugas'])->name('ShowTugas');
    Route::put('/tugas-teknisi/{id}', [TeknisiController::class, 'update_tugas'])->name('UpdateTugas');

    Route::get('/pelaporan-teknisi', [TeknisiController::class, 'pelaporan'])->name('ShowPelaporan');
    Route::put('/pelaporan-teknisi/{id}', [TeknisiController::class, 'update_pelaporan'])->name('UpdatePelaporan');
});

Route::get('/pengaduan', [IndexController::class, 'index'])->name('ShowPengaduan');
Route::post('/pengaduan', [IndexController::class, 'store_pengaduan'])->name('postPengaduan');
