@extends('layout.layout')

@section('title')
    Pengumuman
@endsection

@section('main-content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div class="container">
        <div class="container-fluid bg-white m-2 p-2">
            <div class="row d-flex justify-content-between">
                <h1 class="h3">Pengumuman</h1>
                <a href="/pengumuman/add" class="btn btn-success"><i class="fa fa-plus"></i> Pengumuman</a>
            </div>
            <br>
            <table style="width:100%" class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Taggal Berakhir</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1; ?>
                    @foreach ($pengumuman as $p)
                    <tr>
                        <td>{{$i}}</td>
                        <td>{{ $p->judul}}</td>
                        <td>{{ $p->expired_date}}</td>
                        <td><a href="/pengumuman/edit/{{$p->pengumuman_id}}" class="btn btn-outline-primary"><i class="fa fa-edit"></i> Edit</a><a href="/pengumuman/view/{{$p->pengumuman_id}}" class="btn btn-outline-warning"><i class="fa fa-eye"></i> View</a><button class="btn btn-outline-danger"><i class="fa fa-trash"></i> Hapus</button></td>
                    </tr>
                    <?php $i++; ?>
                    @endforeach 
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection 