<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class HardcopyController extends Controller
{
    public function index()
    {
        $dataHardCopy =  DB::table('producthardcopy')
             ->get();
        return view('hardcopy.index', compact('dataHardCopy'));
    }
    public function detailJemaat()
    {
        return view('hardcopy.detail');
    }
}
