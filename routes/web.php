<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterAccountController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\PengumumanController;

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
    Route::get('akunPage', [AccountController::class, 'index']);
    //pengumuman
    Route::get('pengumuman', [PengumumanController::class, 'index']);
    Route::get('pengumuman/add', [PengumumanController::class, 'create']);
    Route::post('pengumuman/add', [PengumumanController::class, 'store']);
    Route::get('pengumuman/view/$id', [PengumumanController::class, 'view']);
    Route::get('pengumuman/edit/$id', [PengumumanController::class, 'update']);
    Route::post('pengumuman/edit/$id', [PengumumanController::class, 'update']);
    Route::get('pengumuman/delete/$id', [PengumumanController::class, 'update']);
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

