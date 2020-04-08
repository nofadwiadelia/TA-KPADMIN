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
                <li class="breadcrumb-item active">Daftar Akun</li>
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
                            <form action="{{ route('users.update', $data->id_users) }}" method="post" >
                            {{ csrf_field() }}
                            {{ method_field('PUT') }}
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="nama" class="col-sm-3 col-form-label">Nama Lengkap *</label>
                                        <div class="col-sm-9">
                                        @if ($data->id_roles == 2)
                                          <input type="text" class="form-control" required name="nama" value="{{ $data->dosen->nama }}">
                                        @endif
                                        @if($data->id_roles == 3)
                                          <input type="text" class="form-control" required name="nama" value="{{ $data->instansi->nama }}">
                                        @endif
                                        @if($data->id_roles == 4)
                                          <input type="text" class="form-control" required name="nama" value="{{ $data->mahasiswa->nama }}">
                                        @endif
                                       
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="teusernamext" class="col-sm-3 col-form-label">Username *</label>
                                        <div class="col-sm-9">
                                        <input type="text" class="form-control" required name="username" value="{{ $data->username }}">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="id_roles" class="col-sm-3 col-form-label">Role *</label>
                                        <div class="col-sm-9">
                                          <select name="id_roles" class="form-control select2" style="width: 100%;">
                                              <option selected disabled>Pilih Role</option>
                                              @foreach($roles as $role)
                                              <option value="{{ $role->id_roles }}">{{ $role->roles }}</option>
                                              @endforeach
                                          </select >
                                        </div>
                                    </div>
                                    <div class="row justify-content-center">
                                      <!-- <a  data-toggle="modal" data-target="#modal-default">
                                        Change Password
                                      </a> -->
                                      <a href="javascript:void(0)"  data-id="{{  $data->id_users }}" class="edit btn btn-sm btn-info editPassword">Edit Password</a>
                                    </div>
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

    $(document).on('click', '.editPassword', function(){
      id_users = $(this).data("id");
      $('#id_users').val(id_users);
      $('#password').val();
      $('#modal-edit').modal('show');
      $('#saveBtn').val("edit-password");
    });

    $('#saveBtn').click(function (e) {
      e.preventDefault();

      $.ajax({
        data: $('#updatePassword').serialize(),
        url: "/api/admin/password/"+id_users,
        type: "PUT",
        dataType: 'json',
        success: function (data) {
          $('#modal-edit').modal('hide');
          toastr.options.closeButton = true;
          toastr.options.closeMethod = 'fadeOut';
          toastr.options.closeDuration = 100;
          toastr.success(data.message);
        },
        error: function (data) {
            console.log('Error:', data);
            $('#saveBtn').html('Save Changes');
        }
      });
    });
  
});
</script>
@endsection