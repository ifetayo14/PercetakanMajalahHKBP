<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class KhotbahController extends Controller
{
    public function  index(){
        $dataKhotbah = DB::table('kotbah')
            ->join('periode', 'kotbah.periode_id', '=', 'periode.periode_id')
            ->select('periode.bulan', 'periode.tahun', 'periode.tema', 'kotbah.kotbah_id', 'kotbah.judul', 'kotbah.user_id', 'kotbah.status', 'kotbah.created_by')
            ->where('kotbah.status', '=', '5')
            ->get();

        return view('khotbah.index', compact('dataKhotbah'));

    }
    public function  indexPengajuan(){
        $dataKhotbah = DB::table('kotbah')->where('user_id', '=', Session::get('user_id'))->get();
        return view('khotbah.pengajuanKhotbah', compact('dataKhotbah'));
    }
}
