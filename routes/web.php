<?php

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
    return view('admin/v_admin');
});

//siswa
Route::get('/siswa', 'App\Http\Controllers\SiswaController@index');

//mapel
Route::get('/mapel', 'App\Http\Controllers\MapelController@index');
Route::get('/mapel/list', 'App\Http\Controllers\MapelController@mapelGet');
Route::get('/mapel/tambah', 'App\Http\Controllers\MapelController@create');
Route::post('/mapel/store', 'App\Http\Controllers\MapelController@store');
Route::get('/mapel/edit/{id}','App\Http\Controllers\MapelController@edit');
Route::post('/mapel/update','App\Http\Controllers\MapelController@update');
Route::get('/mapel/hapus/{id}','App\Http\Controllers\MapelController@destroy');

//guru
Route::get('/guru', 'App\Http\Controllers\GuruController@index');
Route::get('/guru/list', 'App\Http\Controllers\GuruController@mapelGet');
Route::get('/guru/tambah', 'App\Http\Controllers\GuruController@create');
Route::post('/guru/store', 'App\Http\Controllers\GuruController@store');
Route::get('/guru/edit/{id}','App\Http\Controllers\GuruController@edit');
Route::post('/guru/update','App\Http\Controllers\GuruController@update');
Route::get('/guru/hapus/{id}','App\Http\Controllers\GuruController@destroy');
