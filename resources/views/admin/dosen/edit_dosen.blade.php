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
                        <div class="card-body">
                          <div class="col-4">
                            <div class="row">
                              @if (!empty($dosen->foto))
                              <img src="{{ asset('uploads/users/admin/' . $dosen->foto) }}" 
                                  alt="{{ $dosen->nama }}" width="200px" height="250px">
                              @else
                              <img src="{{ asset('dist/img/default-avatar.png') }}" 
                                  alt="{{ $dosen->nama }}" width="200px" height="250px">
                              @endif
                            </div>
                            
                          </div>
                        </div>
                        <div class="col-8">
                            <form id="editDosen" method="post" >
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="nama" class="col-sm-3 col-form-label">Nama Lengkap *</label>
                                        <div class="col-sm-9">
                                        <input type="text" class="form-control" required name="nama" value="{{ $dosen->nama }}">                                       
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="nama" class="col-sm-3 col-form-label">NIP *</label>
                                        <div class="col-sm-9">
                                        <input type="text" class="form-control" required name="nip" value="{{ $dosen->nip }}">                                       
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                      <label for="email" class="col-sm-3 col-form-label">Email *</label>
                                      <div class="col-sm-9">
                                      <input type="text" class="form-control" name="email" value="{{ $dosen->email }}">
                                      </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="no_hp" class="col-sm-3 col-form-label">No HP *</label>
                                        <div class="col-sm-9">
                                        <input type="text" class="form-control" name="no_hp" value="{{ $dosen->no_hp }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="username" class="col-sm-3 col-form-label">Username *</label>
                                        <div class="col-sm-9">
                                        <input type="text" class="form-control" required name="username" value="{{ $dosen->users->username }}">
                                        </div>
                                    </div>
                                    
                                    <div class="row justify-content-center">
                                      <!-- <a  data-toggle="modal" data-target="#modal-default">
                                        Change Password
                                      </a> -->
                                      <a href="javascript:void(0)"  data-id="{{  $dosen->id_users }}" class="edit btn btn-sm btn-info editPassword">Edit Password</a>
                                    </div><br>
                                    <input type="hidden" name="id_users" id="id_users" value="{{ $dosen->id_users }}">
                                    <div class="d-flex flex-row justify-content-end">
                                        <span class="mr-2">
                                        <input type="submit" class="btn btn-danger" value="Cancel" />
                                        </span>
                                        <span>
                                        <input type="submit" class="btn btn-primary" value="Submit" />
                                        </span>
                                   </div>
                                </div>
                                <!-- /.card-body -->
                            </form>

                              <div class="modal fade" id="modal-edit">
                                <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h4 class="modal-title">Change Password</h4>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <form id="updatePassword">
                                      <div class="modal-body">
                                        <div class="form-group row">
                                          <label for="password" class="col-sm-3 col-form-label">Password *</label>
                                          <div class="col-sm-9">
                                          <input type="hidden" name="id_users" id="id_users">
                                          <input type="password" class="form-control" name="password" id="password" value="">
                                          </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="password" class="col-sm-3 col-form-label">Confirm Password *</label>
                                            <div class="col-sm-9">
                                            <input type="password" class="form-control" name="password" id="password" value="">
                                            </div>
                                        </div>
                                      </div>
                                      <div class="modal-footer justify-content-between">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button id="saveBtn" type="submit" class="btn btn-primary">Save changes</button>
                                      </div>
                                    </form>
                                  </div>
                                  <!-- /.modal-content -->
                                </div>
                                <!-- /.modal-dialog -->
                              </div>
                              <!-- /.modal -->
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

<script >
$(document).ready(function(){   

    $('#editDosen').on('submit', function(e){
      e.preventDefault();
      var id = $('#id_users').val();
      $.ajax({
          type: "POST",
          headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
          url: "/api/admin/dosen/"+id,
          dataType:'JSON',
          contentType: false,
          cache: false,
          processData: false,
          data: new FormData(this),
          success: function(data){
              window.location = "/admin/dosen/";
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


    $(document).on('click', '.editPassword', function(){
      id_users = $(this).data("id");
      $('#id_users').val(id_users);
      $('#password').val();
      $('#modal-edit').modal('show');
      $('#saveBtn').val("edit-password");
    });
    
  
});
</script>
@endsection