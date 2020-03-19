@extends('admin.base')
@section('content')
<!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0 text-dark">Daftar Akun</h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User Management</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
          @if (Session::has('alert-success'))
              <div class="alert alert-success">
                  <strong>{{ \Illuminate\Support\Facades\Session::get('alert-success') }}</strong>
              </div>
            @endif
            <div class="card-body">
              <form role="form">
                  <div class="col-sm-4">
                    <p>Saring berdasarkan</p>
                      <!-- select -->
                      <div class="form-group">
                          <select name="roles_filter" id="roles_filter" class="form-control form-control-sm">
                            <option selected>Semua User</option>
                            @foreach($roles as $role)
                            <option value="{{ $role->id_roles }}">{{ $role->roles }}</option>
                            @endforeach
                          </select>
                      </div>
                  </div>
                </form>
                <form role="form">
                  <div class="col-sm-12">
                  <a href="{{route('users.create')}}" class="btn btn-success float-right btn-sm"><i class="fas fa-plus"></i> Tambah Baru</a> <br><br>
                  </div>
                </form>
              <div class="card-primary">
                <div class="card-body table-responsive p-0">
                  <table id="user_data" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th>Nama</th>
                      <th>Username</th>
                      <th>Role</th>
                      <th>Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                    </tbody>
                  </table>
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
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();
  });

  $(document).ready(function(){
    fill_datatable();

    function fill_datatable(id_roles = ''){
      var dataTable = $('#user_data').DataTable({
        processing: true,
        serverSide: true,
        ajax:{
          url: "{{route('users.index')}}",
          data:{id_roles:id_roles}
        },
        columns:[
          {
            data:'username',
            name:'username'
          },
          {
            data:'username',
            name:'username'
          },
          {
            data:'roles',
            name:'roles'
          },
          {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
      });
    }
    
    $('#roles_filter').change(function(){
      var id_roles = $('#roles_filter').val();
    
      $('#user_data').DataTable().destroy();
    
      fill_datatable(id_roles);
    });
  });

  $(document).on('click', '.deleteUser', function(){
    user_id = $(this).attr('id');
    $('#confirmModal').modal('show');
  });
  $('#ok_button').click(function(){
    $.ajax({
        type: "DELETE",
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        dataType: "json",
        url: '/api/admin/users/'+user_id,
        beforeSend:function(){
          $('#ok_button').text('Deleting...');
        },
        success: function (data) {
            $('#confirmModal').modal('hide');
            $('#user_data').DataTable().ajax.reload();
            toastr.options.closeButton = true;
            toastr.options.closeMethod = 'fadeOut';
            toastr.options.closeDuration = 100;
            toastr.success(data.message);
        }
    });
  });
</script>
@endsection