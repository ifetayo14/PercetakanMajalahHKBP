@extends('layout.layout')

@section('title')
    HardCopy
@endsection
@section('main-content')
    <div class="row card d-flex flex-row-reverse p-1 align-content-center mt-0 mb-2" style="min-height: 40px">
        <a href="hardcopyAdmin/tambah"><button class="btn btn-sm btn-success" data-placement="bottom" data-toggle="tooltip" title="Tambah Produk">Tambah Prdouct <i class="fas fa-plus"></i></button></a>
        <a href="hardcopy/order"><button class="btn btn-sm btn-success mr-2" data-placement="bottom" data-toggle="tooltip" title="Order">List Order <i class="fas fa-sticky-note"></i></button></a>

    </div>

    <div class="row">
        @foreach($dataHardCopy as $row)
            <div class="col-md-3 mt-2 mb-2">
                <div class="card w-100">
                    <img class="card-img-top" src="{{URL::to('uploads/cover/' . $row->cover)}}" alt="Card image cap" style="height: 170px">
                    <div class="card-body" >
                        <h5 class="card-title">{{$row->nama}}</h5>
                        <p class="card-text">{{$row->deskripsi}}</p>
                        <a href="hardcopyJemaat/detail/{{$row->producthardcopy_id}}" class="btn btn-success w-100">Lihat Selengkapnya</a>
                        <div class="row  mt-2">
                           <div class="col-md-8">
                               <p class="card-text"><small class="text-muted">Edisi {{$row->bulan . ' ' .$row->tahun }}</small></p>
                           </div>
                            <div class="col-md-4 d-flex flex-row-reverse">
                                <button class="btn btn-sm btn-danger" data-placement="bottom" data-toggle="tooltip" title="Hapus Produk" onclick="deleteHardCopy({{$row->producthardcopy_id}}) "><i class="fas fa-trash"></i></button>
                                <a href="hardcopyJemaat/edit/{{$row->producthardcopy_id}}"><button class="btn btn-sm btn-primary mr-2" data-placement="bottom" data-toggle="tooltip" title="Edit Produk"><i class="fas fa-edit"></i></button></a>
                            </div>
                        </div>


                    </div>
                </div>
            </div>
        @endforeach

    </div>
    <script>
        function  deleteHardCopy(id){
            console.log(id);
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    var url = "<?php echo url('hardcopyAdmin/hapus'); ?>" +"/"+id ;
                    window.location = url;
                }
            })
        }
    </script>

@endsection
