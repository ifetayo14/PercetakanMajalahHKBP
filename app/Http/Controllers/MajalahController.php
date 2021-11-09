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
                        ->select('judul', 'status.deskripsi as status', 'majalah.status as status_id','majalah_id','majalah.deskripsi as deskripsi')
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
    public function indexJemaat(){
        $majalah =  DB::table('majalah')
            ->join('status', 'status.id','=','majalah.status')
            ->join('periode','majalah.periode_id','=','periode.periode_id')
            ->select('judul', 'status.deskripsi as status','majalah_id','majalah.deskripsi as deskripsi','periode.bulan', 'periode.tahun')
            ->where('majalah.status','=','5')
            ->get();
        return view('majalah.indexJemaat', compact('majalah'));
    }
    public function showJemaat($id)
    {
        $majalah = DB::table('majalah')->where(['majalah_id' => $id])->get();
        $artikel = DB::table('artikel')->where(['periode_id' => $majalah[0]->periode_id, 'status' =>5])->get();
        $berita = DB::table('berita')->where(['periode_id' => $majalah[0]->periode_id, 'status' =>5])->get();
        $kotbah = DB::table('kotbah')->where(['periode_id' => $majalah[0]->periode_id, 'status' =>5])->get();
        $majalah =  DB::table('majalah')
            ->join('status', 'status.id','=','majalah.status')
            ->join('periode', 'periode.periode_id','=','majalah.periode_id')
            ->select('judul', 'majalah.catatan','majalah.file', 'status.deskripsi as status', 'majalah.status as status_id','majalah_id','majalah.deskripsi as deskripsi', 'periode.bulan', 'periode.tahun','periode.tema')
            ->get();
        // var_dump($majalah);die();
        return view('majalah.viewJemaat',compact('majalah','artikel','berita','kotbah'));
    }
    public function indexMember()
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
        $majalah =  DB::table('majalah')
        ->join('status', 'status.id','=','majalah.status')
        ->join('periode', 'periode.periode_id','=','majalah.periode_id')
        ->select('judul', 'majalah.catatan','majalah.file', 'status.deskripsi as status', 'majalah.status as status_id','majalah_id','majalah.deskripsi as deskripsi', 'periode.bulan', 'periode.tahun','periode.tema')
        ->where(['majalah.periode_id' => $id])
        ->get();
        // var_dump($majalah);die();
        $artikel = DB::table('artikel')->where(['periode_id' => $id])->whereIn('status',[2,3,5])
        ->join('status', 'status.id','=','artikel.status')->select('artikel.*', 'status.deskripsi as status_des')->get();
        $berita = DB::table('berita')->where(['periode_id' => $id])->whereIn('status',[2,3,5])
        ->join('status', 'status.id','=','berita.status')->select('berita.*', 'status.deskripsi as status_des')->get();
        $kotbah = DB::table('kotbah')->where(['periode_id' => $id])->whereIn('status',[2,3,5])
        ->join('status', 'status.id','=','kotbah.status')->select('kotbah.*', 'status.deskripsi as status_des')->get();
        $majalah =  DB::table('majalah')
                        ->join('status', 'status.id','=','majalah.status')
                        ->join('periode', 'periode.periode_id','=','majalah.periode_id')
                        ->select('judul', 'majalah.catatan','majalah.file', 'status.deskripsi as status', 'majalah.status as status_id','majalah_id','majalah.deskripsi as deskripsi', 'periode.bulan', 'periode.tahun','periode.tema')
                        ->get();
        // var_dump($majalah);die();
        return view('majalah.view',compact('majalah','artikel','berita','kotbah'));
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
        if($majalah[0]->status == 2 ){
            DB::table('majalah')->where(['majalah_id'=>$id])->update([
                'status' => 3,
                'updated_by' =>Session::get('username'),
                'updated_date' => Carbon::now(),
            ]);
        }
        $artikel = DB::table('artikel')->where(['periode_id' => $majalah[0]->periode_id, 'status' =>5])->get();
        $berita = DB::table('berita')->where(['periode_id' => $majalah[0]->periode_id, 'status' =>5])->get();
        $kotbah = DB::table('kotbah')->where(['periode_id' => $majalah[0]->periode_id, 'status' =>5])->get();
        $majalah =  DB::table('majalah')
                        ->join('status', 'status.id','=','majalah.status')
                        ->join('periode', 'periode.periode_id','=','majalah.periode_id')
                        ->select('judul', 'majalah.catatan','majalah.file', 'status.deskripsi as status', 'majalah.status as status_id','majalah_id','majalah.deskripsi as deskripsi', 'periode.bulan', 'periode.tahun','periode.tema')
                        ->get();
        // var_dump($majalah);die();
        return view('majalah.viewSekjen',compact('majalah','artikel','berita','kotbah'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showSekjenByPeriode($id)
    {
        $majalah = DB::table('majalah')->where(['periode_id' => $id])->get();
        $artikel = DB::table('artikel')->where(['periode_id' => $majalah[0]->periode_id, 'status' =>5])->get();
        $berita = DB::table('berita')->where(['periode_id' => $majalah[0]->periode_id, 'status' =>5])->get();
        $kotbah = DB::table('kotbah')->where(['periode_id' => $majalah[0]->periode_id, 'status' =>5])->get();
        $majalah =  DB::table('majalah')
                        ->join('status', 'status.id','=','majalah.status')
                        ->join('periode', 'periode.periode_id','=','majalah.periode_id')
                        ->select('judul', 'majalah.catatan','majalah.file', 'status.deskripsi as status', 'majalah.status as status_id','majalah_id','majalah.deskripsi as deskripsi', 'periode.bulan', 'periode.tahun','periode.tema')
                        ->get();
        // var_dump($majalah);die();
        return view('majalah.viewSekjen',compact('majalah','artikel','berita','kotbah'));
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function terima($id)
    {
        //
        $majalah = DB::table('majalah')->where(['majalah_id' => $id])->get();
        if($majalah[0]->status != 3){
            return redirect('/majalahSekjen/view/'.$id)->with('error', 'Akses langsung melalui URL tidak diizinkan!');
        }
        // var_dump($majalah);die();
        return view('majalah.terima',compact('majalah'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function terimaUpdate(Request $request, $id)
    {
        $majalah = DB::table('majalah')->where(['majalah_id' => $id])->get();
        if($majalah[0]->status != 3){
            return redirect('/majalahSekjen/view/'.$id)->with('error', 'Akses langsung melalui URL tidak diizinkan!');
        }
        $queryInsert = DB::table('majalah')->where(['majalah_id'=>$id])
        ->update([
            'status' => 5,
            'catatan' => $request->input('catatan'),
            'updated_by' =>Session::get('username'),
            'updated_date' => Carbon::now(),
        ]);

        if ($queryInsert){
            // echo 'berhasil';die();
            return redirect('/majalahSekjen/view/'.$id)->with('success', 'Majalah Berhasil Disetujui!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function tolak($id)
    {
        $majalah = DB::table('majalah')->where(['majalah_id' => $id])->get();
        if($majalah[0]->status != 3){
            return redirect('/majalahSekjen/view/'.$id)->with('error', 'Akses langsung melalui URL tidak diizinkan!');
        }
        //
        $majalah = DB::table('majalah')->where(['majalah_id' => $id])->get();
        // var_dump($majalah);die();
        return view('majalah.tolak',compact('majalah'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function tolakUpdate(Request $request, $id)
    {
        $majalah = DB::table('majalah')->where(['majalah_id' => $id])->get();
        if($majalah[0]->status != 3){
            return redirect('/majalahSekjen/view/'.$id)->with('error', 'Akses langsung melalui URL tidak diizinkan!');
        }
        $queryInsert = DB::table('majalah')->where(['majalah_id'=>$id])
        ->update([
            'status' => 4,
            'catatan' => $request->input('catatan'),
            'updated_by' =>Session::get('username'),
            'updated_date' => Carbon::now(),
        ]);

        if ($queryInsert){
            // echo 'berhasil';die();
            return redirect('/majalahSekjen/view/'.$id)->with('success', 'Majalah Berhasil Ditolak!');
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
