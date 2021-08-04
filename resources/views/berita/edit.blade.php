@extends('layout.layout')

@section('title')
    Edit Berita
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
                            <h1 class="h4 page-head-title mb-4">Edit Berita</h1>
                        </div>
                        <form class="user" method="post" action="/berita/editProcess/{{$dataBerita->berita_id}}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="status" value="{{$dataBerita->status}}">
                            <div class="form-group">
                                <input type="text" name="judul" class="form-control form-control-user" id="exampleFirstName" placeholder="Judul" value="{{$dataBerita->judul}}">
                                <span style="color: red">
                                    @error('judul'){{$message}}@enderror
                                </span>
                            </div>
                            <div class="form-group">
                                <textarea type="" name="isi" class="form-control" id="" placeholder="Isi Berita" style="height: 200px">
                                    {{$dataBerita->isi}}
                                </textarea>
                                <span style="color: red">
                                    @error('isi'){{$message}}@enderror
                                </span>
                            </div>
                            <div class="form-group">
                                <input id="file-5-edit" name="file-pelengkap" class="file form-control" type="file" multiple data-theme="fas">

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
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            $("#file-5-edit").fileinput({
                theme: 'fas',
                showUpload: false,
                showClose:false,
                showCaption: true,
                <?php if(!file_exists(public_path('uploads/' . $dataBerita->file))){
                    ?>

                <?php
                }
                    else{
                    ?>
                initialPreview: [
                    "{{ URL::to('uploads/' . $dataBerita->file) }}"
                ],

                initialPreviewAsData: true,
                initialPreviewConfig: [
                    {type: "pdf", description: "Lampiran terkait kotbah", size: "{{File::size(public_path('uploads/' . $dataBerita->file))}}", caption: "{{$dataBerita->file}}", downloadUrl: "{{URL::to('uploads/' . $dataBerita->file)}}"},
                ]
                <?php
                }
                ?>

            });
        });



    </script>


@endsection
