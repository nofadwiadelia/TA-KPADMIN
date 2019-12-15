@extends('welcome')
@section('content')
<!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            <i class="fas fa-tachometer" aria-hidden="true"></i> Dashboard
        </h1>
    </section>
    <section class="content">
		<div class="row">
			<div class="col-md-12 text-center">
                <p><h2>Periode PKL <strong>2019</strong></h2><i class="text-muted">4 December 2019</i></p>
                    <div class="row justify-content-center">
                        <div class="col-md-6 col-md-offset-3 text-center">
                            <div class="alert alert-success alert-dismissible">
                                <i class="icon fas fa-calendar"></i> Saat ini adalah periode PKL.
                                <h3><b>2 December 2019</b> - <b>9 December 2019</b></h3>
                            </div>
                        </div>
                    </div>
					<div class="row">
                        <div class="col-md-12">
                            <center><a href="https://pklkomsi.000webhostapp.com/admin/periode/periodeListing" class="btn bg-blue"><i class="fa fa-edit"></i> Setting Periode PKL</a></center>
                        </div>
                    </div>
                    <br>
			</div>
		</div>
        <div class="row">
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>0 <sup style="font-size: 20px"> Kelompok</sup></h3>
                  <p>Pendaftar yang masuk</p>
                </div>
                <div class="icon">
                  <i class="ion ion-clipboard"></i>
                </div>
                <a href="https://pklkomsi.000webhostapp.com/admin/pendaftaran/pendaftaranListing" class="small-box-footer">Cek List Pendaftaran (Daftar) <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-green">
                <div class="inner">
                  <h3>5<sup style="font-size: 20px"> Kelompok</sup></h3>
                  <p>Status sedang <b>Magang</b></p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="https://pklkomsi.000webhostapp.com/admin/pendaftaran/pendaftaranMagangListing" class="small-box-footer">Cek List Pendaftaran (Magang) <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
			            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3>32</h3>
                  <p>Total User saat ini</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="https://pklkomsi.000webhostapp.com/admin/user/userListing" class="small-box-footer">Buat Akun Pengguna <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
			            <div class="col-lg-3 col-6">
              <!-- small box -->
              <div class="small-box bg-red">
                <div class="inner">
                  <h3>1</h3>
                  <p>Usulan yang masuk</p>
                </div>
                <div class="icon">
                  <i class="ion ion-chatbubbles"></i>
                </div>
                <a href="https://pklkomsi.000webhostapp.com/admin/usulan/usulanListing" class="small-box-footer">Cek Usulan <i class="fa fa-arrow-circle-right"></i></a>
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
  $(function () {
    $("#example1").DataTable();
  });
</script>
@endsection