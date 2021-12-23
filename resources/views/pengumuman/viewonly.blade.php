@extends('layout.layout')

@section('title')
    Pengumuman
@endsection

@section('main-content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div class="container">
        <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h3>Detail Pengumuman</h3>
            </div>
        </div>
            <form method="post" action="#">
                @csrf
                <div class="form-group row">
                    <label for="staticJudul" class="col-sm-2 col-form-label">Judul</label>
                    <div class="col-sm-10">{{$pengumuman[0]->judul}}</div>
                </div>
                <div class="form-group row">
                    <label for="inputDeskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                    <div class="col-sm-10">{{$pengumuman[0]->deskripsi}}</div>
                </div> 
                <div class="form-group row">
                    <label for="inputDeskripsi" class="col-sm-2 col-form-label">Isi Pengumuman</label>
                    <div class="col-sm-10">{{$pengumuman[0]->isi}}
                    </div>
                </div> 
                <div class="form-group row">
                    <label for="inputDeskripsi" class="col-sm-2 col-form-label">Masa Berlaku</label>
                    <div class="col-sm-4">{{$pengumuman[0]->expired_date}}</div>
                </div>
                <a href="/pengumuman" class="btn btn-outline-success"><i class="fa fa-return"></i> Kembali</a> 
                <br> 
            </form>
        </div>
    </div>
</div>

@endsection 