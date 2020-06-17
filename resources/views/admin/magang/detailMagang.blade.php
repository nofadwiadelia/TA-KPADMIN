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
                <h4>Kelompok {{$kelompok->nama_kelompok}}</h4><br>
                <div class="row">
                  <div class="col-2"><b>Dosen Pembimbing</b></div>
                  <div class="col-3">: {{$kelompok->nama}}</div>
                </div>
                <div class="row">
                  <div class="col-2"><b>Tempat Magang</b></div>
                  @if (!empty($magang->instansi_nama))
                  <div class="col-3">: {{$magang->instansi_nama}}</div>
                  @else
                  <div class="col-3">: </div>
                  @endif
                </div>
                <div class="row">
                  <div class="col-2"><b>Waktu Magang</b>
                  </div>
                  @if (!empty($magang->tanggal_mulai) && ($magang->tanggal_selesai))
                  <div class="col-3">: {{$magang->tanggal_mulai}} - {{$magang->tanggal_selesai}}</div>
                  @else
                  <div class="col-3">: - </div>
                  @endif
                </div>
                <div class="row">
                  <div class="col-2"><b>Lokasi Magang</b>
                  </div>
                  @if (!empty($magang->alamat))
                  <div class="col-3">: {{$magang->alamat}}</div>
                  @else
                  <div class="col-3">: </div>
                  @endif
                </div>
                <div class="row">
                  <div class="col-2"><b>Jobdesk</b>
                  </div>
                  @if (!empty($magang->jobdesk))
                  <div class="col-3">: {{$magang->jobdesk}}</div>
                  @else
                  <div class="col-3">: </div>
                  @endif
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
                    <td>{{$kel->status_keanggotaan}}</td>
                    <td class="text-center py-0 align-middle">
                        <div class="btn-group btn-group-sm">
                          <a href="/admin/mahasiswa/{{$kel->id_mahasiswa}}/{{$kel->id_kelompok}}" class="btn btn-info"><i class="fas fa-eye"></i></a>
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
</script>
@endsection