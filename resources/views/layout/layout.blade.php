@if(Session::has('username'))

@else
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

    <title>
        @yield('title')
    </title>

    <!-- Custom fonts for this template-->
    <link href="{{url('templateResources/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{url('templateResources/css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link href="{{url('templateResources/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">

</head>

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <!-- Sidebar - Brand -->
        <a class="sidebar-brand d-flex align-items-center justify-content-center"
           @if(\Illuminate\Support\Facades\Session::get('role') == '1')
                href="{{url('dashAdmin')}}"
           @elseif(\Illuminate\Support\Facades\Session::get('role') == '2')
                href="{{url('dashJemaat')}}"
           @elseif(\Illuminate\Support\Facades\Session::get('role') == '3')
                href="{{url('dashSekjen')}}"
           @elseif(\Illuminate\Support\Facades\Session::get('role') == '4')
                href="{{url('dashTimMajalah')}}"
           @else
                href="{{url('dashPendeta')}}"
           @endif
        >
            <div class="sidebar-brand-icon">
                <img src="{{ url('icon/logo-white.png') }}" class="mainIcon" alt="">
            </div>
        </a>

        <!-- Divider -->
        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item {{(request()->is('index') ? 'active' : '')}}">
            <a class="nav-link" href="{{url('index')}}">
                <i class="fa fa-tachometer-alt"
                   style="color: {{(request()->is('index') ? '#0500FE' : '#FFFFFF')}} ">
                </i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-item {{(request()->is('artikel*') ? 'active' : '')}}">
            <a class="{{(request()->is('artikel*') ? 'nav-linkDrop' : 'nav-link')}} collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
               aria-expanded="true" aria-controls="collapsePages">
                <i class="fa fa-clipboard"
                   style="
                    margin-left: 5px;
                    color: {{(request()->is('artikel*') ? '#0500FE' : '#FFFFFF')}}">
                </i>
                <span style="margin-left: 10px;">Artikel</span>
            </a>
            <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="{{url('/artikel')}}">Daftar Artikel</a>
                    <a class="collapse-item" href="{{url('/artikel/pengajuan')}}">Pengajuan Artikel</a>
                    @if(\Illuminate\Support\Facades\Session::get('role') == '1')
                        <a class="collapse-item" href="{{url('/artikel/review')}}">Review Artikel</a>
                    @elseif(\Illuminate\Support\Facades\Session::get('role') == '4')
                        <a class="collapse-item" href="{{url('/artikel/review')}}">Review Artikel</a>
                    @endif
                </div>
            </div>
        </li>

        @if(\Illuminate\Support\Facades\Session::get('role') == '1')

            <li class="nav-item  {{(request()->is('pengumuman*') ? 'active' : '')}}">
                <a class="nav-link" href="{{url('pengumuman')}}">
                    <i class="fa fa-bullhorn"
                       style="
                            margin-left: 5px;
                            color: {{(request()->is('pengumuman*') ? '#0500FE' : '#FFFFFF')}}">
                    </i>
                    <span style="margin-left: 10px;">Pengumuman</span>
                </a>
            </li>
            <li class="nav-item  {{(request()->is('periode*') ? 'active' : '')}}">
                <a class="nav-link" href="{{url('periode')}}">
                    <i class="fa fa-book" style="color: {{(request()->is('periode*') ? '#0500FE' : '#FFFFFF')}}"></i><span>Periode</span>
                </a>
            </li>
            <li class="nav-item  {{(request()->is('majalah*') ? 'active' : '')}}">
                <a class="nav-link" href="{{url('majalah')}}">
                    <i class="fa fa-database" style="color: {{(request()->is('majalah*') ? '#0500FE' : '#FFFFFF')}}"></i><span>Majalah</span>
                </a>
            </li>

            <li class="nav-item {{(request()->is('akun*') ? 'active' : '')}}">
                <a class="nav-link" href="{{url('akun')}}">
                    <i class="fa fa-users"
                       style="color: {{(request()->is('akun*') ? '#0500FE' : '#FFFFFF')}}">
                    </i>
                    <span>Kelola Akun</span>
                </a>
            </li>

        @endif

        <!-- Divider -->
        <hr class="sidebar-divider d-none d-md-block">

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                    <li class="nav-item dropdown no-arrow d-sm-none">
                        <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-search fa-fw"></i>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                             aria-labelledby="searchDropdown">
                            <form class="form-inline mr-auto w-100 navbar-search">
                                <div class="input-group">
                                    <input type="text" class="form-control bg-light border-0 small"
                                           placeholder="Search for..." aria-label="Search"
                                           aria-describedby="basic-addon2">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button">
                                            <i class="fas fa-search fa-sm"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li>

                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ \Illuminate\Support\Facades\Session::get('nama') }}</span>
                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                             aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Profile
                            </a>
                            <a class="dropdown-item" href="{{url('logout')}}">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>
            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">
                @yield('main-content')
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

        <!-- Footer -->
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Your Website 2020</span>
                </div>
            </div>
        </footer>
        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                <a class="btn btn-primary" href="login.html">Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="{{url('templateResources/vendor/jquery/jquery.min.js')}}"></script>
<script src="{{url('templateResources/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<!-- Core plugin JavaScript-->
<script src="{{url('templateResources/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

<!-- Custom scripts for all pages-->
<script src="{{url('templateResources/js/sb-admin-2.min.js')}}"></script>

<!-- Page level plugins -->
<script src="{{url('templateResources/vendor/chart.js/Chart.min.js')}}"></script>

<!-- Page level custom scripts -->
<script src="{{url('templateResources/js/demo/chart-area-demo.js')}}"></script>
<script src="{{url('templateResources/js/demo/chart-pie-demo.js')}}"></script>
<script src="{{url('templateResources/js/demo/datatables-demo.js')}}"></script>

<!-- Page level plugins -->
<script src="{{url('templateResources/vendor/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{url('templateResources/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

</body>

</html>
