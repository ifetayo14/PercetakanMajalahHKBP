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
                                <td>{{Carbon\Carbon::parse($row->active_date)->format('H:m d-m-Y')}}</td>
                                <td>{{ Carbon\Carbon::parse($row->end_date)->format('H:m d-m-Y') }}</td>
                                <td>
                                    <?php $datetoday = date('Y-m-d'); ?>
                                    @if($datetoday <= Carbon\Carbon::parse($row->end_date)->format('Y-m-d'))
                                        <div class="btn btn-success">Aktif</div>
                                    @else
                                        <div class="btn btn-info" >Non Aktif</div>
                                    @endif
                            </td>
                                
                                <td style="white-space: nowrap">
                                    <!--a href="" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal-{{$row->member_id}}">
                                        <i class="fas fa-trash"></i>
                                    </a>
                                    <a href="member/edit/{{$row->member_id}}" class="btn btn-info">
                                        <i class="fas fa-edit"></i -->
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
            </div>
        @else
            <div class="card-body">
                @if($dataMember == null)
                    <br><br>
                    <div style="text-align: center">
                        <h3>Anda belum berlangganan</h3>
                        <h5>Silahkan klik tombol dibawah ini untuk berlangganan</h5>
                        <br><br>
                        <a href="member/add" data-toggle="modal" data-target="#memberRequestModal" class="btn btn-success btn-user">Berlangganan</a>
                        <br><br>
                    </div>

                    <div class="modal fade" id="memberRequestModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Request Berlangganan</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form class="user" method="post" action="/member/addProcess" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <div class="row">
                                                <label style="margin-left: 15px" for="end_date">Lama Berlangganan (Bulan)</label>
                                                <select name="lama_member" id="" class="form-control" style="width: 200px; margin-left: 10px">
                                                    <option value="">...</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                    <option value="7">7</option>
                                                    <option value="8">8</option>
                                                    <option value="9">9</option>
                                                    <option value="10">10</option>
                                                    <option value="11">11</option>
                                                    <option value="12">12</option>
                                                </select>
                                                <span style="color: red">
{{--                                        @error('lama_member'){{$message}}@enderror--}}
                                    </span>
                                            </div>
                                        </div>

                                        <br><br><br>
                                        <button type="submit" href="#" class="btn btn-primary btn-user btn-block">
                                            Simpan
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <h5>Status Langganan</h5>
                    <br>
                    <div style="text-align: right">
                        <a href="#" data-toggle="modal" data-target="#perpanjangMemberModal" class="btn btn-success btn-user">Perpanjang MemberShip</a>
                        <br><br>
                    </div>
                    <table class="table ">
                        <tr>
                            <td>Status</td>
                            <td>
                                <?php $datetoday = date('Y-m-d'); ?>
                                @if($datetoday <= $dataMember->end_date)
                                    <div class="btn btn-success">Aktif</div>
                                @else
                                    <div class="btn btn-info" >Non Aktif</div>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td>Tanggal Dimulai</td>
                            <td>{{$dataMember->active_date}}</td>
                        </tr>
                        <tr>
                            <td>Tanggal Berakhir</td>
                            <td>{{$dataMember->end_date}}</td>
                        </tr>
                        <!-- @if($dataMember->status == 'Aktif')
                        <tr>
                            <td>
                                <a href="" class="btn btn-primary">Download Majalah</a>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>
                                <a href="" class="btn btn-primary">Perpanjang Membership</a>
                            </td>
                            <td></td>
                        </tr>
                        @else
                            <tr>
                                <td>
                                    <a href="" data-toggle="modal" data-target="#sendFileRequestModal" class="btn btn-primary">Kirim Bukti Pembayaran</a>
                                </td>
                                <td></td>
                            </tr>



                            <tr>
                                <td>
                                    <a href="" data-toggle="modal" data-target="#tagihanRequestModal" class="btn btn-primary">Tagihan</a>
                                </td>
                                <td></td>
                            </tr>

                        @endif -->
                    </table>
                    <br><br>
                    <h5>Daftar Transaksi Membership</h5>
                    <br>
                    <table class="table ">
                        <thead>
                            <th>No</th>
                            <th>Lama Member</th>
                            <th>Harga</th>
                            <th>Status Pembayaran</th>
                            <th>Tanggal Permintaan</th>
                            <th>Tanggal Perifikasi</th>
                            <th>Tanggal Aktif</th>
                            <th>Aksi</th>
                        </thead>
                        <tbody>
                            <?php $i=1; foreach($transaksiMember as $tm){ ?>
                            <tr>
                                <td>{{$i}}</td>
                                <td>{{$tm->lama_member}}</td>
                                <td>{{$tm->price * $tm->lama_member}}</td>
                                <td>{{$tm->payment_status}}</td>
                                <td>{{$tm->created_date }}</td>
                                <td>{{$tm->verified_date}}</td>
                                <td>{{$tm->verified_date}}</td>
                                <td>@if($tm->payment_status == 'Pending')
                                    <a href="" data-toggle="modal" data-target="#sendFileRequestModal" class="btn btn-primary">Kirim Bukti Pembayaran</a>
                                    @endif
                                    <a href="" data-toggle="modal" data-target="#tagihanRequestModal" class="btn btn-primary">Tagihan</a>
                                </td>
                            </tr>
                            <?php $i++; } ?>
                        </tbody>

                        <!-- @if($dataMember->status == 'Aktif')
                        <tr>
                            <td>
                                <a href="" class="btn btn-primary">Download Majalah</a>
                            </td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>
                                <a href="" class="btn btn-primary">Perpanjang Membership</a>
                            </td>
                            <td></td>
                        </tr>
                        @else
                            <tr>
                                <td>
                                    <a href="" data-toggle="modal" data-target="#sendFileRequestModal" class="btn btn-primary">Kirim Bukti Pembayaran</a>
                                </td>
                                <td></td>
                            </tr>



                            <tr>
                                <td>
                                    <a href="" data-toggle="modal" data-target="#tagihanRequestModal" class="btn btn-primary">Tagihan</a>
                                </td>
                                <td></td>
                            </tr>

                        @endif -->
                    </table>
    <!-- Perpanjang Member -->
                    <div class="modal fade" id="perpanjangMemberModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Request Perpanjangan Berlangganan</h5>
                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">×</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form class="user" method="post" action="/member/perpanjangProcess" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <div class="row">
                                                <label style="margin-left: 15px" for="end_date">Lama Berlangganan (Bulan)</label>
                                                <select name="lama_member" id="" class="form-control" style="width: 200px; margin-left: 10px">
                                                    <option value="">...</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                    <option value="7">7</option>
                                                    <option value="8">8</option>
                                                    <option value="9">9</option>
                                                    <option value="10">10</option>
                                                    <option value="11">11</option>
                                                    <option value="12">12</option>
                                                </select>
                                                <span style="color: red">
{{--                                        @error('lama_member'){{$message}}@enderror--}}
                                    </span>
                                            </div>
                                        </div>

                                        <br><br><br>
                                        <button type="submit" href="#" class="btn btn-primary btn-user btn-block">
                                            Simpan
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
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
    @if($dataMember != null &&  Session::get('role') != '1' && Session::get('role') != '4')
    <div class="modal fade" id="tagihanRequestModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tagihan</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <br>
                <table class="table">
                    <tr>
                        <td>Lama Berlangganan</td>
                        <td>:</td>
                        <td>{{$dataMember->lama_member}} bulan</td>
                    </tr>
                    <tr>
                        <td>Nominal</td>
                        <td>:</td>
                        <td>Rp {{number_format($dataMember->price * $dataMember->lama_member,2)}}</td>
                    </tr>
                    <tr>
                        <td>No. Rekening</td>
                        <td>:</td>
                        <td>{{$dataMember->deskripsi}}</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    @endif
    <div class="modal fade" id="sendFileRequestModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                 aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Upload Bukti Pembayaran</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" enctype="multipart/form-data" action="/member/addBukti" >
                        @csrf
                        <div class="form-group">

                                <input id="file-5" name="buktiBayar" class="file form-control" type="file"/>
                        </div>
                        <br><br><br>
                        <input type="submit" class="btn btn-primary btn-user btn-block" value="Upload">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

@endsection
