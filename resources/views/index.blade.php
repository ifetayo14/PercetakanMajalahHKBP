@extends('layout.layout')

@section('title')
    Dashboard
@endsection

@section('main-content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
</div>
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="row">
            <h4>Periode Aktif</h4>
            @if($periode !=null)
            <div class="col-12">
                <h5>{{$periode[0]->tahun}} {{$periode[0]->bulan}} - {{$periode[0]->tema}}</h5>
                <p>{{$periode[0]->deskripsi}}</p>
            </div>
            @endif
        </div>
    </div>
</div>

@endsection
