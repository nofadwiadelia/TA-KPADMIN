@extends('admin.base')
@section('content')
<!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
    </section>
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
                <form id="editpengumumanForm" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Judul *</label>
                            <input type="text" name="judul" id="judul" required value="{{$data->judul}}" class="form-control {{ $errors->has('judul') ? 'is-invalid':'' }}">
                            <p class="text-danger">{{ $errors->first('judul') }}</p>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">deskripsi *</label>
                            <textarea name="deskripsi" id="deskripsi" value="{{$data->deskripsi}}" required class="form-control {{ $errors->has('deskripsi') ? 'is-invalid':'' }}"></textarea>
                            <p class="text-danger">{{ $errors->first('deskripsi') }}</p>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Lampiran</label>
                            <div class="input-group">
                              <div class="custom-file">
                              <input type="file" name="lampiran" id="lampiran" value="{{$data->lampiran}}" class="form-control" >
                              <!-- <input type="file" class="custom-file-input" id="exampleInputFile"> -->
                              <label class="custom-file-label" for="gambar">Choose file</label>
                              <p class="text-danger">{{ $errors->first('lampiran') }}</p>
                              </div>
                            </div>
                        </div>
                        <input type="hidden" name="id_pengumuman" id="id_pengumuman" value="{{ $data->id_pengumuman }}">
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                      <div class="d-flex flex-row justify-content-end">
                          <span class="mr-2">
                          <button type="reset" class="btn btn-danger">Cancel</button>
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

<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();
  });

  $(document).ready(function(){   
    $('#editpengumumanForm').on('submit', function(e){
        e.preventDefault();

        var id = $('#id_pengumuman').val();
        var judul = $('#judul').val();
        var deskripsi = $('#deskripsi').val();
        var lampiran = $('#lampiran').val();
        $.ajax({
            type: "PUT",
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            url: "/api/admin/pengumuman/"+id+"/edit",
            cache:false,
            dataType: "json",
            data: $('#editpengumumanForm').serialize(),
            success: function(data){
                window.location = "/admin/pengumuman";
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