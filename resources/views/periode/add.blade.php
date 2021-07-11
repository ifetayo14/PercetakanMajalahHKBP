@extends('layout.layout')

@section('title')
    Periode
@endsection

@section('main-content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <div class="container">
        <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h3>Tambah Periode</h3>
            </div>
        </div>
            <form method="post" action="{{url('periode/add')}}">
                @csrf
                <div class="form-group row">
                    <label for="inputDeskripsi" class="col-sm-2 col-form-label">Tahun</label>
                    <div class="col-sm-4">
                       <select name="tahun" class="form-control">
                        <option selected="selected" value="{{$periode['tahun']}}">{{$periode['tahun']}}</option>
                            <?php
                                for($i=date('Y')+1; $i>=date('Y')-32; $i-=1){
                                echo"<option value='$i'> $i </option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputBulan" class="col-sm-2 col-form-label">Bulan</label>
                    <div class="col-sm-4">
                        <select name="bulan" class="form-control">
                            <option selected="selected" value="{{$periode['bulan']}}">{{$periode['bulan']}}</option>
                            <option value="Januari"> Januari </option>
                            <option value="Februari"> Februari </option>
                            <option value="Maret"> Maret </option>
                            <option value="April"> April </option>
                            <option value="Mei"> Mei </option>
                            <option value="Juni"> Juni </option>
                            <option value="Juli"> Juli </option>
                            <option value="Agustus"> Agustus </option>
                            <option value="September"> September </option>
                            <option value="Oktober"> Oktober </option>
                            <option value="November"> November </option>
                            <option value="Desember"> Desember </option>
                        </select>
                    </div>
                </div> 
                <div class="form-group row">
                    <label for="staticTema" class="col-sm-2 col-form-label">Tema</label>
                    <div class="col-sm-10">
                        <input type="text" name="tema" value="{{$periode['tema']}}" class="form-control" id="staticTema" placeholder="Tema Bulan">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="inputDeskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="deskripsi" value="{{$periode['deskripsi']}}" id="inputDeskripsi" placeholder="Deskripsi">
                    </div>
                </div> 
                <div class="form-group row">
                    <label for="inputStatus" class="col-sm-2 col-form-label">Status</label>
                    <div class="col-sm-10">
                        <select name="status" class="form-control" id="inputStatus">
                            <option value="{{$periode['status']}}">{{$periode['status']}}</option>
                            <option value="Tidak Aktif">Tidak Aktif</option>
                            <option value="Aktif">Aktif</option>
                        </select>
                    </div>
                </div>
                <br>
                <button class="btn btn-success">
                    Simpan
                </button>
            </form>
        </div>
    </div>
</div>

@endsection 