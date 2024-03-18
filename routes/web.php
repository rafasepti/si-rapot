<?php

use App\Http\Controllers\ProfileController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['checkRole:Guru,Kepala Sekolah,Admin']);;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/dashboard', function () {
    return view('admin/v_admin');
});

//siswa
Route::get('/siswa', 'App\Http\Controllers\SiswaController@index');
Route::get('/siswa/list', 'App\Http\Controllers\SiswaController@siswaGet');
Route::get('/siswa/filter', 'App\Http\Controllers\SiswaController@filter');
Route::get('/siswa/tambah', 'App\Http\Controllers\SiswaController@create');
Route::post('/siswa/tambah', 'App\Http\Controllers\SiswaController@store');
Route::get('/siswa/detail/{id}', 'App\Http\Controllers\SiswaController@detail');
Route::get('/siswa/edit/{id}','App\Http\Controllers\SiswaController@edit');
Route::post('/siswa/update','App\Http\Controllers\SiswaController@update');
Route::get('/siswa/hapus/{id}','App\Http\Controllers\SiswaController@destroy');

//mapel
Route::get('/mapel', 'App\Http\Controllers\MapelController@index');
Route::get('/mapel/list', 'App\Http\Controllers\MapelController@mapelGet');
Route::get('/mapel/detail/{id}', 'App\Http\Controllers\MapelController@detail');
Route::get('/mapel/tambah', 'App\Http\Controllers\MapelController@create');
Route::post('/mapel/store', 'App\Http\Controllers\MapelController@store');
Route::get('/mapel/edit/{id}','App\Http\Controllers\MapelController@edit');
Route::post('/mapel/update','App\Http\Controllers\MapelController@update');
Route::get('/mapel/hapus/{id}','App\Http\Controllers\MapelController@destroy');

//tahun ajaran
Route::get('/tahunajaran', 'App\Http\Controllers\TahunAjaranController@index');
Route::get('/tahunajaran/list', 'App\Http\Controllers\TahunAjaranController@tahunGet');
Route::get('/tahunajaran/tambah', 'App\Http\Controllers\TahunAjaranController@create');
Route::post('/tahunajaran/store', 'App\Http\Controllers\TahunAjaranController@store');
Route::get('/tahunajaran/edit/{id}','App\Http\Controllers\TahunAjaranController@edit');
Route::post('/tahunajaran/update','App\Http\Controllers\TahunAjaranController@update');
Route::get('/tahunajaran/hapus/{id}','App\Http\Controllers\TahunAjaranController@destroy');

//guru
Route::get('/guru', 'App\Http\Controllers\GuruController@index');
Route::get('/guru/list', 'App\Http\Controllers\GuruController@guruGet');
Route::get('/guru/tambah', 'App\Http\Controllers\GuruController@create');
Route::get('/guru/detail/{id}', 'App\Http\Controllers\GuruController@detail');
Route::post('/guru/store', 'App\Http\Controllers\GuruController@store');
Route::get('/guru/edit/{id}','App\Http\Controllers\GuruController@edit');
Route::post('/guru/update','App\Http\Controllers\GuruController@update');
Route::get('/guru/hapus/{id}','App\Http\Controllers\GuruController@destroy');

//Kepala Sekolah
Route::get('/kepsek', 'App\Http\Controllers\GuruController@indexKS');
Route::post('/kepsek', 'App\Http\Controllers\GuruController@storeKS');
Route::get('/kepsek/loadKepsek', 'App\Http\Controllers\GuruController@loadKepsek');

//kelas
Route::get('/kelas', 'App\Http\Controllers\KelasController@index');
Route::get('/kelas/list', 'App\Http\Controllers\KelasController@kelasGet');
Route::get('/kelas/tambah', 'App\Http\Controllers\KelasController@create');
Route::post('/kelas/store', 'App\Http\Controllers\KelasController@store');
Route::get('/kelas/edit/{id}','App\Http\Controllers\KelasController@edit');
Route::post('/kelas/update','App\Http\Controllers\KelasController@update');
Route::get('/kelas/hapus/{id}','App\Http\Controllers\KelasController@destroy');

require __DIR__.'/auth.php';
