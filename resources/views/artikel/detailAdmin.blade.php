@extends('layout.layout')

@section('title')
    Review Artikel {{$dataArtikel->judul}}
@endsection

@section('main-content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="page-head-title h3 mb-0">{{$dataArtikel->judul}}</h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <br>
            <?php if(!is_null($dataArtikel->file) && $dataArtikel->file != "" && file_exists(public_path('uploads/' . $dataArtikel->file))){  ?>
                <br>
                <img src="{{URL::to('uploads/' .$dataArtikel->file)}}" width="100%">
            <?php }?>
            <div class="artikelContent">
                {!! $dataArtikel->isi !!}
            </div>
            <div class="artikelContent">
                <?php if(!is_null($dataArtikel->file) && $dataArtikel->file != "" && file_exists(public_path('uploads/' . $dataArtikel->file))){  ?>
                File Terlampir
                <br>
                <a href="{{URL::to('uploads/' . $dataArtikel->file)}}" target="#">{!! $dataArtikel->file !!}</a>
                <?php }?>
            </div>
            <br>
            <div class="artikelPeriode">
                Periode {{$dataArtikel->bulan}} {{ $dataArtikel->tahun }}
            </div>
            <div class="artikelPeriode">
                Oleh {{ $dataArtikel->created_by }}
            </div>
            <br>
            <div class="artikelPeriode">
                    Catatan :<b>{{!!$dataArtikel->catatan}}
            </div>
            <br>
        </div>
    </div>

    <div class="card-footer">
        <div class="row d-flex justify-content-end">
                <a href="/majalah/view/{{$dataArtikel->periode_id}}" class="btn btn-outline-danger"><i class="fa fa-back"></i> Kembali</a>
        </div>
    </div>

@endsection
