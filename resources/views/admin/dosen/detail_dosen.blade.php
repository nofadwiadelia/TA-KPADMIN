@extends('admin.base')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-12">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dosen</li>
                <li class="breadcrumb-item active">Detail</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
                <!-- Main content -->
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

                            <h3 class="profile-username text-center">{{ $dosen->nama }}</h3>
                            <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>NIP  </b> <a class="float-right">{{ $dosen->nip }}</a>
                            </li>
                            <li class="list-group-item">
                                <i class="nav-icon fas fa-users"></i> <a class="float-right">{{ $role->roles }}</a>
                            </li>
                        </div>
                        <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#info" data-toggle="tab">Info</a></li>
                                <li class="nav-item"><a class="nav-link" href="#bimbingan" data-toggle="tab">Bimbingan</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="info">
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <h2 style="font-weight: 600;">{{ $dosen->nama }}</h2>
                                        </div>
                                    </div></br>
                                    <div class="card-body card-primary card-outline table-responsive p-0">
                                        <table class="table no-border">
                                                <tr>
                                                <th>NIP</th>
                                                <th>Nama</th>
                                                <th>No.HP</th>
                                                <th>Email</th>
                                                </tr>
                                                <tr>
                                                <td>{{$dosen->nip}}</td>
                                                <td>{{$dosen->nama}}</td>
                                                <td>{{$dosen->no_hp}}</td>
                                                <td>{{$dosen->email}}</td>
                                                </tr>
                                        </table><br/>
                                        </div>
                                </div>
                                <div class="tab-pane" id="bimbingan">
                                <form role="form">
                                        <div class="col-sm-4">
                                            <!-- select -->
                                            <div class="form-group">
                                                <select class="form-control form-control-sm">
                                                    @foreach($periode as $periodes)
                                                        <option value="{{ $periodes->id_periode }}">{{ $periodes->tahun_periode }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </form><br>
                                    <div class="card-primary">
                                        <div class="table-responsive p-0">
                                            <table id="kelompok_data" class="table table-bordered table-striped">
                                                <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Kelompok</th>
                                                    <th>Periode</th>
                                                    <th>Tempat Magang</th>
                                                    <th>Nama Ketua</th>
                                                    <th>Detail</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php $no = 1; @endphp
                                                @foreach($kelompok as $kel)
                                                <tr>
                                                <td>{{$no++}}</td>
                                                <td>{{$kel->nama_kelompok}}</td>
                                                <td>{{$kel->tahun_periode}}</td>
                                                <td>{{$kel->tahun_periode}}</td>
                                                <td>{{$kel->nama}}</td>
                                                <td><a href="/admin/kelompok" class="btn-sm btn-info"><i class="fas fa-list-alt"></i></a></td>
                                                </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        <div>
                                    <div>
                                </div>
                                <!-- /.tab-pane -->

                            <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                        </div>
                        <!-- /.nav-tabs-custom -->
                    </div>
                    <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
                </section>
                <!-- /.content -->
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
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
    $("#kelompok_data").DataTable();
  });
</script>
@endsection