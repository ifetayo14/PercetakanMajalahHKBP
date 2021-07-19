@extends('layout.layout')

@section('title')
    Majalah
@endsection

@section('main-content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div class="container">
        <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h3>Tambah Majalah</h3>
            </div>
        </div>
            <form method="post" enctype="multipart/form-data" action="{{url('majalah/add')}}">
                @csrf
                <div class="form-group row">
                    <label for="staticjudul" class="col-sm-2 col-form-label">Judul</label>
                    <div class="col-sm-10">
                        <input type="text" name="judul" value="{{$majalah['judul']}}" class="form-control" id="staticjudul" placeholder="Judul Majalah">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputDeskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="deskripsi" value="{{$majalah['deskripsi']}}" id="inputDeskripsi" placeholder="Deskripsi">
                    </div>
                </div> 
                <div class="form-group row">
                    <label for="inputDeskripsi" class="col-sm-2 col-form-label">File</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control" name="file" id="inputFile">
                    </div>
                </div> 
                
                <br>
                <button class="btn btn-success">
                    Simpan
                </button>
            </form>
        </div>
    </div>
</div>

@endsection 