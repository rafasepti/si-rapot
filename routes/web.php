<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\GuruKelasController;
use App\Http\Controllers\KelasController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\TahunAjaranController;
use App\Http\Controllers\WaliController;
use App\Models\Nilai;
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

Route::get('/', function () {
    return view('auth/login');
});

Route::get('/dashboard', 
[DashboardController::class, 'index'])->middleware(['checkRole:Guru,Kepala Sekolah,Admin']);;

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

Route::middleware(['checkRole:Kepala Sekolah,Admin'])->group(function () {
    //siswa
    Route::get('/siswa', [SiswaController::class, 'index']);
    Route::get('/siswa/list', [SiswaController::class, 'siswaGet']);
    Route::get('/siswa/filter', [SiswaController::class, 'filter']);
    Route::get('/siswa/tambah', [SiswaController::class, 'create']);
    Route::post('/siswa/tambah', [SiswaController::class, 'store']);
    Route::get('/siswa/detail/{id}', [SiswaController::class, 'detail']);
    Route::get('/siswa/edit/{id}', [SiswaController::class, 'edit']);
    Route::post('/siswa/update', [SiswaController::class, 'update']);
    Route::get('/siswa/hapus/{id}',[SiswaController::class, 'destroy']);

    //mapel
    Route::get('/mapel', [MapelController::class, 'index']);
    Route::get('/mapel/list', [MapelController::class, 'mapelGet']);
    Route::get('/mapel/detail/{id}', [MapelController::class, 'detail']);
    Route::get('/mapel/tambah', [MapelController::class, 'create']);
    Route::post('/mapel/store', [MapelController::class, 'store']);
    Route::get('/mapel/edit/{id}', [MapelController::class, 'edit']);
    Route::post('/mapel/update', [MapelController::class, 'update']);
    Route::get('/mapel/hapus/{id}', [MapelController::class, 'destroy']);

    //guru
    Route::get('/guru', [GuruController::class, 'index']);
    Route::get('/guru/list', [GuruController::class, 'guruGet']);
    Route::get('/guru/tambah', [GuruController::class, 'create']);
    Route::get('/guru/detail/{id}', [GuruController::class, 'detail']);
    Route::post('/guru/store', [GuruController::class, 'store']);
    Route::get('/guru/edit/{id}', [GuruController::class, 'edit']);
    Route::post('/guru/update', [GuruController::class, 'update']);
    Route::get('/guru/hapus/{id}', [GuruController::class, 'destroy']);


    //kelas
    Route::get('/kelas', [KelasController::class, 'index']);
    Route::get('/kelas/list', [KelasController::class, 'kelasGet']);
    Route::get('/kelas/mapel', [KelasController::class, 'mapelGet']);
    Route::get('/kelas/tambah', [KelasController::class, 'create']);
    Route::post('/kelas/store', [KelasController::class, 'store']);
    Route::get('/kelas/edit/{id}', [KelasController::class, 'edit']);
    Route::post('/kelas/update', [KelasController::class, 'update']);
    Route::get('/kelas/hapus/{id}', [KelasController::class, 'destroy']);
});

Route::middleware(['checkRole:Admin'])->group(function () {
    //tahun ajaran
    Route::get('/tahunajaran', [TahunAjaranController::class, 'index']);
    Route::get('/tahunajaran/list', [TahunAjaranController::class, 'tahunGet']);
    Route::get('/tahunajaran/tambah', [TahunAjaranController::class, 'create']);
    Route::post('/tahunajaran/store', [TahunAjaranController::class, 'store']);
    Route::get('/tahunajaran/edit/{id}', [TahunAjaranController::class, 'edit']);
    Route::get('/tahunajaran/aktif/{id}', [TahunAjaranController::class, 'aktif']);
    Route::post('/tahunajaran/update', [TahunAjaranController::class, 'update']);
    Route::get('/tahunajaran/hapus/{id}', [TahunAjaranController::class, 'destroy']);

    //guru kelas
    Route::get('/guru_kelas', [GuruKelasController::class, 'index']);
    Route::get('/guru_kelas/list', [GuruKelasController::class, 'kelasGet']);
    Route::get('/guru_kelas/tambah/{id}', [GuruKelasController::class, 'create']);
    Route::get('/guru_kelas/detail/{id}', [GuruKelasController::class, 'detail']);
    Route::post('/guru_kelas/store', [GuruKelasController::class, 'store']);
    Route::get('/guru_kelas/edit/{id}', [GuruKelasController::class, 'edit']);
    Route::post('/guru_kelas/update', [GuruKelasController::class, 'update']);
    Route::get('/guru_kelas/hapus/{id}', [GuruKelasController::class, 'destroy']);

    //Kepala Sekolah
    Route::get('/kepsek', [GuruController::class, 'indexKS']);
    Route::post('/kepsek', [GuruController::class, 'storeKS']);
    Route::get('/kepsek/loadKepsek', [GuruController::class, 'loadKepsek']);
});

Route::middleware(['checkRole:Guru'])->group(function () {
     //kelas wali
    Route::get('/kelaswali', [WaliController::class, 'index']);    
    Route::get('/kelaswali/list', [WaliController::class, 'siswaGet']);
    Route::get('/kelaswali/list_kelas', [WaliController::class, 'kelasGet']);
    Route::get('/kelaswali/tambah', [WaliController::class, 'create']);
    Route::post('/kelaswali/store', [WaliController::class, 'store']);
    Route::get('/kelaswali/edit/{id}', [WaliController::class, 'edit']);
    Route::post('/kelaswali/update', [WaliController::class, 'update']);

    Route::get('/nilai/tambah/{id}',[NilaiController::class, 'create']);
    Route::post('/nilai/store',[NilaiController::class, 'store']);
    Route::get('/nilai/detail/{id}',[NilaiController::class, 'show']);

    Route::get('/print_nilai/smt1/{id}', [NilaiController::class, 'generatePDF1']);
    Route::get('/print_nilai/smt2/{id}', [NilaiController::class, 'generatePDF2']);
});

require __DIR__.'/auth.php';
