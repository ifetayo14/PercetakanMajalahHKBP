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
                        ->join('periode','majalah.periode_id','=','periode.periode_id')
                        ->select('judul', 'status.deskripsi as status', 'majalah.catatan_dewan', 'majalah.approval_dewan',  'majalah.status as status_id','majalah_id','majalah.deskripsi as deskripsi','periode.bulan', 'periode.tahun')
                        ->orderBy('majalah.periode_id', 'desc')
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
                        ->join('periode','majalah.periode_id','=','periode.periode_id')
                        ->select('judul', 'status.deskripsi as status', 'majalah.catatan_dewan', 'majalah.approval_dewan', 'majalah_id','majalah.deskripsi as deskripsi','periode.bulan', 'periode.tahun')
                        ->orderBy('majalah.periode_id', 'desc')
                        ->get();
        return view('majalah.indexSekjen',compact('majalah'));
    }
    public function indexDewanRedaksi()
    {
        $majalah =  DB::table('majalah')
                        ->join('status', 'status.id','=','majalah.status')
                        ->join('periode','majalah.periode_id','=','periode.periode_id')
                        ->select('judul', 'status.deskripsi as status', 'majalah.catatan_dewan', 'majalah.approval_dewan', 'majalah_id','majalah.deskripsi as deskripsi','periode.bulan', 'periode.tahun')
                        ->orderBy('majalah.periode_id', 'desc')
                        ->get();
        return view('majalah.indexDewanRedaksi',compact('majalah'));
    }
    public function indexJemaat(){
        $majalah =  DB::table('majalah')
            ->join('status', 'status.id','=','majalah.status')
            ->join('periode','majalah.periode_id','=','periode.periode_id')
            ->select('judul', 'status.deskripsi as status','majalah_id','majalah.deskripsi as deskripsi','periode.bulan', 'periode.tahun')
            ->where('majalah.status','=','5')
            ->orderBy('majalah.periode_id', 'desc')
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
            ->orderBy('majalah.periode_id', 'desc')
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
        $request->validate([
            'judul'=>'required',
            'deskripsi'=>'required',
        ],
        [
            'judul.required' => 'Judul tidak boleh kosong!',
            'deskripsi.required' => 'Deskripsi tidak boleh kosong!',
        ]);

        if(is_null($request->file('file-pelengkap'))){
            $majalah = [
                'judul' => $request->input('judul'),
                'deskripsi' => $request->input('deskripsi'),
                'status' => 1,
                'periode_id' => $periode[0]->periode_id,
                'created_by' =>Session::get('username'),
                'created_date' => Carbon::now(),
            ];
            
            $queryInsert = DB::table('majalah')->insert([$majalah]);
            if ($queryInsert){
                Session::flash('success', 'Majalah berhasil ditambah!');
                return redirect('/majalah');
            }else{
                Session::flash('errorr', 'Majalah tidak berhasil ditambah!');
                return view('majalah.add', compact('majalah'));
            }
        }else{
            $fileName = time().$request->file('file-pelengkap')->getClientOriginalName();
            $majalah = [
                'judul' => $request->input('judul'),
                'deskripsi' => $request->input('deskripsi'),
                'file' => $fileName,
                'status' => 1,
                'periode_id' => $periode[0]->periode_id,
                'created_by' =>Session::get('username'),
                'created_date' => Carbon::now(),
            ];
            
            $queryInsert = DB::table('majalah')->insert([$majalah]);
            if ($queryInsert){
                $request->file('file-pelengkap')->move(public_path('uploads'), $fileName);
                Session::flash('success', 'Majalah berhasil ditambah!');
                return redirect('/majalah');
            }else{
                Session::flash('errorr', 'Majalah tidak berhasil ditambah!');
                return view('majalah.add', compact('majalah'));
            }
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
        $majalah =  DB::table('majalah')
        ->join('status', 'status.id','=','majalah.status')
        ->join('periode', 'periode.periode_id','=','majalah.periode_id')
        ->select('judul', 'majalah.catatan','majalah.file', 'status.deskripsi as status', 'majalah.catatan_dewan', 'majalah.approval_dewan', 'majalah.status as status_id','majalah_id','majalah.deskripsi as deskripsi', 'periode.bulan', 'periode.tahun','periode.tema')
        ->where(['majalah.majalah_id' => $id])
        ->get();
        // var_dump($majalah);die();
        $artikel = DB::table('artikel')->where(['periode_id' => $id])->whereIn('status',[2,3,5])
        ->join('status', 'status.id','=','artikel.status')->select('artikel.*', 'status.deskripsi as status_des')->get();
        $berita = DB::table('berita')->where(['periode_id' => $id])->whereIn('status',[2,3,5])
        ->join('status', 'status.id','=','berita.status')->select('berita.*', 'status.deskripsi as status_des')->get();
        $kotbah = DB::table('kotbah')->where(['periode_id' => $id])->whereIn('status',[2,3,5])
        ->join('status', 'status.id','=','kotbah.status')->select('kotbah.*', 'status.deskripsi as status_des')->get();
        // $majalah =  DB::table('majalah')
        //                 ->join('status', 'status.id','=','majalah.status')
        //                 ->join('periode', 'periode.periode_id','=','majalah.periode_id')
        //                 ->select('judul', 'majalah.catatan','majalah.file', 'status.deskripsi as status', 'majalah.status as status_id','majalah_id', 'majalah.catatan_dewan', 'majalah.approval_dewan', 'majalah.deskripsi as deskripsi', 'periode.bulan', 'periode.tahun','periode.tema')
        //                 ->get();
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
        // echo $id;exit;
        $majalah = DB::table('majalah')->where(['majalah_id' => $id])->get();
        // if($majalah[0]->status == 2 ){
        //     DB::table('majalah')->where(['majalah_id'=>$id])->update([
        //         'status' => 3,
        //         'updated_by' =>Session::get('username'),
        //         'updated_date' => Carbon::now(),
        //     ]);
        // }
        $artikel = DB::table('artikel')->where(['periode_id' => $majalah[0]->periode_id, 'status' =>5])->get();
        $berita = DB::table('berita')->where(['periode_id' => $majalah[0]->periode_id, 'status' =>5])->get();
        $kotbah = DB::table('kotbah')->where(['periode_id' => $majalah[0]->periode_id, 'status' =>5])->get();
        $majalah =  DB::table('majalah')
                        ->join('status', 'status.id','=','majalah.status')
                        ->join('periode', 'periode.periode_id','=','majalah.periode_id')
                        ->select('judul', 'majalah.catatan','majalah.file', 'status.deskripsi as status', 'majalah.status as status_id','majalah_id',  'majalah.catatan_dewan', 'majalah.approval_dewan', 'majalah.deskripsi as deskripsi', 'periode.bulan', 'periode.tahun','periode.tema')
                        ->where(['majalah.majalah_id' => $majalah[0]->majalah_id])
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
    public function showDewanRedaksi($id)
    {
       
        $majalah = DB::table('majalah')->where(['majalah_id' => $id])->get(); 
        if($majalah[0]->approval_dewan == 'Diajukan'){
            DB::table('majalah')->where(['majalah_id'=>$id])->update([
                'approval_dewan' => 'Review',
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
                        ->select('judul', 'majalah.catatan','majalah.file', 'status.deskripsi as status', 'majalah.catatan_dewan', 'majalah.approval_dewan', 'majalah.status as status_id','majalah_id','majalah.deskripsi as deskripsi', 'periode.bulan', 'periode.tahun','periode.tema')
                        ->where(['majalah.majalah_id' => $majalah[0]->majalah_id])
                        ->get();
        
        // var_dump($majalah);die();
        return view('majalah.viewDewanRedaksi',compact('majalah','artikel','berita','kotbah'));
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
                        ->where(['majalah.majalah_id' => $majalah[0]->majalah_id])
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
        
        if(is_null($request->file('file-pelengkap'))){

            $queryUpdate = DB::table('majalah')->where(['majalah_id'=>$id])->update([
                'judul' => $request->input('judul'),
                'deskripsi' => $request->input('deskripsi'),
                'updated_by' =>Session::get('username'),
                'status' => 1,
                'updated_date' => Carbon::now(),
            ]);
            if ($queryUpdate){
                Session::flash('success', 'Majalah Berhasil Update!');
                return redirect('/majalah');
            }
        }
        else{
            $fileName = time().$request->file('file-pelengkap')->getClientOriginalName();
            // echo $fileName;exit;
            $queryUpdate = DB::table('majalah')->where(['majalah_id'=>$id])->update([
                    'judul' => $request->input('judul'),
                    'deskripsi' => $request->input('deskripsi'),
                    'file' => $fileName,
                    'updated_by' =>Session::get('username'),
                    'status' => 1,
                    'updated_date' => Carbon::now(),
                ]);
                // var_dump($queryUpdate);exit;
            if ($queryUpdate){
                $request->file('file-pelengkap')->move(public_path('uploads'), $fileName);
                Session::flash('success', 'Majalah Berhasil Update!');
                return redirect('/majalah');
            }
        }
    }

    public function ajukan($id)
    {
        //
        
        $majalah = DB::table('majalah')->where(['majalah_id' => $id])->get();
        if($majalah[0]->approval_dewan != 'Setuju'){
            Session::flash('error', 'Majalah belum disetujui oleh Dewan Redaksi!'); 
            return redirect('/majalah');
        }
        DB::table('majalah')->where(['majalah_id' => $id])->update([
            'status' => 2,
            'updated_by' =>Session::get('username'),
            'updated_date' => Carbon::now(),
        ]);
        Session::flash('success', 'Majalah diajukan ke SEKJEN!'); 
        return redirect('/majalah');
    }
    public function ajukanDewanRedaksi($id)
    {
        //
        DB::table('majalah')->where(['majalah_id' => $id])->update([
            'approval_dewan' => 'Review',
            'updated_by' =>Session::get('username'),
            'updated_date' => Carbon::now(),
        ]);
        Session::flash('success', 'Majalah diajukan ke Dewan Redaksi!'); 
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

    public function terimaDewanRedaksi($id)
    {
        //
        $majalah = DB::table('majalah')->where(['majalah_id' => $id])->get();
        if($majalah[0]->status  == 'Setuju'){
            return redirect('/majalahDewanRedaksi/view/'.$id)->with('error', 'Majalah sudah disetujui!');
        }
        // var_dump($majalah);die();
        return view('majalah.terimaDewanRedaksi',compact('majalah'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function terimaUpdateDewanRedaksi(Request $request, $id)
    {
        $majalah = DB::table('majalah')->where(['majalah_id' => $id])->get();
        if($majalah[0]->status  == 'Setuju'){
            return redirect('/majalahDewanRedaksi/view/'.$id)->with('error', 'Majalah sudah disetujui!');
        }
        $queryInsert = DB::table('majalah')->where(['majalah_id'=>$id])
        ->update([
            'approval_dewan' => 'Setuju',
            'catatan_dewan' => $request->input('catatan_dewan'),
            'updated_by' =>Session::get('username'),
            'updated_date' => Carbon::now(),
        ]);

        if ($queryInsert){
            // echo 'berhasil';die();
            return redirect('/majalahDewanRedaksi/view/'.$id)->with('success', 'Majalah Berhasil Disetujui!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function tolakDewanRedaksi($id)
    {
        $majalah = DB::table('majalah')->where(['majalah_id' => $id])->get();
        if($majalah[0]->status == 'Setuju'){
            return redirect('/majalahDewanRedaksi/view/'.$id)->with('error', 'Majalah sudah disetujui!');
        }
        //
        $majalah = DB::table('majalah')->where(['majalah_id' => $id])->get();
        // var_dump($majalah);die();
        return view('majalah.tolakDewanRedaksi',compact('majalah'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function tolakUpdateDewanRedaksi(Request $request, $id)
    {
        $majalah = DB::table('majalah')->where(['majalah_id' => $id])->get();
        if($majalah[0]->status == 'Setuju'){
            return redirect('/majalahDewanRedaksi/view/'.$id)->with('error', 'Majalah sudah disetujui!');
        }
        $queryInsert = DB::table('majalah')->where(['majalah_id'=>$id])
        ->update([
            'approval_dewan' => 'Tolak',
            'catatan_dewan' => $request->input('catatan_dewan'),
            'updated_by' =>Session::get('username'),
            'updated_date' => Carbon::now(),
        ]);

        if ($queryInsert){
            // echo 'berhasil';die();
            return redirect('/majalahDewanRedaksi/view/'.$id)->with('success', 'Majalah Berhasil Ditolak!');
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
