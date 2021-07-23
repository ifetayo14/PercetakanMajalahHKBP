@extends('layout.layout')

@section('title')
    Khotbah
@endsection

@section('main-content')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Khotbah</h1>
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
                        @if(\Illuminate\Support\Facades\Session::get('role') == '1' || \Illuminate\Support\Facades\Session::get('role') == '4')
                            <th>Aksi</th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($dataKhotbah as $row)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><a href="khotbah/detail/{{$row->kotbah_id}}">{{ $row->judul }}</a></td>
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
                            @if(\Illuminate\Support\Facades\Session::get('role') == '1' || \Illuminate\Support\Facades\Session::get('role') == '4')
                                <td style="white-space: nowrap">
                                    <a href="" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal-{{$row->kotbah_id}}">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <a href="artikel/edit/{{$row->kotbah_id}}" class="btn btn-info">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                            @endif
                        </tr>

                        <div class="modal fade" id="deleteModal-{{$row->kotbah_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                                        <a href="khotbah/delete/{{ $row->kotbah_id }}" class="btn btn-primary">Hapus</a>
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
