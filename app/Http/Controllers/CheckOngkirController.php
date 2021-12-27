<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Province;
use Illuminate\Http\Request;
use Kavist\RajaOngkir\Facades\RajaOngkir;
use DB;
use App\Models\Orders;
use Session;

class CheckOngkirController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
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


        if($request->file('buktiBayar')){
               $fileName = time().$request->file('buktiBayar')->getClientOriginalName();
               
                $save = Orders::create([
                    'user_id' => session()->get('user_id'),
                    'order_date' => "2021-07-26 08:10:19",
                    'status' => "Proses",
                    'ship_date' => "2021-07-26 08:10:19",
                    'ship_name' => $request->nama,
                    'ship_address' => $request->alamat,
                    'ship_city' => $request->city_destination,
                    'ship_region' => $request->province_destination,
                    'ship_postal_code' => $request->kode_pos,
                    'ship_country' => "ID",
                    'qty' => $request->qty,
                    'producthardcopy_id' => $request->producthardcopy_id,
                    'price' => $price,
                    'bukti' => $fileName
                ]);

       if ($save){
                $request->file('buktiBayar')->move(public_path('uploads/bukti_bayar'), $fileName);
                return redirect('/member')->with('success', 'Upload Berhasil');
            }else{
                dd("fail");
            }

   }else{
       dd('f');
   }

    }
}
