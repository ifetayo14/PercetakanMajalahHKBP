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
                        <th>Produk</th>
                        @if(session()->get('role') == 1)
                        <th>Pembeli</th>
                        @endif
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i=1; ?>
                    @foreach($produk as $p)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>{{$p->nama}}</td>
                        @if(session()->get('role') == 1)
                        <td>{{$p->ship_name}}</td>
                        @endif
                        <td>{{$p->status}}</td>
                        <td></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div>
    </div>
</div>

@endsection
