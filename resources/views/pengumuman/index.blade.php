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
            <table style="width:100%">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Body</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pengumuman as $p)
                    <tr>
                        <td style="width: 200px" >{{ $p->judul}}</td>
                        <td style="width: 500px" >{{ $p->expired_date}}</td>
                        <td style="width: 100px"><button class="btn-green">Edit</button></td>
                        <td style="width: 100px"><button class="btn-red">Hapus</button></td>
                    </tr>
                    @endforeach 
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection 