@extends('mahasiswa.base')
@section('content')
   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>Lowongan</h4>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a>Mahasiswa</a></li>
              <li class="breadcrumb-item active">Lowongan</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3">

                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                src="../../dist/img/user4-128x128.jpg"
                                alt="User profile picture">
                            </div>

                            <div class="proyek-title text-center"><h4>PT.KAI</h4> 
                            <p class="text-center"><i class="fa fa-map-marker" style="color: #de0000""></i>Bandung Jawa Barat</p>
                            <ul class="list-group list-group-unbordered mb-3">
                            <p><span class="badge badge-danger">Slot Habis</span></p>
                            <p><span class="breadcrumb-item active">0 slot Tersisa</span></p>
                            </div>
                            
                            <a href="/applylowongan" type="button" class="btn btn-block btn-primary btn-lg">Daftar</a>
                        </div>
                        <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>

                    <div class="col-md-3">

                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                src="../../dist/img/user4-128x128.jpg"
                                alt="User profile picture">
                            </div>

                            <div class="proyek-title text-center"><h4>BCA</h4> 
                            <p class="text-center"><i class="fa fa-map-marker" style="color: #de0000""></i>Jakarta Pusat, DKI Jakarta</p>
                            <ul class="list-group list-group-unbordered mb-3">
                            <p><span class="badge badge-success">Slot Tersedia</span></p>
                            <p><span class="breadcrumb-item active">3 slot Tersisa</span></p>
                            </div>
                            <a href="/applylowongan" type="button" class="btn btn-block btn-primary btn-lg">Daftar</a>
                        </div>
                        <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                        <!-- /.card-body -->
                       
                        <!-- /.card -->
                    </div>
    </section>

    
@endsection