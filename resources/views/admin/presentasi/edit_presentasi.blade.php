@extends('admin.base')
@section('content')
<!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-12">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Kelompok</li>
                <li class="breadcrumb-item active">Presentasi</li>
                <li class="breadcrumb-item active">Edit</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-8">
                            <!-- form start -->
                            <form id="editPresentasi">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">                                
                                            <div class="form-group">
                                            <label>Kelompok *</label>
                                                <select name="id_kelompok" id="id_kelompok" class="form-control select2" style="width: 100%;">
                                                <option selected="selected" value="{{ $presentasi->id_kelompok }}">{{$presentasi->kelompok->nama_kelompok}}</option>
                                                @foreach($kelompok as $kelompoks)
                                                <option value="{{ $kelompoks->id_kelompok }}">{{ $kelompoks->nama_kelompok }}</option>
                                                @endforeach
                                                </select >
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">                                
                                            <div class="form-group">
                                            <label>Dosen Penguji *</label>
                                                <select name="id_dosen" id="id_dosen" class="form-control select2" style="width: 100%;">
                                                <option selected="selected" value="{{ $presentasi->id_dosen }}">{{$presentasi->dosen->nama}}</option>
                                                @foreach($dosen as $dosens)
                                                <option value="{{ $dosens->id_dosen }}">{{ $dosens->nama }}</option>
                                                @endforeach
                                                </select >
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">                                
                                            <!-- Date -->
                                            <div class="form-group">
                                                <label>Waktu *</label>
                                                <div class="input-group date">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                    </div>
                                                    <input type="datetime-local" required id="waktu" name="waktu" class="form-control pull-right required" value="{{$presentasi->waktu}}" >
                                                </div>
                                                <!-- /.input group -->
                                            </div>
                                            <!-- /.form group -->
                                        </div>
                                        <div class="col-md-6">                                
                                            <!-- Date -->
                                            <div class="form-group">
                                                <label>Ruang *</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                    </div>
                                                    <input type="text" required class="form-control" name="ruang" id="ruang" value="{{$presentasi->ruang}}">
                                                </div>
                                                <!-- /.input group -->
                                            </div>
                                            <!-- /.form group -->
                                        </div>
                                    </div>
                                    <input type="hidden" name="id_jadwal_presentasi" id="id_jadwal_presentasi" value="{{ $presentasi->id_jadwal_presentasi }}">
                                    <div class="d-flex flex-row justify-content-end">
                                        <span class="mr-2">
                                        <input type="submit" class="btn btn-danger" value="Cancel" />
                                        <span class="mr-2">
                                        <input type="submit" class="btn btn-primary" value="Submit" />
                                   </div>
                                </div><!-- /.box-body -->
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
    <!-- /.content -->
@endsection

@section('scripts')
<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- InputMask -->
<!-- <script src="../../plugins/moment/moment.min.js"></script>
<script src="../../plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script> -->

<script >
$(document).ready(function(){   
    $('#editPresentasi').on('submit', function(e){
        e.preventDefault();

        var id_kelompok = $('#id_kelompok').val();
        var id_dosen = $('#id_dosen').val();
        var waktu = $('#waktu').val();
        var ruang = $('#ruang').val();
        var id_periode = $('#id_periode').val();
        var id = $('#id_jadwal_presentasi').val();

        $.ajax({
            type: "PUT",
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            url: "/api/admin/presentasi/"+id+"/edit",
            cache:false,
            dataType: "json",
            data: $('#editPresentasi').serialize(),
            success: function(data){
                window.location = "/admin/presentasi";
                toastr.options.closeButton = true;
                toastr.options.closeMethod = 'fadeOut';
                toastr.options.closeDuration = 100;
                toastr.success(data.message);
            },
            error: function(error){
            console.log(error);
            }
        });
    });
});
</script>

@endsection