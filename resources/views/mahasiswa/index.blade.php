@extends('mahasiswa.base')
@section('content')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>Dashboard</h4>
          </div>
            
          <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a>Mahasiswa</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
              </ol>
           </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
		<div class="row">
			<div class="col-md-12 text-center">
                <p><h2>Periode PKL <strong>2019</strong></h2><i class="text-muted">4 December 2019</i></p>
                    <div class="row justify-content-center">
                        <div class="col-md-8 col-md-offset-3 text-center">
                            <div class="alert alert-success alert-dismissible">
                                <i class="icon fas fa-calendar"></i> Saat ini adalah periode PKL.
                                <h3><b>2 December 2019</b> - <b>9 December 2019</b></h3>
                            </div>
                        </div>
                    </div>
				
                    <br>
			</div>
		</div>


    <div class="row justify-content-center">
            <div class="col-md-4 col-md-offset-4">
			        <div class="small-box bg-info">
                <div class="inner">
                  <h3>3<sup style="font-size: 20px"> Mahasiswa</sup></h3>
                  <p>Dalam kelompok <b>Anda</b></p>
                </div>
                <div class="icon">
                  <i class="ion ion-stats-bars"></i>
                </div>
                <a href="/buatkelompok" class="small-box-footer">Cek List Kelompok PKL <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
						<div class="col-md-4 col-md-offset-4">
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>diterima</h3>
                  <p>Status <b>Usulan</b></p>
                </div>
                <div class="icon">
                  <i class="ion ion-clipboard"></i>
                </div>
                <a href="/dataperusahaan" class="small-box-footer">Cek Usulan Anda <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
			</div>
    </section>
@endsection