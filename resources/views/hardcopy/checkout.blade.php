@extends('layout.layout')

@section('title')
   
@endsection
@section('main-content')
<form method="POST" enctype="multipart/form-data" action="{{url('hardcopyJemaat/order')}}">
@csrf
<input type="text" name="producthardcopy_id"hidden  value="{{$dataHardCopy->producthardcopy_id}}">
<input type="text" name="qty"  value="{{$qty}}" hidden>
<input type="text" name="harga_hd" value="{{$dataHardCopy->harga}}" hidden  >
<div class="form-group row">
    <div class="col-sm-6">
    <label for="nama" class="col-sm-2 col-form-label">Nama</label>
        <input type="text" oninput="oninput();" name="nama" value="" class="form-control" id="nama" placeholder="Nama">
    </div>
  
    <div class="col-sm-6">
    <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
        <input type="text" oninput="onFill();" name="alamat" value="" class="form-control" id="alamat" placeholder="Alamat">
    </div>
    <div class="col-sm-6">
        <div class="form-group">
                        <label class="font-weight-bold">PROVINSI TUJUAN</label>
                        <select class="form-control provinsi-tujuan" name="province_destination">
                            <option value="0">-- pilih provinsi tujuan --</option>
                            @foreach ($provinces as $province => $value)
                                <option value="{{ $province  }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
    </div>
    
    <div class="col-sm-6">
    <label for="negara" class="col-sm-2 col-form-label">Negara</label>
        <input type="text" oninput="onFill();" name="negara" value="" class="form-control" id="negara" placeholder="Negara">
    </div>
    <div class="col-sm-6">
    <div class="form-group">
        <label class="font-weight-bold">KOTA / KABUPATEN TUJUAN</label>
            <select class="form-control kota-tujuan" name="city_destination">
                <option value="">-- pilih kota tujuan --</option>
             </select>
    </div>    
</div>
    <div class="col-sm-6">
    <label for="kode_pos" class="col-sm-6 col-form-label">Kode Pos</label>
        <input type="text" oninput="onFill();" name="kode_pos" value="" class="form-control" id="kode_pos" placeholder="Kode Pos">
    </div>
    <div class="col-sm-6">
        <label for="ongkir" class="col-sm-2 col-form-label">    </label>
        <button class="btn btn-md btn-primary btn-block btn-check" id="btn_kirim" >CEK ONGKOS KIRIM</button>
        <script>
            var btn_kirim = document.getElementById("btn_kirim");
            btn_kirim.disabled = true;
        </script>
    </div>
</div>
<input type="number" hidden value="{{$dataHardCopy->berat * $qty}}"  class="form-control" name="weight" id="weight" placeholder="Masukkan Berat (GRAM)">
                 
<div class="container-fluid mt-5">
    <div class="row">
        <div class="col-md-3">
         </div>
    </div>
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card d-none ongkir">
                <div class="card-body">
                    <ul class="list-group" name="ongkir" id="ongkir"></ul>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-12" name="totalPembayaran" id="totalPembayaran">
        <p>Harga Produk Rp.{{$dataHardCopy->harga}}</p>
        <p>Jumlah Pesanan {{$qty}}
        <p id="txtTP"></p>
    </div>
    <div class="col-sm-12"  name="bukti" id="bukti">
    </div>

</div>


    <div class="col-sm-6" id="btnSubmit">
    <input  class="btn btn-md btn-primary btn-block" type="submit" value="Submit">
    </div>
        <script>
            document.getElementById("totalPembayaran").style.display ="none";
            document.getElementById("btnSubmit").style.display = "none";
        </script>
</form>

<!-- Optional JavaScript -->
    @section('script')
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" ></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script>
         var btn_kirim = document.getElementById("btn_kirim");
        function onFill(){
            var nama = document.getElementById("nama").value;
            var alamat = document.getElementById("alamat").value;
            var negara = document.getElementById("negara").value;
            var kode_pos = document.getElementById("kode_pos").value; 
  
            if(nama!="" && alamat !="" && negara != "" && kode_pos !=""){
                btn_kirim.disabled = false;
            }
         
        }                                                                                                                                                                                                                      
        $(document).ready(function(){
            //active select2
            $(".provinsi-tujuan, .kota-tujuan").select2({
                theme:'bootstrap4',width:'style',
            });
            //ajax select kota tujuan
            $('select[name="province_destination"]').on('change', function () {
                let provindeId = $(this).val();
                if (provindeId) {
                    jQuery.ajax({
                        url: '/cities/'+provindeId,
                        type: "GET",
                        dataType: "json",
                        success: function (response) {
                            $('select[name="city_destination"]').empty();
                            $('select[name="city_destination"]').append('<option value="">-- pilih kota tujuan --</option>');
                            $.each(response, function (key, value) {
                                $('select[name="city_destination"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                        },
                    });
                } else {
                    $('select[name="city_destination"]').append('<option value="">-- pilih kota tujuan --</option>');
                }
            });
            //ajax check ongkir
            let isProcessing = false;
            $('.btn-check').click(function (e) {
                e.preventDefault();

                let token            = $("meta[name='csrf-token']").attr("content");
                let city_destination = $('select[name=city_destination]').val();
                let weight           = $('#weight').val();

                if(isProcessing){
                    return;
                }

                isProcessing = true;
                jQuery.ajax({
                    url: "/ongkir",
                    data: {
                        _token:              token,
                        city_destination:    city_destination,
                        weight:              weight,
                    },
                    dataType: "JSON",
                    type: "POST",
                    success: function (response) {
                        isProcessing = false;
                        if (response) {
                            $('#ongkir').empty();
                            $('.ongkir').addClass('d-block');
                            $.each(response[0]['costs'], function (key, value) {
                                $('#ongkir').append('<li class="list-group-item"> <input type="radio" onclick="checkRadio('+value.cost[0].value+')" id="radioOngkir" onclick="alert("s");" name="rOngkir"  value="'+value.cost[0].value+'"> '+response[0].code.toUpperCase()+' : <strong>'+value.service+'</strong> - Rp. '+value.cost[0].value+' ('+value.cost[0].etd+' hari)</li>')
                            });

                        }
                    }
                });

            });

        });
        function checkRadio(tP){
            var total = tP+(<?php echo $dataHardCopy->harga * $qty ?>)
            document.getElementById("txtTP").textContent = "Total pembayaran Rp."+total;
            document.getElementById("btnSubmit").style.display = "block";
            document.getElementById("totalPembayaran").style.display ="block";
            // $('#totalPembayaran').append('<p>Total pembayaran Rp.'+total+'</p>')
            //                     $('#bukti').append('<label  class="col-sm-2 col-form-label">Upload Bukti</label> <input type="file" data-theme="fas" multiple name="buktiBayar" value="" class="file form-control" >');
                            //    $('#btnSubmit').append('</br><input  class="btn btn-md btn-primary btn-block btn-check" type="submit" value="Submit">')
                         
        }
    </script>
    @endsection
@endsection