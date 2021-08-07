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
                Periode
                @if($dataArtikel->bulan == '1')
                    Januari
                @elseif($dataArtikel->bulan == '2')
                    Februari
                @elseif($dataArtikel->bulan == '3')
                    Maret
                @elseif($dataArtikel->bulan == '4')
                    April
                @elseif($dataArtikel->bulan == '5')
                    Mei
                @elseif($dataArtikel->bulan == '6')
                    Juni
                @elseif($dataArtikel->bulan == '7')
                    Juli
                @elseif($dataArtikel->bulan == '8')
                    Agustus
                @elseif($dataArtikel->bulan == '9')
                    September
                @elseif($dataArtikel->bulan == '10')
                    Oktober
                @elseif($dataArtikel->bulan == '11')
                    November
                @else
                    Desember
                @endif
                {{ $dataArtikel->tahun }}
            </div>
            <div class="artikelPeriode">
                Oleh {{ $dataArtikel->created_by }}
            </div>
            <br>
            <div class="" style="margin-left: 385px">
            </div>
            <br>
        </div>
    </div>

    <div class="card-footer">
        <div class="row d-flex justify-content-end">
                <a href="/majalahSekjen/viewByPeriode/{{$dataArtikel->periode_id}}" class="btn btn-outline-danger"><i class="fa fa-back"></i> Kembali</a>
        </div>
    </div>

@endsection
