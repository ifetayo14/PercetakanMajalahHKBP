@extends('layout.layout')

@section('title')
    Member
@endsection

@section('main-content')
    <!-- Page Heading -->
    @if(\Illuminate\Support\Facades\Session::get('role') == '1' || \Illuminate\Support\Facades\Session::get('role') == '4')
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Member</h1>
        </div>
    @else
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Membership</h1>
        </div>
    @endif


    <div class="card shadow mb-4">
        @if($message = Session::get('success'))
            <div class="alert alert-success">
                <p>
                    {{$message}}
                </p>
            </div>
        @endif

        @if(\Illuminate\Support\Facades\Session::get('role') == '1' || \Illuminate\Support\Facades\Session::get('role') == '4')
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Tanggal Dimulai</th>
                            <th>Tanggal Berakhir</th>
                            <th>Status Langganan</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($dataMember as $row)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $row->nama }}</td>
                                <td>{{ $row->start_date }}</td>
                                <td>{{ $row->end_date }}</td>
                                <td>
                                    @if($row->status == '1')
                                        <div class="btn btn-success">Aktif</div>
                                    @else
                                        <div class="btn btn-info">Pending</div>
                                    @endif
                                </td>
                                <td style="white-space: nowrap">
                                    <a href="" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal-{{$row->member_id}}">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <a href="member/edit/{{$row->member_id}}" class="btn btn-info">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </td>
                            </tr>

                            <div class="modal fade" id="deleteModal-{{$row->member_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                                            <a href="artikel/delete/{{ $row->member_id }}" class="btn btn-primary">Hapus</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <div class="card-body">
                @if($dataMember == null)
                    <br><br>
                    <div style="text-align: center">
                        <h3>Anda belum berlangganan</h3>
                        <h5>Silahkan klik tombol dibawah ini untuk berlangganan</h5>
                        <br><br>
                        <a href="member/add" class="btn btn-success btn-user">Berlangganan</a>
                        <br><br>
                    </div>
                @else
                    <h5>Status Langganan</h5>
                    <br>
                    <table class="table ">
                        <tr>
                            <td>Status</td>
                            <td>
                                @if($dataMember->status == '1')
                                    <div class="btn btn-success">Aktif</div>
                                @else
                                    <div class="btn btn-info">Pending</div>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Tanggal Dimulai</td>
                            <td>{{$dataMember->start_date}}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Berakhir</td>
                            <td>{{$dataMember->end_date}}</td>
                        </tr>
                        @if($dataMember->status == '1')
                        <tr>
                            <td>
                                <a href="" class="btn btn-primary">Download Majalah</a></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>
                                <a href="" class="btn btn-primary">Perpanjang Membership</a></td>
                            <td></td>
                        </tr>
                        @endif
                    </table>
                @endif
            </div>
        @endif
    </div>

@endsection
