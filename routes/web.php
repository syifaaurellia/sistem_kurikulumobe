<?php

use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\TahunAkademikController;
use App\Http\Controllers\ProgramStudiController;
use App\Http\Controllers\RangeNilaiController;
use App\Http\Controllers\ProfilLulusanController;
use App\Http\Controllers\CplProdiController;
use App\Http\Controllers\CplPlController;
use App\Http\Controllers\BahanKajianController;
use App\Http\Controllers\CplBkController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\BkMkController;
use App\Http\Controllers\CplMkController;
use App\Http\Controllers\CplBkMkController;
use App\Http\Controllers\SusunanMataKuliahController;
use App\Http\Controllers\CPMKController;
use App\Http\Controllers\MkCpmkController;
use App\Http\Controllers\OrganisasiMataKuliahController;
use App\Http\Controllers\PemenuhanCPLController;
use App\Http\Controllers\CplCpmkMkController;
use App\Http\Controllers\PemenuhanCPLCPMKMKController;
use App\Http\Controllers\PemetaanCPLMKCPMKController;
use App\Http\Controllers\SubCPMKController;
use App\Http\Controllers\PemetaanMKCPMKSubCPMKController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\TahapPenilaianController;
use App\Http\Controllers\BobotPenilaianController;
use App\Http\Controllers\BobotPenilaianCplController;
use App\Http\Controllers\NilaiAkhirMKController;
use App\Http\Controllers\NilaiAkhirCPLController;



// Redirect halaman utama langsung ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// Login & Register (Hanya Bisa diakses oleh Guest)
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);

    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::get('/users', [UserController::class, 'index'])->name('users.index');
Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
Route::get('/update-activity', [UserController::class, 'updateActivity'])->name('user.update.activity');

Route::get('/profil-lulusan', [ProfilLulusanController::class, 'index'])->name('profil-lulusan.index')->middleware('auth');
Route::post('/profil-lulusan', [ProfilLulusanController::class, 'store'])->name('profil-lulusan.store');
Route::delete('/profil-lulusan/{id}', [ProfilLulusanController::class, 'destroy'])->name('profil-lulusan.destroy');
// Jika menggunakan web.php
Route::put('/profil-lulusan/{id}', [ProfilLulusanController::class, 'update'])->name('profil-lulusan.update');

Route::resource('cpl-prodi', CplProdiController::class);

Route::resource('cpl-pl', CplPlController::class);
Route::post('/cpl-pl/store', [CplPlController::class, 'store'])->name('cpl-pl.store');
Route::put('cpl-pl/{id}', [CplPlController::class, 'update'])->name('cpl-pl.update');

Route::resource('cpl-bk', CplBkController::class);
Route::get('/cpl-bk', [CplBkController::class, 'index'])->name('cpl-bk.index')->middleware('auth');
Route::post('/cpl-bk/simpan', [CplBkController::class, 'simpan'])->name('cpl-bk.simpan')->middleware('auth');
Route::resource('mata-kuliah', MataKuliahController::class);

Route::resource('cpmk', CPMKController::class);
Route::post('/cpmk', [CpmkController::class, 'store'])->name('cpmk.store');
Route::put('/cpmk/{id}', [CPMKController::class, 'update'])->name('cpmk.update');
Route::delete('/cpmk/{id}', [CpmkController::class, 'destroy'])->name('cpmk.destroy');

Route::resource('sub_cpmk', SubCPMKController::class);
Route::post('/sub_cpmk', [SubCPMKController::class, 'store'])->name('sub_cpmk.store');
Route::put('/sub_cpmk/{id}', [SubCPMKController::class, 'update'])->name('sub_cpmk.update');
Route::delete('/sub_cpmk/{id}', [SubCPMKController::class, 'destroy'])->name('sub_cpmk.destroy');

Route::resource('cpl-mk', CplMkController::class);
Route::get('/cpl-mk', [CplMkController::class, 'index'])->name('cpl-mk.index');
Route::get('/cpl-mk/create', [CplMkController::class, 'create'])->name('cpl-mk.create');
Route::get('/cpl-mk/{id}/edit', [CplMkController::class, 'edit'])->name('cpl-mk.edit');
Route::put('/cpl-mk/{id}', [CplMkController::class, 'update'])->name('cpl-mk.update');

Route::resource('mk-cpmk', MkCpmkController::class);

Route::resource('organisasi', OrganisasiMataKuliahController::class);
Route::get('/organisasi-mata-kuliah', [OrganisasiMataKuliahController::class, 'index'])->name('organisasi_mata_kuliah.index');
Route::put('/organisasi/{id}', [OrganisasiMataKuliahController::class, 'update'])->name('organisasi.update');

Route::resource('cpl-bk-mk', CplBkMkController::class);
Route::get('/cpl-bk-mk', [CplBkMkController::class, 'index'])->name('cpl-bk-mk.index');
Route::post('/cpl-bk-mk', [CplBkMkController::class, 'store'])->name('cpl-bk-mk.store');
Route::get('/cpl-bk-mk/create', [CplBkMkController::class, 'create'])->name('cpl-bk-mk.create');
Route::get('/cpl-bk-mk/{id}/edit', [CplBkMkController::class, 'edit'])->name('cpl-bk-mk.edit');
Route::put('/cpl-bk-mk/{id}', [CplBkMkController::class, 'update'])->name('cpl-bk-mk.update');

