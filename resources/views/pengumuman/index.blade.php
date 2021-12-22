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
                        <td>
                            <a href="/pengumuman/edit/{{$p->pengumuman_id}}" class="btn btn-outline-primary"><i class="fa fa-edit"></i> Edit</a>
                            <a href="/pengumuman/view/{{$p->pengumuman_id}}" class="btn btn-outline-warning"><i class="fa fa-eye"></i> View</a>
                            <a href="" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal-{{$p->pengumuman_id}}">
                                        <i class="fas fa-trash"></i>
                                    </a>
                        </td>
                        @else
                            <td><a href="/pengumuman/viewonly/{{$p->pengumuman_id}}" class="btn btn-outline-warning"><i class="fa fa-eye"></i> View</a></td>
                        @endif

                    </tr>
                        <div class="modal fade" id="deleteModal-{{$p->pengumuman_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Hapus Data?</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">Hapus Pengumuman <b>{{$p->judul}}</b> ?</div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                        <a href="pengumuman/delete/{{$p->pengumuman_id}}" class="btn btn-primary">Hapus</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php $i++; ?>
                    @endforeach
                </tbody>
            </table>
            
        </div>
    </div>
</div>

@endsection
