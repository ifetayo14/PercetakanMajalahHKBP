<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
class BeritaController extends Controller
{
    public function  index(){
        $dataBerita = DB::table('berita')
            ->join('periode', 'berita.periode_id', '=', 'periode.periode_id')
            ->select('periode.bulan', 'periode.tahun', 'periode.tema', 'berita.berita_id', 'berita.judul', 'berita.user_id', 'berita.status', 'berita.created_by')
            ->where('berita.status', '=', '5')
            ->orderBy('berita.periode_id', 'desc')
            ->get();

        return view('berita.index', compact('dataBerita'));

    }
    public function  indexPengajuan(){
        $dataBerita = DB::table('berita')->where('user_id', '=', Session::get('user_id'))
            ->join('periode', 'berita.periode_id', '=', 'periode.periode_id')
            ->select('periode.bulan', 'periode.tahun', 'periode.tema', 'berita.berita_id', 'berita.judul', 'berita.user_id', 'berita.status', 'berita.created_by', 'berita.catatan')
            ->orderBy('berita.periode_id', 'desc')
            ->get();
        return view('berita.pengajuanBerita', compact('dataBerita'));
    }
    public function indexReview()
    {
        $dataBerita = DB::table('berita')->where('berita.status', '!=', '1')
            ->join('periode', 'berita.periode_id', '=', 'periode.periode_id')
            ->select('periode.bulan', 'periode.tahun', 'periode.tema', 'berita.berita_id', 'berita.judul', 'berita.user_id', 'berita.status', 'berita.created_by', 'berita.catatan')
            ->orderBy('berita.periode_id', 'desc')
            ->get();
        return view('berita.review', compact('dataBerita'));
    }
    public function create()
    {
        return view('berita.add');
    }
    public function store(Request $request)
    {
        $periode = DB::table('periode')->where('status', '=', 'Aktif')->first();
        $request->validate([
            'judul'=>'required',
            'isi'=>'required',
            'file-pelengkap' => 'required'

        ],
            [
                'judul.required'=>'Judul tidak boleh kosong',
                'isi.required'=>'Isi tidak boleh kosong',
                'file-pelengkap.required' => 'File tidak boleh kosong'

            ]);
        $fileName = time().$request->file('file-pelengkap')->getClientOriginalName();
        $queryInsert = DB::table('berita')->insert([
            'judul' => $request->input('judul'),
            'isi' => $request->input('isi'),
            'file' => $fileName,
            'status' => '1',
            'approved1_by' => '0',
            'approved2_by' => '2',
            'periode_id' => $periode->periode_id,
            'user_id' => Session::get('user_id'),
            'created_by' => Session::get('nama'),
            'created_date' => Carbon::now(),
            'updated_by' => '0',
            'updated_date' => Carbon::now()
        ]);

        if ($queryInsert){
            $request->file('file-pelengkap')->move(public_path('uploads'), $fileName);

            return redirect('/berita/pengajuan')->with('success', 'berita berhasil disimpan. Anda masih dapat mengedit Berita. Atau anda dapat mengirim artikel tersebut untuk direview dengan klik tombol upload di kolom aksi.');
        }
    }
    public function upload($id)
    {
        $uploadBerita = DB::table('berita')->where('berita_id', $id)
            ->update([
                'status' => '2'
            ]);

        return redirect()->back()->with('success', 'Berita Dikirim');
    }

    public function edit($id)
    {
        $data = DB::table('berita')->where('berita_id', $id)->first();
        $dataBerita = [
            'dataBerita' => $data
        ];
        return view('berita.edit', $dataBerita);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul'=>'required',
            'isi'=>'required',
        ],
            [
                'judul.required'=>'Judul tidak boleh kosong',
                'isi.required'=>'Isi tidak boleh kosong',
            ]);
        if(is_null($request->file('file-pelengkap'))) {


            $queryUpdate = DB::table('berita')->where('berita_id', $id)
                ->update([
                    'judul' => $request->input('judul'),
                    'isi' => $request->input('isi'),
                    'updated_by' => Session::get('nama'),
                    'updated_date' => Carbon::now(),
                ]);

            if ($request->input('status') == '1'){
                return redirect('berita/pengajuan')->with('success', 'Data Diubah');
            }
            else{
                return redirect('berita')->with('success', 'Data Diubah');
            }
        }
        else{

            $fileName = time().$request->file('file-pelengkap')->getClientOriginalName();
            $queryUpdate = DB::table('berita')->where('berita_id', $id)
                ->update([
                    'judul' => $request->input('judul'),
                    'isi' => $request->input('isi'),
                    'file' => $fileName,
                    'updated_by' => Session::get('nama'),
                    'updated_date' => Carbon::now(),
                ]);

            if ($request->input('status') == '1'){
                $request->file('file-pelengkap')->move(public_path('uploads'), $fileName);
                return redirect('berita/pengajuan')->with('success', 'Data Diubah');
            }
            else{
                $request->file('file-pelengkap')->move(public_path('uploads'), $fileName);

                return redirect('berita')->with('success', 'Data Diubah');
            }
        }
    }
    public function show($id)
    {
        $dataBerita= DB::table('berita')
            ->where('berita_id', $id)
            ->join('periode', 'berita.periode_id', '=', 'berita.periode_id')
            ->select('periode.bulan', 'periode.tahun', 'periode.tema', 'berita.berita_id', 'berita.judul', 'berita.isi','berita.file', 'berita.status', 'berita.created_by', 'berita.catatan')
            ->first();
        if (Session::get('role') == '1' || Session::get('role') == '4'){
            if ($dataBerita->status == '2'){
                $updateStatus = DB::table('berita')->where('berita_id', $id)->update([
                    'status' => '3'
                ]);
            }
        }
        return view('berita.detail', compact('dataBerita'));
    }
    public function showSekjen($id)
    {
        $dataBerita= DB::table('berita')
            ->where('berita_id', $id)
            ->join('periode', 'berita.periode_id', '=', 'berita.periode_id')
            ->select('periode.bulan', 'periode.tahun', 'periode.tema', 'berita.berita_id', 'berita.judul', 'berita.isi','berita.file', 'berita.status', 'berita.created_by', 'berita.periode_id', 'berita.catatan')
            ->first();
        return view('berita.detailSekjen', compact('dataBerita'));
    }

    public function showDewanRedaksi($id)
    {
        $dataBerita= DB::table('berita')
            ->where('berita_id', $id)
            ->join('periode', 'berita.periode_id', '=', 'berita.periode_id')
            ->select('periode.bulan', 'periode.tahun', 'periode.tema', 'berita.berita_id', 'berita.judul', 'berita.isi','berita.file', 'berita.status', 'berita.created_by', 'berita.periode_id', 'berita.catatan')
            ->first();
        return view('berita.detailDewanRedaksi', compact('dataBerita'));
    }
    public function showJemaat($id)
    {
        $dataBerita= DB::table('berita')
            ->where('berita_id', $id)
            ->join('periode', 'berita.periode_id', '=', 'berita.periode_id')
            ->select('periode.bulan', 'periode.tahun', 'periode.tema', 'berita.berita_id', 'berita.judul', 'berita.isi','berita.file', 'berita.status', 'berita.created_by', 'berita.periode_id', 'berita.catatan')
            ->first();
        return view('berita.detailJemaat', compact('dataBerita'));
    }

    public function showAdmin($id)
    {
        $dataBerita= DB::table('berita')
            ->where('berita_id', $id)
            ->join('periode', 'berita.periode_id', '=', 'berita.periode_id')
            ->select('periode.bulan', 'periode.tahun', 'periode.tema', 'berita.berita_id', 'berita.judul', 'berita.isi','berita.file', 'berita.status', 'berita.created_by', 'berita.periode_id', 'berita.catatan')
            ->first();
        return view('berita.detailAdmin', compact('dataBerita'));
    }

    public function acceptBerita($id)
    {
        $acceptArtikel = DB::table('berita')->where('berita_id', $id)
            ->update([
                'approved1_by' => Session::get('nama'),
                'status' => '5'
            ]);

        return redirect()->back()->with('success', 'Berita Diterima');
    }

    public function refuseBerita(Request $request, $id)
    {
        $refuseArtikel = DB::table('berita')->where('berita_id', $id)
            ->update([
                'catatan' => $request->input('catatan'),
                'status' => '4'
            ]);

        $dataArtikel = DB::table('berita')->where('status', '=', '5')->get();

        return redirect()->back()->with('success', 'Berita Ditolak');
    }

    public function destroy($id)
    {
        $query = DB::table('berita')->where('berita_id', $id)->delete();
        return redirect()->back()->with('success', 'Data Dihapus');
    }
}
