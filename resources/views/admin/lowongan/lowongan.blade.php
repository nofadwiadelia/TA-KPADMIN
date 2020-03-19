@extends('admin.base')
@section('content')
<!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0 text-dark">Manajemen Lowongan</h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Lowongan</li>
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
              <form role="form">
                  <div class="col-sm-4">
                    <p>Saring berdasarkan</p>
                      <!-- select -->
                      <div class="form-group">
                          <select name="periode_filter" id="periode_filter" class="form-control form-control-sm">
                            <option selected>Semua Periode</option>
                            @foreach($periode as $row)
                            <option value="{{ $row->id_periode }}">{{ $row->tahun_periode }}</option>
                            @endforeach
                          </select>
                      </div>
                  </div>
                </form>
                <div class="col-sm-12">
                  <a href="{{route('lowongan.create')}}" class="btn btn-success float-right btn-sm"><i class="fas fa-plus"></i> Tambah Lowongan</a> <br><br>
                </div>
              <div class="card-primary">
                <div class="table-responsive p-0">
                  <table id="lowongan_data" class="table table-bordered table-striped ">
                    <thead>
                    <tr>
                      <th>Posisi</th>
                      <th>Persyaratan</th>
                      <th>Kapasistas</th>
                      <th>Instansi</th>
                      <th>Detail</th>
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

    function fill_datatable(id_periode = ''){
      var dataTable = $('#lowongan_data').DataTable({
        processing: true,
        serverSide: true,
        ajax:{
          url: "/admin/lowongan",
          data:{id_periode:id_periode}
        },
        columns:[
          {
            data:'pekerjaan',
            name:'pekerjaan'
          },
          {
            data:'persyaratan',
            name:'persyaratan'
          },
          {
            data:'kapasitas',
            name:'kapasitas'
          },
          {
            data:'nama',
            name:'nama'
          },
          {
            data:'id_lowongan',
            name:'id_lowongan',
            render: function(data, type, full, meta){
              return '<a href="/admin/lowongan/'+data+'" class="btn btn-sm btn-warning editbtn"><i class="fa fa-arrow-right"></i></a>';
            },
            orderable: false
          },
          {
            data: 'action',
            name: 'action', 
            orderable: false, 
            searchable: false
          },
        ]
      });
    }
    
    $('#periode_filter').change(function(){
      var id_periode = $('#periode_filter').val();
    
      $('#lowongan_data').DataTable().destroy();
    
      fill_datatable(id_periode);
    });
  });

    $(document).on('click', '.deleteUser', function(){
      lowongan_id = $(this).attr('id');
      $('#confirmModal').modal('show');
    });
    $('#ok_button').click(function(){
      $.ajax({
          type: "DELETE",
          headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
          dataType: "json",
          url: '/api/admin/lowongan/'+lowongan_id,
          beforeSend:function(){
            $('#ok_button').text('Deleting...');
          },
          success: function (data) {
            $('#confirmModal').modal('hide');
            $('#lowongan_data').DataTable().ajax.reload();
            toastr.options.closeButton = true;
            toastr.options.closeMethod = 'fadeOut';
            toastr.options.closeDuration = 100;
            toastr.success(data.message);
          }
      });
      });
  </script>
  @endsection