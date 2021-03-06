<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Blade;
use App\Models\Orders;

class HardcopyController extends Controller
{
    public function index()
    {
        $dataHardCopy =  DB::table('producthardcopy')
            ->join('periode', 'producthardcopy.periode_id', '=', 'periode.periode_id')
            ->select('producthardcopy.producthardcopy_id','producthardcopy.nama','producthardcopy.cover','producthardcopy.stok','producthardcopy.berat','producthardcopy.harga','producthardcopy.deskripsi','periode.bulan','periode.tahun')

            ->get();
        return view('hardcopy.index', compact('dataHardCopy'));
    }
    public function detailJemaat($id)
    {
        $dataHardCopy =  DB::table('producthardcopy')
            ->join('periode', 'producthardcopy.periode_id', '=', 'periode.periode_id')
            ->select('producthardcopy.producthardcopy_id','producthardcopy.nama','producthardcopy.cover','producthardcopy.stok','producthardcopy.berat','producthardcopy.harga','producthardcopy.deskripsi','periode.bulan','periode.tahun')
            ->where('producthardcopy.producthardcopy_id',$id)
            ->first();
        return view('hardcopy.detail',compact('dataHardCopy'));
    }
    public function detailAdmin($id)
    {
        $dataHardCopy =  DB::table('producthardcopy')
            ->join('periode', 'producthardcopy.periode_id', '=', 'periode.periode_id')
            ->select('producthardcopy.producthardcopy_id','producthardcopy.nama','producthardcopy.cover','producthardcopy.stok','producthardcopy.berat','producthardcopy.harga','producthardcopy.deskripsi','periode.bulan','periode.tahun')
            ->where('producthardcopy.producthardcopy_id',$id)
            ->first();
        return view('hardcopy.admin.detail',compact('dataHardCopy'));
    }
    public function indexAdmin()
    {
        $dataHardCopy =  DB::table('producthardcopy')
            ->join('periode', 'producthardcopy.periode_id', '=', 'periode.periode_id')
            ->select('producthardcopy.producthardcopy_id','producthardcopy.nama','producthardcopy.cover','producthardcopy.stok','producthardcopy.berat','producthardcopy.harga','producthardcopy.deskripsi','periode.bulan','periode.tahun')

            ->get();
        return view('hardcopy.admin.index', compact('dataHardCopy'));
    }
    public function tambah()
    {
        $dataPeriode = DB::table('periode')
            ->get();
        return view('hardcopy.admin.tambah',compact('dataPeriode'));
    }
    public function ubah($id)
    {
        $dataProduct = DB::table('producthardcopy')
            ->where('producthardcopy.producthardcopy_id', $id)
            ->first();
        $dataPeriode = DB::table('periode')
            ->get();
        return view('hardcopy.admin.edit',compact('dataPeriode','dataProduct'));
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
            'nama'=>'required',
            'periode'=>'required',
            'berat' => 'required',
            'harga' => 'required',
            'deskripsi' => 'required',
        ],
            [
                'nama.required'=>'Nama tidak boleh kosong',
                'periode.required'=>'Periode tidak boleh kosong',
                'berat.required' => 'Berat alkitab tidak boleh kosong',
                'harga.required' => 'Harga nats alkitab tidak boleh kosong',
                'deskripsi.required' => 'Deskripsi tidak boleh kosong'
            ]);
        $fileName = time().$request->file('file-pelengkap')->getClientOriginalName();
        $queryInsert = DB::table('producthardcopy')->insert([
            'nama' => $request->input('nama'),
            'cover' => $fileName,
            'norek' =>'ss',
            'periode_id' => $request->input('periode'),
            'harga' => $request->input('harga'),
            'stok' => $request->input('stok'),
            'berat' => $request->input('berat'),
            'deskripsi' => $request->input('deskripsi'),
        ]);
        if ($queryInsert){
            $request->file('file-pelengkap')->move(public_path('uploads/cover'), $fileName);
            return redirect('/hardcopyAdmin')->with('success', 'HardCopy berhasil disimpan. Anda masih dapat mengedit artikel. Atau anda dapat mengirim artikel tersebut untuk direview dengan klik tombol upload di kolom aksi.');
        }

    }
    public function update(Request $request)
    {
        $request->validate([
            'nama'=>'required',
            'periode'=>'required',
            'berat' => 'required',
            'harga' => 'required',
            'deskripsi' => 'required',
        ],
            [
                'nama.required'=>'Nama tidak boleh kosong',
                'periode.required'=>'Periode tidak boleh kosong',
                'berat.required' => 'Berat alkitab tidak boleh kosong',
                'harga.required' => 'Harga nats alkitab tidak boleh kosong',
                'deskripsi.required' => 'Deskripsi tidak boleh kosong'
            ]);
        if(is_null($request->file('file-pelengkap'))) {
            $queryInsert = DB::table('producthardcopy')->update([
                'nama' => $request->input('nama'),
                'norek' =>'ss',
                'periode_id' => $request->input('periode'),
                'harga' => $request->input('harga'),
                'stok' => $request->input('stok'),
                'berat' => $request->input('berat'),
                'deskripsi' => $request->input('deskripsi'),
            ]);
            if ($queryInsert){
                return redirect('/hardcopyAdmin')->with('success', 'Artikel berhasil disimpan. Anda masih dapat mengedit artikel. Atau anda dapat mengirim artikel tersebut untuk direview dengan klik tombol upload di kolom aksi.');
            }
        }
        else{
            $fileName = time().$request->file('file-pelengkap')->getClientOriginalName();
            $queryInsert = DB::table('producthardcopy')->update([
                'nama' => $request->input('nama'),
                'cover' => $fileName,
                'norek' =>'ss',
                'periode_id' => $request->input('periode'),
                'harga' => $request->input('harga'),
                'stok' => $request->input('stok'),
                'berat' => $request->input('berat'),
                'deskripsi' => $request->input('deskripsi'),
            ]);
            if ($queryInsert){
                $request->file('file-pelengkap')->move(public_path('uploads/cover'), $fileName);
                return redirect('/hardcopyAdmin')->with('success', 'Artikel berhasil disimpan. Anda masih dapat mengedit artikel. Atau anda dapat mengirim artikel tersebut untuk direview dengan klik tombol upload di kolom aksi.');
            }
        }


    }


    public function delete($id)
    {
        $query = DB::table('producthardcopy')->where('producthardcopy_id', $id)->delete();
        return redirect()->back()->with('success', 'Data Dihapus');
    }

    public function orderJemaat(){

        if(session()->get('role') == 1 || session()->get('role') == 4){
            $produk = DB::table('orders')
            ->join('producthardcopy', 'orders.producthardcopy_id' ,'producthardcopy.producthardcopy_id')
            ->orderBy('orders_id', 'DESC')
            ->select('orders.*', 'producthardcopy.nama', 'producthardcopy.periode_id', 'producthardcopy.majalah_id', 'producthardcopy.harga')
            ->get();
        }else{
            $produk = DB::table('orders')
            ->where('user_id', session()->get('user_id'))
            ->join('producthardcopy', 'orders.producthardcopy_id' ,'producthardcopy.producthardcopy_id')
            ->orderBy('orders_id', 'DESC')
            ->select('orders.*', 'producthardcopy.nama', 'producthardcopy.periode_id', 'producthardcopy.majalah_id', 'producthardcopy.harga')
            ->get();
        }

        // die($produk);
        return view('hardcopy.listOrder', compact('produk'));
    }

    public function orderDetail($id){
        $produk =DB::table('orders')
        ->where('orders_id', $id)
        ->join('producthardcopy', 'orders.producthardcopy_id' ,'producthardcopy.producthardcopy_id')
        ->select('orders.*', 'producthardcopy.nama', 'producthardcopy.periode_id', 'producthardcopy.majalah_id', 'producthardcopy.harga', 'producthardcopy.deskripsi', 'producthardcopy.berat', 'producthardcopy.norek')
        ->first();

        $city = DB::table('cities')
        ->where('city_id', $produk->ship_city)
        ->first();

        $provinces = DB::table('provinces')
        ->where('province_id', $produk->ship_region)
        ->first();


        return view('hardcopy.detailOrder', compact('produk', 'city', 'provinces'));
    }



}
