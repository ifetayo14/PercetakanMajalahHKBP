@extends('layout.layout')

@section('title')
    Review Artikel {{$dataArtikel->judul}}
@endsection

@section('main-content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="page-head-title h3 mb-0">{{$dataArtikel->judul}}</h1>
        @if(\Illuminate\Support\Facades\Session::get('role') == '1' || \Illuminate\Support\Facades\Session::get('role') == '4')
            @if($dataArtikel->status == '2' || $dataArtikel->status == '3')
                <div style="white-space: nowrap">
                    <a href="" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal-{{$dataArtikel->artikel_id}}">
                        <i class="fas fa-times"></i>
                        Tolak
                    </a>
                    <a href="" class="btn btn-success" data-toggle="modal" data-target="#acceptModal-{{$dataArtikel->artikel_id}}">
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
            <div class="artikelContent">
                {!! $dataArtikel->isi !!}
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

    <div class="modal fade" id="deleteModal-{{$dataArtikel->artikel_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                <form action="/artikel/refuse/{{ $dataArtikel->artikel_id }}" class="user" method="post" enctype="multipart/form-data">
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

    <div class="modal fade" id="acceptModal-{{$dataArtikel->artikel_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Terima Artikel?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Terima Artikel {{$dataArtikel->judul}} ?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <a href="/artikel/accept/{{ $dataArtikel->artikel_id }}" class="btn btn-success">Terima</a>
                </div>
            </div>
        </div>
    </div>

@endsection
