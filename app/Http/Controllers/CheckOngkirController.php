<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Province;
use Illuminate\Http\Request;
use Kavist\RajaOngkir\Facades\RajaOngkir;
use DB;
use App\Models\Orders;
use Session;
use Carbon\Carbon;

class CheckOngkirController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $request->validate([
            'stok'=>'required',
        ],
            [
                'stok.required'=>'Stok tidak boleh kosong',

            ]);
        $dataHardCopy =  DB::table('producthardcopy')
        ->join('periode', 'producthardcopy.periode_id', '=', 'periode.periode_id')
        ->select('producthardcopy.producthardcopy_id','producthardcopy.nama','producthardcopy.cover','producthardcopy.stok','producthardcopy.berat','producthardcopy.harga','producthardcopy.deskripsi','periode.bulan','periode.tahun')
        ->where('producthardcopy.producthardcopy_id',$request->id)
        ->first();
        $provinces = Province::pluck('name', 'province_id');
        $qty = $request->stok;

        return view('hardcopy.checkout', compact('provinces', 'dataHardCopy', 'qty'));
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCities($id)
    {
        $city = City::where('province_id', $id)->pluck('name', 'city_id');
        return response()->json($city);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function check_ongkir(Request $request)
    {

        $weight = $request->weight;
        if($weight<1){
            $weight = 1;
        }
        
        $cost = RajaOngkir::ongkosKirim([
            'origin'        => 465, // ID kota/kabupaten asal -> 465 id Tapanuli Utara
            'destination'   => $request->city_destination, // ID kota/kabupaten tujuan
            'weight'        => $weight, // berat barang dalam gram
            'courier'       => "pos" // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
        ])->get();

        return response()->json($cost);
    }

    public function order(Request $request){

        $price = ($request->qty * $request->harga_hd) +$request->rOngkir;

        $dataHardCopy =  DB::table('producthardcopy')
        ->where('producthardcopy_id', $request->producthardcopy_id)
        ->first();

        DB::table('producthardcopy')
        ->where('producthardcopy_id', $request->producthardcopy_id)
        ->update([
            'stok' => $dataHardCopy->stok-$request->qty
        ]);
        // if($request->file('buktiBayar')){
        //        $fileName = time().$request->file('buktiBayar')->getClientOriginalName();

                $save = Orders::create([
                    'user_id' => session()->get('user_id'),
                    'order_date' => Carbon::now(),
                    'status' => "Menunggu Pembayaran",
                    'ship_date' => Carbon::now(),
                    'ship_name' => $request->nama,
                    'ship_address' => $request->alamat,
                    'ship_city' => $request->city_destination,
                    'ship_region' => $request->province_destination,
                    'ship_postal_code' => $request->kode_pos,
                    'ship_country' => $request->negara,
                    'qty' => $request->qty,
                    'producthardcopy_id' => $request->producthardcopy_id,
                    'price' => $price,
                    'bukti' => "null"
                ]);

       if ($save){
                // $request->file('buktiBayar')->move(public_path('uploads/bukti_bayar'), $fileName);
                return redirect('/hardcopy/order')->with('success', 'Upload Berhasil');
            }else{
                dd("fail");
            }

//    }

    }

    public function uploadBukti(Request $request){
        if($request->file('fileBukti')){
            $fileName = time().$request->file('fileBukti')->getClientOriginalName();

            $produk = Orders::find($request->id);

            $produk->status = "Menunggu Konfirmasi";
            $produk->bukti = $fileName;
            if ($produk->update()){

                $request->file('fileBukti')->move(public_path('uploads/bukti_bayar'), $fileName);
                return redirect('/hardcopy/order')->with('success', 'Upload Bukti Berhasil');
            }
        }
    }

    public function terimaOrder($id){
        $produk = Orders::find($id);
        $produk->status = "Proses pengiriman barang";
        if ($produk->update()){
            return redirect('/hardcopy/order')->with('success', 'Berhasil meneria orderan');
        }
    }

    public function uploadResi(Request $request){
        if($request->file('fileResi')){
            $fileName = time().$request->file('fileResi')->getClientOriginalName();

            $produk = Orders::find($request->id);

            $produk->status = "Dikirim";
            $produk->resi = $fileName;
            if ($produk->update()){
                $request->file('fileResi')->move(public_path('uploads/resi'), $fileName);
                return redirect('/hardcopy/order')->with('success', 'Upload Resi Berhasil');
            }
        }
    }
    public function tolakOrder($id){
        $produk = Orders::find($id);
        $produk->status = "Ditolak";

        $dataHardCopy =  DB::table('producthardcopy')
        ->where('producthardcopy_id', $produk->producthardcopy_id)
        ->first();

        DB::table('producthardcopy')
        ->where('producthardcopy_id',  $produk->producthardcopy_id)
        ->update([
            'stok' => $dataHardCopy->stok+$produk->qty
        ]);
        if ($produk->update()){
            return redirect('/hardcopy/order')->with('success', 'Berhasil menolak orderan');
        }

    }

    public function konfirmasiOrder($id){
        $produk = Orders::find($id);
        $produk->status = "Selesai";
        $produk->ship_date = Carbon::now();
        if ($produk->update()){
            return redirect('/hardcopy/order')->with('success', 'Barang berhasil diterima');
        }

    }
}
