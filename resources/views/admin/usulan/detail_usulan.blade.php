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
                <li class="breadcrumb-item active">Persetujuan</li>
                <li class="breadcrumb-item active">Usulan</li>
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
            <div class="card-header">
              <h3 class="card-title">Detail Usulan</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="card-primary">
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
              <br>
              <p>Usulan</p>
              <div class="card-primary card-outline">
                <div class="card-body table-responsive p-0">
                    <table class="table no-border">
                            <tr>
                                <th>No</th>
                                <th>Tempat Magang</th>
                                <th>Alamat</th>
                                <th>Website</th>
                                <th>Surat Keterangan</th>
                                <th>Keterangan Jobdesk</th>
                                <th>Terima</th>
                            </tr>
                            @foreach($usulan as $usulans)
                            <tr>
                              <td>1</td>
                              <td>{{$usulans->nama_instansi}}</td>
                              <td>{{$usulans->alamat_instansi}}</td>
                              <td>{{$usulans->website_instansi}}</td>
                              <td>{{$usulans->surat}}</td>
                              <td>{{$usulans->jobdesk}}</td>
                              <td class="text-center py-0 align-middle">
                              <div class="form-check">
                                <input class="form-check-input" type="radio" name="blankRadio" id="blankRadio1" value="option1" aria-label="...">
                              </div>
                              </td>
                            </tr>
                            @endforeach
                    </table><br/>
                    <div class="d-flex flex-row justify-content-end">
                          <span class="mr-2">
                          <input type="submit" class="btn btn-danger" value="Cancel" />
                          </span>
                          <span>
                          <input type="submit" class="btn btn-primary" value="Submit" />
                          </span>
                      </div>
                </div>
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