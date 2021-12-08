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
                    <a href="" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal-{{$dataKhotbah->kotbah_id}}">
                        <i class="fas fa-times"></i>
                        Tolak
                    </a>
                    <a href="" class="btn btn-success" data-toggle="modal" data-target="#acceptModal-{{$dataKhotbah->kotbah_id}}">
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
            <div class="artikelContent">
                {!! $dataKhotbah->isi !!}
            </div>
            <div class="artikelContent">
                <?php if($dataKhotbah->file != null && $dataKhotbah->file != ""){  ?>
                File Terlampir
                <br>
                <a href="{{URL::to('uploads/' . $dataKhotbah->file)}}" target="#">Download</a>
                <?php }?>
            </div>
            <br>
            <br>
            <div class="artikelPeriode">
                Periode {{$dataKhotbah->bulan }} {{ $dataKhotbah->tahun }}
            </div>
            <div class="artikelPeriode">
                Oleh {{ $dataKhotbah->created_by }}
            </div>
            <br>
            <div class="">
                <label for="">Status :  
                    @if($dataKhotbah->status == '1')
                        <div href="" class="btn btn-dark" style="pointer-events: none">
                            <i class="">Belum Diajukan</i>
                        </div>
                    @elseif($dataKhotbah->status == '2')
                        <div href="" class="btn btn-primary" style="pointer-events: none">
                            <i class="">Diajukan</i>
                        </div>
                    @elseif($dataKhotbah->status == '3')
                        <div href="" class="btn btn-info" style="pointer-events: none">
                            <i class="">Diproses</i>
                        </div>
                    @elseif($dataKhotbah->status == '4')
                        <div href="" class="btn btn-danger" style="pointer-events: none">
                            <i class="">Ditolak</i>
                        </div>
                    @elseif($dataKhotbah->status == '5')
                        <div href="" class="btn btn-success" style="pointer-events: none">
                            <i class="">Diterima</i>
                        </div>
                    @endif
                </label>
            </div>
            <br>
            <div class="">
                <label for="">Catatan :</label>
                <br>
                {{$dataKhotbah->catatan}}

            </div>
            <br>
        </div>
    </div>

    <div class="modal fade" id="deleteModal-{{$dataKhotbah->kotbah_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tolak Khotbah?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Harap tinggalkan catatan penolakan Khotbah</div>
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
                <div class="modal-body">Terima Khotbah {{$dataKhotbah->judul}} ?</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                    <a href="/artikel/accept/{{ $dataKhotbah->kotbah_id }}" class="btn btn-success">Terima</a>
                </div>
            </div>
        </div>
    </div>

@endsection
