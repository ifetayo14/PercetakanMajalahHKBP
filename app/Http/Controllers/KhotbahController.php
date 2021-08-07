<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use File;
class KhotbahController extends Controller
{
    public function  index(){
        $dataKhotbah = DB::table('kotbah')
            ->join('periode', 'kotbah.periode_id', '=', 'periode.periode_id')
            ->select('periode.bulan', 'periode.tahun', 'periode.tema', 'kotbah.kotbah_id', 'kotbah.judul', 'kotbah.user_id', 'kotbah.status', 'kotbah.created_by')
            ->where('kotbah.status', '=', '5')
            ->get();

        return view('khotbah.index', compact('dataKhotbah'));

    }
    public function  indexPengajuan(){
        $dataKhotbah = DB::table('kotbah')->where('user_id', '=', Session::get('user_id'))->get();
        return view('khotbah.pengajuanKhotbah', compact('dataKhotbah'));
    }
    public function indexReview()
    {
        $dataKhotbah = DB::table('kotbah')->where('kotbah.status', '!=', '1')
            ->join('periode', 'kotbah.periode_id', '=', 'periode.periode_id')
            ->select('periode.bulan', 'periode.tahun', 'periode.tema', 'kotbah.kotbah_id', 'kotbah.judul', 'kotbah.user_id', 'kotbah.status', 'kotbah.created_by')
            ->get();
        return view('khotbah.review', compact('dataKhotbah'));
    }
    public function create()
    {
        return view('khotbah.add');
    }
    public function store(Request $request)
    {
        $periode = DB::table('periode')->where('status', '=', 'Aktif')->first();
        $request->validate([
            'judul'=>'required',
            'isi'=>'required',
            'nats'=>'required',
            'topik' => 'required',
            'nama_minggu' => 'required',
            'file-pelengkap' => 'required'
        ],
            [
                'judul.required'=>'Judul tidak boleh kosong',
                'isi.required'=>'Isi tidak boleh kosong',
                'nats.required'=>'Nats tidak boleh kosong',
                'topik.required'=>'Topik tidak boleh kosong',
                'nama_minggu.required'=>'Nama Minggu tidak boleh kosong',
                'file-pelengkap.required' => 'File tidak boleh kosong'
            ]);
        $fileName = time().$request->file('file-pelengkap')->getClientOriginalName();
        $queryInsert = DB::table('kotbah')->insert([
            'judul' => $request->input('judul'),
            'isi' => $request->input('isi'),
            'nats_alkitab' =>  $request->input('nats'),
            'file' => $fileName,
            'status' => '1',
            'approved1_by' => '0',
            'topik' => $request->input('topik'),
            'nama_minggu' => $request->input('nama_minggu'),
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
            return redirect('/khotbah/pengajuan')->with('success', 'berita berhasil disimpan. Anda masih dapat mengedit Khotbah. Atau anda dapat mengirim artikel tersebut untuk direview dengan klik tombol upload di kolom aksi.');
        }
    }

    public function upload($id)
    {
        $uploadBerita = DB::table('kotbah')->where('kotbah_id', $id)
            ->update([
                'status' => '2'
            ]);

        return redirect()->back()->with('success', 'Khotbah Dikirim');
    }
    public function edit($id)
    {
        $data = DB::table('kotbah')->where('kotbah_id', $id)->first();
        $dataKhotbah = [
            'dataKhotbah' => $data
        ];
        return view('khotbah.edit', $dataKhotbah);
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'judul'=>'required',
            'isi'=>'required',
            'nats'=>'required',
            'nama_minggu'=>'required',
            'topik'=>'required'
        ],
            [
                'judul.required'=>'Judul tidak boleh kosong',
                'isi.required'=>'Isi tidak boleh kosong',
                'nats.required'=>'Nats tidak boleh kosong',
                'topik.required'=>'Topik tidak boleh kosong',
                'nama_minggu.required'=>'Nama Minggu tidak boleh kosong'



            ]);
        if(is_null($request->file('file-pelengkap'))){

            $queryUpdate = DB::table('kotbah')->where('kotbah_id', $id)
                ->update([
                    'judul' => $request->input('judul'),
                    'isi' => $request->input('isi'),
                    'nats_alkitab' =>  $request->input('nats'),
                    'nama_minggu' => $request->input('nama_minggu'),
                    'topik' => $request->input('topik'),
                    'updated_by' => Session::get('nama'),
                    'updated_date' => Carbon::now(),
                ]);

            if ($request->input('status') == '1'){
                return redirect('khotbah/pengajuan')->with('success', 'Data Diubah');
            }
            else{
                return redirect('khotbah')->with('success', 'Data Diubah');
            }
        }
        else{
            $fileName = time().$request->file('file-pelengkap')->getClientOriginalName();
            $queryUpdate = DB::table('kotbah')->where('kotbah_id', $id)
                ->update([
                    'judul' => $request->input('judul'),
                    'isi' => $request->input('isi'),
                    'nats_alkitab' =>  $request->input('nats'),
                    'nama_minggu' => $request->input('nama_minggu'),
                    'file' => $fileName,
                    'topik' => $request->input('topik'),
                    'updated_by' => Session::get('nama'),
                    'updated_date' => Carbon::now(),
                ]);

            if ($request->input('status') == '1'){
                $request->file('file-pelengkap')->move(public_path('uploads'), $fileName);
                return redirect('khotbah/pengajuan')->with('success', 'Data Diubah');
            }
            else{
                $request->file('file-pelengkap')->move(public_path('uploads'), $fileName);
                return redirect('khotbah')->with('success', 'Data Diubah');
            }
        }

    }
    public function show($id)
    {
        $dataKhotbah = DB::table('kotbah')
            ->where('kotbah_id', $id)
            ->join('periode', 'kotbah.periode_id', '=', 'kotbah.periode_id')
            ->select('periode.bulan', 'periode.tahun', 'periode.tema', 'kotbah.kotbah_id', 'kotbah.judul','kotbah.nama_minggu','kotbah.topik', 'kotbah.file', 'kotbah.nats_alkitab', 'kotbah.isi', 'kotbah.status', 'kotbah.created_by')
            ->first();
        if (Session::get('role') == '1' || Session::get('role') == '4'){
            if ($dataKhotbah->status == '2'){
                $updateStatus = DB::table('kotbah')->where('kotbah_id', $id)->update([
                    'status' => '3'
                ]);
            }
        }

        return view('khotbah.detail', compact('dataKhotbah'));
    }
    public function showSekjen($id)
    {
        $dataKhotbah = DB::table('kotbah')
            ->where('kotbah_id', $id)
            ->join('periode', 'kotbah.periode_id', '=', 'kotbah.periode_id')
            ->select('periode.bulan', 'periode.tahun', 'periode.tema', 'kotbah.kotbah_id', 'kotbah.judul','kotbah.nama_minggu','kotbah.topik', 'kotbah.file', 'kotbah.nats_alkitab', 'kotbah.isi', 'kotbah.status', 'kotbah.created_by', 'kotbah.periode_id')
            ->first();

        return view('khotbah.detailSekjen', compact('dataKhotbah'));
    }
    public function acceptKhotbah($id)
    {
        $acceptArtikel = DB::table('kotbah')->where('kotbah_id', $id)
            ->update([
                'approved1_by' => Session::get('nama'),
                'status' => '5'
            ]);

        return redirect()->back()->with('success', 'Khotbah Diterima');
    }

    public function refuseKhotbah(Request $request, $id)
    {
        $refuseArtikel = DB::table('kotbah')->where('kotbah_id', $id)
            ->update([
                'catatan' => $request->input('catatan'),
                'status' => '4'
            ]);

        $dataArtikel = DB::table('kotbah')->where('status', '=', '5')->get();

        return redirect()->back()->with('success', 'Khotbah Ditolak');
    }


    public function destroy($id)
    {
        $query = DB::table('kotbah')->where('kotbah_id', $id)->delete();
        return redirect()->back()->with('success', 'Data Dihapus');
    }
}
