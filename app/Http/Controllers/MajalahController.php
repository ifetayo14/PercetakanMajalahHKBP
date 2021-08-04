<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class MajalahController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $majalah =  DB::table('majalah')
                        ->join('status', 'status.id','=','majalah.status')
                        ->select('judul', 'status.deskripsi as status','majalah_id','majalah.deskripsi as deskripsi')
                        ->get();
        return view('majalah.index',compact('majalah'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexSekjen()
    {
        $majalah =  DB::table('majalah')
                        ->join('status', 'status.id','=','majalah.status')
                        ->select('judul', 'status.deskripsi as status','majalah_id','majalah.deskripsi as deskripsi')
                        ->get();
        return view('majalah.indexSekjen',compact('majalah'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $majalah = [
            'judul' => '',
            'deskripsi' => '',
        ];
        // die($majalah);
        return view('majalah.add', compact('majalah'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $periode = DB::table('periode')->where(['status' => 'Aktif'])->get(); 
        if(!isset($periode[0]->periode_id)){
            //set error to create periode
        }
        $majalah = [
            'judul' => $request->input('judul'),
            'deskripsi' => $request->input('deskripsi'),
            'status' => 1,
            'periode_id' => $periode[0]->periode_id,
            'created_by' =>Session::get('username'),
            'created_date' => Carbon::now(),

        ];
        $request->validate([
            'judul'=>'required',
            'deskripsi'=>'required',
        ],
        [
            'judul.required' => 'Judul tidak boleh kosong!',
            'deskripsi.required' => 'Deskripsi tidak boleh kosong!',
        ]);
        $queryInsert = DB::table('majalah')->insert([$majalah]);

        if($queryInsert){
            return redirect('/majalah')->with('success', 'Majalah berhasil ditambah!');
        }else{
            // var_dump($majalah);die();
            return view('majalah.add', compact('majalah'));
        }
        // var_dump($majalah);die();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $majalah = DB::table('majalah')->where(['majalah_id' => $id])->get(); 
        // var_dump($majalah);die();
        return view('majalah.view',compact('majalah'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showSekjen($id)
    {
        $majalah = DB::table('majalah')->where(['majalah_id' => $id])->get(); 
        // var_dump($majalah);die();
        return view('majalah.viewSekjen',compact('majalah'));
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
        $majalah = DB::table('majalah')->where(['majalah_id' => $id])->get(); 
        // var_dump($majalah);die();
        return view('majalah.edit',compact('majalah'));
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
            'judul'=>'required',
            'deskripsi'=>'required',
        ],
        [
            'judul.required' => 'Judul tidak boleh kosong!',
            'deskripsi.required' => 'Deskripsi tidak boleh kosong!',
        ]);
        $queryInsert = DB::table('majalah')->where(['majalah_id'=>$id])->update([
            'judul' => $request->input('judul'), 
            'deskripsi' => $request->input('deskripsi'),
            'updated_by' =>Session::get('username'),
            'updated_date' => Carbon::now(),
        ]);

        if ($queryInsert){
            return redirect('/majalah')->with('success', 'Majalah Berhasil Update!');
        }
    }
    
    public function ajukan($id)
    {
        //
        DB::table('majalah')->where(['majalah_id' => $id])->update([
            'status' => 2, 
            'updated_by' =>Session::get('username'),
            'updated_date' => Carbon::now(),
        ]);
        return redirect('/majalah');
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
