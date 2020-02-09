@extends('welcome')
@section('content')
<!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0 text-dark">Manajemen Lowongan</h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Mahasiswa</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body ">
                <div class="col-sm-12">
                  <a href="/add_lowongan" class="btn btn-success float-right btn-sm"><i class="fas fa-plus"></i> Tambah Lowongan</a> <br><br>
                </div>
              <table id="example1" class="table table-bordered table-striped ">
                <thead>
                <tr>
                  <th>Nama Lowongan</th>
                  <th>Detail Info</th>
                  <th>Batas Maksimal</th>
                  <th>Instansi</th>
                  <th>Status</th>
                  <th>Pesetujuan</th>
                  <th>Detail</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>Trident</td>
                  <td>1</td>
                  <td>Trident</td>
                  <td>Win 95+</td>
                  <td class="text-center py-0 align-middle"><span class="badge bg-warning">Process</span></td>
                  <td class="text-center py-0 align-middle">
                      <a href="#" class="btn-sm btn-info"><i class="fas fa-check"></i></a>
                      <a href="#" class="btn-sm btn-danger"><i class="fas fa-times"></i></a>
                  </td>
                  <td class="text-center py-0 align-middle">
                    <a href="#" class="btn-sm btn-info"><i class="fas fa-pencil-alt"></i></a>
                    <a href="#" class="btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                  </td>
                </tr>
                <tr>
                  <td>Trident</td>
                  <td>2
                  </td>
                  <td>Trident</td>
                  <td>Win 95+</td>
                  <td class="text-center py-0 align-middle"><span class="badge bg-warning">Process</span></td>
                  <td class="text-center py-0 align-middle">
                      <a href="#" class="btn-sm btn-info"><i class="fas fa-check"></i></a>
                      <a href="#" class="btn-sm btn-danger"><i class="fas fa-times"></i></a>
                    </td>
                  <td class="text-center py-0 align-middle">
                    <a href="#" class="btn-sm btn-info"><i class="fas fa-pencil-alt"></i></a>
                    <a href="#" class="btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                  </td>
                </tr>
                <tr>
                  <td>Trident</td>
                  <td>2
                  </td>
                  <td>Trident</td>
                  <td>Win 95+</td>
                  <td class="text-center py-0 align-middle"><span class="badge bg-warning">Process</span></td>
                  <td class="text-center py-0 align-middle">
                      <a href="#" class="btn-sm btn-info"><i class="fas fa-check"></i></a>
                      <a href="#" class="btn-sm btn-danger"><i class="fas fa-times"></i></a>
                    </td>
                  <td class="text-center py-0 align-middle">
                    <a href="#" class="btn-sm btn-info"><i class="fas fa-pencil-alt"></i></a>
                    <a href="#" class="btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                  </td>
                </tr>
                <tr>
                  <td>Trident</td>
                  <td>3
                  </td>
                  <td>Trident</td>
                  <td>Win 98+</td>
                  <td class="text-center py-0 align-middle"><span class="badge bg-warning">Process</span></td>
                  <td class="text-center py-0 align-middle">
                      <a href="#" class="btn-sm btn-info"><i class="fas fa-check"></i></a>
                      <a href="#" class="btn-sm btn-danger"><i class="fas fa-times"></i></a>
                    </td>
                  <td class="text-center py-0 align-middle">
                    <a href="#" class="btn-sm btn-info"><i class="fas fa-pencil-alt"></i></a>
                    <a href="#" class="btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                  </td>
                </tr>
                <tr>
                  <td>Trident</td>
                  <td>3</td>
                  <td>Trident</td>
                  <td>Win XP SP2+</td>
                  <td class="text-center py-0 align-middle"><span class="badge bg-warning">Process</span></td>
                  <td class="text-center py-0 align-middle">
                      <a href="#" class="btn-sm btn-info"><i class="fas fa-check"></i></a>
                      <a href="#" class="btn-sm btn-danger"><i class="fas fa-times"></i></a>
                    </td>
                  <td class="text-center py-0 align-middle">
                    <a href="#" class="btn-sm btn-info"><i class="fas fa-pencil-alt"></i></a>
                    <a href="#" class="btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                  </td>
                </tr>
                <tr>
                  <td>Trident</td>
                  <td>2</td>
                  <td>Trident</td>
                  <td>Win XP</td>
                  <td class="text-center py-0 align-middle"><span class="badge bg-warning">Process</span></td>
                  <td class="text-center py-0 align-middle">
                      <a href="#" class="btn-sm btn-info"><i class="fas fa-check"></i></a>
                      <a href="#" class="btn-sm btn-danger"><i class="fas fa-times"></i></a>
                    </td>
                  <td class="text-center py-0 align-middle">
                    <a href="#" class="btn-sm btn-info"><i class="fas fa-pencil-alt"></i></a>
                    <a href="#" class="btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                  </td>
                </tr>
                <tr>
                  <td>Gecko</td>
                  <td>3</td>
                  <td>Trident</td>
                  <td>Win 98+ / OSX.2+</td>
                  <td class="text-center py-0 align-middle"><span class="badge bg-warning">Process</span></td>
                  <td class="text-center py-0 align-middle">
                      <a href="#" class="btn-sm btn-info"><i class="fas fa-check"></i></a>
                      <a href="#" class="btn-sm btn-danger"><i class="fas fa-times"></i></a>
                    </td>
                  <td class="text-center py-0 align-middle">
                    <a href="#" class="btn-sm btn-info"><i class="fas fa-pencil-alt"></i></a>
                    <a href="#" class="btn-sm btn-danger"><i class="fas fa-trash"></i></a>                  
                    </td>
                </tr>
                <tr>
                  <td>Gecko</td>
                  <td>2</td>
                  <td>Trident</td>
                  <td>Win 98+ / OSX.2+</td>
                  <td class="text-center py-0 align-middle"><span class="badge bg-warning">Process</span></td>
                  <td class="text-center py-0 align-middle">
                      <a href="#" class="btn-sm btn-info"><i class="fas fa-check"></i></a>
                      <a href="#" class="btn-sm btn-danger"><i class="fas fa-times"></i></a>
                    </td>
                  <td class="text-center py-0 align-middle">
                    <a href="#" class="btn-sm btn-info"><i class="fas fa-pencil-alt"></i></a>
                    <a href="#" class="btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                  </td>
                </tr>
                <tr>
                  <td>Gecko</td>
                  <td>3</td>
                  <td>Trident</td>
                  <td>Win 98+ / OSX.2+</td>
                  <td class="text-center py-0 align-middle"><span class="badge bg-warning">Process</span></td>
                  <td class="text-center py-0 align-middle">
                      <a href="#" class="btn-sm btn-info"><i class="fas fa-check"></i></a>
                      <a href="#" class="btn-sm btn-danger"><i class="fas fa-times"></i></a>
                    </td>
                  <td class="text-center py-0 align-middle">
                    <a href="#" class="btn-sm btn-info"><i class="fas fa-pencil-alt"></i></a>
                    <a href="#" class="btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                  </td>
                </tr>
                <tr>
                  <td>Gecko</td>
                  <td>3</td>
                  <td>Trident</td>
                  <td>Win 2k+ / OSX.3+</td>
                  <td class="text-center py-0 align-middle"><span class="badge bg-warning">Process</span></td>
                  <td class="text-center py-0 align-middle">
                      <a href="#" class="btn-sm btn-info"><i class="fas fa-check"></i></a>
                      <a href="#" class="btn-sm btn-danger"><i class="fas fa-times"></i></a>
                    </td>
                  <td class="text-center py-0 align-middle">
                    <a href="#" class="btn-sm btn-info"><i class="fas fa-pencil-alt"></i></a>
                    <a href="#" class="btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                  </td>
                </tr>
                <tr>
                  <td>Gecko</td>
                  <td>3</td>
                  <td>Trident</td>
                  <td>OSX.2+</td>
                  <td class="text-center py-0 align-middle"><span class="badge bg-warning">Process</span></td>
                  <td class="text-center py-0 align-middle">
                      <a href="#" class="btn-sm btn-info"><i class="fas fa-check"></i></a>
                      <a href="#" class="btn-sm btn-danger"><i class="fas fa-times"></i></a>
                    </td>
                  <td class="text-center py-0 align-middle">
                    <a href="#" class="btn-sm btn-info"><i class="fas fa-pencil-alt"></i></a>
                    <a href="#" class="btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                  </td>
                </tr>
                <tr>
                  <td>Gecko</td>
                  <td>2</td>
                  <td>Trident</td>
                  <td>OSX.2+</td>
                  <td class="text-center py-0 align-middle"><span class="badge bg-warning">Process</span></td>
                  <td class="text-center py-0 align-middle">
                      <a href="#" class="btn-sm btn-info"><i class="fas fa-check"></i></a>
                      <a href="#" class="btn-sm btn-danger"><i class="fas fa-times"></i></a>
                    </td>
                  <td class="text-center py-0 align-middle">
                    <a href="#" class="btn-sm btn-info"><i class="fas fa-pencil-alt"></i></a>
                    <a href="#" class="btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                  </td>
                </tr>
                </tbody>
              </table>
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