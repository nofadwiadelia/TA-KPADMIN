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
              <table id="example1" class="table table-bordered table-striped ">
                <thead>
                <tr>
                  <th scope="col">Nama Kelompok</th>
                  <th scope="col">Ketua</th>
                  <th scope="col">Dosen Pembimbing</th>
                  <th scope="col">Status</th>
                  <th scope="col">Pesetujuan</th>
                  <th scope="col">Detail</th>
                </tr>
                </thead>
                <tbody>
                @foreach($kelompok as $data)
                <tr>
                  <td>{{ $data->nama_kelompok }}</td>
                  <td>{{ $data->nama }}</td>
                  <td>{{ $data->id_dosen }}</td>
                  <td class="text-center py-0 align-middle"><span class="badge bg-warning">{{ $data->persetujuan }}</span></td>
                  <td class="text-center py-0 align-middle">
                      <a href="#" class="btn btn-sm btn-info editbtn"><i class="fas fa-check"></i></a>
                      <input type="hidden"  name="persetujuan" id="persetujuan" value="ditolak">
                      <button data-id="{{ $data->id_kelompok }}" class="btn btn-danger btn-sm declinebtn"><i class="fas fa-times"></i></button>
                  </td>
                  <td class="text-center py-0 align-middle">
                    <a href="/detailKelompok" class="btn-sm btn-info"><i class="fas fa-list-alt"></i></a>
                  </td>
                </tr>
                @endforeach
                </tbody>
              </table>
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
                      <input type="hidden" data-id="{{ $data->id_kelompok }}" name="persetujuans" id="persetujuans" value="diterima">
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
<!-- <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script> -->
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script> -->

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
    $(".editbtn").on('click', function(){
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
      var persetujuans = $('#persetujuans').val();
      // var id = $(this).data('id');
      var id = 5;

      $.ajax({
          type: "POST",
          headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
          url: "/api/admin/persetujuan_kelompoks/",
          cache:false,
          dataType: "json",
          data: {'id_dosen': id_dosen,'persetujuan': persetujuans, 'id_kelompok': id},
          success: function(data){
              console.log(data);
              $("#modal-default").modal('hide');
              toastr.options.closeButton = true;
              toastr.options.closeMethod = 'fadeOut';
              toastr.options.closeDuration = 100;
              toastr.success(data.message);
              location.reload();
          },
          error: function(error){
            console.log(error);
          }
      });
    });
  });

  $(document).ready(function(){ 
    $('.declinebtn').click(function(e){
        e.preventDefault();

        var persetujuan = $('#persetujuan').val();
        let kelompokId = $(this).data('id');

        $.ajax({
            type: "POST",
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            url: "/api/admin/tolak_kelompok/",
            cache:false,
            dataType: "json",
            data: {'persetujuan': persetujuan, 'id_kelompok': kelompokId},
            success: function(data){
              toastr.options.closeButton = true;
              toastr.options.closeMethod = 'fadeOut';
              toastr.options.closeDuration = 100;
              toastr.success(data.message);
              location.reload();
            },
            error: function(error){
              console.log(error);
            }
        });
      });
    });
  

</script>
@endsection