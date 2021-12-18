@extends('layout.layout')

@section('title')
    Pengajuan Artikel
@endsection

@section('main-content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Pengajuan Artikel</h1>
        <a href="/artikel/add" class="btn btn-success">Ajukan Artikel Baru</a>
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
                        <th>Judul</th>
                        <th>Periode</th>
                        <th>Status</th>
                        <th>Aksi</th>
                        <th>Feedback</th>

                    </tr>
                    </thead>
                    <tbody>
                    @foreach($dataArtikel as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><a href="detail/{{$row->artikel_id}}">{{ $row->judul }}</td>
                            <td>{{$row->bulan}} {{ $row->tahun }}
                            </td>
                            <td>
                                @if($row->status == '1')
                                    <div href="" class="btn btn-dark" style="pointer-events: none">
                                        <i class="">Belum Diajukan</i>
                                    </div>
                                @elseif($row->status == '2')
                                    <div href="" class="btn btn-primary" style="pointer-events: none">
                                        <i class="">Diajukan</i>
                                    </div>
                                @elseif($row->status == '3')
                                    <div href="" class="btn btn-info" style="pointer-events: none">
                                        <i class="">Diproses</i>
                                    </div>
                                @elseif($row->status == '4')
                                    <div href="" class="btn btn-danger" style="pointer-events: none">
                                        <i class="">Ditolak</i>
                                    </div>
                                @elseif($row->status == '5')
                                    <div href="" class="btn btn-success" style="pointer-events: none">
                                        <i class="">Diterima</i>
                                    </div>
                                @endif
                            </td>
                            @if(\Illuminate\Support\Facades\Session::get('role') != '1' && \Illuminate\Support\Facades\Session::get('role') != '4' && $row -> status == '1')
                                <td style="white-space: nowrap">
                                    <a href="" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal-{{$row->artikel_id}}">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <a href="/artikel/edit/{{$row->artikel_id}}" class="btn btn-info">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="" class="btn btn-primary" data-toggle="modal" data-target="#uploadModal-{{$row->artikel_id}}">
                                        <i class="fas fa-upload"></i>
                                    </a>
                                </td>
                            @elseif(\Illuminate\Support\Facades\Session::get('role') == '1' || \Illuminate\Support\Facades\Session::get('role') == '4')
                                <td style="white-space: nowrap">
                                    <a href="" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal-{{$row->artikel_id}}">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <a href="/artikel/edit/{{$row->artikel_id}}" class="btn btn-info">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="" class="btn btn-primary" data-toggle="modal" data-target="#uploadModal-{{$row->artikel_id}}">
                                        <i class="fas fa-upload"></i>
                                    </a>
                                </td>
                            @endif
                            @if($row->catatan != null)
                                <td>{{$row->catatan}}</td>
                            @else
                                <td>Belum ada Feedback</td>
                            @endif

                        </tr>

                        <div class="modal fade" id="deleteModal-{{$row->artikel_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Hapus Data?</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">Hapus {{$row->judul}} ?</div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                        <a href="/artikel/delete/{{ $row->artikel_id }}" class="btn btn-danger">Hapus</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="uploadModal-{{$row->artikel_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Kirim artikel untuk di review?</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">Apabila anda memilih upload, artikel tersebut tidak akan dapat diubah kembali.</div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                        <a href="/artikel/upload/{{$row->artikel_id}}" class="btn btn-primary">Upload</a>
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
