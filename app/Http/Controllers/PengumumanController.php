<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Auth; 
use DataTables;

class PengumumanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengumuman = Pengumuman::all(); 
        return view('pengumuman.index',compact('pengumuman'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pengumuman.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul'=>'required',
            'isi'=>'required',
        ],
        [
            'judul.required'=>'Judul tidak boleh kosong',
            'isi.required'=>'Alamat tidak boleh kosong', 
        ]);
        $queryInsert = DB::table('pengumuman')->insert([
            'user_id' => Session::get('user_id'),
            'judul' => $request->input('judul'),
            'deskripsi' => $request->input('deskripsi'),
            'isi' => $request->input('isi'),
            'expired_date' => $request->input('expired_date'),
            'created_by' =>Session::get('username'),
            'created_date' => Carbon::now(),
        ]);

        if ($queryInsert){
            return redirect('/pengumuman')->with('success', 'Pengumuman Berhasil di Tambah!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pengumuman = DB::table('pengumuman')->where(['pengumuman_id' => $id])->get(); 
        // var_dump($pengumuman);die();
        return view('pengumuman.view',compact('pengumuman'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showonly($id)
    {
        $pengumuman = DB::table('pengumuman')->where(['pengumuman_id' => $id])->get(); 
        // var_dump($pengumuman);die();
        return view('pengumuman.viewonly',compact('pengumuman'));
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
        $pengumuman = DB::table('pengumuman')->where(['pengumuman_id' => $id])->get(); 
        // var_dump($pengumuman);die();
        return view('pengumuman.edit',compact('pengumuman'));
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
            'isi'=>'required',
        ],
        [
            'judul.required'=>'Judul tidak boleh kosong',
            'isi.required'=>'Alamat tidak boleh kosong', 
        ]);
        $queryInsert = DB::table('pengumuman')->where(['pengumuman_id'=>$id])->update([
            'user_id' => Session::get('user_id'),
            'judul' => $request->input('judul'),
            'deskripsi' => $request->input('deskripsi'),
            'isi' => $request->input('isi'),
            'expired_date' => $request->input('expired_date'),
            'updated_by' =>Session::get('username'),
            'updated_date' => Carbon::now(),
        ]);

        if ($queryInsert){
            return redirect('/pengumuman')->with('success', 'Pengumuman Berhasil Update!');
        }else{
            
            return redirect('/pengumuman')->with('danger', 'Pengumuman Tidak Berhasil Update!');
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
