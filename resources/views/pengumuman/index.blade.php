@extends('layout.layout')

@section('title')
    Pengumuman
@endsection

@section('main-content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div class="container">
        <div class="container-fluid">
            <div class="row d-flex justify-content-between">
                <h1 class="h3 mb-0 text-gray-800">Pengumuman</h1>
                <a href="/pengumuman/add" class="btn btn-success">Tambah Pengumuman</a>

            </div>
            <br>
            <table style="width:100%">
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
                        <td><a href="/pengumuman/edit/{{$p->pengumuman_id}}" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a><button class="btn btn-danger"><i class="fa fa-trash"></i> Hapus</button></td>
                    </tr>
                    <?php $i++; ?>
                    @endforeach 
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection 