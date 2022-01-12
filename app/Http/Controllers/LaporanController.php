<?php

namespace App\Http\Controllers;

use App\Exports\ExportHardcopy;
use App\Exports\ExportMember;
use App\Exports\ExportSoftcopy;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('laporan.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function exportFile(Request $request)
    {
        if ($request->input('month') == 13){
            $fileName = '1-12';
        }else{
            $fileName = $request->input('month');
        }
        if ($request->input('laporanType') == 'hardcopy'){
            return (new ExportHardcopy)->getParam($request->input('month'), $request->input('year'))->download('LaporanHardcopy_' . $fileName . '-' . $request->input('year') . '.xlsx');
        }elseif ($request->input('laporanType') == 'softcopy'){
            return (new ExportSoftcopy())->getParam($request->input('month'), $request->input('year'))->download('LaporanSoftcopy_' . $fileName . '-' . $request->input('year') . '.xlsx');
        }else{
            return (new ExportMember())->getParam($request->input('month'), $request->input('year'))->download('LaporanMember_' . $fileName . '-' . $request->input('year') . '.xlsx');
        }
    }
}
