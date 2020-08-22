@extends('admin.base')
@section('content')
<!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3 class="m-0 text-dark">Data Ruang</h3>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Master</li>
              <li class="breadcrumb-item active">Ruang</li>
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
                  <a href="javascript:void(0)" id="createNewRuang" class="btn btn-success float-right btn-sm addruang"><i class="fas fa-plus"></i> Tambah Ruang</a> <br><br>
                </div>
              <div class="card-primary">
                <div class="table-responsive p-0">
                  <table id="ruang_data" class="table table-bordered table-striped ">
                    <thead>
                    <tr>
                      <th>ID ruang</th>
                      <th>Nama Ruang</th>
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
                            <form id="RuangForm" name="RuangForm" class="form-horizontal">
                              <input type="hidden" name="id_ruang" id="id_ruang">
                                <div class="form-group">
                                    <label for="ruang" class="col-sm-2 control-label">Ruang</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="ruang" name="ruang" placeholder="Enter Name" value="" maxlength="50" required="">
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
    var dataTable = $('#ruang_data').DataTable({
      processing: true,
      serverSide: true,
      ajax:{
      url: "/admin/ruang",
      },
      columns:[
      {
        data: 'id_ruang',
        name: 'id_ruang'
      },
      {
        data: 'ruang',
        name: 'ruang'
      },
      {
        data: 'action',
        name: 'action',
        orderable: false
      }
      ]
    });
  }

    $('#createNewRuang').click(function () {
      $('#saveBtn').val("create-ruang");
      $('#id_ruang').val('');
      $('#RuangForm').trigger("reset");
      $('#modelHeading').html("Create New Ruang");
      $('#ajaxModel').modal('show');
    });

    
    $('body').on('click', '.editRuang', function () {
      var id_ruang = $(this).data('id');
      $.get("/api/admin/ruang/" + id_ruang , function (data) {
        var id_ruang = $(this).data('id');
          $('#modelHeading').html("Edit Ruang");
          $('#saveBtn').val("edit-user");
          $('#ajaxModel').modal('show');
          $('#id_ruang').val(data.id_ruang);
          $('#ruang').val(data.ruang);
      })
    });


  $('#saveBtn').click(function (e) {
      e.preventDefault();

      $.ajax({
        data: $('#RuangForm').serialize(),
        url: "/api/admin/ruang",
        type: "POST",
        dataType: 'json',
        success: function (data) {
          $('#ruang_data').DataTable().ajax.reload();
          $('#RuangForm').trigger("reset");
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

    // DELETE
    $(document).on('click', '.deleteRuang', function(){
      id_ruang = $(this).data("id");
      $('#confirmModal').modal('show');
    });
    $('#ok_button').click(function(){
      $.ajax({
          type: "PUT",
          headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
          dataType: "json",
          url: '/api/admin/ruang/'+id_ruang,
          success: function (data) {
            $('#confirmModal').modal('hide');
            window.location.reload();
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