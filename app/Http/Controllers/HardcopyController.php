<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Blade;
class HardcopyController extends Controller
{
    public function index()
    {
        $dataHardCopy =  DB::table('producthardcopy')
            ->join('periode', 'producthardcopy.periode_id', '=', 'periode.periode_id')
            ->select('producthardcopy.producthardcopy_id','producthardcopy.nama','producthardcopy.cover','producthardcopy.stok','producthardcopy.berat','producthardcopy.harga','producthardcopy.deskripsi','periode.bulan','periode.tahun')

            ->get();
        return view('hardcopy.index', compact('dataHardCopy'));
    }
    public function detailJemaat($id)
    {
        $dataHardCopy =  DB::table('producthardcopy')
            ->join('periode', 'producthardcopy.periode_id', '=', 'periode.periode_id')
            ->select('producthardcopy.producthardcopy_id','producthardcopy.nama','producthardcopy.cover','producthardcopy.stok','producthardcopy.berat','producthardcopy.harga','producthardcopy.deskripsi','periode.bulan','periode.tahun')
            ->where('producthardcopy.producthardcopy_id',$id)
            ->first();
        return view('hardcopy.detail',compact('dataHardCopy'));
    }
    
}
