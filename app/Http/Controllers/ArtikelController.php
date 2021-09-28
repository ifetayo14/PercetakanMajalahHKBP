<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ArtikelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $dataArtikel = DB::table('artikel')
            ->join('periode', 'artikel.periode_id', '=', 'periode.periode_id')
            ->select('periode.bulan', 'periode.tahun', 'periode.tema', 'artikel.created_by', 'artikel.judul', 'artikel.artikel_id')
            ->where('artikel.status', '=', '5')
            ->get();
        return view('artikel.index', compact('dataArtikel'));
    }

    public function indexPengajuan()
    {
        $dataArtikel = DB::table('artikel')->where('user_id', '=', Session::get('user_id'))->get();
        return view('artikel.pengajuanArtikel', compact('dataArtikel'));
    }

    public function indexReview()
    {
        $dataArtikel = DB::table('artikel')->where('artikel.status', '!=', '1')
            ->join('periode', 'artikel.periode_id', '=', 'periode.periode_id')
            ->select('periode.bulan', 'periode.tahun', 'periode.tema', 'artikel.artikel_id', 'artikel.judul', 'artikel.user_id', 'artikel.status', 'artikel.created_by')
            ->get();
        return view('artikel.review', compact('dataArtikel'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('artikel.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $periode = DB::table('periode')->where('status', '=', 'Aktif')->first();
        $request->validate([
            'judul'=>'required',
            'isi'=>'required',
            'nats_alkitab' => 'required',
            'isi_alkitab' => 'required',
            'file-pelengkap' => 'required',
        ],
        [
            'judul.required'=>'Judul tidak boleh kosong',
            'isi.required'=>'Isi tidak boleh kosong',
            'nats_alkitab.required' => 'Nats alkitab tidak boleh kosong',
            'isi_alkitab.required' => 'Isi nats alkitab tidak boleh kosong',
            'file-pelengkap.required' => 'File tidak boleh kosong'
        ]);
        $fileName = time().$request->file('file-pelengkap')->getClientOriginalName();
        $queryInsert = DB::table('artikel')->insert([
            'judul' => $request->input('judul'),
            'isi' => $request->input('isi'),
            'nats_alkitab' => $request->input('nats_alkitab'),
            'isi_alkitab' => $request->input('isi_alkitab'),
            'file' => $fileName,
            'status' => '1',
            'approved1_by' => '0',
            'approved2_by' => '2',
            'periode_id' => $periode->periode_id,
            'user_id' => Session::get('user_id'),
            'created_by' => Session::get('nama'),
            'created_date' => Carbon::now(),
            'updated_by' => '0',
            'updated_date' => Carbon::now(),
            'catatan' => '0'
        ]);

        if ($queryInsert){
            $request->file('file-pelengkap')->move(public_path('uploads'), $fileName);
            return redirect('/artikel/pengajuan')->with('success', 'Artikel berhasil disimpan. Anda masih dapat mengedit artikel. Atau anda dapat mengirim artikel tersebut untuk direview dengan klik tombol upload di kolom aksi.');
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
        $dataArtikel = DB::table('artikel')
            ->where('artikel_id', $id)
            ->join('periode', 'artikel.periode_id', '=', 'periode.periode_id')
            ->select('periode.bulan', 'periode.tahun', 'periode.tema', 'artikel.artikel_id', 'artikel.judul', 'artikel.isi','artikel.nats_alkitab','artikel.isi_alkitab', 'artikel.file', 'artikel.status', 'artikel.created_by')
            ->first();
        if (Session::get('role') == '1' || Session::get('role') == '4'){
            if ($dataArtikel->status == '2'){
                $updateStatus = DB::table('artikel')->where('artikel_id', $id)->update([
                    'status' => '3'
                ]);
            }
        }
        return view('artikel.detail', compact('dataArtikel'));
    }

    public function showSekjen($id)
    {
        $dataArtikel = DB::table('artikel')
            ->where('artikel_id', $id)
            ->join('periode', 'artikel.periode_id', '=', 'periode.periode_id')
            ->select('periode.bulan', 'periode.tahun', 'periode.tema', 'artikel.artikel_id', 'artikel.judul', 'artikel.isi', 'artikel.file', 'artikel.status', 'artikel.periode_id', 'artikel.created_by')
            ->first();
        return view('artikel.detailSekjen', compact('dataArtikel'));
    }

    public function showAdmin($id)
    {
        $dataArtikel = DB::table('artikel')
            ->where('artikel_id', $id)
            ->join('periode', 'artikel.periode_id', '=', 'periode.periode_id')
            ->select('periode.bulan', 'periode.tahun', 'periode.tema', 'artikel.artikel_id', 'artikel.judul', 'artikel.isi', 'artikel.file', 'artikel.status', 'artikel.periode_id', 'artikel.created_by')
            ->first();
        return view('artikel.detailAdmin', compact('dataArtikel'));
    }
    public function acceptArtikel($id)
    {
        $acceptArtikel = DB::table('artikel')->where('artikel_id', $id)
            ->update([
                'approved1_by' => Session::get('nama'),
                'status' => '5'
            ]);

        return redirect()->back()->with('success', 'Artikel Diterima');
    }

    public function refuseArtikel(Request $request, $id)
    {
        $refuseArtikel = DB::table('artikel')->where('artikel_id', $id)
            ->update([
                'catatan' => $request->input('catatan'),
                'status' => '4'
            ]);

        $dataArtikel = DB::table('artikel')->where('status', '=', '5')->get();

        return redirect()->back()->with('success', 'Artikel Ditolak');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function upload($id)
    {
        $uploadArtikel = DB::table('artikel')->where('artikel_id', $id)
            ->update([
                'status' => '2'
            ]);

        return redirect()->back()->with('success', 'Artikel Dikirim');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = DB::table('artikel')->where('artikel_id', $id)->first();
        $dataArtikel = [
            'dataArtikel' => $data
        ];
        return view('artikel.edit', $dataArtikel);
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
            'nats_alkitab' => 'required',
            'isi_alkitab' => 'required',
        ],
        [
            'judul.required'=>'Judul tidak boleh kosong',
            'isi.required'=>'Isi tidak boleh kosong',
            'nats_alkitab.required' => 'Nats alkitab tidak boleh kosong',
            'isi_alkitab.required' => 'Isi nats alkitab tidak boleh kosong',
        ]);
        if(is_null($request->file('file-pelengkap'))) {
            $queryUpdate = DB::table('artikel')->where('artikel_id', $id)
                ->update([
                    'judul' => $request->input('judul'),
                    'isi' => $request->input('isi'),
                    'nats_alkitab' => $request->input('nats_alkitab'),
                    'isi_alkitab' => $request->input('isi_alkitab'),
                    'updated_by' => Session::get('nama'),
                    'updated_date' => Carbon::now(),

                ]);

            if ($request->input('status') == '1') {
                return redirect('artikel/pengajuan')->with('success', 'Data Diubah');
            } else {
                return redirect('artikel')->with('success', 'Data Diubah');
            }
        }
        else{
            $fileName = time().$request->file('file-pelengkap')->getClientOriginalName();
            $queryUpdate = DB::table('artikel')->where('artikel_id', $id)
                ->update([
                    'judul' => $request->input('judul'),
                    'isi' => $request->input('isi'),
                    'nats_alkitab' => $request->input('nats_alkitab'),
                    'isi_alkitab' => $request->input('isi_alkitab'),
                    'updated_by' => Session::get('nama'),
                    'updated_date' => Carbon::now(),
                ]);

            if ($request->input('status') == '1') {
                $request->file('file-pelengkap')->move(public_path('uploads'), $fileName);
                return redirect('artikel/pengajuan')->with('success', 'Data Diubah');
            } else {
                $request->file('file-pelengkap')->move(public_path('uploads'), $fileName);
                return redirect('artikel')->with('success', 'Data Diubah');
            }
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
        $query = DB::table('artikel')->where('artikel_id', $id)->delete();
        return redirect()->back()->with('success', 'Data Dihapus');
    }
}
