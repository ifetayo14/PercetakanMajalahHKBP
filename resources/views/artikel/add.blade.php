@extends('layout.layout')

@section('title')
    Pengajuan Artikel
@endsection

@section('main-content')

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
                <div class="col-lg-2"></div>
                <div class="col-lg-8">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 page-head-title mb-4">Pengajuan Artikel</h1>
                        </div>
                        <form class="user" method="post" action="/artikel/addProcess" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="judul" class="form-control form-control-user" id="exampleFirstName" placeholder="Judul">
                                <span style="color: red">
                                    @error('judul'){{$message}}@enderror
                                </span>
                            </div>
                            <div class="form-group">
                                <textarea type="" name="isi" class="form-control" id="" placeholder="Isi Artikel" style="height: 200px"></textarea>
                                <span style="color: red">
                                    @error('isi'){{$message}}@enderror
                                </span>
                            </div>
                            <div class="form-group">
                                <div class="file-loading">
                                    <input id="file-5" name="file-pelengkap" class="file form-control" type="file" multiple data-theme="fas">

                                </div>
                                <span style="color: red">
                                    @error('file-pelengkap'){{$message}}@enderror
                                </span>
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
