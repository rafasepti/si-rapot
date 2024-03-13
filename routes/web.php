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
