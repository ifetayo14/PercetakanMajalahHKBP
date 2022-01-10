@extends('layout.layout')

@section('title')
    HardCopy Order
@endsection

@section('main-content')
<!-- Page Heading -->
<div class="row d-flex justify-content-between">
    <h1 class="h3">HardCopy Order</h1>
    @if(\Illuminate\Support\Facades\Session::get('role') == '1' || \Illuminate\Support\Facades\Session::get('role') == '4')
     @endif
</div>
<br>

@if($message = Session::get('success'))
            <div class="alert alert-success">
                <p>
                    {{$message}}
                </p>
            </div>
        @endif
<div class="card shadow mb-4">
    <div class="card-body">
        <div class="table-responsive">
            <table style="width:100%" id="dataTable"  class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Produk</th>
                        @if(session()->get('role') == 1 || session()->get('role') == 4)
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
                        @if(session()->get('role') == 1 || session()->get('role') == 4)
                        <td>{{$p->ship_name}}</td>
                        @endif
                        <td>{{$p->status}}</td>
                        @if(session()->get('role') == 2 || session()->get('role') == 5)
                            <td>
                                @if($p->status == "Menunggu Pembayaran")
                                    <a href="" class="btn btn-outline-primary"  data-toggle="modal" data-target="#upload-{{$p->orders_id}}"><i class="fa fa-upload"></i> Upload Bukti Byar</a>
                                @endif
                                @if($p->status == "Dikirim")
                                    <a href="" class="btn btn-outline-primary"  data-toggle="modal" data-target="#selesai-{{$p->orders_id}}"><i class="fa fa-check"></i> Konfirmasi Terima</a>
                                @endif
                                    <a href="{{url('hardcopy/order/detail/'.$p->orders_id)}}" class="btn btn-outline-warning"><i class="fa fa-eye"></i> View</a>
                            </td>
                        @endif

                        @if(session()->get('role') == 1 || session()->get('role') == 4)
                            <td>
                                @if($p->status == "Menunggu Konfirmasi")
                                    <a href="" class="btn btn-outline-primary"  data-toggle="modal" data-target="#terima-{{$p->orders_id}}"><i class="fa fa-check"></i> Terima</a>
                                    <a href="" class="btn btn-outline-primary"  data-toggle="modal" data-target="#tolak-{{$p->orders_id}}"><i class="fa fa-ban"></i> Tolak</a>
                                @endif
                                @if($p->status == "Proses pengiriman barang")
                                    <a href="" class="btn btn-outline-primary"  data-toggle="modal" data-target="#resi-{{$p->orders_id}}"><i class="fa fa-upload"></i> Upload Resi</a>
                                @endif
                                    <a href="{{url('hardcopy/order/detail/'.$p->orders_id)}}" class="btn btn-outline-warning"><i class="fa fa-eye"></i> View</a>
                            </td>
                        @endif
                        
                    </tr>
                    <!-- Modal Upload -->
                    <div class="modal fade" id="upload-{{$p->orders_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Upload Bukti Pembayaran</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">Upload Bukti Pembayara <b>{{$p->nama}}</b></div>
                                    <form method="POST" enctype="multipart/form-data" action="{{url('hardcopyJemaat/upload/bukti')}}">
                                        @csrf
                                        <input type="text" name="id" hidden value="{{$p->orders_id}}">
                                          <center>  <input id="file" name="fileBukti" type="file"  data-theme="fas"></center>  
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                        <input type="submit" value="Upload" class="btn btn-primary">
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Konfirmasi Terima-->
                        <div class="modal fade" id="terima-{{$p->orders_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Terima</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">Yakin ingin menerima buki pembayaran <b>{{$p->nama}}</b>?</div>
                                     <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                        <a href="{{url('hardcopyAdmin/terima/'.$p->orders_id)}}"  class="btn btn-primary">Terima</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal Konfirmasi Tolak-->
                        <div class="modal fade" id="tolak-{{$p->orders_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Tolak</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">Yakin ingin menolak buki pembayaran <b>{{$p->nama}}</b>?</div>
                                     <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                        <a href="{{url('hardcopyAdmin/tolak/'.$p->orders_id)}}"  class="btn btn-primary">Tolak</a>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <!-- Modal Upload Resi-->
                    <div class="modal fade" id="resi-{{$p->orders_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Upload Bukti Pembayaran</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">Upload Bukti Pembayara <b>{{$p->nama}}</b></div>
                                    <form method="POST" enctype="multipart/form-data" action="{{url('hardcopyAdmin/upload/resi')}}">
                                        @csrf
                                        <input type="text" name="id" hidden value="{{$p->orders_id}}">
                                          <center>  <input id="file" name="fileResi" type="file"  data-theme="fas"></center>  
                                    <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                        <input type="submit" value="Upload" class="btn btn-primary">
                                    </div>
                                </form>
                                </div>
                            </div>
                        </div>

                        <!-- Konfirmasi Selesai -->
                        <div class="modal fade" id="selesai-{{$p->orders_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Konfirmasi Barang diterima</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">Yakin barang sudah <b>{{$p->nama}}</b> sudah diterima? status otomatis akan berubah menjadi selesai</div>
                                     <div class="modal-footer">
                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
                                        <a href="{{url('hardcopyUser/konfirmasi/'.$p->orders_id)}}"  class="btn btn-primary">Ya</a>
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
