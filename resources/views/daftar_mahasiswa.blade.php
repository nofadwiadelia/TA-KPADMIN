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
              <h3 class="card-title">Data User Mahasiswa</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <form role="form">
                  <div class="col-sm-4">
                    <p>Saring berdasarkan</p>
                      <!-- select -->
                      <div class="form-group">
                          <select class="form-control form-control-sm">
                            <option>Semua Angkatan</option>
                            <option>Periode 2019</option>
                            <option>option 3</option>
                            <option>option 4</option>
                            <option>option 5</option>
                          </select>
                      </div>
                      <button type="submit" class="btn btn-default">Filter</button> <br><br>
                  </div>
                </form>
                <div class="col-sm-12">
                  <a href="/add_form_pengumuman" class="btn btn-primary float-right btn-sm"><i class="fas fa-download"></i> &nbsp; Export to Excel</a> <br><br>
                </div>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>NIM</th>
                  <th>Nama</th>
                  <th>No.HP</th>
                  <th>Periode</th>
                  <th>Kelompok</th>
                  <th>Status</th>
                  <th>Status Magang</th>
                  <th>Nilai</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>17/415526/SV/13391</td>
                  <td>Nofa Dwi Adelia</td>
                  <td>089622372883</td>
                  <td> 2019</td>
                  <td>Cyber</td>
                  <td>Ketua</td>
                  <td class="text-center py-0 align-middle"><span class="badge bg-warning">magang</span></td>
                  <td>4</td>
                  <td class="text-center py-0 align-middle">
                    <a href="/detail_mahasiswa" class="btn-sm btn-info"><i class="fas fa-eye"></i></a>
                  </td>
                </tr>
                <tr>
                  <td>17/415526/SV/13391</td>
                  <td>Dear Nasyita</td>
                  <td>08123456789</td>
                  <td>2019</td>
                  <td>Cyber</td>
                  <td>Anggota</td>
                  <td class="text-center py-0 align-middle"><span class="badge bg-warning">magang</span></td>
                  <td> 4</td>
                  <td class="text-center py-0 align-middle">
                    <a href="/detail_mahasiswa" class="btn-sm btn-info"><i class="fas fa-eye"></i></a>
                  </td>
                </tr>
                <tr>
                  <td>17/415526/SV/13391</td>
                  <td>Internet
                    Explorer 5.5
                  </td>
                  <td>Win 95+</td>
                  <td>5.5</td>
                  <td>Cyber</td>
                  <td>Ketua</td>
                  <td class="text-center py-0 align-middle"><span class="badge bg-warning">magang</span></td>
                  <td> 4</td>
                  <td class="text-center py-0 align-middle">
                    <a href="/detail_mahasiswa" class="btn-sm btn-info"><i class="fas fa-eye"></i></a>
                    </td>
                </tr>
                <tr>
                  <td>17/415526/SV/13391</td>
                  <td>Internet
                    Explorer 6
                  </td>
                  <td>Win 98+</td>
                  <td>6</td>
                  <td>Cyber</td>
                  <td>Anggota</td>
                  <td class="text-center py-0 align-middle"><span class="badge bg-warning">magang</span></td>
                  <td> 4</td>
                  <td class="text-center py-0 align-middle">
                    <a href="/detail_mahasiswa" class="btn-sm btn-info"><i class="fas fa-eye"></i></a>
                    </td>
                </tr>
                <tr>
                  <td>17/415526/SV/13391</td>
                  <td>Internet Explorer 7</td>
                  <td>Win XP SP2+</td>
                  <td>7</td>
                  <td>Cyber</td>
                  <td>Anggota</td>
                  <td class="text-center py-0 align-middle"><span class="badge bg-warning">magang</span></td>
                  <td> 4</td>
                  <td class="text-center py-0 align-middle">
                    <a href="/detail_mahasiswa" class="btn-sm btn-info"><i class="fas fa-eye"></i></a>
                  </td>
                </tr>
                <tr>
                  <td>17/415526/SV/13391</td>
                  <td>AOL browser (AOL desktop)</td>
                  <td>Win XP</td>
                  <td>6</td>
                  <td>Cyber</td>
                  <td>Anggota</td>
                  <td class="text-center py-0 align-middle"><span class="badge bg-warning">magang</span></td>
                  <td> 4</td>
                  <td class="text-center py-0 align-middle">
                    <a href="/detail_mahasiswa" class="btn-sm btn-info"><i class="fas fa-eye"></i></a>
                  </td>
                </tr>
                <tr>
                  <td>17/415526/SV/13391</td>
                  <td>Firefox 1.0</td>
                  <td>Win 98+ / OSX.2+</td>
                  <td>1.7</td>
                  <td>Cyber</td>
                  <td>Ketua</td>
                  <td class="text-center py-0 align-middle"><span class="badge bg-warning">magang</span></td>
                  <td> 4</td>
                  <td class="text-center py-0 align-middle">
                    <a href="/detail_mahasiswa" class="btn-sm btn-info"><i class="fas fa-eye"></i></a>
                  </td>
                </tr>
                <tr>
                  <td>17/415526/SV/13391</td>
                  <td>Firefox 1.5</td>
                  <td>Win 98+ / OSX.2+</td>
                  <td>1.8</td>
                  <td>Cyber</td>
                  <td>Ketua</td>
                  <td class="text-center py-0 align-middle"><span class="badge bg-warning">magang</span></td>
                  <td> 4</td>
                  <td class="text-center py-0 align-middle">
                    <a href="/detail_mahasiswa" class="btn-sm btn-info"><i class="fas fa-eye"></i></a>
                  </td>
                </tr>
                <tr>
                  <td>17/415526/SV/13391</td>
                  <td>Firefox 2.0</td>
                  <td>Win 98+ / OSX.2+</td>
                  <td>1.8</td>
                  <td>Cyber</td>
                  <td>Anggota</td>
                  <td class="text-center py-0 align-middle"><span class="badge bg-warning">magang</span></td>
                  <td> 4</td>
                  <td class="text-center py-0 align-middle">
                    <a href="/detail_mahasiswa" class="btn-sm btn-info"><i class="fas fa-eye"></i></a>
                  </td>
                </tr>
                <tr>
                  <td>17/415526/SV/13391</td>
                  <td>Firefox 3.0</td>
                  <td>Win 2k+ / OSX.3+</td>
                  <td>1.9</td>
                  <td>Cyber</td>
                  <td>Anggota</td>
                  <td class="text-center py-0 align-middle"><span class="badge bg-warning">magang</span></td>
                  <td> 4</td>
                  <td class="text-center py-0 align-middle">
                    <a href="/detail_mahasiswa" class="btn-sm btn-info"><i class="fas fa-eye"></i></a>
                  </td>
                </tr>
                <tr>
                  <td>17/415526/SV/13391</td>
                  <td>Camino 1.0</td>
                  <td>OSX.2+</td>
                  <td>1.8</td>
                  <td>Cyber</td>
                  <td>Anggota</td>
                  <td class="text-center py-0 align-middle"><span class="badge bg-warning">magang</span></td>
                  <td> 4</td>
                  <td class="text-center py-0 align-middle">
                    <a href="/detail_mahasiswa" class="btn-sm btn-info"><i class="fas fa-eye"></i></a>
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