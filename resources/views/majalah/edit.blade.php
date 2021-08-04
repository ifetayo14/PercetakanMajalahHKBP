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
        <div class="row">
            <div class="col-lg-2"></div>
                <div class="col-lg-8">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 page-head-title mb-4">Ubah Majalah</h1>
                        </div>
                        <form method="post" enctype="multipart/form-data"  action="{{url('majalah/edit/'.$majalah[0]->majalah_id)}}">
                            @csrf
                            
                            <div class="form-group row">
                                <label for="staticjudul" class="col-sm-2 col-form-label">Judul</label>
                                <div class="col-sm-10">
                                    <input type="text" name="judul" value="{{$majalah[0]->judul}}" class="form-control" id="staticjudul" placeholder="Judul Majalh">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputDeskripsi" class="col-sm-2 col-form-label">Deskripsi</label>
                                <div class="col-sm-10">
                                    <textarea type="" name="deskripsi" class="form-control" id="deskripsi" placeholder="Deskripsi" style="height: 200px">{{$majalah[0]->deskripsi}}
                                    </textarea>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputDeskripsi" class="col-sm-2 col-form-label">File</label>
                                <div class="col-sm-10">
                                    <input type="file" class="form-control" name="file" id="inputFile">
                                </div>
                            </div> 
                        
                            <br>
                            <button href="" class="btn btn-success">
                                Update
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