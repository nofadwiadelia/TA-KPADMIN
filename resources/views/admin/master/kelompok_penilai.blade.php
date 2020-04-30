@extends('admin.base')
@section('content')
<!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3 class="m-0 text-dark">Data Kelompok Penilai</h3>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Master</li>
              <li class="breadcrumb-item active">Kelompok Penilai</li>
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
                  <a href="javascript:void(0)" id="createNewPenilai" class="btn btn-success float-right btn-sm addpenilai"><i class="fas fa-plus"></i> Tambah Kelompok Penilai</a> <br><br>
                </div>
              <div class="card-primary">
                <div class="table-responsive p-0">
                  <table id="penilai_data" class="table table-bordered table-striped ">
                    <thead>
                    <tr>
                      <th>ID Kelompok Penilai</th>
                      <th>Nama</th>
                      <th>Prsesntase</th>
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
                            <form id="PenilaiForm" name="PenilaiForm" class="form-horizontal">
                              <input type="hidden" name="id_kelompok_penilai" id="id_kelompok_penilai">
                                <div class="form-group">
                                  <label for="nama" class="col-sm-2 control-label">Nama</label>
                                  <div class="col-sm-12">
                                      <input type="text" class="form-control" id="nama" name="nama" placeholder="Enter Name" value="" maxlength="50" required="">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label for="presentase" class="col-sm-2 control-label">Presentase</label>
                                  <div class="col-sm-12">
                                      <input type="text" class="form-control" id="presentase" name="presentase" placeholder="Enter Presentase" value="" maxlength="50" required="">
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
    var dataTable = $('#penilai_data').DataTable({
      processing: true,
      serverSide: true,
      ajax:{
      url: "/admin/kelompokpenilai",
      },
      columns:[
      {
        data: 'id_kelompok_penilai',
        name: 'id_kelompok_penilai'
      },
      {
        data: 'nama',
        name: 'nama'
      },
      {
        data: 'presentase',
        name: 'presentase'
      },
      {
        data: 'action',
        name: 'action',
        orderable: false
      }
      ]
    });
  }

    $('#createNewPenilai').click(function () {
      $('#saveBtn').val("create-penilai");
      $('#id_kelompok_penilai').val('');
      $('#PenilaiForm').trigger("reset");
      $('#modelHeading').html("Create New Kelompok Penilai");
      $('#ajaxModel').modal('show');
    });

    
    $('body').on('click', '.editPenilai', function () {
      var id_kelompok_penilai = $(this).data('id');
      $.get("/api/admin/kelompokpenilai/" + id_kelompok_penilai , function (data) {
        var id_kelompok_penilai = $(this).data('id');
          $('#modelHeading').html("Edit Kelompok Penilai");
          $('#saveBtn').val("edit-penilai");
          $('#ajaxModel').modal('show');
          $('#id_kelompok_penilai').val(data.id_kelompok_penilai);
          $('#nama').val(data.nama);
          $('#presentase').val(data.presentase);
      })
    });


  $('#saveBtn').click(function (e) {
      e.preventDefault();

      $.ajax({
        data: $('#PenilaiForm').serialize(),
        url: "/api/admin/kelompokpenilai",
        type: "POST",
        dataType: 'json',
        success: function (data) {
          $('#penilai_data').DataTable().ajax.reload();
          $('#PenilaiForm').trigger("reset");
          $('#ajaxModel').modal('hide');
        },
        error: function (data) {
            console.log('Error:', data);
            $('#saveBtn').html('Save Changes');
        }
      });
    });

    // DELETE
    $(document).on('click', '.deletePenilai', function(){
      id_kelompok_penilai = $(this).data("id");
      $('#confirmModal').modal('show');
    });
    $('#ok_button').click(function(){
      $.ajax({
          type: "DELETE",
          headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
          dataType: "json",
          url: '/api/admin/kelompokpenilai/'+id_kelompok_penilai,
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