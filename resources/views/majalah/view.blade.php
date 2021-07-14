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
                <h3>Detail Majalah</h3>
            </div>
        </div>
            <form>
                @csrf
                
                <div class="form-group row">
                    <label for="staticjudul" class="col-sm-2 col-form-label">Judul</label>
                    <div class="col-sm-10">
                        <input type="text" name="judul" readonly  readonly  value="{{$majalah[0]->judul}}" class="form-control" id="staticjudul">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputDeskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="deskripsi"  readonly value="{{$majalah[0]->deskripsi}}" id="inputDeskripsi" placeholder="Deskripsi">
                    </div>
                </div> 
                <div class="form-group row">
                    <label for="inputStatus" class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                        <select name="status" readonly  class="form-control" id="inputStatus">
                            <option value="{{$majalah[0]->status}}">{{$majalah[0]->status}}</option>
                        </select>
                    </div>
                </div>
                <a href="/majalah" class="btn btn-outline-success"><i class="fa fa-return"></i> Kembali</a> 
                <br> 
            </form>
        </div>
    </div>
</div>

@endsection 