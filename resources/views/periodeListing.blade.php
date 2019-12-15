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
              <h3 class="card-title">Periode PKL</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body ">
                <form role="form">
                  <div class="col-sm-12">
                  <a href="/add_new_periode" class="btn btn-success float-right btn-sm"><i class="fas fa-plus"></i> Buat Periode</a> <br><br>
                  </div>
                </form>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Tahun Periode</th>
                  <th>Tanggal Mulai</th>
                  <th>Tanggal Selesai</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>1</td>
                  <td>2019</td>
                  <td>8 February 2018
                  </td>
                  <td>8 February 2018</td>
                  <td class="text-center py-0 align-middle">
                      <div class="btn-group btn-group-sm">
                        <a href="#" class="btn btn-info"><i class="fas fa-pencil-alt"></i></a>
                        <a href="#" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                      </div>
                    </td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>2018</td>
                  <td>8 February 2018</td>
                  <td>8 February 2018</td>
                  <td class="text-center py-0 align-middle">
                      <div class="btn-group btn-group-sm">
                        <a href="#" class="btn btn-info"><i class="fas fa-pencil-alt"></i></a>
                        <a href="#" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                      </div>
                    </td>
                </tr>
                <tr>
                  <td>3</td>
                  <td>2017</td>
                  <td>8 February 2018</td>
                  <td>8 February 2018</td>
                  <td class="text-center py-0 align-middle">
                      <div class="btn-group btn-group-sm">
                        <a href="#" class="btn btn-info"><i class="fas fa-pencil-alt"></i></a>
                        <a href="#" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                      </div>
                    </td>
                </tr>
                <tr>
                  <td>4</td>
                  <td>2019</td>
                  <td>8 February 2018</td>
                  <td>8 February 2018</td>
                  <td class="text-center py-0 align-middle">
                      <div class="btn-group btn-group-sm">
                        <a href="#" class="btn btn-info"><i class="fas fa-pencil-alt"></i></a>
                        <a href="#" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                      </div>
                    </td>
                </tr>
                <tr>
                  <td>5</td>
                  <td>2019</td>
                  <td>8 February 2018</td>
                  <td>8 February 2018</td>
                  <td class="text-center py-0 align-middle">
                      <div class="btn-group btn-group-sm">
                        <a href="#" class="btn btn-info"><i class="fas fa-pencil-alt"></i></a>
                        <a href="#" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a> 
                      </div>
                    </td>
                </tr>
                <tr>
                  <td>6</td>
                  <td>2019</td>
                  <td>8 February 2018</td>
                  <td>8 February 2018</td>
                  <td class="text-center py-0 align-middle">
                      <div class="btn-group btn-group-sm">
                        <a href="#" class="btn btn-info"><i class="fas fa-pencil-alt"></i></a>
                        <a href="#" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                      </div>
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