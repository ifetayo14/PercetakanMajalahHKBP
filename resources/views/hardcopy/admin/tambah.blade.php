@extends('layout.layout')

@section('title')
    Tambah Produk HardCopy
@endsection
@section('main-content')
    <div class="card container-fluid p-3" style="min-height: 400px">
        <div class="text-center mt-2"> <h1 class="h4 page-head-title mb-4">Tambah Produk</h1></div>
        <form  method="post" action="/hardcopyAdmin/tambah" enctype= "multipart/form-data">
            @csrf
            <div class="row mt-2">
                <div class="col-md-3"></div>
                <div class="col-md-1 align-self-center ml-4">Nama</div>
                <div  class="col-md-5">
                    <input type="text" class="form-control form-control-user" name="nama">
                    <span style="color: red">
                                    @error('nama'){{$message}}@enderror
                                </span>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-3"></div>
                <div class="col-md-1 align-self-center ml-4">Periode</div>
                <div  class="col-md-5">
                    <select type="text" class="form-control form-control-user" name="periode">
                    @foreach($dataPeriode as $row)
                            <option class="form-control" value="{{$row->periode_id}}">{{$row->bulan . " " . $row->tahun}}</option>
                        @endforeach
                    </select>

                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-3"></div>
                <div class="col-md-1 align-self-center ml-4">Stok</div>
                <div  class="col-md-2">
                    <input type="number" class="form-control form-control-user" name="stok">
                    <span style="color: red">
                                    @error('berat'){{$message}}@enderror
                                </span>
                </div>
                <div class="col-md-1 align-self-center text-center">Berat</div>
                <div  class="col-md-2 ">
                    <input type="number" class="form-control form-control-user" name="berat">
                    <span style="color: red">
                                    @error('harga'){{$message}}@enderror
                                </span>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-3"></div>
                <div class="col-md-1 align-self-center ml-4">Harga</div>
                <div  class="col-md-5">
                    <input type="number" class="form-control form-control-user" name="harga">
                    <span style="color: red">
                                    @error('nama'){{$message}}@enderror
                                </span>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-3"></div>
                <div class="col-md-1 align-self-center ml-4">Deskripsi</div>
                <div  class="col-md-5">
                    <textarea type="text" class="form-control form-control-user" name="deskripsi"></textarea>
                    <span style="color: red">
                                    @error('deskripsi'){{$message}}@enderror
                                </span>
                </div>
            </div>
            <div class="row mt-4">
                <div class="col-md-3"></div>
                <div class="col-md-1 ml-4">Cover</div>
               <div class="col-md-5">
                   <div class="file-loading">
                       <input id="file-5" name="file-pelengkap" class="file form-control w-100" type="file" multiple data-theme="fas">
                   </div>
               </div>
            </div>
            <div class="row  mt-2">
                <div class="col-md-4"> </div>
                <div class="col-md-5">
                    <button class="btn btn-success w-100 ml-4" type="submit">Tambah</button>
                </div>
            </div>
        </form>
    </div>
@endsection
