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
                <li class="breadcrumb-item active">Pengumuman</li>
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
                <form id="editPengumuman" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Judul *</label>
                            <input type="text" name="judul" id="judul" required  class="form-control" value="{{ $data->judul }}" maxlength="100">
                            <p class="text-muted"><small><i>*Max 100 karakter</i></small></p>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Deskripsi *</label>
                            <textarea name="deskripsi" id="deskripsi" required class="form-control" maxlength="1000">{{ $data->deskripsi }}</textarea>
                            <p class="text-muted"><small><i>*Max 1000 karakter</i></small></p>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Lampiran</label>
                              <div class="input-group">
                                <div class="custom-file">
                                <input type="hidden" name="id_pengumuman" id="id_pengumuman" value="{{ $data->id_pengumuman }}">
                                  <input type="file" name="lampiran" id="lampiran" class="form-control" value="{{ $data->lampiran }}">
                                  <!-- <input type="file" class="custom-file-input" id="exampleInputFile"> -->
                                  <label class="custom-file-label" for="lampiran">Choose file</label>
                                </div>
                              </div>
                              <p class="text-muted"><small><i>*pdf,jpg,png,jpeg</i></small></p>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                      <div class="d-flex flex-row justify-content-end">
                          <span class="mr-2">
                          <a type="" href="{{url()->previous()}}" class="btn btn-danger"> Cancel </a>
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
<script>
  $(document).ready(function(){   
    $('#editPengumuman').on('submit', function(e){
        e.preventDefault();
        var id = $('#id_pengumuman').val();
        $.ajax({
            type: "POST",
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            url: "/api/admin/pengumuman/"+id+"/edit",
            dataType:'JSON',
            contentType: false,
            cache: false,
            processData: false,
            data: new FormData(this),
            success: function(data){
                window.location = "/admin/pengumuman";
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