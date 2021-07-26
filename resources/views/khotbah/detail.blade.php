@extends('layout.layout')

@section('title')
    Review Artikel {{$dataKhotbah->judul}}
@endsection

@section('main-content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="page-head-title h3 mb-0">{{$dataKhotbah->judul}}</h1>
        @if(\Illuminate\Support\Facades\Session::get('role') == '1' || \Illuminate\Support\Facades\Session::get('role') == '4')
            @if($dataKhotbah->status == '2' || $dataKhotbah->status == '3')
                <div style="white-space: nowrap">
                    <a href="" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal-{{$dataKhotbah->artikel_id}}">
                        <i class="fas fa-times"></i>
                        Tolak
                    </a>
                    <a href="" class="btn btn-success" data-toggle="modal" data-target="#acceptModal-{{$dataKhotbah->artikel_id}}">
                        <i class="fas fa-check"></i>
                        Terima
                    </a>
                </div>
            @endif
        @endif
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <br>
            <div class="khotbahNats">
                Nats Alkitab : {!! $dataKhotbah->nats_alkitab !!}
            </div>
            <div class="artikelContent">
                {!! $dataKhotbah->isi !!}
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
    </div>

    <div class="modal fade" id="deleteModal-{{$dataKhotbah->kotbah_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tolak Artikel?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Harap tinggalkan catatan penolakan artikel</div>
                <form action="/artikel/refuse/{{ $dataKhotbah->kotbah_id }}" class="user" method="post" enctype="multipart/form-data">
                    @csrf
                    <textarea style="width: 400px; margin-left: 20px" name="catatan" id="exampleFirstName" placeholder="Catatan" required></textarea>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Tolak</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="acceptModal-{{$dataKhotbah->kotbah_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Terima Artikel?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Terima Artikel {{$dataKhotbah->judul}} ?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <a href="/artikel/accept/{{ $dataKhotbah->kotbah_id }}" class="btn btn-success">Terima</a>
                </div>
            </div>
        </div>
    </div>

@endsection
