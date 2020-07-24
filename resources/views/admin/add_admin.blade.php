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
                <li class="breadcrumb-item active">Admin</li>
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
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-8">
                          <div class="card-body">
                              <form id="addAdmin" method="post" enctype="multipart/form-data">
                                  <div class="form-group row">
                                      <label for="nama" class="col-sm-3 col-form-label">Nama Lengkap *</label>
                                      <div class="col-sm-9">
                                      <input type="text" class="form-control" required name="nama" placeholder="">
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                      <label for="email" class="col-sm-3 col-form-label">Email *</label>
                                      <div class="col-sm-9">
                                      <input type="text" class="form-control" required name="email" placeholder="">
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                      <label for="no_hp" class="col-sm-3 col-form-label">No HP *</label>
                                      <div class="col-sm-9">
                                      <input type="text" class="form-control" required name="no_hp" placeholder="">
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                    <label for="exampleInputFile" class="col-sm-3 col-form-label">Foto</label>
                                      <div class="col-sm-9"> 
                                        <div class="input-group">
                                          <div class="custom-file">
                                            <input type="file" name="foto" id="foto" class="form-control" >
                                            <label class="custom-file-label" for="foto">Choose file</label>
                                          </div>
                                        </div>
                                      </div>
                                      <p class="text-muted"><small><i>*jpg,png,jpeg</i></small></p>
                                  </div>
                                  <div class="form-group row">
                                      <label for="teusernamext" class="col-sm-3 col-form-label">Username*</label>
                                      <div class="col-sm-9">
                                      <input type="text" class="form-control" required name="username" placeholder="">
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                      <label for="password" class="col-sm-3 col-form-label">Password *</label>
                                      <div class="col-sm-9">
                                      <input type="password" class="form-control" name="password" placeholder="">
                                      </div>
                                  </div>
                                  <div class="form-group row">
                                      <label for="password" class="col-sm-3 col-form-label">Confirm Password *</label>
                                      <div class="col-sm-9">
                                      <input type="password" class="form-control" required name="password" placeholder="">
                                      </div>
                                  </div>
                                  <input type="hidden" class="form-control" required name="created_by" value="{{$userId}}">
                                  <input type="hidden" class="form-control" required name="created_by" value="{{$userId}}">
                                  <div class="d-flex flex-row justify-content-end">
                                      <span class="mr-2">
                                      <button type="" class="btn btn-danger"> Cancel </button>
                                      </span>
                                      <span>
                                      <button type="submit" class="btn btn-primary addbtn"> Submit </button>
                                      </span>
                                  </div><br>
                              </form>
                            </div>
                            <!-- /.card-body -->
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
<!-- DataTables -->
<script src="../../plugins/datatables/jquery.dataTables.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- page script -->
<script>
  $(document).ready(function(){   
    $('#addAdmin').on('submit', function(e){
        e.preventDefault();

        $.ajax({
            type: "POST",
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            url: "/api/admin/admin/add",
            dataType:'JSON',
            contentType: false,
            cache: false,
            processData: false,
            data: new FormData(this),
            success: function(data){
                window.location = "/admin/daftaradmin/";
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