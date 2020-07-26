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
                                                <option selected="selected" value="{{ $data->id_kelompok }}">{{$data->nama_kelompok}}</option>
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
                                                <select name="id_dospeng" id="id_dospeng" class="form-control select2" style="width: 100%;">
                                                <option selected="selected" value="{{ $data->id_dosen }}">{{$data->dospeng}}</option>
                                                @foreach($dosen as $dosens)
                                                <option value="{{ $dosens->id_dosen }}">{{ $dosens->nama }}</option>
                                                @endforeach
                                                </select >
                                            </div>
                                            
                                        </div>
                                    </div>

                                    <input type="hidden" name="id_periode" id="id_periode" class="form-control pull-right required" value="{{$presentasi->id_periode}}">

                                    <div class="row">
                                        <div class="col-md-12">                                
                                            <div class="form-group">
                                                <label>Tanggal *</label>
                                                <div class="input-group date">
                                                    <!-- <div class="input-group-prepend">
                                                        <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                                    </div> -->
                                                    <input type="date" name="tanggal" id="tanggal" class="form-control pull-right required" value="{{$presentasi->tanggal}}">
                                                </div>
                                                <!-- /.input group -->
                                            </div>
                                            
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">                                
                                            <!-- Date -->
                                            <div class="form-group">
                                                <label>Waktu *</label>
                                                <div class="input-group">
                                                    <select name="id_sesiwaktu" id="id_sesiwaktu" class="form-control select2" style="width: 100%;">
                                                    <option selected="selected" value="{{ $presentasi->id_sesiwaktu }}">{{$presentasi->sesi->sesi}}</option>
                                                    @foreach($sesi as $waktu)
                                                    <option value="{{ $waktu->id_sesiwaktu }}">{{ $waktu->sesi }}</option>
                                                    @endforeach
                                                    </select >
                                                </div>
                                                <!-- /.input group -->
                                            </div>
                                            <!-- /.form group -->
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Ruang *</label>
                                                <div class="input-group">
                                                <select name="id_ruang" id="id_ruang" class="form-control select2" style="width: 100%;">
                                                <option selected="selected" value="{{ $presentasi->id_ruang }}">{{$presentasi->ruang->ruang}}</option>
                                                @foreach($ruang as $ruangs)
                                                <option value="{{ $ruangs->id_ruang }}">{{ $ruangs->ruang }}</option>
                                                @endforeach
                                                </select >
                                                    

                                                </div>
                                                <!-- /.input group -->
                                            </div>
                                            <!-- /.form group -->
                                        </div>
                                    </div>
                                    <input type="hidden" name="id_jadwal_presentasi" id="id_jadwal_presentasi" value="{{ $presentasi->id_jadwal_presentasi }}">
                                    <div class="d-flex flex-row justify-content-end">
                                        <span class="mr-2">
                                        <a type="" href="{{url()->previous()}}" class="btn btn-danger"> Cancel </a>
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
<script src="{{ asset('/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->

<script src="{{ asset('/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- InputMask -->
<!-- <script src="../../plugins/moment/moment.min.js"></script>
<script src="../../plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script> -->

<script >
$(document).ready(function(){   
    $('#editPresentasi').on('submit', function(e){
        e.preventDefault();
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
            error: function(xhr, status, error) 
            {

              $.each(xhr.responseJSON.errors, function (key, item) 
              {
                // $("#errors").append("<li class='alert alert-danger'>"+item+"</li>")
                toastr.options.closeButton = true;
                toastr.options.closeMethod = 'fadeOut';
                toastr.options.closeDuration = 200;
                toastr.error(item);
              });

            }
        });
    });
});
</script>

@endsection