@extends('welcome')
@section('content')
<!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
    </section>
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data Kelompok PKL</h3>
            </div>
            <div class="card-body ">
              <table id="example1" class="table table-bordered table-striped ">
                <thead>
                <tr>
                  <th>Nama Kelompok</th>
                  <th>Anggota</th>
                  <th>Dosen Pembimbing</th>
                  <th>Status</th>
                  <th>Pesetujuan</th>
                  <th>Detail</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>Trident</td>
                  <td>1
                  </td>
                  <td>Win 95+</td>
                  <td class="text-center py-0 align-middle"><span class="badge bg-warning">Process</span></td>
                  <td class="text-center py-0 align-middle">
                      <a href="#" class="btn-sm btn-info"><i class="fas fa-check"></i></a>
                      <a href="#" class="btn-sm btn-danger"><i class="fas fa-times"></i></a>
                    </td>
                  <td class="text-center py-0 align-middle">
                    <a href="/detailKelompok" class="btn-sm btn-info"><i class="fas fa-list-alt"></i></a>
                  </td>
                </tr>
                <tr>
                  <td>Trident</td>
                  <td>2
                  </td>
                  <td>Win 95+</td>
                  <td class="text-center py-0 align-middle"><span class="badge bg-warning">Process</span></td>
                  <td class="text-center py-0 align-middle">
                      <a href="#" class="btn-sm btn-info"><i class="fas fa-check"></i></a>
                      <a href="#" class="btn-sm btn-danger"><i class="fas fa-times"></i></a>
                    </td>
                  <td class="text-center py-0 align-middle">
                    <a href="/detailKelompok" class="btn-sm btn-info"><i class="fas fa-list-alt"></i></a>
                  </td>
                </tr>
                <tr>
                  <td>Trident</td>
                  <td>2
                  </td>
                  <td>Win 95+</td>
                  <td class="text-center py-0 align-middle"><span class="badge bg-warning">Process</span></td>
                  <td class="text-center py-0 align-middle">
                      <a href="#" class="btn-sm btn-info"><i class="fas fa-check"></i></a>
                      <a href="#" class="btn-sm btn-danger"><i class="fas fa-times"></i></a>
                    </td>
                  <td class="text-center py-0 align-middle">
                    <a href="/detailKelompok" class="btn-sm btn-info"><i class="fas fa-list-alt"></i></a>
                  </td>
                </tr>
                <tr>
                  <td>Trident</td>
                  <td>3
                  </td>
                  <td>Win 98+</td>
                  <td class="text-center py-0 align-middle"><span class="badge bg-warning">Process</span></td>
                  <td class="text-center py-0 align-middle">
                      <a href="#" class="btn-sm btn-info"><i class="fas fa-check"></i></a>
                      <a href="#" class="btn-sm btn-danger"><i class="fas fa-times"></i></a>
                    </td>
                  <td class="text-center py-0 align-middle">
                    <a href="/detailKelompok" class="btn-sm btn-info"><i class="fas fa-list-alt"></i></a>
                  </td>
                </tr>
                <tr>
                  <td>Trident</td>
                  <td>3</td>
                  <td>Win XP SP2+</td>
                  <td class="text-center py-0 align-middle"><span class="badge bg-warning">Process</span></td>
                  <td class="text-center py-0 align-middle">
                      <a href="#" class="btn-sm btn-info"><i class="fas fa-check"></i></a>
                      <a href="#" class="btn-sm btn-danger"><i class="fas fa-times"></i></a>
                    </td>
                  <td class="text-center py-0 align-middle">
                    <a href="/detailKelompok" class="btn-sm btn-info"><i class="fas fa-list-alt"></i></a>
                  </td>
                </tr>
                <tr>
                  <td>Trident</td>
                  <td>2</td>
                  <td>Win XP</td>
                  <td class="text-center py-0 align-middle"><span class="badge bg-warning">Process</span></td>
                  <td class="text-center py-0 align-middle">
                      <a href="#" class="btn-sm btn-info"><i class="fas fa-check"></i></a>
                      <a href="#" class="btn-sm btn-danger"><i class="fas fa-times"></i></a>
                    </td>
                  <td class="text-center py-0 align-middle">
                    <a href="/detailKelompok" class="btn-sm btn-info"><i class="fas fa-list-alt"></i></a>
                  </td>
                </tr>
                <tr>
                  <td>Gecko</td>
                  <td>3</td>
                  <td>Win 98+ / OSX.2+</td>
                  <td class="text-center py-0 align-middle"><span class="badge bg-warning">Process</span></td>
                  <td class="text-center py-0 align-middle">
                      <a href="#" class="btn-sm btn-info"><i class="fas fa-check"></i></a>
                      <a href="#" class="btn-sm btn-danger"><i class="fas fa-times"></i></a>
                    </td>
                  <td class="text-center py-0 align-middle">
                    <a href="/detailKelompok" class="btn-sm btn-info"><i class="fas fa-list-alt"></i></a>
                  </td>
                </tr>
                <tr>
                  <td>Gecko</td>
                  <td>2</td>
                  <td>Win 98+ / OSX.2+</td>
                  <td class="text-center py-0 align-middle"><span class="badge bg-warning">Process</span></td>
                  <td class="text-center py-0 align-middle">
                      <a href="#" class="btn-sm btn-info"><i class="fas fa-check"></i></a>
                      <a href="#" class="btn-sm btn-danger"><i class="fas fa-times"></i></a>
                    </td>
                  <td class="text-center py-0 align-middle">
                    <a href="/detailKelompok" class="btn-sm btn-info"><i class="fas fa-list-alt"></i></a>
                  </td>
                </tr>
                <tr>
                  <td>Gecko</td>
                  <td>3</td>
                  <td>Win 98+ / OSX.2+</td>
                  <td class="text-center py-0 align-middle"><span class="badge bg-warning">Process</span></td>
                  <td class="text-center py-0 align-middle">
                      <a href="#" class="btn-sm btn-info"><i class="fas fa-check"></i></a>
                      <a href="#" class="btn-sm btn-danger"><i class="fas fa-times"></i></a>
                    </td>
                  <td class="text-center py-0 align-middle">
                    <a href="/detailKelompok" class="btn-sm btn-info"><i class="fas fa-list-alt"></i></a>
                  </td>
                </tr>
                <tr>
                  <td>Gecko</td>
                  <td>3</td>
                  <td>Win 2k+ / OSX.3+</td>
                  <td class="text-center py-0 align-middle"><span class="badge bg-warning">Process</span></td>
                  <td class="text-center py-0 align-middle">
                      <a href="#" class="btn-sm btn-info"><i class="fas fa-check"></i></a>
                      <a href="#" class="btn-sm btn-danger"><i class="fas fa-times"></i></a>
                    </td>
                  <td class="text-center py-0 align-middle">
                    <a href="/detailKelompok" class="btn-sm btn-info"><i class="fas fa-list-alt"></i></a>
                  </td>
                </tr>
                <tr>
                  <td>Gecko</td>
                  <td>3</td>
                  <td>OSX.2+</td>
                  <td class="text-center py-0 align-middle"><span class="badge bg-warning">Process</span></td>
                  <td class="text-center py-0 align-middle">
                      <a href="#" class="btn-sm btn-info"><i class="fas fa-check"></i></a>
                      <a href="#" class="btn-sm btn-danger"><i class="fas fa-times"></i></a>
                    </td>
                  <td class="text-center py-0 align-middle">
                    <a href="/detailKelompok" class="btn-sm btn-info"><i class="fas fa-list-alt"></i></a>
                  </td>
                </tr>
                <tr>
                  <td>Gecko</td>
                  <td>2</td>
                  <td>OSX.2+</td>
                  <td class="text-center py-0 align-middle"><span class="badge bg-warning">Process</span></td>
                  <td class="text-center py-0 align-middle">
                      <a href="#" class="btn-sm btn-info"><i class="fas fa-check"></i></a>
                      <a href="#" class="btn-sm btn-danger"><i class="fas fa-times"></i></a>
                    </td>
                  <td class="text-center py-0 align-middle">
                    <a href="/detailKelompok" class="btn-sm btn-info"><i class="fas fa-list-alt"></i></a>
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