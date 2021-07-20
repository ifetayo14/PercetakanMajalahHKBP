<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class BeritaController extends Controller
{
    public function  index(){
        $dataBerita = DB::table('berita')
            ->join('periode', 'berita.periode_id', '=', 'periode.periode_id')
            ->select('periode.bulan', 'periode.tahun', 'periode.tema', 'berita.berita_id', 'berita.judul', 'berita.user_id', 'berita.status', 'berita.created_by')
            ->where('berita.status', '=', '5')
            ->get();

        return view('berita.index', compact('dataBerita'));

    }
}
