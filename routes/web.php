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
use App\Http\Controllers\MemberController;
use App\Http\Controllers\CheckOngkirController;
use App\Http\Controllers\HardcopyController;
use App\Http\Controllers\LaporanController;



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

//khotbah
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
//majalah jemaat
Route::get('majalahJemaat', [MajalahController::class, 'indexJemaat']);
Route::get('majalahJemaat/view/{id}', [MajalahController::class, 'showJemaat']);
Route::get('artikelJemaat/view/{id}', [ArtikelController::class, 'showSekjen']);
Route::get('beritaJemaat/view/{id}', [BeritaController::class, 'showSekjen']);
Route::get('kotbahJemaat/view/{id}', [KhotbahController::class, 'showSekjen']);
//harcopy
Route::get('hardcopyJemaat/', [HardcopyController::class, 'index']);
Route::get('hardcopyJemaat/detail/{id}', [HardcopyController::class, 'detailJemaat']);
Route::get('hardcopyAdmin/', [HardcopyController::class, 'indexAdmin']);
Route::get('hardcopyAdmin/tambah', [HardcopyController::class, 'tambah']);
Route::post('hardcopyAdmin/tambah', [HardcopyController::class, 'store']);
Route::get('hardcopyAdmin/hapus/{id}', [HardcopyController::class, 'delete']);

Route::get('/hardcopyJemaat/ongkir', [CheckOngkirController::class, 'index']);
Route::post('/ongkir', [CheckOngkirController::class,'check_ongkir']);
Route::get('/cities/{province_id}', [CheckOngkirController::class,'getCities']);
Route::post('/hardcopyJemaat/order', [CheckOngkirController::class,'order']);
Route::get('/hardcopy/order', [HardcopyController::class, 'orderJemaat']);
Route::post('/hardcopyJemaat/upload/bukti', [CheckOngkirController::class, 'uploadBukti']);
Route::get('/hardcopyAdmin/terima/{id}', [CheckOngkirController::class, 'terimaOrder']);
Route::get('/hardcopyAdmin/tolak/{id}', [CheckOngkirController::class, 'tolakOrder']);
Route::post('/hardcopyAdmin/upload/resi', [CheckOngkirController::class, 'uploadResi']);
Route::get('/hardcopyUser/konfirmasi/{id}', [CheckOngkirController::class, 'konfirmasiOrder']);
Route::get('/hardcopy/order/detail/{id}', [HardcopyController::class, 'orderDetail']);


//member
Route::get('member', [MemberController::class, 'index']);
Route::get('member/transaksimember', [MemberController::class, 'transaksimember']);
Route::get('member/add', [MemberController::class, 'create']);
Route::post('member/addProcess', [MemberController::class, 'store']);
Route::post('member/perpanjangProcess', [MemberController::class, 'perpanjang']);
Route::post('member/addBukti', [MemberController::class, 'uploadBuktiPembayaran']);
Route::middleware(['memberAccess'])->group(function (){
    Route::get('member/insert', [MemberController::class, 'create']);
    Route::get('member/edit/{id}', [MemberController::class, 'edit']);
    Route::get('member/approve/{id}', [MemberController::class, 'approve']);
    Route::get('member/reject/{id}', [MemberController::class, 'reject']);
    Route::post('member/updateProcess/{id}', [MemberController::class, 'update']);
});

Route::middleware(['artikelAccess'])->group(function (){
    Route::get('artikel/review', [ArtikelController::class, 'indexReview']);
    Route::get('artikel/accept/{id}', [ArtikelController::class, 'acceptArtikel']);
    Route::post('artikel/refuse/{id}', [ArtikelController::class, 'refuseArtikel']);
});
Route::get('pengumuman', [PengumumanController::class, 'index']);
Route::get('pengumuman/viewonly/{id}', [PengumumanController::class, 'showonly']);
Route::get('majalah', [MajalahController::class, 'index']);

