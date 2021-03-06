@extends('mahasiswa.base')
@section('content')
   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
          </div>


          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a>Mahasiswa</a></li>
              <li class="breadcrumb-item active">Laporan Akhir</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content --><section class="content">
      
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Tambah Laporan Akhir</h3>
            </div>
            <!-- /.card-header -->
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-8">
                            <form role="form">
                                <div class="card-body">
                                    
                                    <div class="form-group row">
                                        <label for="nama_instansi" class="col-sm-3 col-form-label">Judul Laporan</label>
                                        <div class="col-sm-9">
                                        <input type="text" class="form-control" id="nama_instansi" placeholder="">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="alamat_instansi" class="col-sm-3 col-form-label">Pilih Berkas</label>
                                        <div class="col-sm-9">
                                        <div class="row">
                                            <div class="col-md-6">     
                                            <div class="form-group">
    					                    <input type="file" class="form-control required" id="foto" name="foto">
                                            <p class="text-muted"><small><i>*Dalam bentuk PDF, max ukuran 10 MB</i></small></p>
					                        </div>
                                            </div>
                                        </div>
                                        </div>
                                    </div>
                                    
                                    <div class="d-flex flex-row justify-content-end">
                                        <span class="mr-2">
                                        <input type="submit" class="btn btn-danger" value="Batal" />
                                        </span>
                                        <span>
                                        <input type="submit" class="btn btn-primary" value="Simpan" />
                                        </span>
                                   </div>
                                </div>
                                <!-- /.card-body -->

                            </form>
                        </div>
                    </div>
                </div>
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    
@endsection