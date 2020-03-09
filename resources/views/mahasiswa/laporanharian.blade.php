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
              <div class="col-sm-12">
                <a href="" class="btn btn-success float-right btn-sm" data-toggle="modal" data-target="#modal-lg"><i class="fas fa-plus"></i> Tambah </a> <br><br>
              </div>
              <div class="form-group row">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr class="text-center">
                      <th>No</th>
                      <th>Tanggal</th>
                      <th>Datang</th>
                      <th>Pulang</th>
                      <th>Kegiatan</th>
                      <th>Aksi</th>
                    </tr>
                    </thead>
                  <tbody>
                  @php $no = 1; @endphp
                  @foreach($laporanharian as $laporan)
                  <tr>
                    <td>{{$no++}}</td>
                    <td>{{$laporan->tanggal}}</td>
                    <td>{{$laporan->datang}}</td>
                    <td>{{$laporan->pulang}}</td>
                    <td>{{$laporan->kegiatan}}</td>
                    <td class="text-center py-0 align-middle">
                        <a href="/editlaporanharian" class="btn-sm btn-info"><i class="fas fa-pencil-alt"></i></a>
                    </td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
            <div class="card-body">
              <div class="modal fade show" id="modal-lg">
                  <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Tambah List Kegiatan Harian</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <div class="row justify-content-center">
                          <div class="col-8">
                            <form action="/mahasiswa/laporanharian" method="post" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('POST') }}
                              <div class="card-body ">                               
                                <div class="form-group row">
                                  <label for="Tanggal" class="col-sm-3 col-form-label">Tanggal <font color="red">*</font></label>
                                  <div class="col-sm-9">
                                    <input type="date" class="form-control" id="tanggal" name="tanggal">
                                  </div>
                                </div>
                                </br>
                                <div class="form-group row">
                                    <label for="Datang" class="col-sm-3 col-form-label">Datang <font color="red">*</font></label>
                                    <div class="col-sm-9">
                                    <input type="time" class="form-control" id="datang" name="datang">
                                    
                                    </div>
                                </div>
                                </br>
                                <div class="form-group row">
                                    <label for="Pulang" class="col-sm-3 col-form-label">Pulang <font color="red">*</font></label>
                                    <div class="col-sm-9">
                                    <input type="time" class="form-control" id="pulang" name="pulang">
                                    </div>
                                </div>
                                </br>
                                <div class="form-group row">
                                    <label for="alamat_instansi" class="col-sm-3 col-form-label">Kegiatan <font color="red">*</font></label>
                                    <div class="col-sm-9">
                                    <input type="text" class="form-control" id="kegiatan" name="kegiatan" >
                                    </div>
                                </div>
                                </br>
                                <input type="hidden" class="form-control" id="mahasiswa_id" name="mahasiswa_id" value="1" >
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
                      <!-- /.card-body -->
                    </div>
                  </div>
                      <!-- /.card-body -->
                </div>
                 
              </div>
                
            </div>
                <!-- /.modal-content -->
          </div>
              <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
          <!-- /.card -->
      </div>
        <!-- /.col -->
    </div>
      <!-- /.row -->
    </section>
@endsection

@section('scripts')

<!-- bootstrap time picker -->
<script >

$(function () {
    
    //Timepicker
    $('#timepicker').timepicker({
      format: 'LT'
    });
  })


</script>


@endsection