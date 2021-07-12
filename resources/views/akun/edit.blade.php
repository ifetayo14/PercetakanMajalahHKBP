@extends('layout.layout')

@section('title')
    Edit Akun
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
                            <h1 class="h4 page-head-title mb-4">Edit Akun</h1>
                        </div>
                        <form class="user" method="post" action="/akun/updateProcess/{{$dataAkun->user_id}}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{$dataAkun->user_id}}">
                            <div class="form-group">
                                <input type="text" name="nama" value="{{$dataAkun->nama}}" class="form-control form-control-user" id="exampleFirstName" placeholder="Nama">
                                <span style="color: red">
                                    @error('nama'){{$message}}@enderror
                                </span>
                            </div>
                            <div class="form-group">
                                <input type="text" name="username" value="{{$dataAkun->username}}" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Username">
                                <span style="color: red">
                                    @error('username'){{$message}}@enderror
                                </span>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6">
                                    <input type="email" name="email" value="{{$dataAkun->email}}" class="form-control form-control-user" id="exampleRepeatPassword" placeholder="Email">
                                    <span style="color: red">
                                        @error('email'){{$message}}@enderror
                                    </span>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" name="alamat" value="{{$dataAkun->alamat}}" class="form-control form-control-user" id="exampleFirstName" placeholder="Alamat">
                                    <span style="color: red">
                                        @error('alamat'){{$message}}@enderror
                                    </span>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label style="margin-left: 10px" for="role" class="col-md-2 control-label">Role</label>
                                    <select style="width: 200px; margin-left: 10px" name="role" class="form-control">
                                        @if($dataAkun->role_id == '1')
                                            <option value="">...</option>
                                            <option value="1" selected>Admin</option>
                                            <option value="2">Jemaat</option>
                                            <option value="3">Sekjen</option>
                                            <option value="4">Tim Majalah</option>
                                            <option value="5">Pendeta</option>
                                        @elseif($dataAkun->role_id == '2')
                                            <option value="">...</option>
                                            <option value="1">Admin</option>
                                            <option value="2" selected>Jemaat</option>
                                            <option value="3">Sekjen</option>
                                            <option value="4">Tim Majalah</option>
                                            <option value="5">Pendeta</option>
                                        @elseif($dataAkun->role_id == '3')
                                            <option value="">...</option>
                                            <option value="1">Admin</option>
                                            <option value="2">Jemaat</option>
                                            <option value="3" selected>Sekjen</option>
                                            <option value="4">Tim Majalah</option>
                                            <option value="5">Pendeta</option>
                                        @elseif($dataAkun->role_id == '4')
                                            <option value="">...</option>
                                            <option value="1">Admin</option>
                                            <option value="2">Jemaat</option>
                                            <option value="3">Sekjen</option>
                                            <option value="4" selected>Tim Majalah</option>
                                            <option value="5">Pendeta</option>
                                        @else
                                            <option value="">...</option>
                                            <option value="1">Admin</option>
                                            <option value="2">Jemaat</option>
                                            <option value="3">Sekjen</option>
                                            <option value="4">Tim Majalah</option>
                                            <option value="5" selected>Pendeta</option>
                                        @endif
                                    </select>
                                </div>
                                <span style="color: red">
                                    @error('role'){{$message}}@enderror
                                </span>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label style="margin-left: 10px" for="status" class="col-md-2 control-label">Status</label>
                                    <select style="width: 200px; margin-left: 10px" name="status" class="form-control">
                                        @if($dataAkun->status == '1')
                                            <option value="">...</option>
                                            <option value="1" selected>Aktif</option>
                                            <option value="2">Non-Aktif</option>
                                        @elseif($dataAkun->status == '0')
                                            <option value="">...</option>
                                            <option value="1">Aktif</option>
                                            <option value="2" selected>Non-Aktif</option>
                                        @endif
                                    </select>
                                </div>
                                <span style="color: red">
                                    @error('status'){{$message}}@enderror
                                </span>
                            </div>
                            <br><br><br>
                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                Simpan
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
