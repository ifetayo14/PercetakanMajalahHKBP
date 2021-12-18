@extends('layout.layout')

@section('title')
    Review Berita {{$dataBerita->judul}}
@endsection

@section('main-content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="page-head-title h3 mb-0">{{$dataBerita->judul}}</h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <br>
            <?php if(!is_null($dataBerita->file) && $dataBerita->file != "" && file_exists(public_path('uploads/' . $dataBerita->file))){  ?>
                <br>
                <img src="{{URL::to('uploads/' . $dataBerita->file)}}" width="100%">
            <?php }?>
            <div class="artikelContent">
                {!! $dataBerita->isi !!}
            </div>
            <div class="artikelContent">
                <?php if(!is_null($dataBerita->file) && $dataBerita->file != "" && file_exists(public_path('uploads/' . $dataBerita->file))){  ?>
                File Terlampir
                <br>
                <a href="{{URL::to('uploads/' . $dataBerita->file)}}" target="#">{!! $dataBerita->file !!}</a>
                <?php }?>
            </div>
            <br>
            <div class="artikelPeriode">
                Periode {{$dataBerita->bula}} {{ $dataBerita->tahun }}
            </div>
            <div class="artikelPeriode">
                Oleh {{ $dataBerita->created_by }}
            </div>
            <div class="artikelPeriode">
                Catatan : <b>{{ $dataBerita->catatan }}</b>
            </div>
            <br>
        </div>
    </div>
    <div class="card-footer">
        <div class="row d-flex justify-content-end">
                <a href="/majalah/view/{{$dataBerita->periode_id}}" class="btn btn-outline-danger"><i class="fa fa-back"></i> Kembali</a>
        </div>
    </div>

@endsection
