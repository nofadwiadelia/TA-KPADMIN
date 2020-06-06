<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Komsi</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Font Awesome
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css"> -->
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('/dist/css/adminlte.min.css') }}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('/plugins/datatables-bs4/css/dataTables.bootstrap4.css') }}">
  <!-- daterange picker -->
  <link rel="stylesheet" href="{{ asset('/plugins/daterangepicker/daterangepicker.css') }}">

  <!-- Switchery -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.css">
  <!-- Toast -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  
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
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i id="avatar">
          <!-- <img src="{{ asset('dist/img/user4-128x128.jpg') }}" alt="User Avatar" style="width:25px" class="mr-3 img-circle"> -->
          </i>
          <span id="username"></span>
          
        </a>
        <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
        
        <!-- <a class="dropdown-item" href="{{ route('logout') }}">
                      {{ __('Logout') }} -->
        <a class="dropdown-item" href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                      {{ __('Logout') }}
                  </a>
        
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                  </form>
       
        </div>
      </li>
    </ul>
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
        <div class="image" id="avatar1">
          <!-- <img src="{{ asset('/uploads/users/admin/admin-utama1590507191.jpg') }}" class="img-circle elevation-2" alt="User Image"> -->
        </div>
        <div class="info">
          <a href="#" class="d-block" id="usernames"></a>
         
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
                with font-awesome or any other icon font library -->
            <li class="nav-item ">
              <a href="/admin" class="nav-link ">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Dashboard
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/pengumuman" class="nav-link">
                <i class="nav-icon fas fa-edit"></i>
                <p>
                  Pengumuman
                </p>
              </a>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-user"></i>
                <p>
                  Daftar User
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/admin/daftaradmin" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Admin</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('mahasiswa.index')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Mahasiswa</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('dosen.index')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Dosen</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('instansi.index')}}" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Instansi</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview">
              <a href="/admin/users" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  Akun User
                </p>
              </a>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-check"></i>
                <p>
                  Persetujuan
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/admin/persetujuan_kelompok" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Pendaftaran Kelompok</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/admin/usulan" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Usulan PKL</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-users"></i>
                <p>
                  Kelompok
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/admin/kelompok" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Magang</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="/admin/presentasi" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Presentasi</p>
                  </a>
                </li>
              </ul>
            </li>
            <li class="nav-item">
              <a href="/admin/periode" class="nav-link">
                <i class="nav-icon far fa-clock"></i>
                <p>
                  Setting Periode PKL
                </p>
              </a>
            </li>
            <li class="nav-item has-treeview">
              <a href="{{route('lowongan.index')}}" class="nav-link">
                <i class="nav-icon fas fa-table"></i>
                <p>
                  Lowongan
                </p>
              </a>
            </li>
            <li class="nav-item has-treeview">
              <a href="#" class="nav-link">
                <i class="nav-icon fas fa-list"></i>
                <p>
                  Data Master
                  <i class="fas fa-angle-left right"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="/admin/roles" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Role</p>
                  </a>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item has-treeview">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>
                      Presentasi
                      <i class="fas fa-angle-left right"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="/admin/sesi" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Sesi</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="/admin/ruang" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Ruang</p>
                      </a>
                    </li>
                  </ul>
                </li>
              </ul>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Nilai</p>
                    <i class="fas fa-angle-left right"></i>
                  </a>
                  <ul class="nav nav-treeview">
                    <li class="nav-item">
                      <a href="/admin/aspekpenilaian" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Aspek</p>
                      </a>
                    </li>
                    <li class="nav-item">
                      <a href="/admin/kelompokpenilai" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Penilai</p>
                      </a>
                    </li>
                  </ul>
                </li>
              </ul>
            </li>
          </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
  @yield('content') {{-- Semua file konten di bagian ini --}}
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <strong >Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Komsi</b> PKL
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>

<!-- jQuery -->
<script src="{{ asset('/plugins/jquery/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('/dist/js/demo.js') }}"></script>
<!-- bs-custom-file-input -->
<script src="{{ asset('/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>
<script type="text/javascript">
$(document).ready(function () {
  bsCustomFileInput.init();
});
</script>

<!-- Toast -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script>
  
  $(document).ready(function(){

    $.ajax({
      type: 'GET',
      url: '/api/admin/userlogin',
      dataType: 'JSON',
      headers: {
          Authorization : 'Bearer {{Auth::user()->api_token}}',
      },
      success: function (response) {
        var user = response.user.admin.nama;
        $("#username").append(user);
        $("#usernames").append(user);
        var kel = "<img src={{ URL::to('/') }}/uploads/users/admin/" + response.user.admin.foto + " width='25px' height='25px' class='mr-3 img-circle' />";
        $("#avatar").append(kel);

        var foto = response.user.admin.foto;
        if(foto == 'null'){
          var kel2 = "<img src={{ URL::to('/') }}/dist/img/default-avatar/default-avatar.png class='img-circle elevation-2' />";
          $("#avatar1").append(kel2);
          // var kel1 = "<img src={{ URL::to('/') }}/uploads/users/admin/" + foto + " class='img-circle elevation-2' />";
          // $("#avatar1").append(kel1);
        }else{
          var kel1 = "<img src={{ URL::to('/') }}/uploads/users/admin/" + foto + " class='img-circle elevation-2' />";
          $("#avatar1").append(kel1);
          // var kel2 = "<img src={{ URL::to('/') }}/dist/img/default-avatar/default-avatar.png class='img-circle elevation-2' />";
          // $("#avatar1").append(kel2);
        }
        
      }
    });
  });

</script>

@yield('scripts')

</body>
</html>
