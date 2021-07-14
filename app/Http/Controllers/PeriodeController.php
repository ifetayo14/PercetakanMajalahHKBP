<?php

namespace App\Http\Controllers;

use App\Models\Periode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Auth; 
use DataTables;

class PeriodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $periode = Periode::all(); 
        return view('periode.index',compact('periode'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $periode = [
            'tahun' => '',
            'bulan' => '',
            'tema' => '',
            'deskripsi' => '',
            'status' => '',
            'created_by' =>'',
            'created_date' => '',
        ];
        // die($periode);
        return view('periode.add', compact('periode'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $periode = [
            'tahun' => $request->input('tahun'),
            'bulan' => $request->input('bulan'),
            'tema' => $request->input('tema'),
            'deskripsi' => $request->input('deskripsi'),
            'status' => $request->input('status'),
            'created_by' =>Session::get('username'),
            'created_date' => Carbon::now(),

        ];
        $request->validate([
            'bulan'=>'required',
            'tahun'=>'required',
            'deskripsi'=>'required',
            'tema' => 'required',
            'status' => 'required',
        ],
        [
            'bulan.required' => 'Bulan tidak boleh kosong!',
            'tahun.required' => 'Tahun tidak boleh kosong!',
            'deskripsi.required' => 'Deskripsi tidak boleh kosong!',
            'tema.required' => 'Tema tidak boleh kosong!',
            'status.required' => 'Status tidak boleh kosong!',
        ]);
        // var_dump($periode);die();
        //set periode lain Tidak Aktif
        if($request->input('status') == 'Aktif'){
            DB::table('periode')->where(['status' => 'Aktif'])->update(['status' => 'Tidak Aftif']);
        }

        $queryInsert = DB::table('periode')->insert([$periode]);

        if($queryInsert){
            return redirect('/periode')->with('success', 'Periode berhasil ditambah!');
        }else{
            var_dump($periode);die();
            return view('periode.add', compact('periode'));
        }
        // var_dump($periode);die();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $periode = DB::table('periode')->where(['periode_id' => $id])->get(); 
        // var_dump($periode);die();
        return view('periode.view',compact('periode'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $periode = DB::table('periode')->where(['periode_id' => $id])->get(); 
        // var_dump($periode);die();
        return view('periode.edit',compact('periode'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'bulan'=>'required',
            'tahun'=>'required',
            'deskripsi'=>'required',
            'tema' => 'required',
            'status' => 'required',
        ],
        [
            'bulan.required' => 'Bulan tidak boleh kosong!',
            'tahun.required' => 'Tahun tidak boleh kosong!',
            'deskripsi.required' => 'Deskripsi tidak boleh kosong!',
            'tema.required' => 'Tema tidak boleh kosong!',
            'status.required' => 'Status tidak boleh kosong!',
        ]);
        if($request->input('status') == 'Aktif'){
            DB::table('periode')->where(['status' => 'Aktif'])->update(['status' => 'Tidak Aftif']);
        }
        $queryInsert = DB::table('periode')->where(['periode_id'=>$id])->update([
            'status' => $request->input('status'),
            'bulan' => $request->input('bulan'),
            'tahun' => $request->input('tahun'),
            'tema' => $request->input('tema'),
            'deskripsi' => $request->input('deskripsi'),
            'updated_by' =>Session::get('username'),
            'updated_date' => Carbon::now(),
        ]);

        if ($queryInsert){
            return redirect('/periode')->with('success', 'Periode Berhasil Update!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
