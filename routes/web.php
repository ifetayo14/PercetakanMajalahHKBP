<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterAccountController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\PengumumanController;
use App\Http\Controllers\PeriodeController;
use App\Http\Controllers\MajalahController;

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

Route::middleware(['adminPage'])->group(function (){
    Route::get('dashAdmin', [PageController::class, 'toAdmin']);

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

Route::middleware(['jemaatPage'])->group(function (){
    Route::get('dashJemaat', [PageController::class, 'toJemaat']);
});

Route::middleware(['pendetaPage'])->group(function (){
    Route::get('dashPendeta', [PageController::class, 'toPendeta']);
});

Route::middleware(['sekjenPage'])->group(function (){
    Route::get('dashSekjen', [PageController::class, 'toSekjen']);
});

Route::middleware(['timMajalahPage'])->group(function (){
    Route::get('dashTimMajalah', [PageController::class, 'toTimMajalah']);
});

