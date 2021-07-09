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
                <h3>Ubah Pengumuman</h3>
            </div>
        </div>
            <form method="post" action="{{url('pengumuman/edit/'.$pengumuman[0]->pengumuman_id)}}">
                @csrf
                <div class="form-group row">
                    <label for="staticJudul" class="col-sm-2 col-form-label">Judul</label>
                    <div class="col-sm-10">
                        <input type="text" name="judul" value="{{$pengumuman[0]->judul}}" class="form-control" id="staticJudul" placeholder="Judul Pengumuman">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputDeskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                    <div class="col-sm-10">
                        <input type="text" name="deskripsi" value="{{$pengumuman[0]->deskripsi}}" class="form-control" id="inputDeskripsi" placeholder="Deskripsi">
                    </div>
                </div> 
                <div class="form-group row">
                    <label for="inputDeskripsi" class="col-sm-2 col-form-label">Isi Pengumuman</label>
                    <div class="col-sm-10">
                        <textarea name="isi" id="" cols="30" rows="5" class="form-control" id="inputDeskripsi">{{$pengumuman[0]->isi}}</textarea>
                    </div>
                </div> 
                <div class="form-group row">
                    <label for="inputDeskripsi" class="col-sm-2 col-form-label">Masa Berlaku</label>
                    <div class="col-sm-4">
                        <input type="date" class="form-control" name="expired_date" value="{{$pengumuman[0]->expired_date}}">
                    </div>
                </div> 
                <br>
                <button href="" class="btn btn-success">
                    Update
                </button>
            </form>
        </div>
    </div>
</div>

@endsection 