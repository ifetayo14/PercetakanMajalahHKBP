@extends('layout.layout')

@section('title')
    Detail HardCopy {{$dataHardCopy->nama}}
@endsection
@section('main-content')
    <div class="container card mb-4 p-2 align-self-center" style="min-height: 400px;">

        <div class="row p-3">
            <div class="col-md-5">
                <img class="w-100" src="{{URL::to('uploads/cover/' . $dataHardCopy->cover)}}" alt="" height="400px">
            </div>
            <div class="col-md-7">
                <h1 class="page-head-title h3 text-center radius">{{$dataHardCopy->nama}}</h1>
                <form method="get" action="{{url('/hardcopyJemaat/ongkir')}}">
                    <input type="text" hidden name="id" value="{{$dataHardCopy->producthardcopy_id}}">
                    <div class="card-text mt-4 pt-2 pb-2 pl-2 pr-2" style="min-height: 300px">
                        <div class="row  mt-1">
                            <div class="col-sm-2">Deskripsi</div>
                            <div class="col-sm-0">:</div>
                            <div class="col-sm-9">{{$dataHardCopy->deskripsi}}</div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-2">Berat</div>
                            <div class="col-sm-0">:</div>
                            <div class="col-sm-9">{{$dataHardCopy->berat}} gram</div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-2">Periode</div>
                            <div class="col-sm-0">:</div>
                            <div class="col-sm-9">{{$dataHardCopy->bulan . ' ' .$dataHardCopy->tahun }}</div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-2">Stok</div>
                            <div class="col-sm-0">:</div>
                            <div class="col-sm-9">{{$dataHardCopy->stok}}</div>
                        </div>
                        <div class="row mt-1">
                            <div class="col-sm-2">Harga</div>
                            <div class="col-sm-0">:</div>
                            <div class="col-sm-9">Rp. {{$dataHardCopy->harga}}</div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-sm-2 align-self-center">
                                Jumlah
                            </div>
                            <div class="col-sm-0 align-self-center">:</div>
                            <div class="col-sm-2">
                                <input type="number" class="form-control" id="stok" name="stok" min="0" >

                            </div>
                        </div>
                    </div>
                <div class="row">
                    <input type="submit" class="btn btn-success w-100" value="Beli">
                </div>
            </form>


            </div>

        </div>




    </div>
@endsection
