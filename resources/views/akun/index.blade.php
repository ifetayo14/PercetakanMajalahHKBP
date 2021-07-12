@extends('layout.layout')

@section('title')
    Kelola Akun
@endsection

@section('main-content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Akun</h1>
        <a href="/akun/add" class="btn btn-success">Tambah Akun Baru</a>
    </div>

    <div class="card shadow mb-4">
        @if($message = Session::get('success'))
            <div class="alert alert-success">
                <p>
                    {{$message}}
                </p>
            </div>
        @endif
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Username</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Alamat</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($dataAkun as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $row->username }}</td>
                                <td>{{ $row->nama }}</td>
                                <td>{{ $row->email }}</td>
                                <td>{{ $row->alamat }}</td>
                                <td>
                                    @if($row->role_id == '2')
                                        Jemaat
                                    @elseif($row->role_id == '3')
                                        Sekjen
                                    @elseif($row->role_id == '4')
                                        Tim Majalah
                                    @elseif($row->role_id == '5')
                                        Pendeta
                                    @endif
                                </td>
                                <td>
                                    @if($row->status == '0')
                                        <div href="" class="btn btn-dark" style="pointer-events: none">
                                            <i class="">Non-Aktif</i>
                                        </div>
                                    @elseif($row->status == '1')
                                        <div href="" class="btn btn-success" style="pointer-events: none">
                                            <i class="">Aktif</i>
                                        </div>
                                    @endif
                                </td>
                                <td style="white-space: nowrap">
                                    <a href="" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal-{{$row->user_id}}">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <a href="akun/edit/{{$row->user_id}}" class="btn btn-info">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                            </tr>

                            <div class="modal fade" id="deleteModal-{{$row->user_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                 aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Hapus Data?</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">Hapus {{$row->nama}} ?</div>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                            <a href="akun/delete/{{ $row->user_id }}" class="btn btn-primary">Hapus</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection
