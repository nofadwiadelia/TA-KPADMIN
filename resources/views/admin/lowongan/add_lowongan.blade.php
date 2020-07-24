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
                <li class="breadcrumb-item active">Lowongan</li>
                <li class="breadcrumb-item active">Add</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
                <form id="lowonganForm">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Posisi *</label>
                            <input type="text" class="form-control" name="pekerjaan" id="pekerjaan" placeholder="" maxlength="100">
                            <p class="text-muted"><small><i>*Max 100 karakter</i></small></p>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Persyaratan *</label>
                            <textarea name="persyaratan" id="persyaratan" class="form-control" maxlength="1000"></textarea>
                            <p class="text-muted"><small><i>*Max 1000 karakter</i></small></p>
                        </div>
                        <input type="hidden" class="form-control" name="created_by" id="created_by" value="{{$userId}}">
                        
                        <div class="form-group">
                            <label for="exampleInputEmail1">Kapasitas *</label>
                            <input type="number" class="form-control" name="kapasitas" id="kapasitas" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slot *</label>
                            <input type="number" class="form-control" name="slot" id="slot" placeholder="">
                        </div>
                        <div class="form-group">
                          <label>Instansi *</label>
                          <select name="id_instansi" class="form-control select2" style="width: 100%;">
                              <option selected disabled>Pilih Instansi</option>
                              @foreach($data as $instansi)
                              <option value="{{ $instansi->id_instansi }}">{{ $instansi->nama }}</option>
                              @endforeach
                          </select >
                        </div>
                        <div class="form-group">
                          <label>Periode *</label>
                          <select name="id_periode" class="form-control select2" style="width: 100%;">
                              <option value="{{ $periode->id_periode }}">{{ $periode->tahun_periode }}</option>
                          </select >
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                      <div class="d-flex flex-row justify-content-end">
                          <span class="mr-2">
                          <button type="submit" class="btn btn-danger">Cancel</button>
                          </span>
                          <span>
                          <button type="submit" class="btn btn-primary">Submit</button>
                          </span>
                      </div>
                    </div>
                </form>
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
<script src="../../plugins/summernote/summernote-bs4.min.js"></script>
<!-- page script -->
<script>
  $(document).ready(function(){   
    $('#lowonganForm').on('submit', function(e){
        e.preventDefault();

        $.ajax({
            type: "POST",
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            url: "/api/admin/lowongan/add",
            cache:false,
            dataType: "json",
            data: $('#lowonganForm').serialize(),
            success: function(data){
                window.location = "/admin/lowongan";
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