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
                Periode
                @if($dataBerita->bulan == '1')
                    Januari
                @elseif($dataBerita->bulan == '2')
                    Februari
                @elseif($dataBerita->bulan == '3')
                    Maret
                @elseif($dataBerita->bulan == '4')
                    April
                @elseif($dataBerita->bulan == '5')
                    Mei
                @elseif($dataBerita->bulan == '6')
                    Juni
                @elseif($dataBerita->bulan == '7')
                    Juli
                @elseif($dataBerita->bulan == '8')
                    Agustus
                @elseif($dataBerita->bulan == '9')
                    September
                @elseif($dataBerita->bulan == '10')
                    Oktober
                @elseif($dataBerita->bulan == '11')
                    November
                @else
                    Desember
                @endif
                {{ $dataBerita->tahun }}
            </div>
            <div class="artikelPeriode">
                Oleh {{ $dataBerita->created_by }}
            </div>
            <br>
            <div class="" style="margin-left: 385px">
            </div>
            <br>
        </div>
    </div>
    <div class="card-footer">
        <div class="row d-flex justify-content-end">
                <a href="/majalahSekjen/viewByPeriode/{{$dataBerita->periode_id}}" class="btn btn-outline-danger"><i class="fa fa-back"></i> Kembali</a>
        </div>
    </div>

@endsection
