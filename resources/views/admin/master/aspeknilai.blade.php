@extends('admin.base')
@section('content')
<!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3 class="m-0 text-dark">Data Aspek Nilai</h3>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Data Master</li>
              <li class="breadcrumb-item active">Aspek nilai</li>
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
                  <a href="javascript:void(0)" id="createNewAspekNilai" class="btn btn-success float-right btn-sm addaspeknilai"><i class="fas fa-plus"></i> Tambah Aspek Nilai</a> <br><br>
                </div>
              <div class="card-primary">
                <div class="table-responsive p-0">
                  <table id="aspeknilai_data" class="table table-bordered table-striped ">
                    <thead>
                    <tr>
                      <th>ID aspeknilai</th>
                      <th>Nama aspeknilai</th>
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
                            <form id="AspeknilaiForm" name="AspeknilaiForm" class="form-horizontal">
                              <input type="hidden" name="id_aspek_penilaian" id="id_aspek_penilaian">
                                <div class="form-group">
                                    <label for="nama" class="col-sm-2 control-label">Nama</label>
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Enter Name" value="" maxlength="50" required="">
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
    var dataTable = $('#aspeknilai_data').DataTable({
      processing: true,
      serverSide: true,
      ajax:{
      url: "/admin/aspekpenilaian",
      },
      columns:[
      {
        data: 'id_aspek_penilaian',
        name: 'id_aspek_penilaian'
      },
      {
        data: 'nama',
        name: 'nama'
      },
      {
        data: 'action',
        name: 'action',
        orderable: false
      }
      ]
    });
  }

    $('#createNewAspekNilai').click(function () {
      $('#saveBtn').val("create-aspeknilai");
      $('#id_aspek_penilaian').val('');
      $('#AspeknilaiForm').trigger("reset");
      $('#modelHeading').html("Create New Aspek Nilai");
      $('#ajaxModel').modal('show');
    });

    
    $('body').on('click', '.editAspeknilai', function () {
      var id_aspek_penilaian = $(this).data('id');
      $.get("/api/admin/aspekpenilaian/" + id_aspek_penilaian , function (data) {
        var id_aspek_penilaian = $(this).data('id');
          $('#modelHeading').html("Edit Sesi");
          $('#saveBtn').val("edit-user");
          $('#ajaxModel').modal('show');
          $('#id_aspek_penilaian').val(data.id_aspek_penilaian);
          $('#nama').val(data.nama);
      })
    });


  $('#saveBtn').click(function (e) {
      e.preventDefault();

      $.ajax({
        data: $('#AspeknilaiForm').serialize(),
        url: "/api/admin/aspekpenilaian",
        type: "POST",
        dataType: 'json',
        success: function (data) {
          $('#aspeknilai_data').DataTable().ajax.reload();
          $('#AspeknilaiForm').trigger("reset");
          $('#ajaxModel').modal('hide');
        },
        error: function (data) {
            console.log('Error:', data);
            $('#saveBtn').html('Save Changes');
        }
      });
    });

    // DELETE
    $(document).on('click', '.deleteAspeknilai', function(){
      id_aspek_penilaian = $(this).data("id");
      $('#confirmModal').modal('show');
    });
    $('#ok_button').click(function(){
      $.ajax({
          type: "DELETE",
          headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
          dataType: "json",
          url: '/api/admin/aspekpenilaian/'+id_aspek_penilaian,
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