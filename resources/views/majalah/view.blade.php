@extends('layout.layout')

@section('title')
    Majalah
@endsection

@section('main-content')
<!-- Page Heading -->
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="row">
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
            Catatan : <i>{!! $majalah[0]->catatan !!}</i>
            </div>
            <div class="col-12 d-flex justify-content-end">
                <label for="status" class="badge badge-info p-2 m-2">{{$majalah[0]->status}}</label> 
                @if($majalah[0]->file !=null)
                    <a href="/public/uploads/{{$majalah[0]->file}}" target=”_blank” class="btn btn-primary" >Download File</a>
                @endif
            </div>
            
            <div class="row p-2 m-2 d-flex justify-content-end">
                @if($majalah[0]->status_id == 5)
                    <a href="majalah/edit/{{$majalah[0]->majalah_id}}" class="btn btn-success p-2 m-2" ><i class="fa fa-edit"></i> Edit</a>
                @endif
                    <a href="/majalah" class="btn btn-danger p-2 m-2" ><i class="fa fa-arrow-left"></i>  Kembali</a>
            </div>
        </div>
    </div>
    <br>
    <div class="card-body">
        <h3 style="background-color: #bdf7ba; justify-content:center;">Kotbah</h3>
        <table class="table">
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
            <?php $i=1; foreach($kotbah as $k){ ?>
                <tr>
                    <td>{{$i}}</td>
                    <td>{{$k->judul}}</td>
                    <td>{{$k->status_des}}</td>
                    <td><a href="/majalah/khotbah/detail/{{$k->kotbah_id}}" class="btn btn-outline-warning"><i class="fa fa-eye"></i> Baca</a></td>
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
                <th>Status</th>
                <th>Aksi</th>
            </tr>
            <?php $i=1; foreach($artikel as $a){ ?>
                <tr>
                    <td>{{$i}}</td>
                    <td>{{$a->judul}}</td>
                    <td>{{$a->status_des}}</td>
                    <td><a href="/majalah/artikel/detail/{{$a->artikel_id}}" class="btn btn-outline-warning"><i class="fa fa-eye"></i> Baca</a></td>
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
                <th>Status</th>
                <th>Aksi</th>
            </tr>
            <?php $i=1; foreach($berita as $b){ ?>
                <tr>
                    <td>{{$i}}</td>
                    <td>{{$b->judul}}</td>
                    <td>{{$b->status_des}}</td>
                    <td><a href="/majalah/berita/detail/{{$b->berita_id}}" class="btn btn-outline-warning"><i class="fa fa-eye"></i> Baca</a></td>
                </tr>
               <?php $i++;
            }?>
        </table>
    </div>
</div>

@endsection 