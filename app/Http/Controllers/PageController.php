<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PageController extends Controller
{
    public function dashboard(){
        if (Session::get('role') == '1') {
            $periode = DB::table('periode')->where(['status' => 'Aktif'])->get();
            //artikel
            $artikel = DB::table('artikel')->where(['periode_id' => $periode[0]->periode_id])->get();
            //berita
            $berita = DB::table('berita')->where(['periode_id' => $periode[0]->periode_id])->get();
            //kotbah
            $kotbah = DB::table('kotbah')->where(['periode_id' => $periode[0]->periode_id])->get();
            return view('indexAdmin', compact(['periode', 'artikel', 'berita', 'kotbah']));
        }
        else{
            $periode = DB::table('periode')->where(['status' => 'Aktif'])->get();
            return view('index', compact('periode'));
        }
    }
}
