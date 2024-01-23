<?php

use App\Document;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Route::get('/', 'HomeController@index')->name('home');
Route::get('panduan', 'HomeController@panduan')->name('panduan');

//Auth Route
Route::get('auth/login', 'AuthController@showLogin')->name('login');
Route::post('login', 'AuthController@login');
Route::get('auth/register', 'AuthController@showRegister')->name('register');
Route::post('register', 'AuthController@register');
Route::post('logout', 'AuthController@logout')->name('logout');

Route::group(['middleware' => ['auth', 'cekRole:Admin,Operator,Mahasiswa']], function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('profil', 'ProfilController@index')->name('profil');
    Route::put('profil/simpan/{user:nim}', 'ProfilController@simpan');
});

Route::group(['middleware' => ['auth', 'cekRole:Admin']], function () {
    Route::get('operator', 'AdminController@showOperator')->name('operator');
    Route::get('pendaftaran/operator', 'AdminController@showPendaftaranOperator');
    Route::post('simpan/operator', 'AdminController@simpanOperator');
    Route::get('operator/{user:nim}/update', 'AdminController@showUpdateOperator');
    Route::put('update/operator/{user:nim}', 'AdminController@updateOperator');
    Route::delete('operator/{user:nim}/delete', 'AdminController@deleteOperator');
    Route::get('operator/{num}', 'AdminController@detailOperator');

});

Route::group(['middleware' => ['auth', 'cekRole:Admin,Operator']], function () {
    Route::get('pendaftaran/mahasiswa', 'FungsiController@showPendaftaranMahasiswa');
    Route::post('simpan/mahasiswa', 'FungsiController@simpanMahasiswa');

    Route::get('mahasiswa/verifikasi', 'FungsiController@showVerifikasi')->name('verifikasi');
    Route::get('mahasiswa/sukses', 'FungsiController@showSukses')->name('sukses');
    Route::get('mahasiswa/gagal', 'FungsiController@showGagal')->name('gagal');

    Route::delete('mahasiswa/{num}/delete', 'FungsiController@hapusMahasiswa');
    Route::put('mahasiswa/{num}/reset', 'FungsiController@resetMahasiswa');
    Route::put('mahasiswa/{num}/tolak', 'FungsiController@tolakMahasiswa');
    Route::put('mahasiswa/{num}/sukses', 'FungsiController@suksesMahasiswa');
    Route::get('mahasiswa/{num}', 'FungsiController@detailMahasiswa');

    Route::get('khs/{num}/download', function ($nim) {
        $d = Document::where('nim', $nim)->first();
        $file = 'docs/' . $d->nim . '/' . $d->khs;
        return response()->download(public_path($file));
    });

    Route::get('krs/{num}/download', function ($nim) {
        $d = Document::where('nim', $nim)->first();
        $file = 'docs/' . $d->nim . '/' . $d->krs;
        return response()->download(public_path($file));
    });

    Route::get('uk/{num}/download', function ($nim) {
        $d = Document::where('nim', $nim)->first();
        $file = 'docs/' . $d->nim . '/' . $d->uk;
        return response()->download(public_path($file));
    });
});

Route::group(['middleware' => ['auth', 'cekRole:Mahasiswa']], function () {
    Route::get('biodata', 'MahasiswaController@showBiodata')->name('biodata');
    Route::post('biodata/simpan', 'MahasiswaController@simpanBiodata');
    Route::get('document', 'MahasiswaController@showDocument')->name('document');
    Route::post('document/simpan', 'MahasiswaController@simpanDocument');
    Route::get('kartu', 'MahasiswaController@Kartu')->name('kartu');
    Route::put('account/{num}/reset', 'MahasiswaController@resetAccount');
});
