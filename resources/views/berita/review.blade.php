@extends('layout.layout')

@section('title')
    Review Berita
@endsection

@section('main-content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Review Berita</h1>
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
                        <th>Pengaju</th>
                        <th>Periode</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($dataBerita as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><a href="detail/{{$row->berita_id}}">{{ $row->judul }}</a></td>
                            <td>{{ $row->created_by }}</td>
                            <td>
                                @if($row->bulan == '1')
                                    Januari
                                @elseif($row->bulan == '2')
                                    Februari
                                @elseif($row->bulan == '3')
                                    Maret
                                @elseif($row->bulan == '4')
                                    April
                                @elseif($row->bulan == '5')
                                    Mei
                                @elseif($row->bulan == '6')
                                    Juni
                                @elseif($row->bulan == '7')
                                    Juli
                                @elseif($row->bulan == '8')
                                    Agustus
                                @elseif($row->bulan == '9')
                                    September
                                @elseif($row->bulan == '10')
                                    Oktober
                                @elseif($row->bulan == '11')
                                    November
                                @else
                                    Desember
                                @endif
                                {{ $row->tahun }}
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
                            @if($row->status == '2' || $row->status == '3')
                                <td style="white-space: nowrap">
                                    <a href="" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal-{{$row->berita_id}}">
                                        <i class="fas fa-times"></i>
                                        Tolak
                                    </a>
                                    <a href="" class="btn btn-success" data-toggle="modal" data-target="#acceptModal-{{$row->berita_id}}">
                                        <i class="fas fa-check"></i>
                                        Terima
                                    </a>
                                </td>
                            @endif
                        </tr>

                        <div class="modal fade" id="deleteModal-{{$row->berita_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Tolak Berita?</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">Harap tinggalkan catatan penolakan Berita</div>
                                    <form action="/berita/refuse/{{ $row->berita_id }}" class="user" method="post" enctype="multipart/form-data">
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

                        <div class="modal fade" id="acceptModal-{{$row->berita_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                             aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Terima Berita?</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">Terima {{$row->judul}} ?</div>
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                        <a href="/berita/accept/{{ $row->artikel_id }}" class="btn btn-success">Terima</a>
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
