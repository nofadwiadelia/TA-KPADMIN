@extends('admin.base')
@section('content')
<!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0 text-dark">Persetujuan Kelompok</h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Persetujuan</li>
              <li class="breadcrumb-item active">Kelompok</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data Pengajuan Kelompok</h3>
            </div>
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
                <a href="/admin/kelompok/create" class="btn btn-success float-right btn-sm"><i class="fas fa-plus"></i> &nbsp; Buat Kelompok</a> <br><br>
              </div>
              <div class="card-primary">
                <div class="table-responsive p-0">
                <table id="persetujuan_data" class="table table-bordered table-striped ">
                  <thead>
                  <tr>
                  
                    <th scope="col">No</th>
                    <th scope="col">Periode</th>
                    <th scope="col">Nama Kelompok</th>
                    <th scope="col">Ketua</th>
                    <th scope="col">Dosen Pembimbing</th>
                    <th scope="col">Status</th>
                    <th scope="col">Pesetujuan</th>
                    <th scope="col">Detail</th>
                  </tr>
                  </thead>
                  <tbody>
                </table>
                </div>
              </div>

              <div id="confirmTolak" class="modal fade" role="dialog">
                  <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Confirmation</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <h6 align="center" style="margin:0;">Anda yakin ingin menolak kelompok?</h6>
                        </div>
                        <div class="modal-footer">
                          <button type="button" name="button_tolak" id="button_tolak" class="btn btn-danger">OK</button>
                          <button type="reset" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        </div>
                      </div>
                  </div>
                </div>

              <div class="modal fade" id="modal-default">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Pilih dosen pembimbing</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                      <form id="dosenForm">
                      <div class="modal-body">
                          <div class="form-group row">
                            <label for="password" class="col-sm-3 col-form-label">Dosen Pembimbing*</label>
                            <div class="col-sm-9">
                              <select name="id_dosen" id="id_dosen" class="form-control select2" style="width: 100%;">
                                  <option selected disabled>Pilih Dosen</option>
                                  @foreach($dosen as $dosens)
                                  <option value="{{ $dosens->id_dosen }}">{{ $dosens->nama }}</option>
                                  @endforeach
                              </select >
                            </div>
                          </div>
                      </div>
                      <div class="modal-footer justify-content-between">
                        <button type="submit" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary" id="submit">Submit</button>
                      </div>
                      </form>
                  </div>
                  <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
              </div>
              <!-- /.modal -->

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
                          <button type="reset" class="btn btn-default" data-dismiss="modal">Cancel</button>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

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
      var dataTable = $('#persetujuan_data').DataTable({
        processing: true,
        serverSide: true,
        ajax:{
          url: "/admin/persetujuan_kelompok",
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
            data:'tahun_periode',
            name:'tahun_periode'
          },
          {
            data:'nama_kelompok',
            name:'nama_kelompok'
          },
          {
            data:'nama',
            name:'nama'
          },
          {
            data:'dosen_nama',
            name:'dosen_nama'
          },
          {
            data:'tahap',
            name:'tahap',
            render: function(data, type, full, meta){
              if (data == 'diproses'){
                return "<span class='badge bg-warning'>"+ data + "</span>";
              }else if(data == 'diterima'){
                return "<span class='badge bg-success'>"+ data + "</span>";
              }else if(data =='ditolak'){
                return "<span class='badge bg-danger'>"+ data + "</span>"
              }
            },
            orderable: false
          },
          {
            data: 'action',
            name: 'action', 
            orderable: false, 
            searchable: false
          },
          {
            data: 'detail',
            name: 'detail', 
            orderable: false, 
            searchable: false
          },
        ]
      });
    }
    
    $('#periode_filter').change(function(){
      var id_periode = $('#periode_filter').val();
    
      $('#persetujuan_data').DataTable().destroy();
    
      fill_datatable(id_periode);
    });
  });

    $(document).on('click','.editbtn', function(){
        id_kelompok = $(this).attr('id');
        $('#modal-default').modal('show');

        $tr = $(this).closest('tr');

        var data = $tr.children("td").map(function(){
          return $(this).text();
        }).get();

        console.log(data);
        $('#id_dosen').val(data[2]);
    });
    
    $('#dosenForm').on('submit', function(e){
      e.preventDefault();

      var id_dosen = $('#id_dosen').val();

      $.ajax({
          type: "POST",
          headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
          url: "/api/admin/persetujuan_kelompoks/",
          cache:false,
          dataType: "json",
          data: {'id_dosen': id_dosen,'id_kelompok': id_kelompok},
          success: function(data){
              console.log(data);
              $("#modal-default").modal('hide');
              toastr.options.closeButton = true;
              toastr.options.closeMethod = 'fadeOut';
              toastr.options.closeDuration = 100;
              toastr.success(data.message);
              $('#persetujuan_data').DataTable().ajax.reload();
          },
          error: function(error){
            console.log(error);
          }
      });
    });

// DECLINE
      $(document).on('click', '.declinebtn', function(){
        id_kelompok = $(this).attr('id');
        $('#confirmTolak').modal('show');
      });
      $('#button_tolak').click(function(){
        $.ajax({
            type: "POST",
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            url: "/api/admin/tolak_kelompok/",
            cache:false,
            dataType: "json",
            data: {'id_kelompok': id_kelompok},
            success: function(data){
              $('#confirmTolak').modal('hide');
              toastr.options.closeButton = true;
              toastr.options.closeMethod = 'fadeOut';
              toastr.options.closeDuration = 100;
              toastr.success(data.message);
              $('#persetujuan_data').DataTable().ajax.reload();
            },
            error: function(error){
              console.log(error);
            }
        });
      });

  
  // DELETE
  $(document).on('click', '.deleteKelompok', function(){
    id_kelompok = $(this).attr('id');
    $('#confirmModal').modal('show');
  });
  $('#ok_button').click(function(){
    $.ajax({
        type: "PUT",
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        dataType: "json",
        url: '/api/admin/kelompok/'+id_kelompok,
        success: function (data) {
            $('#confirmModal').modal('hide');
            $('#persetujuan_data').DataTable().ajax.reload();
            toastr.options.closeButton = true;
            toastr.options.closeMethod = 'fadeOut';
            toastr.options.closeDuration = 100;
            toastr.success(data.message);
        }
    });
  });

</script>
@endsection