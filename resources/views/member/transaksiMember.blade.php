@extends('layout.layout')

@section('title')
    Member
@endsection

@section('main-content')
    <!-- Page Heading -->
    @if(\Illuminate\Support\Facades\Session::get('role') == '1' || \Illuminate\Support\Facades\Session::get('role') == '4')
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Member</h1>
            <a href="/member" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Kembali</a>
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
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                    <br>
                        <br>
                        <h3>Daftar Transaksi Pengajuan Member</h3>
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Lama Member</th>
                                <th>Harga</th>
                                <th>Status Pembayaran</th>
                                <th>Tanggal Permintaan</th>
                                <th>Tanggal Perifikasi</th>
                                <th>Tanggal Aktif</th>
                                <th>Bukti Pembayaran</th>
                                <th>Aksi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($transaksiMember as $row)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->nama }}</td>
                                    <td>{{ $row->lama_member}}</td>
                                    <td>{{ $row->price* $row->lama_member}}</td>
                                    <td>{{ $row->payment_status }}</td>
                                    <td>{{$row->created_date }}</td>
                                    <td>{{$row->verified_date}}</td>
                                    <td>{{$row->verified_date}}</td>
                                    <td>
                                        <button class="btn btn-info" onclick="showBuktiBayar('{{$row->file}}')" data-toggle="modal" data-target="#tagihanModal">Bukti Bayar</button>
                                    </td>
                                    <td style="white-space: nowrap">
                                        @if($row->payment_status == 'Menunggu Konfirmasi')
                                            <a href="member/approve/{{$row->transaksimember_id}}" class="btn btn-info">
                                                <i class="fas fa-check"> Konfirmasi</i>
                                            </a>
                                            <a href="member/reject/{{$row->transaksimember_id}}" class="btn btn-danger">
                                                <i class="fas fa-times"> Tolak</i>
                                            </a>
                                        @endif
                                    </td>
                                </tr>

                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        @endif
    </div>
    @if(Session::get('role') == '1' || Session::get('role') == '4')
    <div class="modal fade" id="tagihanModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Bukti Bayar</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <img class="img-fluid" id="gambarBukti"/>
                </div>
                <br>
            </div>
        </div>
    </div>
    @endif
   
    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

@endsection
