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
            </div>
        </div>
        <br>
        <dib class="card-body">
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
                    <td><a href="/kotbahJemaat/view/{{$k->kotbah_id}}" class="btn btn-outline-warning"><i class="fa fa-eye"></i> Baca</a></td>
                </tr>
                <?php $i++;
                }?>
            </table>
        </dib>
        <dib class="card-body">
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
                    <td><a href="/artikelJemaat/view/{{$a->artikel_id}}" class="btn btn-outline-warning"><i class="fa fa-eye"></i> Baca</a></td>
                </tr>
                <?php $i++;
                }?>
            </table>
        </dib>
        <dib class="card-body">
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
                    <td><a href="/beritaJemaat/view/{{$b->berita_id}}" class="btn btn-outline-warning"><i class="fa fa-eye"></i> Baca</a></td>
                </tr>
                <?php $i++;
                }?>
            </table>
        </dib>
    </div>

@endsection
