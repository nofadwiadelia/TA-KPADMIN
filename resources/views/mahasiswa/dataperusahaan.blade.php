@extends('mahasiswa.base')
@section('content')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Usulan Instansi</h1>
          </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a>Mahasiswa</a></li>
              <li class="breadcrumb-item active">Usulan Instansi</li>
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
              <h3 class="card-title">Usulan Instansi</h3>
            </div>
            
              <div class="card-body">
                <form role="form">
                  <div class="col-sm-12">
                  <a href="/tambahperusahaan" class="btn btn-success float-right btn-sm"><i class="fas fa-plus"></i> Tambah </a> <br><br>
                  </div>
                </form>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr class="text-center">
                  <th>No</th>
                  <th>Nama Instansi</th>
                  <th>Website</th>
                  <th>Alamat</th>
                  <th>Deskripsi</th>
                  <th>Status</th>
                  <th>Dokumen</th>
                  <th>Aksi</th>
                  
                </tr>
                </thead>
                <tbody>
                <tr>
                  <td>1</td>
                  <td>PT Telkom Indonesia</td>
                  <td>www.telkomindonesia.com</td>
                  <td>Jakal KM 4,Yogyakarta</td>
                  <td>Membuat SI Pendataan barang , posisi sebagai frontend</td>
                  <td>Diterima</td>
                  <td class="hidden-print text-center py-0 align-middle">
											<a href="#" class="btn btn-primary btn-sm"  data-target="#surat"><i class="fas fa-eye"></i></a>
									</td>
                  <td class="text-center py-0 align-middle">
                      <a href="/editdataperusahaan" class="btn-sm btn-info"><i class="fas fa-pencil-alt"></i></a>
                      
                  </td>
                  
                </tr>

                <tr>
                  <td>2</td>
                  <td>PT KAI Indonesia</td>
                  <td>www.ptkai.com</td>
                  <td>Lempuyangan Yogyakarta</td>
                  <td>Membuat SI Pendataan barang , posisi sebagai frontend</td>
                  <td>Ditolak</td>
                  <td class="hidden-print text-center py-0 align-middle">
											<a href="#" class="btn btn-primary btn-sm"  data-target="#surat"><i class="fas fa-eye"></i></a>
									</td>
                  <td class="text-center py-0 align-middle">
                      <a href="/editdataperusahaan" class="btn-sm btn-info"><i class="fas fa-pencil-alt"></i></a>
                      
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