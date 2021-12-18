@extends('layout.layout')

@section('title')
    Review Artikel {{$dataKhotbah->judul}}
@endsection

@section('main-content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="page-head-title h3 mb-0">{{$dataKhotbah->judul}}</h1>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <br>
            <div class="khotbahNats">
                <table>
                    <tr>
                        <td>Topik Minggu</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td> {{$dataKhotbah->topik}} ({!! $dataKhotbah->nama_minggu !!})</td>
                    </tr>
                    <tr>
                        <td>Nats Alkitab</td>
                        <td>&nbsp;:&nbsp;</td>
                        <td> {!! $dataKhotbah->nats_alkitab !!}</td>
                    </tr>
                </table>
            </div>
            <?php if(!is_null($dataKhotbah->file) && $dataKhotbah->file != "" && file_exists(public_path('uploads/' . $dataKhotbah->file))){  ?>
                <br>
                <img src="{{URL::to('uploads/' . $dataKhotbah->file)}}" width="100%">
            <?php }?>
            <div class="artikelContent">
                {!! $dataKhotbah->isi !!}
            </div>
            <div class="artikelContent">
                <?php if(!is_null($dataKhotbah->file) && $dataKhotbah->file != ""){  ?>
                File Terlampir
                <br>
                <a href="{{URL::to('uploads/' . $dataKhotbah->file)}}" target="#">{!! $dataKhotbah->file !!}</a>
                <?php }?>
            </div>

            <br>

            <br>
            <div class="artikelPeriode">
                Periode {{$dataKhotbah->bulan}} {{ $dataKhotbah->tahun }}
            </div>
            <div class="artikelPeriode">
                Oleh <b>{{ $dataKhotbah->created_by }}</b>
            </div>
            <div class="artikelPeriode">
                Catatan : <b>{{ $dataKhotbah->catatan }}</b>
            </div>
            <br>
        </div>
        <div class="card-footer">
            <div class="row d-flex justify-content-end">
                    <a href="/majalahSekjen/viewByPeriode/{{$dataKhotbah->periode_id}}" class="btn btn-outline-danger"><i class="fa fa-back"></i> Kembali</a>
            </div>
        </div>
    </div>


@endsection
