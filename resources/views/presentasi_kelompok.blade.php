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
              <h3 class="card-title">Jadwal Presentasi Kelompok</h3>
            </div>
            <div class="card-body ">
                <form role="form">
                  <div class="col-sm-4">
                    <p>Pilih Periode</p>
                      <!-- select -->
                      <div class="form-group">
                          <select class="form-control form-control-sm">
                            <option>2019</option>
                            <option>2018</option>
                          </select>
                      </div>
                      <button type="submit" class="btn btn-default">Filter</button> <br><br>
                  </div>
                  <div class="col-sm-12">
                  <a href="/add_jadwal_presentasi" class="btn btn-success float-right btn-sm"><i class="fas fa-plus"></i> Buat Jadwal</a> <br><br>
                  </div>
                </form>
              <table id="example1" class="table table-bordered table-striped ">
                <thead>
                <tr>
                  <th>Nama Kelompok</th>
                  <th>Periode</th>
                  <th>Dosen Pembimbing</th>
                  <th>Dosen Penguji</th>
                  <th>Hari</th>
                  <th>Jam</th>
                  <th>Ruang</th>
                  <th>Aksi</th>                  
                  <th>Detail</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>Trident</td>
                  <td>2019</td>
                  <td>Imam Fakhrurrozi, M.Cs</td>
                  <td>Irkham Huda, M.Cs</td>
                  <td>Senin, 2 September 2019</td>
                  <td>11.00</td>
                  <td>Lab Techno</td>
                  <td class="text-center py-0 align-middle">
                    <a href="/detailMagang" class="btn-sm btn-info"><i class="fas fa-list-alt"></i></a>
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