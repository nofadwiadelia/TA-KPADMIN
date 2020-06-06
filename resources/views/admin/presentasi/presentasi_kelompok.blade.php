@extends('admin.base')
@section('content')
<!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3 class="m-0 text-dark">Jadwal Presentasi</h3>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Kelompok</li>
              <li class="breadcrumb-item active">Presentasi</li>
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
                  <a href="{{route('presentasi.create')}}" class="btn btn-success float-right btn-sm"><i class="fas fa-plus"></i> Buat Jadwal</a> <br><br>
                </div>
              <div class="card-primary">
                <div class="table-responsive p-0">
                  <table id="presentasi_data" class="table table-bordered table-striped ">
                    <thead>
                    <tr>
                      <th>Nama Kelompok</th>
                      <th>Periode</th>
                      <th>Dosen Pembimbing</th>
                      <th>Dosen Penguji</th>
                      <th>Tanggal</th>
                      <th>Waktu</th>
                      <th>Ruang</th>
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

<script src="../../plugins/moment/moment.min.js"></script>

<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();
  });

  $(document).ready(function(){
    fill_datatable();

    function fill_datatable(id_periode = ''){
      var dataTable = $('#presentasi_data').DataTable({
        processing: true,
        serverSide: true,
        ajax:{
          url: "/admin/presentasi",
          data:{id_periode:id_periode}
        },
        columns:[
          {
            data:'nama_kelompok',
            name:'nama_kelompok'
          },
          {
            data:'tahun_periode',
            name:'tahun_periode'
          },
          {
            data:'dosen_nama',
            name:'dosen_nama'
          },
          {
            data:'dosen.nama',
            name:'dosen.nama'
          },
          {
            data:'tanggal',
            name:'tanggal',
            render : function (data) {
            return moment(data).format('dddd, D MMMM YYYY');
            } 
          },
          {
            data:'sesi',
            name:'sesi'
            
          },
          {
            data:'ruang',
            name:'ruang'
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
    
      $('#presentasi_data').DataTable().destroy();
    
      fill_datatable(id_periode);
    });
  });

// DELETE
    $(document).on('click', '.deletePresentasi', function(){
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