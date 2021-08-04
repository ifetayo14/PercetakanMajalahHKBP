<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterAccountController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\MajalahController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\KhotbahController;


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

Route::get('/', function () {
    return view('login');
});

Route::post('loginProcess', [LogController::class, 'loginProcess']);
Route::get('logout', [LogController::class, 'logout']);

Route::get('registerForm', [RegisterAccountController::class, 'create']);
Route::post('registerProcess', [RegisterAccountController::class, 'store']);

Route::get('index', [PageController::class, 'dashboard']);

//Artikel
Route::get('artikel', [ArtikelController::class, 'index']);
Route::get('artikel/pengajuan', [ArtikelController::class, 'indexPengajuan']);
Route::get('artikel/add', [ArtikelController::class, 'create']);
Route::post('artikel/addProcess', [ArtikelController::class, 'store']);
Route::get('artikel/edit/{id}', [ArtikelController::class, 'edit']);
Route::post('artikel/editProcess/{id}', [ArtikelController::class, 'update']);
Route::get('artikel/upload/{id}', [ArtikelController::class, 'upload']);
Route::get('artikel/delete/{id}', [ArtikelController::class, 'destroy']);
Route::get('artikel/detail/{id}', [ArtikelController::class, 'show']);

//berita
Route::get('berita', [BeritaController::class, 'index']);
Route::get('berita/pengajuan', [BeritaController::class, 'indexPengajuan']);
Route::get('berita/add', [BeritaController::class, 'create']);
Route::post('berita/addProcess', [BeritaController::class, 'store']);
Route::get('berita/edit/{id}', [BeritaController::class, 'edit']);
Route::post('berita/editProcess/{id}', [BeritaController::class, 'update']);
Route::get('berita/upload/{id}', [BeritaController::class, 'upload']);
Route::get('berita/delete/{id}', [BeritaController::class, 'destroy']);
Route::get('berita/detail/{id}', [BeritaController::class, 'show']);
Route::get('berita/review', [BeritaController::class, 'indexReview']);
Route::get('berita/accept/{id}', [BeritaController::class, 'acceptBerita']);
Route::post('berita/refuse/{id}', [BeritaController::class, 'refuseBerita']);

Route::get('khotbah', [KhotbahController::class, 'index']);
Route::get('khotbah/pengajuan', [KhotbahController::class, 'indexPengajuan']);
Route::get('khotbah/add', [KhotbahController::class, 'create']);
Route::post('khotbah/addProcess', [KhotbahController::class, 'store']);
Route::get('khotbah/edit/{id}', [KhotbahController::class, 'edit']);
Route::post('khotbah/editProcess/{id}', [KhotbahController::class, 'update']);
Route::get('khotbah/upload/{id}', [KhotbahController::class, 'upload']);
Route::get('khotbah/delete/{id}', [KhotbahController::class, 'destroy']);
Route::get('khotbah/detail/{id}', [KhotbahController::class, 'show']);
Route::get('khotbah/review', [KhotbahController::class, 'indexReview']);
Route::get('khotbah/accept/{id}', [KhotbahController::class, 'acceptKhotbah']);
Route::post('khotbah/refuse/{id}', [KhotbahController::class, 'refuseKhotbah']);





Route::middleware(['artikelAccess'])->group(function (){
    Route::get('artikel/review', [ArtikelController::class, 'indexReview']);
    Route::get('artikel/accept/{id}', [ArtikelController::class, 'acceptArtikel']);
    Route::post('artikel/refuse/{id}', [ArtikelController::class, 'refuseArtikel']);
});

Route::middleware(['adminPage'])->group(function (){

    //akun
    Route::get('akun', [AccountController::class, 'index']);
    Route::get('akun/add', [AccountController::class, 'create']);
    Route::post('akun/addProcess', [AccountController::class, 'store']);
    Route::get('akun/edit/{id}', [AccountController::class, 'edit']);
    Route::post('akun/updateProcess/{id}', [AccountController::class, 'update']);
    Route::get('akun/delete/{id}', [AccountController::class, 'destroy']);

    //pengumuman
    Route::get('pengumuman', [PengumumanController::class, 'index']);
    Route::get('pengumuman/add', [PengumumanController::class, 'create']);
    Route::post('pengumuman/add', [PengumumanController::class, 'store']);
    Route::get('pengumuman/view/{id}', [PengumumanController::class, 'show']);
    Route::get('pengumuman/edit/{id}', [PengumumanController::class, 'edit']);
    Route::post('pengumuman/edit/{id}', [PengumumanController::class, 'update']);
    Route::get('pengumuman/delete/{id}', [PengumumanController::class, 'update']);

    //periode
    Route::get('periode', [PeriodeController::class, 'index']);
    Route::get('periode/add', [PeriodeController::class, 'create']);
    Route::post('periode/add', [PeriodeController::class, 'store']);
    Route::get('periode/view/{id}', [PeriodeController::class, 'show']);
    Route::get('periode/edit/{id}', [PeriodeController::class, 'edit']);
    Route::post('periode/edit/{id}', [PeriodeController::class, 'update']);
    Route::get('periode/delete/{id}', [PeriodeController::class, 'update']);
    //majalah
    Route::get('majalah', [MajalahController::class, 'index']);
    Route::get('majalah/add', [MajalahController::class, 'create']);
    Route::post('majalah/add', [MajalahController::class, 'store']);
    Route::get('majalah/view/{id}', [MajalahController::class, 'show']);
    Route::get('majalah/edit/{id}', [MajalahController::class, 'edit']);
    Route::post('majalah/edit/{id}', [MajalahController::class, 'update']);
    Route::get('majalah/delete/{id}', [MajalahController::class, 'delete']);
    Route::get('majalah/ajukan/{id}', [MajalahController::class, 'ajukan']);
});

