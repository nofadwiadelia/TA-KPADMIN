@extends('admin.base')
@section('content')
<!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0 text-dark">Admin</h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Admin</li>
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
                  <a href="/admin/admin/create" class="btn btn-success float-right btn-sm"><i class="fas fa-plus"></i> &nbsp; Tambah Admin</a> <br><br>
                </div>
              <div class="card-primary">
                <div class="table-responsive p-0">
                <table id="admin_data" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Nama</th>
                    <th>No.HP</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
                <div>

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

              <div>
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

  $(document).ready(function(){
    fill_datatable();

    function fill_datatable(id_periode = ''){
      var dataTable = $('#admin_data').DataTable({
        processing: true,
        serverSide: true,
        ajax:{
          url: "/admin/daftaradmin",
        },
        columns:[
          {
            data:'nama',
            name:'nama'
          },
          {
            data:'no_hp',
            name:'no_hp'
          },
          {
            data:'email',
            name:'email'
          },
          {
            data:'roles',
            name:'roles'
          },
          {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
      });
    }

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
          success: function (data) {
              $('#confirmModal').modal('hide');
              $('#admin_data').DataTable().ajax.reload();
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