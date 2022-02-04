@if(\Illuminate\Support\Facades\Session::has('username'))
    <script>window.location = "/";</script>
@endif
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Register</title>

    <!-- Custom fonts for this template-->
    <link href="templateResources/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="templateResources/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">
<br><br>
<div class="container">

    <!-- Outer Row -->
    <div class="row justify-content-center">
        <div class="col-xl-5 col-lg-12 col-md-9">

            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-3"></div>
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <img src="{{url('icon/logo.jpg')}}" alt="" class="loginIcon">
                                </div>
                                <br>
                                <form class="user" method="post" action="{{url('registerProcess')}}">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" name="username" id="username" aria-describedby="emailHelp" placeholder="Username">
                                        <span style="color: red">
                                            @error('username'){{$message}}@enderror
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" class="form-control form-control-user" name="password" id="password" placeholder="Password">
                                        <span style="color: red">
                                            @error('password'){{$message}}@enderror
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" name="nama" id="nama" placeholder="Nama">
                                        <span style="color: red">
                                            @error('nama'){{$message}}@enderror
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" name="alamat" id="alamat" placeholder="Alamat">
                                        <span style="color: red">
                                            @error('alamat'){{$message}}@enderror
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user" name="email" id="email" placeholder="Email">
                                        <span style="color: red">
                                            @error('email'){{$message}}@enderror
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <label for="role" style="margin-left: 15px">Daftar Sebagai</label>
                                            <select name="role" style="width: 225px; margin-left: 10px" class="form-control">
                                                <option value="">...</option>
                                                <option value="pendeta">Pelayan</option>
                                                <option value="jemaat">Jemaat</option>
                                            </select>
                                        </div>
                                        <span style="color: red">
                                            @error('role'){{$message}}@enderror
                                        </span>
                                    </div>
                                    <br>
                                    <button href="" class="btn btn-success btn-user btn-block">
                                        Daftar
                                    </button>
                                </form>
                                <br>
                                <p>&nbsp;&nbsp;Sudah punya akun? <a href="/">Masuk</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

<!-- Bootstrap core JavaScript-->
<script src="templateResources/vendor/jquery/jquery.min.js"></script>
<script src="templateResources/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="templateResources/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="templateResources/js/sb-admin-2.min.js"></script>

</body>

</html>
