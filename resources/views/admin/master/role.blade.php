@extends('admin.base')
@section('content')
<!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3 class="m-0 text-dark">Data Roles</h3>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Master</li>
              <li class="breadcrumb-item active">Roles</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body ">
                <div class="col-sm-12">
                  <a href="javascript:void(0)" id="createNewRoles" class="btn btn-success float-right btn-sm addrole"><i class="fas fa-plus"></i> Tambah Role</a> <br><br>
                </div>
              <div class="card-primary">
                <div class="table-responsive p-0">
                  <table id="role_data" class="table table-bordered table-striped ">
                    <thead>
                    <tr>
                      <th>ID role</th>
                      <th>Nama Role</th>
                      <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
                </div>

                <div class="modal fade" id="ajaxModel" aria-hidden="true">

                <div class="modal-dialog">

                    <div class="modal-content">

                        <div class="modal-header">

                            <h4 class="modal-title" id="modelHeading"></h4>

                        </div>

                        <div class="modal-body">
                            <form id="RolesForm" name="RolesForm" class="form-horizontal">
                              <input type="hidden" name="roles_id" id="roles_id">
                                <div class="form-group">
                                    <label for="roles" class="col-sm-2 control-label">Roles</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="roles" name="roles" placeholder="Enter Name" value="" maxlength="50" required="">
                                    </div>
                                </div>
                                <div class="col-sm-offset-2 col-sm-10">
                                <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes
                                </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
                
                


                <div id="confirmModal" class="modal fade" role="dialog">
                  <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Confirmation</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <h6 align="center" style="margin:0;">Anda yakin ingin menghapus data ini?</h6>
                        </div>
                        <div class="modal-footer">
                          <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                          <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        </div>
                      </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
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

<script src="../../plugins/moment/moment.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>

<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>


<!-- page script -->
<script type="text/javascript">
$(document).ready(function(){

    $.ajaxSetup({

      headers: {

          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')

      }

    });

    $('#role_data').DataTable({
      processing: true,
      serverSide: true,
      ajax:{
      url: "/admin/roles",
      },
      columns:[
      {
        data: 'id_roles',
        name: 'id_roles'
      },
      {
        data: 'roles',
        name: 'roles'
      },
      {
        data: 'action',
        name: 'action',
        orderable: false
      }
      ]
    });

    $('#createNewRoles').click(function () {
      $('#saveBtn').val("create-roles");
      $('#roles_id').val('');
      $('#RolesForm').trigger("reset");
      $('#modelHeading').html("Create New Roles");
      $('#ajaxModel').modal('show');
    });

    $('body').on('click', '.editRoles', function () {
      var roles_id = $(this).data('id');
      $.get("/admin/roles/" + roles_id , function (data) {
        var roles_id = $(this).data('id');
          $('#modelHeading').html("Edit Roles");
          $('#saveBtn').val("edit-user");
          $('#ajaxModel').modal('show');
          $('#roles_id').val(data.id_roles);
          $('#roles').val(data.roles);
      })
    });

    $('#saveBtn').click(function (e) {
      e.preventDefault();
      $.ajax({
        data: $('#RolesForm').serialize(),
        url: "/api/admin/roles",
        type: "POST",
        dataType: 'json',
        success: function (data) {
          $('#role_data').DataTable().ajax.reload();
          $('#RolesForm').trigger("reset");
          $('#ajaxModel').modal('hide');
        },
        error: function (data) {
            console.log('Error:', data);
            $('#saveBtn').html('Save Changes');

        }

      });

    });

  //  

    // DELETE
    $(document).on('click', '.deleteRoles', function(){
      roles_id = $(this).data("id");
      $('#confirmModal').modal('show');
    });
    $('#ok_button').click(function(){
      $.ajax({
          type: "DELETE",
          headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
          dataType: "json",
          url: '/api/admin/roles/'+roles_id,
          success: function (data) {
            $('#confirmModal').modal('hide');
            $('#role_data').DataTable().ajax.reload();
            toastr.options.closeButton = true;
            toastr.options.closeMethod = 'fadeOut';
            toastr.options.closeDuration = 100;
            toastr.success(data.message);
          }
      });
    });

});
</script>
@endsection