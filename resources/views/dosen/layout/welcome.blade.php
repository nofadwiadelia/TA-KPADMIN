<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Komsi PKL</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
   <!-- DataTables -->
   <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">

 <!-- Left navbar links -->
 <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
          </li>
        </ul>
         <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">    
            <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
            </button>
        </div>
      </div>
    </form>
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i><img src="dist/img/user1-128x128.jpg" alt="User Avatar" style="width:25px" class="mr-3 img-circle"></i>
          <span class="namaProfile">{{ Auth::user()->nama_lengkap }}</span>
        </a>
        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
          <a onclick="if(confirm('Are you sure to logout?')) location.href='{{ URL::to('admin/login') }}';" class="dropdown-item">
            <div class="media">
              <div class="media-body">
                <h3 class="dropdown-item-title">
                  LOGOUT
                </h3>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                  @csrf
                </form>
              </div>
            </div>
          </a>
        </div>
      </li>
    </ul>
      
      <!-- Notifications Dropdown Menu -->
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
      <span class="brand-text font-weight-light">Komsi PKL</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block namaProfile">{{ Auth::user()->nama_lengkap }} </a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">
            <a href="/dosen/dashboard" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="/dosen/profile" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>Profile</p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="/dosen/kelompok" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>Daftar Kelompok</p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="/dosen/list_kegiatanHarian" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>Buku Harian </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Input Nilai
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/dosen/input_nilai" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dosen Pembimbing</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/dosen/inputNilai_penguji" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dosen Penguji</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-envelope"></i>
              <p>
                Mahasiswa
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="/dosen/daftar_nilaiAkhir" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Nilai Akhir</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="/dosen/laporan" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Laporan PKL</p>
                </a>
              </li>
            </ul>
          </li>

      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  @yield('content')
  </div>
    
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
@yield('scripts')

</body>
</html>
