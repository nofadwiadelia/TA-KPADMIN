@extends('admin.base')
@section('content')
<!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3 class="m-0 text-dark">Data Sesi</h3>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Master</li>
              <li class="breadcrumb-item active">Sesi</li>
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
                  <a href="javascript:void(0)" id="createNewSesi" class="btn btn-success float-right btn-sm addsesi"><i class="fas fa-plus"></i> Tambah Sesi</a> <br><br>
                </div>
              <div class="card-primary">
                <div class="table-responsive p-0">
                  <table id="sesi_data" class="table table-bordered table-striped ">
                    <thead>
                    <tr>
                      <th>ID sesi</th>
                      <th>Sesi</th>
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
                            <form id="SesiForm" name="SesiForm" class="form-horizontal">
                              <input type="hidden" name="id_sesiwaktu" id="id_sesiwaktu">
                                <div class="form-group">
                                    <label for="sesi" class="col-sm-2 control-label">Sesi</label>
                                    <div class="col-sm-12">
                                        <input type="time" class="form-control" id="sesi" name="sesi" placeholder="Enter Name" value="" maxlength="50" required="">
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



<!-- page script -->
<script type="text/javascript">
$(document).ready(function(){

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

  fill_datatable();
  function fill_datatable(){
    var dataTable = $('#sesi_data').DataTable({
      processing: true,
      serverSide: true,
      ajax:{
      url: "/admin/sesi",
      },
      columns:[
      {
        data: 'id_sesiwaktu',
        name: 'id_sesiwaktu'
      },
      {
        data: 'sesi',
        name: 'sesi'
      },
      {
        data: 'action',
        name: 'action',
        orderable: false
      }
      ]
    });
  }

    $('#createNewSesi').click(function () {
      $('#saveBtn').val("create-Sesi");
      $('#id_sesiwaktu').val('');
      $('#SesiForm').trigger("reset");
      $('#modelHeading').html("Create New Sesi");
      $('#ajaxModel').modal('show');
    });

    $('body').on('click', '.editSesi', function () {
      var id_sesiwaktu = $(this).data('id');
      $.get("/api/admin/sesi/" + id_sesiwaktu , function (data) {
        var id_sesiwaktu = $(this).data('id');
          $('#modelHeading').html("Edit Sesi");
          $('#saveBtn').val("edit-user");
          $('#ajaxModel').modal('show');
          $('#id_sesiwaktu').val(data.id_sesiwaktu);
          $('#sesi').val(data.sesi);
      })
    });

    $('#saveBtn').click(function (e) {
      e.preventDefault();

      $.ajax({
        data: $('#SesiForm').serialize(),
        url: "/api/admin/sesi",
        type: "POST",
        dataType: 'json',
        success: function (data) {
          $('#sesi_data').DataTable().ajax.reload();
          $('#SesiForm').trigger("reset");
          $('#ajaxModel').modal('hide');
          toastr.options.closeButton = true;
          toastr.options.closeMethod = 'fadeOut';
          toastr.options.closeDuration = 100;
          toastr.success(data.success);
        },
        error: function(xhr, status, error) 
        {
              $.each(xhr.responseJSON.errors, function (key, item) 
              {
               
                toastr.options.closeButton = true;
                toastr.options.closeMethod = 'fadeOut';
                toastr.options.closeDuration = 200;
                toastr.error(item);
              });

        }
      });
    });

  //  

    // DELETE
    $(document).on('click', '.deleteSesi', function(){
      id_sesiwaktu = $(this).data("id");
      $('#confirmModal').modal('show');
    });
    $('#ok_button').click(function(){
      $.ajax({
          type: "PUT",
          headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
          dataType: "json",
          url: '/api/admin/sesi/'+id_sesiwaktu,
          success: function (data) {
            $('#confirmModal').modal('hide');
            $('#sesi_data').DataTable().ajax.reload();
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