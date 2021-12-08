@extends('layout.layout')

@section('title')
    Pengumuman
@endsection

@section('main-content')
<!-- Page Heading -->
<div class="row d-flex justify-content-between">
    <h1 class="h3">Pengumuman</h1>
    @if(\Illuminate\Support\Facades\Session::get('role') == '1' || \Illuminate\Support\Facades\Session::get('role') == '4')
    <a href="/pengumuman/add" class="btn btn-success"><i class="fa fa-plus"></i> Pengumuman</a>
    @endif
</div>
<br>

<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table style="width:100%" id="dataTable"  class="table table-striped">
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
                        @if(\Illuminate\Support\Facades\Session::get('role') == '1' || \Illuminate\Support\Facades\Session::get('role') == '4')
                        <td><a href="/pengumuman/edit/{{$p->pengumuman_id}}" class="btn btn-outline-primary"><i class="fa fa-edit"></i> Edit</a><a href="/pengumuman/view/{{$p->pengumuman_id}}" class="btn btn-outline-warning"><i class="fa fa-eye"></i> View</a><button class="btn btn-outline-danger"><i class="fa fa-trash"></i> Hapus</button></td>
                        @else
                            <td><a href="/pengumuman/view/{{$p->pengumuman_id}}" class="btn btn-outline-warning"><i class="fa fa-eye"></i> View</a></td>
                        @endif

                    </tr>
                    <?php $i++; ?>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
