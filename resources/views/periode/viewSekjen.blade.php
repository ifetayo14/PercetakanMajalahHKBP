@extends('layout.layout')

@section('title')
    Periode
@endsection

@section('main-content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h3>Detail Periode</h3>
</div>
 
<div class="card shadow mb-4">
    <div class="card-body">
            <div class="row">
                <div class="col-3">
                        <label for="inputDeskripsi">Tahun</label>
                </div>
                <div class="col-9">{{$periode[0]->tahun}}</div>
            </div>
            <div class="row">
                <div class="col-3">
                        <label for="inputBulan">Bulan</label>
                    </div>
                <div class="col-9">{{$periode[0]->bulan}}</div>
            </div>
            <div class="row">
                <div class="col-3">
                        <label for="staticTema">Tema</label></div>
                <div class="col-9">{{$periode[0]->tema}}</div>
            </div>
            <div class="row">
                <div class="col-3">
                    <label for="inputDeskripsi">Deskripsi</label>
                </div>
                <div class="col-9">{!!$periode[0]->deskripsi!!}</div>
            </div>
            <div class="row">
                <div class="col-3">
                    <label for="inputStatus">Status</label>
                </div>
                <div class="col-9">{{$periode[0]->status}}</div>
            </div>
            <a href="/periodeSekjen" class="btn btn-outline-success"><i class="fa fa-return"></i> Kembali</a> 
            <br>
    </div>
</div>

@endsection 