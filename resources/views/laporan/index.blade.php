@extends('layout.layout')

@section('title')
    Laporan
@endsection

@section('main-content')
    <!-- DataTales Example -->
    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 page-head-title mb-4">Laporan</h1>
                        </div>
                        <form class="user" method="post" action="/laporan/printLaporan" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <div class="row">
                                    <label for="laporanType" style="margin-left: 15px" class="col-md-3 control-label">Jenis Laporan</label>
                                    <select style="width: 200px" name="laporanType" id="" class="form-control" required>
                                        <option value="">. . .</option>
                                        <option value="softcopy">Penjualan Softcopy</option>
                                        <option value="hardcopy">Penjualan Hardcopy</option>1
                                        <option value="member">Member</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <label for="month" style="margin-left: 15px" class="col-md-3 control-label">Bulan</label>
                                    <select style="width: 200px" name="month" id="" class="form-control" required>
                                        <option value="">. . .</option>
                                        <option value="1">Januari</option>
                                        <option value="2">Februari</option>
                                        <option value="3">Maret</option>
                                        <option value="4">April</option>
                                        <option value="5">Mei</option>
                                        <option value="6">Juni</option>
                                        <option value="7">Juli</option>
                                        <option value="8">Agustus</option>
                                        <option value="9">September</option>
                                        <option value="10">Oktober</option>
                                        <option value="11">November</option>
                                        <option value="12">Desember</option>
                                        <option value="13">Januari - Desember</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <label for="year" style="margin-left: 15px" class="col-md-3 control-label">Tahun</label>
                                    <select style="width: 200px" name="year" id="" class="form-control" required>
                                        <option value="">. . .</option>
                                        <option value="2020">2020</option>
                                        <option value="2021">2021</option>
                                    </select>
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
    </div>


    <script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'isi' );

    </script>


@endsection
