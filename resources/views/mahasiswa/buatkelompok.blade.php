@extends('mahasiswa.base')
@section('content')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4>Kelompok</h4>
          </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a>Mahasiswa</a></li>
                <li class="breadcrumb-item active">Buat Kelompok</li>
              </ol>
           </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
     
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Anggota Kelompok</h3>
            </div>
            
            <form class="form-inline float-right "> 
              <div class="card-body">
               
              <form role="form">
                  <div class="col-sm-12">
                  <a href="" class="btn btn-success float-right btn-sm"><i class="fas fa-plus"></i> Tambah </a> <br><br>
                  </div>
                </form>
                
              </form>
           
            <div class="card-body">
            
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>NIM</th>
                  <th>Nama</th>
                  <th>Angkatan</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>1</td>
                  <td>17/410830/SV/12757</td>
                  <td>Dear Nasyita</td>
                  <td>2017</td>
                  <td class="text-center py-0 align-middle">
                      <a href="#" class="btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                  </td>
                </tr>

                <tr>
                  <td>2</td>
                  <td>17/433830/SV/12333</td>
                  <td>Nofa Dwi A</td>
                  <td>2017</td>
                  <td class="text-center py-0 align-middle">
                      <a href="#" class="btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                  </td>
                </tr>
                <tr>
                  <td>3</td>
                  <td>17/411133/SV/12345</td>
                  <td>Febi Fiolanda</td>
                  <td>2017</td>
                  <td class="text-center py-0 align-middle">
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