<?php

use App\Http\Controllers\AdminDepositController;
use App\Http\Controllers\AdminPointConfigController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CertificateController;
use App\Http\Controllers\DepositController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\WorkshopController;
use App\Http\Middleware\PreventBackHistory;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes - Project B Indonesia
|--------------------------------------------------------------------------
*/

// ==========================================
// 1. Rute Halaman Publik / Pengunjung
// ==========================================
Route::get('/', [ProductController::class, 'home'])->name('home');
Route::get('/alur-proses', function () { return view('pages.production-process'); })->name('production-process');
Route::get('/produk', [ProductController::class, 'index'])->name('products.index');
Route::get('/penghargaan', [CertificateController::class, 'index'])->name('certificates.index');
Route::get('/penghargaan/{id}', [CertificateController::class, 'show'])->name('certificates.show');
Route::get('/lokasi', function () { return view('pages.location'); })->name('location');
Route::get('/kontak', function () { return view('pages.contact'); })->name('contact');

// Autentikasi
Route::get('/login', function () { return view('pages.auth.login'); })->name('login');
Route::get('/register', function () { return view('pages.auth.register'); })->name('register');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login.process');
Route::post('/register', [AuthController::class, 'register_process'])->name('register.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rute untuk Halaman User (Lihat Workshop)
Route::get('/workshops', [WorkshopController::class, 'index'])->name('workshops.index');


// ==========================================
// AREA WAJIB LOGIN & ANTI-BACK HISTORY
// ==========================================
Route::middleware(['auth', PreventBackHistory::class])->group(function () {

    // ==========================================
    // 2. Rute Halaman Penyetor (Depositor)
    // ==========================================
    Route::get('/customer/dashboard', function () { return view('customer.dashboard'); })->name('customer.dashboard');

    Route::prefix('penyetor')->name('depositor.')->group(function () {
        Route::get('/panduan', function () {$configs = \App\Models\PointConfig::all()->keyBy('jenis_sampah');
        return view('pages.depositor.procedure', compact('configs'));
        })->name('procedure');
        Route::get('/setor-sampah', [App\Http\Controllers\DepositController::class, 'create'])->name('form');
        Route::post('/setor-sampah/simpan', [App\Http\Controllers\DepositController::class, 'store'])->name('store');
        Route::get('/riwayat', [App\Http\Controllers\DepositController::class, 'history'])->name('history');
        Route::get('/riwayat/{id}', [App\Http\Controllers\DepositController::class, 'show'])->name('detail');
        Route::delete('/riwayat/batal/{id}', [App\Http\Controllers\DepositController::class, 'destroy'])->name('cancel');
        Route::get('/peringkat', [App\Http\Controllers\DepositController::class, 'leaderboard'])->name('leaderboard');
        Route::get('/profil', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile');
    });

    // ==========================================
    // 3. Rute Halaman Admin
    // ==========================================
    
    // Rute Workshop Admin (Sengaja dikeluarkan dari prefix name 'admin.' agar tidak bentrok)
    // Route::get('/admin/workshops', [WorkshopController::class, 'create'])->name('workshops.create');
    // Route::post('/admin/workshops/simpan', [WorkshopController::class, 'store'])->name('workshops.store');
    // Route::delete('/admin/workshops/hapus/{id}', [WorkshopController::class, 'destroy'])->name('workshops.destroy');

    // Rute Admin Lainnya
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', function () { return view('pages.admin.dashboard'); })->name('dashboard');
        Route::get('/setoran', [App\Http\Controllers\AdminDepositController::class, 'index'])->name('deposits.index');
        Route::post('/setoran/verifikasi/{id}', [App\Http\Controllers\AdminDepositController::class, 'verify'])->name('deposits.verify');
        Route::get('/pengaturan-poin', [App\Http\Controllers\AdminPointConfigController::class, 'edit'])->name('points.edit');
        Route::post('/pengaturan-poin/simpan', [App\Http\Controllers\AdminPointConfigController::class, 'update'])->name('points.update');
        Route::get('/sertifikat', function () { return view('pages.admin.certificates'); })->name('certificates');
        Route::get('/sertifikat', [CertificateController::class, 'create'])->name('certificates.create');
        Route::post('/sertifikat/simpan', [CertificateController::class, 'store'])->name('certificates.store');
        Route::delete('/sertifikat/hapus/{id}', [CertificateController::class, 'destroy'])->name('certificates.destroy');
        Route::get('/workshops', [WorkshopController::class, 'create'])->name('workshops.create');
        Route::post('/workshops/simpan', [WorkshopController::class, 'store'])->name('workshops.store');
        Route::delete('/workshops/hapus/{id}', [WorkshopController::class, 'destroy'])->name('workshops.destroy');
    });

});