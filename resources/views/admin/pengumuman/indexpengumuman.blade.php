@extends('admin.base')
@section('content')
<!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0 text-dark">Pengumuman</h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Pengumuman</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <!-- /.card-header -->
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
                <form role="form">
                  <div class="col-sm-12">
                  <a href="{{route('pengumuman.create')}}" class="btn btn-success float-right btn-sm"><i class="fas fa-plus"></i> Tambah Pengumuman</a> <br><br>
                  </div>
                </form>
              <div class="card-primary">
                <div class="table-responsive p-0">
                  <table id="pengumuman_data" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                      <th width="5%">No</th>
                      <th>Judul</th>
                      <th>deskripsi</th>
                      <th width="5%">Lampiran</th>
                      <th width="10%">Aksi</th>
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

                  <div class="modal fade" id="surat">
                      <div class="modal-dialog modal-lg">
                          <div class="modal-content">
                              <div class="modal-header">
                              <h5 class="modal-title judul"></h5>
                                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                  </button>
                              </div>

                              <div class="modal-body">
                                  <div class="row justify-content-center" id="suratLampiran">
                                        
                                  </div>
                                  <div class="modal-footer">
                                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                  </div>
                              </div>
                          </div>
                          <!-- /.modal-content -->
                      </div>
                      <!-- /.modal-dialog -->
                  </div>
                  <!-- /.modal -->

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
  $(document).ready(function(){
    fill_datatable();

    function fill_datatable(id_periode = ''){
      var dataTable = $('#pengumuman_data').DataTable({
        processing: true,
        serverSide: true,
        ajax:{
          url: "{{route('pengumuman.index')}}",
          data:{id_periode:id_periode}
        },
        columns:[
          {data: 'DT_RowIndex', 
          name: 'DT_RowIndex', 
          orderable: false,
          searchable: false
          },
          {
            data:'judul',
            name:'judul'
          },
          {
            data:'deskripsi',
            name:'deskripsi'
          },
          {
            data:'lampiran',
            name:'lampiran',
            orderable: false, searchable: false
          },
          {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
      });
    }
    $('#periode_filter').change(function(){
      var id_periode = $('#periode_filter').val();
    
      $('#pengumuman_data').DataTable().destroy();
    
      fill_datatable(id_periode);
    });
  });

  $(document).on('click','.showlamp', function(){
    id = $(this).attr('id');
    $('#surat').modal('show');
    $.ajax({
      url: '/api/admin/pengumuman/'+id,
      method: 'GET',
      dataType: 'JSON',
      data: {id_pengumuman: id},
      success: function (response) {
          var lampiran = "<iframe src={{ URL::to('/') }}/uploads/pengumuman/" + response.lampiran + " width='700px' height='700px' frameborder='0' ></iframe>";
          $("#suratLampiran").html(lampiran);
          $('#surat').modal({
              backdrop: 'static',
              keyboard: true,
              show: true
          });
      }
    });
  });

  $(document).on('click', '.deletePengumuman', function(){
    pengumuman_id = $(this).attr('id');
    $('#confirmModal').modal('show');
  });

  $('#ok_button').click(function(){
    $.ajax({
        type: "DELETE",
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        dataType: "json",
        url: '/api/admin/pengumuman/'+pengumuman_id,
        success: function (data) {
          $('#confirmModal').modal('hide');
            $('#pengumuman_data').DataTable().ajax.reload();
            toastr.options.closeButton = true;
            toastr.options.closeMethod = 'fadeOut';
            toastr.options.closeDuration = 100;
            toastr.success(data.message);
        }
    });
  });
</script>
@endsection