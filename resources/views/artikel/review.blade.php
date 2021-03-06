@extends('layout.layout')

@section('title')
    Review Artikel
@endsection

@section('main-content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Review Artikel</h1>
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
                        <th>Dibuat Oleh</th>
                        <th>Periode</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($dataArtikel as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><a href="detail/{{$row->artikel_id}}">{{ $row->judul }}</a></td>
                            <td>{{ $row->created_by }}</td>
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
                                <br>
                                <div class="">
                                        Catatan :<b>{{!!$row->catatan}}
                                </div>
                            </td>
                            <td style="white-space: nowrap">
                            @if($row->status == '2' || $row->status == '3')
                                    <a href="" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal-{{$row->artikel_id}}">
                                        <i class="fas fa-times"></i>
                                        Tolak
                                    </a>
                                    <a href="" class="btn btn-success" data-toggle="modal" data-target="#acceptModal-{{$row->artikel_id}}">
                                        <i class="fas fa-check"></i>
                                        Terima
                                    </a>
                            @endif
                            </td>
                        </tr>

                        <div class="modal fade" id="deleteModal-{{$row->artikel_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tolak Artikel?</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">??</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">Harap tinggalkan catatan penolakan artikel</div>
                                    <form action="/artikel/refuse/{{ $row->artikel_id }}" class="user" method="post" enctype="multipart/form-data">
                                        @csrf
                                        <textarea style="width: 400px; margin-left: 20px" name="catatan" id="exampleFirstName" placeholder="Catatan" required></textarea>
                                        <div class="modal-footer">
                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-danger">Tolak</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="acceptModal-{{$row->artikel_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Terima Artikel?</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">??</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">Terima {{$row->judul}} ?</div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                        <a href="/artikel/accept/{{ $row->artikel_id }}" class="btn btn-success">Terima</a>
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
