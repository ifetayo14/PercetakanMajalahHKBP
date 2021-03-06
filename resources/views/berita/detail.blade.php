@extends('layout.layout')

@section('title')
    Review Berita {{$dataBerita->judul}}
@endsection

@section('main-content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="page-head-title h3 mb-0">{{$dataBerita->judul}}</h1>
        @if(\Illuminate\Support\Facades\Session::get('role') == '1' || \Illuminate\Support\Facades\Session::get('role') == '4')
            @if($dataBerita->status == '2' || $dataBerita->status == '3')
                <div style="white-space: nowrap">
                    <a href="" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal-{{$dataBerita->berita_id}}">
                        <i class="fas fa-times"></i>
                        Tolak
                    </a>
                    <a href="" class="btn btn-success" data-toggle="modal" data-target="#acceptModal-{{$dataBerita->berita_id}}">
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
                Periode {{$dataBerita->bulan}} {{ $dataBerita->tahun }}
            </div>
            <div class="artikelPeriode">
                Oleh <b>{{ $dataBerita->created_by }}</b>
            </div>
            <div class="artikelPeriode">
                Catatan : <b>{{ $dataBerita->catatan }}</b>
            </div>
            <br>
        </div>
    </div>

    <div class="modal fade" id="deleteModal-{{$dataBerita->berita_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tolak Artikel?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">??</span>
                    </button>
                </div>
                <div class="modal-body">Harap tinggalkan catatan penolakan artikel</div>
                <form action="/artikel/refuse/{{ $dataBerita->berita_id }}" class="user" method="post" enctype="multipart/form-data">
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

    <div class="modal fade" id="acceptModal-{{$dataBerita->berita_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Terima Artikel?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">??</span>
                    </button>
                </div>
                <div class="modal-body">Terima Artikel {{$dataBerita->judul}} ?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <a href="/artikel/accept/{{ $dataBerita->berita_id }}" class="btn btn-success">Terima</a>
                </div>
            </div>
        </div>
    </div>

@endsection
