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
                <form id="pengumumanForm" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Judul *</label>
                            <input type="text" name="judul" id="judul" required  class="form-control {{ $errors->has('judul') ? 'is-invalid':'' }}">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">deskripsi *</label>
                            <textarea name="deskripsi" id="deskripsi" required class="form-control {{ $errors->has('deskripsi') ? 'is-invalid':'' }}"></textarea>
                            <p class="text-danger">{{ $errors->first('deskripsi') }}</p>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Lampiran</label>
                            <div class="input-group">
                            <div class="custom-file">
                            <input type="file" name="lampiran" id="lampiran" class="form-control" >
                            <!-- <input type="file" class="custom-file-input" id="exampleInputFile"> -->
                            <label class="custom-file-label" for="lampiran">Choose file</label>
                            <p class="text-danger">{{ $errors->first('lampiran') }}</p>
                            </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                      <div class="d-flex flex-row justify-content-end">
                          <span class="mr-2">
                          <button type="submit" class="btn btn-danger">Cancel</button>
                          </span>
                          <span>
                          <button type="submit" class="btn btn-primary" id="submit">Submit</button>
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
<!-- DataTables -->
<script src="../../plugins/datatables/jquery.dataTables.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<script src="../../plugins/summernote/summernote-bs4.min.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();
  });
  $(document).ready(function(){   
    $('#pengumumanForm').on('submit', function(e){
        e.preventDefault();

        var judul = $('#judul').val();
        var deskripsi = $('#deskripsi').val();
        var lampiran = $('#lampiran').val();

        $.ajax({
            type: "POST",
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            url: "/api/admin/pengumuman/add",
            cache:false,
            dataType: "json",
            data: $('#pengumumanForm').serialize(),
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