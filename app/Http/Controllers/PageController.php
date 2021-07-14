<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function dashboard()
    {
        return view('index');
    }
    public function toAdmin(){
        $periode = DB::table('periode')->where(['status' => 'Aktif'])->get();
        //artikel
        $artikel = DB::table('artikel')->where(['periode_id' => $periode[0]->periode_id])->get();
        //berita
        $berita = DB::table('berita')->where(['periode_id' => $periode[0]->periode_id])->get();
        //kotbah
        $kotbah = DB::table('kotbah')->where(['periode_id' => $periode[0]->periode_id])->get();
        return view('index', compact(['periode', 'artikel', 'berita', 'kotbah']));
    }
}
