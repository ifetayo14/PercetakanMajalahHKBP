@extends('layout.layout')

@section('title')
    Majalah
@endsection

@section('main-content')
<!-- Page Heading -->
<div class="card o-hidden border-0 shadow-lg my-5">
    <div class="card-body p-0">
        @if($message = Session::get('error'))
            <div class="alert alert-danger">
                <p>
                    {{$message}}
                </p>
            </div>
        @endif
        @if($message = Session::get('success'))
            <div class="alert alert-success">
                <p>{{$message}}</p>
            </div>
        @endif
        <div class="row">
            <div class="col-lg-2"></div>
                <div class="col-lg-8">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 page-head-title mb-4">Setujui Majalah</h1>
                        </div>
                        <form method="post" enctype="multipart/form-data"  action="{{url('majalahDewanRedaksi/terima/'.$majalah[0]->majalah_id)}}">
                            @csrf
                            <div class="form-group row">
                                <label for="inputCatatan" class="col-sm-2 col-form-label">Catatan</label>
                                <div class="col-sm-10">
                                    <textarea type="" name="catatan" class="form-control" id="catatan" placeholder="Catatan" style="height: 300px">{{$majalah[0]->catatan}}
                                    </textarea>
                                </div>
                            </div>
                            <br>
                            <div class="row d-flex justify-content-center">
                                <button class="btn btn-success p-2 m-2"><i class="fa fa-save"></i> Simpan</button>
                                <a href="/majalahDewanRedaksi/view/{{$majalah[0]->majalah_id}}" class="btn btn-danger p-2 m-2"><i class="fa fa-arrow-left"></i> Kembali</a>
                            </div>
                            
                        </form>
                    </div>
                </div>
        </div>
    </div>
</div>


<script src="https://cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace( 'catatan' );
    </script>
@endsection 