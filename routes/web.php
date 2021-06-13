<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogController;
use App\Http\Controllers\PageController;

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

Route::get('dashAdmin', [PageController::class, 'toAdmin']);
Route::get('dashJemaat', [PageController::class, 'toJemaat']);
Route::get('dashPendeta', [PageController::class, 'toPendeta']);
Route::get('dashSekjen', [PageController::class, 'toSekjen']);
Route::get('dashTimMajalah', [PageController::class, 'toTimMajalah']);

