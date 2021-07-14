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
                <h3>Ubah Majalah</h3>
            </div>
        </div>
            <form method="post" action="{{url('majalah/edit/'.$majalah[0]->majalah_id)}}">
                @csrf
                
                <div class="form-group row">
                    <label for="staticjudul" class="col-sm-2 col-form-label">Judul</label>
                    <div class="col-sm-10">
                        <input type="text" name="judul" value="{{$majalah[0]->judul}}" class="form-control" id="staticjudul" placeholder="Judul Majalh">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputDeskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="deskripsi" value="{{$majalah[0]->deskripsi}}" id="inputDeskripsi" placeholder="Deskripsi">
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