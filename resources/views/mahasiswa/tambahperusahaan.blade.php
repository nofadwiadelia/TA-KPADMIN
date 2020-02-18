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
              <li class="breadcrumb-item active">Tambah Data Instansi</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content --><section class="content">
      
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Tambah Data Instansi</h3>
            </div>
            <!-- /.card-header -->
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-8">
                            <form role="form">
                                <div class="card-body">
                                    
                                    <div class="form-group row">
                                        <label for="nama_instansi" class="col-sm-3 col-form-label">Nama Instansi</label>
                                        <div class="col-sm-9">
                                        <input type="text" class="form-control" id="nama_instansi" placeholder="">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="website" class="col-sm-3 col-form-label">Website</label>
                                        <div class="col-sm-9">
                                        <input type="text" class="form-control" id="website" placeholder="">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="alamat_instansi" class="col-sm-3 col-form-label">Alamat</label>
                                        <div class="col-sm-9">
                                        <input type="text" class="form-control" id="alamat_instansi" placeholder="">
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                      <label for="alamat_instansi" class="col-sm-3 col-form-label">Deskripsi</label>
                                        <div class="col-sm-9">
                                          <textarea type="text" class="form-control required" id="pengalaman" name="pengalaman" rows="5" maxlength="1000" placeholder="Penjelasan singkat jobdesk dan posisi saat kerja praktik "></textarea>
                                          <p class="text-muted"><small><i>*Pisahkan dengan koma, Max 1000 karakter</i></small></p>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="alamat_instansi" class="col-sm-3 col-form-label">Surat Pemberitahuan</label>
                                        <div class="col-sm-9">
                                        <input type="file" class="form-control required" id="cv" name="cv">
                                          <p class="text-muted"><small><i>*Dalam format PDF. Max ukuran 3 MB</i></small></p>
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