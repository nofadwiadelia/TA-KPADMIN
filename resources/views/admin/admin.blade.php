@extends('admin.base')
@section('content')
<!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h4 class="m-0 text-dark">Dashboard</h4>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
		<div class="row">
			<div class="col-md-12 text-center">
              @if (!empty($periode))
                <p><h2>Periode PKL <strong>{{$periode->tahun_periode}}</strong></h2><i class="text-muted">{{$date}}</i></p>
              @else
                <p><h2>Periode KP <strong>tidak aktif</strong></h2></p>
              @endif
                    <div class="row justify-content-center">
                        <div class="col-md-6 col-md-offset-3 text-center">
                            <div class="alert alert-success alert-dismissible">
                            @if (!empty($periode))
                              <i class="icon fas fa-calendar"></i> Saat ini adalah periode KP.
                              <h3><b>{{Carbon\Carbon::parse($periode->tgl_mulai)->translatedFormat('d F Y')}}</b> - <b>{{Carbon\Carbon::parse($periode->tgl_selesai)->translatedFormat('d F Y')}}</b></h3>
                            @else
                            <i class="icon fas fa-calendar"></i> Saat ini tidak ada periode KP yang aktif .
                            @endif
                            </div>
                        </div>
                    </div>
					<div class="row">
                        <div class="col-md-12">
                            <center><a href="/admin/periode" class="btn bg-blue"><i class="fa fa-edit"></i> Setting Periode PKL</a></center>
                        </div>
                    </div>
                    <br>
			</div>
		</div>
        <div class="row justify-content-center">
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info"> 
                <div class="inner" id="kelompokcount">
                  <!-- <h3 id="kelompokcount"><sup style="font-size: 20px"> Kelompok</sup></h3>
                  <p>Pendaftar yang masuk</p> -->
                </div>
                <div class="icon">
                  <i class="ion ion-clipboard"></i>
                </div>
                <a href="https://pklkomsi.000webhostapp.com/admin/pendaftaran/pendaftaranListing" class="small-box-footer">Cek List Pendaftaran (Daftar) <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>5<sup style="font-size: 20px"> Kelompok</sup></h3>
                  <p>Status sedang <b>Magang</b></p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="https://pklkomsi.000webhostapp.com/admin/pendaftaran/pendaftaranMagangListing" class="small-box-footer">Cek List Kelompok (Magang) <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner" id="usulancount">
                  
                </div>
                <div class="icon">
                  <i class="ion ion-chatbubbles"></i>
                </div>
                <a href="/admin/usulan" class="small-box-footer">Cek Usulan <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
          </div>
    </section>
    <!-- /.content -->
@endsection

@section('scripts')
<!-- DataTables -->
<script src="../../plugins/datatables/jquery.dataTables.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- page script -->
<script>
  
  $(document).ready(function(){

    $.ajax({
      type: 'GET',
      url: '/api/admin/kelompokcount/',
      dataType: 'JSON',
      success: function (response) {
        var kel = "<h3>"+response.kelompok+"<sup style='font-size: 20px'>Kelompok</sup></h3>"+
        "<p>Pendaftar yang masuk</p>";
        $("#kelompokcount").append(kel);
      }
    });

    $.ajax({
      type: 'GET',
      url: '/api/admin/usulancount/',
      dataType: 'JSON',
      success: function (response) {
        var usulans = "<h3>"+response.usulan+"</h3>"+
        "<p>Usulan yang masuk</p>";
        $("#usulancount").append(usulans);
      }
    });
  });
</script>
@endsection