Route::get('/susunan-mata-kuliah', [SusunanMataKuliahController::class, 'index'])->name('susunan_mata_kuliah.index');
Route::post('/susunan-mata-kuliah', [SusunanMataKuliahController::class, 'store'])->name('susunan_mata_kuliah.store');

Route::middleware(['auth'])->group(function () {
    Route::get('/pemenuhan-cpl', [PemenuhanCPLController::class, 'index'])->name('pemenuhan-cpl.index');
    Route::get('/pemenuhan-cpl/create', [PemenuhanCPLController::class, 'create'])->name('pemenuhan-cpl.create');
    Route::post('/pemenuhan-cpl', [PemenuhanCPLController::class, 'store'])->name('pemenuhan-cpl.store');
    Route::get('/pemenuhan-cpl/{id}/edit', [PemenuhanCPLController::class, 'edit'])->name('pemenuhan-cpl.edit');
    Route::put('/pemenuhan-cpl/{id}', [PemenuhanCPLController::class, 'update'])->name('pemenuhan-cpl.update');
    Route::delete('/pemenuhan-cpl/{id}', [PemenuhanCPLController::class, 'destroy'])->name('pemenuhan-cpl.destroy');
});

Route::resource('cpl-cpmk-mk', CplCpmkMkController::class);
Route::get('/cpl_cpmk_mk', [CplCpmkMkController::class, 'index'])->name('cpl_cpmk_mk.index');
Route::put('/cpl-cpmk-mk/{id}', [CplCpmkMkController::class, 'update'])->name('cpl-cpmk-mk.update');

Route::get('/pemenuhan', [PemenuhanCPLCPMKMKController::class, 'index'])->name('pemenuhan.index');
Route::get('/pemenuhan/create', [PemenuhanCPLCPMKMKController::class, 'create'])->name('pemenuhan.create');
Route::post('/pemenuhan', [PemenuhanCPLCPMKMKController::class, 'store'])->name('pemenuhan.store');
Route::get('/pemenuhan/{id}/edit', [PemenuhanCPLCPMKMKController::class, 'edit'])->name('pemenuhan.edit');
Route::put('/pemenuhan/{id}', [PemenuhanCPLCPMKMKController::class, 'update'])->name('pemenuhan.update');
Route::delete('/pemenuhan/{id}', [PemenuhanCPLCPMKMKController::class, 'destroy'])->name('pemenuhan.destroy');

Route::resource('pemetaan', PemetaanCPLMKCPMKController::class);
Route::post('/pemetaan/store', [PemetaanCPLMKCPMKController::class, 'store'])->name('pemetaan.store');
Route::get('/pemetaan/{id}/edit', [PemetaanCPLMKCPMKController::class, 'edit'])->name('pemetaan.edit');
Route::put('/pemetaan/{id}', [PemetaanCPLMKCPMKController::class, 'update'])->name('pemetaan.update');

Route::resource('pemetaansubcpmk', PemetaanMKCPMKSubCPMKController::class);

Route::resource('penilaian', PenilaianController::class);
Route::get('/penilaian/{id}/edit', [PenilaianController::class, 'edit'])->name('penilaian.edit');

Route::resource('tahap_penilaian', TahapPenilaianController::class);

Route::resource('bobot-penilaian', BobotPenilaianController::class);

Route::resource('bobot-penilaian-cpl', BobotPenilaianCplController::class);

Route::get('/nilai-akhir-mk', [NilaiAkhirMKController::class, 'index'])->name('nilai_akhir.index');

Route::get('/nilai-akhir-cpl', [NilaiAkhirCPLController::class, 'index'])->name('nilai_akhir_cpl.index');


Route::resource('bahan-kajian', BahanKajianController::class);
Route::resource('bk-mk', BkMkController::class)->middleware('auth');

Route::put('/tahunAkademik/{id}', [DashboardController::class, 'updateTahunAkademik'])->name('tahunAkademik.update');
Route::put('/{type}/{id}', [DashboardController::class, 'update']);

Route::middleware(['auth'])->group(function () {
    Route::middleware(['auth'])->group(function () {
        // Menggunakan Controller langsung
        Route::get('/admin/dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');
        Route::get('/admin/create', [AdminDashboardController::class, 'create'])->name('admin.create');
        Route::post('/admin/store', [AdminDashboardController::class, 'store'])->name('admin.store');
        Route::get('/admin/edit/{id}', [AdminDashboardController::class, 'edit'])->name('admin.edit');
        Route::put('/admin/update/{id}', [AdminDashboardController::class, 'update'])->name('admin.update');
        Route::delete('/admin/delete/{id}', [AdminDashboardController::class, 'destroy'])->name('admin.delete');
        Route::post('/admin/reset-password/{id}', [AdminDashboardController::class, 'resetPassword'])->name('admin.resetPassword');

    });

// Dashboard & Logout (Hanya Bisa diakses oleh User yang Login)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // web.php
Route::resource('tahunAkademik', TahunAkademikController::class)->except(['create', 'edit', 'show']);
Route::resource('programStudi', ProgramStudiController::class)->except(['create', 'edit', 'show']);
Route::resource('rangeNilai', RangeNilaiController::class)->except(['create', 'edit', 'show']);

Route::middleware(['auth'])->group(function () {


});

});
});