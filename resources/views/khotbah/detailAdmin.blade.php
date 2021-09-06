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
                Periode
                @if($dataKhotbah->bulan == '1')
                    Januari
                @elseif($dataKhotbah->bulan == '2')
                    Februari
                @elseif($dataKhotbah->bulan == '3')
                    Maret
                @elseif($dataKhotbah->bulan == '4')
                    April
                @elseif($dataKhotbah->bulan == '5')
                    Mei
                @elseif($dataKhotbah->bulan == '6')
                    Juni
                @elseif($dataKhotbah->bulan == '7')
                    Juli
                @elseif($dataKhotbah->bulan == '8')
                    Agustus
                @elseif($dataKhotbah->bulan == '9')
                    September
                @elseif($dataKhotbah->bulan == '10')
                    Oktober
                @elseif($dataKhotbah->bulan == '11')
                    November
                @else
                    Desember
                @endif
                {{ $dataKhotbah->tahun }}
            </div>
            <div class="artikelPeriode">
                Oleh {{ $dataKhotbah->created_by }}
            </div>
            <br>
            <div class="" style="margin-left: 385px">
            </div>
            <br>
        </div>
        <div class="card-footer">
            <div class="row d-flex justify-content-end">
                    <a href="/majalah/view/{{$dataKhotbah->periode_id}}" class="btn btn-outline-danger"><i class="fa fa-back"></i> Kembali</a>
            </div>
        </div>
    </div>


@endsection
