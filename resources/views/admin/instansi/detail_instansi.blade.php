@extends('admin.base')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-12">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Perusahaan</li>
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

                            <h3 class="profile-username text-center">{{ $instansi->nama }}</h3>
                            <ul class="list-group list-group-unbordered mb-3">
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
                                <li class="nav-item"><a class="nav-link" href="#lowongan" data-toggle="tab">Lowongan</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="info">
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <h2 style="font-weight: 600;">{{ $instansi->nama }}</h2>
                                        </div>
                                    </div></br>
                                    <div class="card-body card-primary card-outline table-responsive p-0">
                                        <table class="table no-border">
                                                <tr>
                                                <th>Nama Instansi</th>
                                                <th>Website</th>
                                                <th>No.Telp</th>
                                                </tr>
                                                <tr>
                                                <td>{{ $instansi->nama }}</td>
                                                <td>{{ $instansi->website }}</td>
                                                <td>{{ $instansi->no_hp }}</td>
                                                </tr>
                                        </table><br/>
                                        <strong><i class="fas fa-map-marker-alt mr-1"></i> Alamat</strong>
                                        <p class="text-muted">{{$instansi->alamat}}</p>
                                        <strong><i class="far fa-file-alt mr-1"></i> Deskripsi</strong>
                                        <p class="text-muted">{{$instansi->deskripsi}}</p>
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
                                            <button type="submit" class="btn btn-default">Filter</button> <br><br>
                                        </div>
                                    </form>
                                    <div class="card-primary card-outline">
                                    <div class="card-body table-responsive p-0">
                                        <table class="table no-border">
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Kelompok</th>
                                                    <th>Periode</th>
                                                    <th>Tempat Magang</th>
                                                    <th>Nama Ketua</th>
                                                    <th>Detail Kelompok</th>
                                                </tr>
                                                <tr>
                                                <td>1</td>
                                                <td>Trident</td>
                                                <td>2018</td>
                                                <td>ICON+</td>
                                                <td>Marsekal Rama</td>
                                                <td class="text-center py-0 align-middle">
                                                    <a href="/detailMagang" class="btn-sm btn-info"><i class="fas fa-list-alt"></i></a>
                                                </td>
                                                </tr>
                                        </table><br/>
                                    </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="lowongan">
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
                                            <button type="submit" class="btn btn-default">Filter</button> <br><br>
                                        </div>
                                    </form>
                                    <div class="card-primary card-outline">
                                    <div class="card-body table-responsive p-0">
                                        <table class="table no-border">
                                                <tr>
                                                    <th>No</th>
                                                    <th>Posisi</th>
                                                    <th>Persyaratan</th>
                                                    <th>Slot</th>
                                                    <th>Periode</th>
                                                    <th class="text-center py-0 align-middle">Detail</th>
                                                    <th class="text-center py-0 align-middle">Aksi</th>
                                                </tr>
                                                <tr>
                                                <td>1</td>
                                                <td>{{ $lowongan->posisi }}</td>
                                                <td>{{ $lowongan->persyaratan }}</td>
                                                <td>{{ $lowongan->slot }}</td>
                                                <td>{{ $lowongan->tahun }}</td>   
                                                <td class="text-center py-0 align-middle">
                                                    <a href="{{ route('lowongan.show', $lowongan->id_lowongan) }}" class="btn-sm btn-warning"><i class="fas fa-arrow-right"></i></a>
                                                </td>
                                                <td class="text-center py-0 align-middle">
                                                    <a href="{{ route('lowongan.edit', $lowongan->id_lowongan) }}" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></a>
                                                    <button class="btn btn-sm btn-danger deleteLowongan" data-id="{{ $lowongan->id_lowongan }}" onclick="return confirm('Yakin ingin menghapus data?')"><i class="fas fa-trash"></i></button>
                                                </td>
                                                </tr>
                                        </table><br/>
                                    </div>
                                    </div>
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
  $(document).ready(function(){
        $('.deleteLowongan').click(function(){
            var id = $(this).data('id');
            $.ajax({
                type: "DELETE",
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                dataType: "json",
                url: '/api/admin/lowongan/'+id,
                data: {'id_lowongan': id,},
                success: function (data) {
                    toastr.options.closeButton = true;
                    toastr.options.closeMethod = 'fadeOut';
                    toastr.options.closeDuration = 100;
                    toastr.success(data.message);
                    window.location.reload();
                }
            });
        });
    });
</script>
@endsection