@extends('admin.base')
@section('content')
<!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0 text-dark">Mahasiswa</h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Mahasiswa</li>
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
                            @foreach($periode as $row)
                            <option value="{{ $row->id_periode }}">Periode {{ $row->tahun_periode }}</option>
                            @endforeach
                          </select>
                      </div>
                  </div>
                </form>
                <div class="col-sm-12">
                  <a href="/admin/mahasiswa/create" class="btn btn-success float-right btn-sm"><i class="fas fa-plus"></i> &nbsp; Tambah Mahasiswa</a> <br><br>
                </div>
                <!-- <div class="col-sm-12">
                  <a href="{{ route('exportmahasiswa') }}" class="btn btn-primary float-right btn-sm"><i class="fas fa-download"></i> &nbsp; Export to Excel</a> <br><br>
                </div> -->
              <div class="card-primary">
                <div class="table-responsive p-0">
                <table id="mahasiswa_data" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Periode</th>
                    <th>Kelompok</th>
                    <th>Status</th>
                    <th>Status Magang</th>
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
      var dataTable = $('#mahasiswa_data').DataTable({
        processing: true,
        serverSide: true,
        ajax:{
          url: "/admin/mahasiswa",
          data:{id_periode:id_periode}
        },
        columns:[
          {
            data: 'DT_RowIndex', 
            name: 'DT_RowIndex', 
            orderable: false,
            searchable: false
          },
          {
            data:'nim',
            name:'nim'
          },
          {
            data:'nama',
            name:'nama'
          },
          {
            data:'tahun_periode',
            name:'tahun_periode'
          },
          {
            data:'nama_kelompok',
            name:'nama_kelompok',
          },
          {
            data:'status_keanggotaan',
            name:'status_keanggotaan'
          },
          {
            data:'status',
            name:'status',
            render: function(data, type, full, meta){
              if (data == 'belummagang'){
                return "<span class='badge bg-warning'>"+ data + "</span>";
              }else if(data == 'magang'){
                return "<span class='badge bg-info'>"+ data + "</span>";
              }else if(data == 'selesai'){
                return "<span class='badge bg-success'>"+ data + "</span>";
              }else{
                return "<span class='badge bg-warning'>belum magang</span>";
              }
            },
            orderable: false
          },
          {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
      });
    }
    
    $('#periode_filter').change(function(){
      var id_periode = $('#periode_filter').val();
    
      $('#mahasiswa_data').DataTable().destroy();
    
      fill_datatable(id_periode);
    });
  });

  $(document).on('click', '.deleteUser', function(){
    user_id = $(this).attr('id');
    $('#confirmModal').modal('show');
  });
  $('#ok_button').click(function(){
    $.ajax({
        type: "PUT",
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        dataType: "json",
        url: '/api/admin/mahasiswa/delete/'+user_id,
        success: function (data) {
            $('#confirmModal').modal('hide');
            $('#mahasiswa_data').DataTable().ajax.reload();
            toastr.options.closeButton = true;
            toastr.options.closeMethod = 'fadeOut';
            toastr.options.closeDuration = 100;
            toastr.success(data.message);
        }
    });
  });
</script>
@endsection