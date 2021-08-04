@extends('layout.layout')

@section('title')
    Majalah
@endsection

@section('main-content')
<!-- Page Heading -->
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="row">
            <div class="col-12">
                <div class="text-center">
                    <h1 class="h4 page-head-title mb-4">Detail Majalah</h1>
                </div>
            </div>
            <div class="col-12 text-center">
                <h3>{{$majalah[0]->judul}}</h3>
            </div>
            <div class="col-12">
                {!! $majalah[0]->deskripsi !!}
            </div>
            <div class="col-12">
                {{$majalah[0]->status}}
            </div>
            <div class="col-12">
                @if($majalah[0]->file !=null)
                    <a href="/public/uploads/{{$majalah[0]->file}}" target=”_blank” class="btn btn-primary" >Download File</a>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection 