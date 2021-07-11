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
            <form>
                @csrf
                <div class="form-group row">
                    <label for="inputDeskripsi" class="col-sm-2 col-form-label">Tahun</label>
                    <div class="col-sm-4">
                       <select name="tahun" readonly class="form-control">
                        <option selected="selected" value="{{$periode[0]->tahun}}">{{$periode[0]->tahun}}</option>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputBulan" class="col-sm-2 col-form-label">Bulan</label>
                    <div class="col-sm-4">
                        <select name="bulan"  readonly class="form-control">
                            <option selected="selected" value="{{$periode[0]->bulan}}">{{$periode[0]->bulan}}</option>
                        </select>
                    </div>
                </div> 
                <div class="form-group row">
                    <label for="staticTema" class="col-sm-2 col-form-label">Tema</label>
                    <div class="col-sm-10">
                        <input type="text" name="tema" readonly  readonly  value="{{$periode[0]->tema}}" class="form-control" id="staticTema" placeholder="Tema Bulan">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputDeskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="deskripsi"  readonly value="{{$periode[0]->deskripsi}}" id="inputDeskripsi" placeholder="Deskripsi">
                    </div>
                </div> 
                <div class="form-group row">
                    <label for="inputStatus" class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                        <select name="status" readonly  class="form-control" id="inputStatus">
                            <option value="{{$periode[0]->status}}">{{$periode[0]->status}}</option>
                        </select>
                    </div>
                </div>
                <a href="/periode" class="btn btn-outline-success"><i class="fa fa-return"></i> Kembali</a> 
                <br> 
            </form>
        </div>
    </div>
</div>

@endsection 