@extends('layout.layout')

@section('title')
    Majalah
@endsection

@section('main-content')
<!-- Page Heading -->
<div class="card shadow mb-4">
    <div class="card-body">
        
        @if($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{$message}}</p>
            </div>
        @endif
        @if($message = Session::get('error'))
            <div class="alert alert-danger">
                <p>
                    {{$message}}
                </p>
            </div>
        @endif
        <div class="row p-2 m-2">
            <div class="col-12">
                <div class="text-center">
                    <h1 class="h3 page-head-title mb-4">{{$majalah[0]->judul}}</h1>
                    <h5 class="h5 page-head-title mb-4">Periode {{$majalah[0]->bulan}}  {{$majalah[0]->tahun}} dengan tema  {{$majalah[0]->tema}}</h5>
                </div>
            </div>
            <div class="col-12">
                {!! $majalah[0]->deskripsi !!}
            </div>
            <div class="col-12">
            Catatan SEKJEN: <i>{!! $majalah[0]->catatan !!}</i>
            <br>
            Catatan Dewan Redaksi: <i>{!! $majalah[0]->catatan_dewan !!}</i>
            </div>
            <div class="col-12">
                <div class="row d-flex justify-content-between">
                    <div class="col-12 col-sm-6">
                        Status SEKJEN <label for="status" class="badge badge-pill badge-info p-2 m-2">{{$majalah[0]->status}}</label>
                        <br>
                        Status Dewan Redaksi     <label for="status" class="badge badge-pill badge-primary p-2 m-2">{{$majalah[0]->approval_dewan}}</label>
                    </div>
                    <div class="col-12 col-sm-6">
                        @if($majalah[0]->file !=Null)
                            <a href="{{URL::to('uploads/'.$majalah[0]->file)}}" target="_blank" class="btn btn-primary" >Download File</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="row p-2 m-2 d-flex justify-content-end">
            @if($majalah[0]->approval_dewan == 'Diajukan' || $majalah[0]->approval_dewan == 'Review')
                <a href="/majalahDewanRedaksi/terima/{{$majalah[0]->majalah_id}}" class="btn btn-success p-2 m-2" ><i class="fa fa-check"></i> Setujui</a>
                <a href="/majalahDewanRedaksi/tolak/{{$majalah[0]->majalah_id}}" class="btn btn-primary p-2 m-2" ><i class="fa fa-times"></i> Tolak</a>
            @endif
                <a href="/majalahDewanRedaksi" class="btn btn-danger p-2 m-2" ><i class="fa fa-arrow-left"></i>  Kembali</a>
        </div>
    </div>
    <br>
    <div class="card-body">
        <h3 style="background-color: #bdf7ba; justify-content:center;">Kotbah</h3>
        <table class="table">
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Aksi</th>
            </tr>
            <?php $i=1; foreach($kotbah as $k){ ?>
                <tr>
                    <td>{{$i}}</td>
                    <td>{{$k->judul}}</td>
                    <td><a href="/kotbahDewanRedaksi/view/{{$k->kotbah_id}}" class="btn btn-outline-warning"><i class="fa fa-eye"></i> Baca</a></td>
                </tr>
               <?php $i++;
            }?>
        </table>
    </div>
    <div class="card-body">
        <h3 style="background-color: #ecf7ba; justify-content:center;">Artikel</h3>
        <table class="table ">
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Aksi</th>
            </tr>
            <?php $i=1; foreach($artikel as $a){ ?>
                <tr>
                    <td>{{$i}}</td>
                    <td>{{$a->judul}}</td>
                    <td><a href="/artikelDewanRedaksi/view/{{$a->artikel_id}}" class="btn btn-outline-warning"><i class="fa fa-eye"></i> Baca</a></td>
                </tr>
               <?php $i++;
            }?>
        </table>
    </div>
    <div class="card-body">
        <h3 style="background-color: #baf7e9; justify-content:center;">Berita</h3>
        <table class="table">
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Aksi</th>
            </tr>
            <?php $i=1; foreach($berita as $b){ ?>
                <tr>
                    <td>{{$i}}</td>
                    <td>{{$b->judul}}</td>
                    <td><a href="/beritaDewanRedaksi/view/{{$b->berita_id}}" class="btn btn-outline-warning"><i class="fa fa-eye"></i> Baca</a></td>
                </tr>
               <?php $i++;
            }?>
        </table>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-12" oncontextmenu="return false" onselectstart="return false" ondragstart="return false">
                <body oncontextmenu="return false;">
                <object data="{{URL::to('uploads/' . $majalah[0]->file)}}#toolbar=0" type="application/pdf" width="100%" height="500px"  oncontextmenu="return false;"></object>
                </body>
            </div>
        </div>
    </div>
</div>

@endsection 