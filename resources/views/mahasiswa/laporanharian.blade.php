@extends('mahasiswa.base')
@section('content')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Buku Harian</h1>
          </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a>Mahasiswa</a></li>
              <li class="breadcrumb-item active">Buku Harian</li>
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
              <h3 class="card-title">List Buku Harian</h3>
            </div>
            
              <div class="card-body">
                <form role="form">
                  <div class="col-sm-12">
                  <a href="/tambahlaporanharian" class="btn btn-success float-right btn-sm"><i class="fas fa-plus"></i> Tambah </a> <br><br>
                  </div>
                </form>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr class="text-center">
                  <th>No</th>
                  <th>Tanggal</th>
                  <th>Datang</th>
                  <th>Pulang</th>
                  <th>Kegiatan</th>
                  <th>Edit</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>1</td>
                  <td>12 Juni 2020</td>
                  <td>08.00</td>
                  <td>17.00</td>
                  <td>Membuat front end sistem</td>
                  <td class="text-center py-0 align-middle">
                      <a href="/editlaporanharian" class="btn-sm btn-info"><i class="fas fa-pencil-alt"></i></a>
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