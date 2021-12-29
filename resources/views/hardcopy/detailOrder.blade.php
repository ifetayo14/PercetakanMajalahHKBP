@extends('layout.layout')

@section('title')
    Detail HardCopy {{$produk->nama}}
@endsection
@section('main-content')
<div class="row d-flex justify-content-between">
    <h1 class="h3">Detail Pembelian</h1>
    @if(\Illuminate\Support\Facades\Session::get('role') == '1' || \Illuminate\Support\Facades\Session::get('role') == '4')
     @endif
</div>
<br>

    <div class="container card mb-4 p-2 align-self-center" style="min-height: 400px;">

        <div class="row p-3">
            <!-- <div class="col-md-5">
                <img class="w-100" src="https://winstarlink.com/wp-content/uploads/2020/02/jasa-pembuatan-desain-katalog-Portrait-10.jpg" alt="" height="400px">
            </div> -->
            <div class="col-md-7">
                <h1 class="page-head-title h3 text-center radius">{{$produk->nama}}</h1>
                <form method="get" action="{{url('/ongkir')}}">
                    <input type="text" hidden name="id" value="{{$produk->producthardcopy_id}}">
                    <div class="card-text mt-4 pt-2 pb-2 pl-2 pr-2" style="min-height: 300px">
                        <div class="row  mt-1">
                            <div class="col-sm-3">Nama Penerima</div>
                            <div class="col-sm-0">:</div>
                            <div class="col-sm-8">{{$produk->ship_name}}</div>
                        </div>
                        <div class="row  mt-1">
                            <div class="col-sm-3">Alamat</div>
                            <div class="col-sm-0">:</div>
                            <div class="col-sm-8">{{$provinces->name}}, {{$city->name}}, {{$produk->ship_address}}</div>
                        </div>
                        <div class="row  mt-1">
                            <div class="col-sm-3">Kode Post</div>
                            <div class="col-sm-0">:</div>
                            <div class="col-sm-8">{{$produk->ship_postal_code}}</div>
                        </div>
                        <div class="row  mt-1">
                            <div class="col-sm-3">Deskripsi</div>
                            <div class="col-sm-0">:</div>
                            <div class="col-sm-8">{{$produk->deskripsi}}</div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-3">Berat</div>
                            <div class="col-sm-0">:</div>
                            <div class="col-sm-8">{{$produk->berat}} kg</div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-3">Qty</div>
                            <div class="col-sm-0">:</div>
                            <div class="col-sm-8">{{$produk->qty}}</div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-3">Harga Produk</div>
                            <div class="col-sm-0">:</div>
                            <div class="col-sm-8">Rp. {{$produk->harga}}</div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-3">Ongkir Produk</div>
                            <div class="col-sm-0">:</div>
                            <div class="col-sm-8">Rp. {{$produk->price-$produk->harga}}</div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-3">Status</div>
                            <div class="col-sm-0">:</div>
                            <div class="col-sm-8">{{$produk->status}}</div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-3">Pembayarn ke</div>
                            <div class="col-sm-0">:</div>
                            <div class="col-sm-8">{{$produk->norek}}</div>
                        </div>
                    </div>
            </form>
            </div>
            <div class="col-md-5">
            <div class="row mt-5">
                            <div class="col-sm-3">Bukti</div>
                            <div class="col-sm-0">:</div>
                            <div class="col-sm-8"><img src="{{ url('/uploads/bukti_bayar/'.$produk->bukti) }}" alt="" width="250px"></div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-3">Resi</div>
                            <div class="col-sm-0">:</div>
                            <div class="col-sm-8"><img src="{{ url('/uploads/resi/'.$produk->resi) }}" alt="" width="250px"></div>
                       </div>
            </div>
                    
        </div>




    </div>
    <script>
        document.getElementById()t
    </script>
@endsection
