@extends('layout.layout')

@section('title')
    Periode
@endsection

@section('main-content')
<!-- Page Heading -->

<!-- DataTales Example -->
<div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
        @if($message = Session::get('error'))
            <div class="alert alert-danger">
                <p>
                    {{$message}}
                </p>
            </div>
    @endif
    <!-- Nested Row within Card Body -->
        <div class="row">
                <div class="col-12">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 page-head-title mb-4">Tambah Periode</h1>
                        </div>

                        <form method="post" action="{{url('periode/add')}}">
                            @csrf
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group row">
                                        <label for="inputDeskripsi" class="col-4 col-form-label">Tahun</label>
                                        <div class="col-8">
                                        <select name="tahun" class="form-control">
                                            <option selected="selected" >Pilih Tahun</option>
                                                <?php
                                                    for($i=date('Y')+1; $i>=date('Y')-32; $i-=1){
                                                    echo"<option value='$i'> $i </option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group row">
                                        <label for="inputBulan" class="col-4 col-form-label">Bulan</label>
                                        <div class="col-8">
                                            <select name="bulan" class="form-control">
                                                <option selected="selected" >Pilih Bulan</option>
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
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="staticTema" class="col-2 col-form-label">Tema</label>
                                <div class="col-10">
                                    <input type="text" name="tema" value="{{$periode['tema']}}" class="form-control" id="staticTema" placeholder="Tema Bulan">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputDeskripsi" class="col-2 col-form-label">Deskripsi</label>
                                <div class="col-10">
                                    <textarea type="" name="deskripsi" class="form-control" id="" placeholder="Deskripsi" style="height: 200px">{{$periode['deskripsi']}}</textarea>
                                </div>
                            </div> 
                            <div class="form-group row">
                                <label for="inputStatus" class="col-2 col-form-label">Status</label>
                                <div class="col-4">
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
    </div>
</div>
    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'deskripsi' );
    </script>

@endsection 