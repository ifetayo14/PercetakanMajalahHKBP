@extends('layout.layout')

@section('title')
    Edit Membership
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
                            <h1 class="h4 page-head-title mb-4">Edit Membership</h1>
                        </div>
                        <form class="user" method="post" action="/member/updateProcess/{{$dataMember->member_id}}" enctype="multipart/form-data">
                            @csrf
                            <input hidden type="text" name="id" value="{{$dataMember->member_id}}">
                            <div class="form-group">
                                <label for="start_date">Nama</label>
                                <input disabled type="text" name="nama" class="form-control form-control-user" id="exampleFirstName" placeholder="Judul" value="{{$dataMember->nama}}">
                            </div>
                            <div class="form-group">
                                <label for="start_date">Tanggal Mulai Berlangganan</label>
                                <input  disabled type="datetime-local" name="start_date" class="form-control form-control-user" id="exampleFirstName" placeholder="Start Date" value="{{Carbon\Carbon::parse($dataMember->active_date)->format('Y-m-d\TH:i')}}">
                            </div>
                            <div class="form-group">
                                <label for="end_date">Tanggal Berakhir Berlangganan</label>
                                <input disabled type="datetime-local" name="end_date" class="form-control form-control-user" id="exampleFirstName" placeholder="End Date" value="{{Carbon\Carbon::parse($dataMember->end_date)->format('Y-m-d\TH:i')}}">
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <label style="margin-left: 10px" for="status" class="col-md-2 control-label">Status</label>
                                    <select style="width: 200px; margin-left: 10px" name="status" class="form-control">
                                        @if($dataMember->status == '1')
                                            <option value="1" selected>Aktif</option>
                                            <option value="0">Pending</option>
                                        @else
                                            <option value="1">Aktif</option>
                                            <option value="0" selected>Pending</option>
                                        @endif
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
@endsection