Route::middleware(['adminPage'])->group(function (){

    //akun
    Route::get('akun', [AccountController::class, 'index']);
    Route::get('akun/add', [AccountController::class, 'create']);
    Route::post('akun/addProcess', [AccountController::class, 'store']);
    Route::get('akun/edit/{id}', [AccountController::class, 'edit']);
    Route::post('akun/updateProcess/{id}', [AccountController::class, 'update']);
    Route::get('akun/delete/{id}', [AccountController::class, 'destroy']);

    //pengumuman
    Route::get('pengumuman/add', [PengumumanController::class, 'create']);
    Route::post('pengumuman/add', [PengumumanController::class, 'store']);
    Route::get('pengumuman/view/{id}', [PengumumanController::class, 'show']);
    Route::get('pengumuman/edit/{id}', [PengumumanController::class, 'edit']);
    Route::post('pengumuman/edit/{id}', [PengumumanController::class, 'update']);
    Route::get('pengumuman/delete/{id}', [PengumumanController::class, 'destroy']);

    //periode
    Route::get('periode', [PeriodeController::class, 'index']);
    Route::get('periode/add', [PeriodeController::class, 'create']);
    Route::post('periode/add', [PeriodeController::class, 'store']);
    Route::get('periode/view/{id}', [PeriodeController::class, 'show']);
    Route::get('periode/edit/{id}', [PeriodeController::class, 'edit']);
    Route::post('periode/edit/{id}', [PeriodeController::class, 'update']);
    Route::get('periode/delete/{id}', [PeriodeController::class, 'update']);
    //majalah
    Route::get('majalah/add', [MajalahController::class, 'create']);
    Route::post('majalah/add', [MajalahController::class, 'store']);
    Route::get('majalah/view/{id}', [MajalahController::class, 'show']);
    Route::get('majalah/edit/{id}', [MajalahController::class, 'edit']);
    Route::post('majalah/edit/{id}', [MajalahController::class, 'update']);
    Route::get('majalah/delete/{id}', [MajalahController::class, 'delete']);
    Route::get('majalah/ajukan/{id}', [MajalahController::class, 'ajukan']);
    Route::get('majalah/ajukanDewanRedaksi/{id}', [MajalahController::class, 'ajukanDewanRedaksi']);
    Route::get('majalah/berita/detail/{id}', [BeritaController::class, 'showAdmin']);
    Route::get('majalah/artikel/detail/{id}', [ArtikelController::class, 'showAdmin']);
    Route::get('majalah/khotbah/detail/{id}', [KhotbahController::class, 'showAdmin']);
});
Route::middleware(['sekjenPage'])->group(function (){
    //periode
    Route::get('periodeSekjen', [PeriodeController::class, 'indexSekjen']);
    Route::get('periodeSekjen/view/{id}', [PeriodeController::class, 'showSekjen']);
    //majalah
    Route::get('majalahSekjen', [MajalahController::class, 'indexSekjen']);
    Route::get('majalahSekjen/view/{id}', [MajalahController::class, 'showSekjen']);
    Route::get('majalahSekjen/terima/{id}', [MajalahController::class, 'terima']);
    Route::post('majalahSekjen/terima/{id}', [MajalahController::class, 'terimaUpdate']);
    Route::get('majalahSekjen/tolak/{id}', [MajalahController::class, 'tolak']);
    Route::get('/majalahSekjen/viewByPeriode/{id}', [MajalahController::class, 'showSekjenByPeriode']);
    Route::post('majalahSekjen/tolak/{id}', [MajalahController::class, 'tolakUpdate']);
    Route::get('artikelSekjen/view/{id}', [ArtikelController::class, 'showSekjen']);
    Route::get('beritaSekjen/view/{id}', [BeritaController::class, 'showSekjen']);
    Route::get('kotbahSekjen/view/{id}', [KhotbahController::class, 'showSekjen']);
});
Route::middleware(['dewanRedaksiPage'])->group(function (){
    //periode
    Route::get('periodeDewanRedaksi', [PeriodeController::class, 'indexDewanRedaksi']);
    Route::get('periodeDewanRedaksi/view/{id}', [PeriodeController::class, 'showDewanRedaksi']);
    //majalah
    Route::get('majalahDewanRedaksi', [MajalahController::class, 'indexDewanRedaksi']);
    Route::get('majalahDewanRedaksi/view/{id}', [MajalahController::class, 'showDewanRedaksi']);
    Route::get('majalahDewanRedaksi/terima/{id}', [MajalahController::class, 'terimaDewanRedaksi']);
    Route::post('majalahDewanRedaksi/terima/{id}', [MajalahController::class, 'terimaUpdateDewanRedaksi']);
    Route::get('majalahDewanRedaksi/tolak/{id}', [MajalahController::class, 'tolakDewanRedaksi']);
    Route::get('/majalahDewanRedaksi/viewByPeriode/{id}', [MajalahController::class, 'showDewanRedaksiByPeriode']);
    Route::post('majalahDewanRedaksi/tolak/{id}', [MajalahController::class, 'tolakUpdateDewanRedaksi']);
    Route::get('artikelDewanRedaksi/view/{id}', [ArtikelController::class, 'showDewanRedaksi']);
    Route::get('beritaDewanRedaksi/view/{id}', [BeritaController::class, 'showDewanRedaksi']);
    Route::get('kotbahDewanRedaksi/view/{id}', [KhotbahController::class, 'showDewanRedaksi']);
});





Route::middleware(['timaMajalahPage'])->group(function (){
    //pengumuman
    Route::get('pengumuman/add', [PengumumanController::class, 'create']);
    Route::post('pengumuman/add', [PengumumanController::class, 'store']);
    Route::get('pengumuman/view/{id}', [PengumumanController::class, 'show']);
    Route::get('pengumuman/edit/{id}', [PengumumanController::class, 'edit']);
    Route::post('pengumuman/edit/{id}', [PengumumanController::class, 'update']);
    Route::get('pengumuman/delete/{id}', [PengumumanController::class, 'destroy']);
    //majalah
    Route::get('majalah/add', [MajalahController::class, 'create']);
    Route::post('majalah/add', [MajalahController::class, 'store']);
    Route::get('majalah/view/{id}', [MajalahController::class, 'show']);
    Route::get('majalah/edit/{id}', [MajalahController::class, 'edit']);
    Route::post('majalah/edit/{id}', [MajalahController::class, 'update']);
    Route::get('majalah/delete/{id}', [MajalahController::class, 'delete']);
    Route::get('majalah/ajukan/{id}', [MajalahController::class, 'ajukan']);
    Route::get('majalah/ajukanDewanRedaksi/{id}', [MajalahController::class, 'ajukanDewanRedaksi']);
    Route::get('majalah/berita/detail/{id}', [BeritaController::class, 'showAdmin']);
    Route::get('majalah/artikel/detail/{id}', [ArtikelController::class, 'showAdmin']);
    Route::get('majalah/khotbah/detail/{id}', [KhotbahController::class, 'showAdmin']);

    //periode
    Route::get('periode', [PeriodeController::class, 'index']);
    Route::get('periode/add', [PeriodeController::class, 'create']);
    Route::post('periode/add', [PeriodeController::class, 'store']);
    Route::get('periode/view/{id}', [PeriodeController::class, 'show']);
    Route::get('periode/edit/{id}', [PeriodeController::class, 'edit']);
    Route::post('periode/edit/{id}', [PeriodeController::class, 'update']);
    Route::get('periode/delete/{id}', [PeriodeController::class, 'destroy']);

});

//laporan
Route::get('laporan', [LaporanController::class, 'index']);
Route::post('laporan/printLaporan', [LaporanController::class, 'exportFile']);

