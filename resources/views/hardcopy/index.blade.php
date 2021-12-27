@extends('layout.layout')

@section('title')
    HardCopy
@endsection
@section('main-content')
    <div class="row card d-flex flex-row-reverse p-1 align-content-center mt-0" style="min-height: 40px">
        <a href="hardcopyAdmin/order"><button class="btn btn-sm btn-success" data-placement="bottom" data-toggle="tooltip" title="Order"><i class="fas fa-sticky-note"></i></button></a>

    </div>
   <div class="row">
       @foreach($dataHardCopy as $row)
       <div class="col-md-3 mt-2">
           <div class="card w-100">
               <img class="card-img-top" src="https://winstarlink.com/wp-content/uploads/2020/02/jasa-pembuatan-desain-katalog-Portrait-10.jpg" alt="Card image cap" style="height: 170px">
               <div class="card-body" >
                   <h5 class="card-title">{{$row->nama}}</h5>
                   <p class="card-text">{{$row->deskripsi}}</p>
                   <a href="hardcopyJemaat/detail/{{$row->producthardcopy_id}}" class="btn btn-success w-100">Beli</a>
                   <p class="card-text mt-1"><small class="text-muted">Edisi {{$row->bulan . ' ' .$row->tahun }}</small></p>
               </div>
           </div>
       </div>
       @endforeach

   </div>
@endsection
