@extends('admin.base')
@section('content')
<!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-12">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Kelompok</li>
                <li class="breadcrumb-item active">Detail Magang</li>
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
                <h4>Kelompok ASIK</h4><br>
                <div class="row">
                  <div class="col-2"><b>Dosen Pembimbing</b></div>
                  <div class="col-3">: Imam Fakhrurrozi, M.Cs</div>
                </div>
                <div class="row">
                  <div class="col-2"><b>Tempat Magang</b>
                  </div>
                  <div class="col-3">: PT. GMF AeroAsia Tbk
                  </div>
                </div>
                <div class="row">
                  <div class="col-2"><b>Waktu Magang</b>
                  </div>
                  <div class="col-3">: 24 Juni 2019 - 10 Agustus 2019</div>
                </div>
                <div class="row">
                  <div class="col-2"><b>Lokasi Magang</b>
                  </div>
                  <div class="col-3">: 24 Juni 2019 - 10 Agustus 2019</div>
                </div>
                <div class="row">
                  <div class="col-2"><b>Jobdesk</b>
                  </div>
                  <div class="col-3">: 24 Juni 2019 - 10 Agustus 2019</div>
                </div>

                <br>
              <div class="table-responsive p-0">
                <table class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>NIM</th>
                    <th>Nama Mahasiswa</th>
                    <th>No.HP</th>
                    <th>Status</th>
                    <th>Detail</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($kelompoks as $kel)
                  <tr>
                    <td>{{$kel->nim}}</td>
                    <td>{{$kel->nama}}
                    </td>
                    <td>{{$kel->no_hp}}</td>
                    <td>{{$kel->status}}</td>
                    <td class="text-center py-0 align-middle">
                        <div class="btn-group btn-group-sm">
                          <a href="#" class="btn btn-info"><i class="fas fa-eye"></i></a>
                        </div>
                      </td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
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
    $("#example1").DataTable();
  });
</script>
@endsection