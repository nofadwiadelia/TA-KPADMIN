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
              <h3 class="card-title">Pengumuman</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body ">
                <form role="form">
                  <div class="col-sm-12">
                  <a href="/add_form_pengumuman" class="btn btn-success float-right btn-sm"><i class="fas fa-plus"></i> Buat Pengumuman</a> <br><br>
                  </div>
                </form>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Judul</th>
                  <th>Detail</th>
                  <th>Lampiran</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>Trident</td>
                  <td>Internet
                    Explorer 4.0hi svg uvtergctwcteb ugcergecuv3 t3gc73t 8ecg7f3cgr8c bg7wcgt
                  </td>
                  <td>Win 95+</td>
                  <td class="text-center py-0 align-middle">
                      <a href="#" class="btn-sm btn-info"><i class="fas fa-edit"></i></a>
                      <a href="#" class="btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                  </td>
                </tr>
                <tr>
                  <td>Trident</td>
                  <td>Internet
                    Explorer 5.0
                  </td>
                  <td>Win 95+</td>
                  <td class="text-center py-0 align-middle">
                      <a href="#" class="btn-sm btn-info"><i class="fas fa-edit"></i></a>
                      <a href="#" class="btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                  </td>
                </tr>
                <tr>
                  <td>Trident</td>
                  <td>Internet
                    Explorer 5.5
                  </td>
                  <td>Win 95+</td>
                  <td class="text-center py-0 align-middle">
                      <a href="#" class="btn-sm btn-info"><i class="fas fa-edit"></i></a>
                      <a href="#" class="btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                  </td>
                </tr>
                <tr>
                  <td>Trident</td>
                  <td>Internet
                    Explorer 6
                  </td>
                  <td>Win 98+</td>
                  <td class="text-center py-0 align-middle">
                      <a href="#" class="btn-sm btn-info"><i class="fas fa-edit"></i></a>
                      <a href="#" class="btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                  </td>
                </tr>
                <tr>
                  <td>Trident</td>
                  <td>Internet Explorer 7</td>
                  <td>Win XP SP2+</td>
                  <td class="text-center py-0 align-middle">
                      <a href="#" class="btn-sm btn-info"><i class="fas fa-edit"></i></a>
                      <a href="#" class="btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                  </td>
                </tr>
                <tr>
                  <td>Trident</td>
                  <td>AOL browser (AOL desktop)</td>
                  <td>Win XP</td>
                  <td class="text-center py-0 align-middle">
                      <a href="#" class="btn-sm btn-info"><i class="fas fa-edit"></i></a>
                      <a href="#" class="btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                  </td>
                </tr>
                <tr>
                  <td>Gecko</td>
                  <td>Firefox 1.0</td>
                  <td>Win 98+ / OSX.2+</td>
                  <td class="text-center py-0 align-middle">
                      <a href="#" class="btn-sm btn-info"><i class="fas fa-edit"></i></a>
                      <a href="#" class="btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                  </td>
                </tr>
                <tr>
                  <td>Gecko</td>
                  <td>Firefox 1.5</td>
                  <td>Win 98+ / OSX.2+</td>
                  <td class="text-center py-0 align-middle">
                      <a href="#" class="btn-sm btn-info"><i class="fas fa-edit"></i></a>
                      <a href="#" class="btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                  </td>
                </tr>
                <tr>
                  <td>Gecko</td>
                  <td>Firefox 2.0</td>
                  <td>Win 98+ / OSX.2+</td>
                  <td class="text-center py-0 align-middle">
                      <a href="#" class="btn-sm btn-info"><i class="fas fa-edit"></i></a>
                      <a href="#" class="btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                  </td>
                </tr>
                <tr>
                  <td>Gecko</td>
                  <td>Firefox 3.0</td>
                  <td>Win 2k+ / OSX.3+</td>
                  <td class="text-center py-0 align-middle">
                      <a href="#" class="btn-sm btn-info"><i class="fas fa-edit"></i></a>
                      <a href="#" class="btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                  </td>
                </tr>
                <tr>
                  <td>Gecko</td>
                  <td>Camino 1.0</td>
                  <td>OSX.2+</td>
                  <td class="text-center py-0 align-middle">
                      <a href="#" class="btn-sm btn-info"><i class="fas fa-edit"></i></a>
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