<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{!! $konfig->judul_web !!} | Dashboard</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8" name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{$konfig->favicon}}" rel="icon" width="40px">

    <link rel="stylesheet" href="/css/app.css">

</head>

<body class="hold-transition sidebar-mini">
    <!-- Site wrapper -->
    <div class="wrapper" id="app">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
                    <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">


                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fa fa-wrench"></i> Pengaturan
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <router-link to="/profil" class="dropdown-item">
                          <i class="fa fa-user"></i> Profil
                        </router-link>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item" onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();">
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </div>

                </li>
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4" style="width: 300px !importan;">

            <a href="/dashboard" class="brand-link">
                <img src="/img/logo.jpg" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light">Aerotek</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="/img/user.png" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block">{{ Auth()->user()->name }}</a>
                        {{-- <a href="" class="d-block">{{ $user->akses }} - {{ $user->nama_wilayah}}</a> --}}
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                        <li class="nav-item">
                            <router-link to="/admin/dashboard" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    Dashboard
                                    <span class="right badge badge-danger">New</span>
                                </p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/admin/halaman" class="nav-link">
                                <i class="nav-icon fas fa-file"></i>
                                <p>
                                    Halaman
                                </p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/admin/produk" class="nav-link">
                                <i class="nav-icon fas fa-database"></i>
                                <p>
                                    Produk
                                </p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/admin/galeri" class="nav-link">
                                <i class="nav-icon fas fa-images"></i>
                                <p>
                                    Galeri
                                </p>
                            </router-link>
                        </li>
                        <li class="nav-item">
                            <router-link to="/admin/pengaturan" class="nav-link">
                                <i class="nav-icon fas fa-wrench"></i>
                                <p>
                                    Pengaturan Website
                                </p>
                            </router-link>
                        </li>

                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page Aerotekheader) -->
            <router-view></router-view>
            <vue-progress-bar></vue-progress-bar>
        </div>
        <!-- /.content-wrapper -->

        <footer class="main-footer">

            <a href="https://sindujateng.id">{{$konfig->footer}}</a> <strong>Copyright &copy; 2019</strong>
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->


    <script type="text/javascript" src="/js/app.js"></script>


</body>

</html>
