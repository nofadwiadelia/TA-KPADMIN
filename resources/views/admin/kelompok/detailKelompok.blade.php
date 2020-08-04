@extends('admin.base')
@section('content')
<!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-12">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Persetujuan</li>
                <li class="breadcrumb-item active">Kelompok</li>
                <li class="breadcrumb-item active">Detail</li>
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
              <h3 class="card-title">Detail Kelompok</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <div class="col-sm-12">
                  <button href="javascript:void(0)" class="btn btn-success float-right btn-sm openAnggota" <?php if ($kelompoks->tahap == 'ditolak') { echo 'disabled="disabled"';}?>><i class="fas fa-plus"></i> Tambah Anggota</button> <br><br>
                </div>
              <div class="card-primary">
              <div class="table-responsive p-0">
              <table class="table table-bordered table-striped" id="kelompokTable">
                <thead>
                <tr>
                  <th>NIM</th>
                  <th>Nama Mahasiswa</th>
                  <th>Status</th>
                  <th>Detail</th>
                </tr>
                </thead>
                <tbody>
                @foreach($kelompok as $kel)
                <tr>
                    <td>{{$kel->nim}}</td>
                    <td>{{$kel->nama}}</td>
                    <td>{{$kel->status_keanggotaan}}</td>
                    <td class="text-center py-0 align-middle">
                        <div class="btn-group btn-group-sm">
                          <a href="/admin/mahasiswa/{{$kel->id_mahasiswa}}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                        </div>
                        <div class="btn-group btn-group-sm">
                          <button type="button" name="delete" id="{{$kel->id_kelompok_detail}}" class="btn btn-danger btn-sm deleteAnggota" ><i class="fas fa-trash"></i></button>
                        </div>
                    </td>
                    
                </tr>
                @endforeach
                </tbody>
              </table>
              </div>

              <div id="openModal" class="modal fade" role="dialog">
                  <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Pilih Anggota</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <div class="table-responsive p-0">
                            <table class="table table-bordered table-striped" id="mahasiswa">
                              <thead>
                              <tr>
                                <th>No</th>
                                <th>NIM</th>
                                <th>Nama Mahasiswa</th>
                                <th>Tambah</th>
                              </tr>
                              </thead>
                              <tbody>
                              @php $no = 1; @endphp
                              @foreach($mahasiswa_tersedia as $row)
                              <tr>
                                  <td>{{$no++}}</td>
                                  <td>{{$row->nim}}</td>
                                  <td>{{$row->nama}}</td>
                                  <td class="text-center py-0 align-middle">
                                      <div class="btn-group btn-group-sm">
                                      <button data-nama="{{$row->nama}}" data-id="{{$row->id_mahasiswa}}" data-nim="{{$row->nim}}" data-no="{{$row->no_hp}}" class="btn btn-warning add-anggota"><i class="fas fa-plus"></i></button>
                                      </div>
                                  </td>
                                  
                              </tr>
                              @endforeach
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <input type="hidden" name="id_kelompok" id="id_kelompok" value="{{ $kelompoks->id_kelompok }}">
                        <input type="hidden" name="created_by" id="created_by" value="{{ $userId }}">
                        <div class="modal-footer justify-content-between">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary addAnggota">Save changes</button>
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
                          <h6 align="center" style="margin:0;">Anda yakin ingin mengeluarkan anggota?</h6>
                        </div>
                        <div class="modal-footer">
                          <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                          <button type="reset" class="btn btn-default" data-dismiss="modal">Cancel</button>
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
    $("#mahasiswa").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    
  });


// OpenAnggota
  $(document).on('click', '.openAnggota', function(){
    $('#openModal').modal('show');
  });


// DELETE
  $(document).on('click', '.deleteAnggota', function(){
  id_kelompok_detail = $(this).attr('id');
    $('#confirmModal').modal('show');
  });
  $('#ok_button').click(function(){
    $.ajax({
        type: "DELETE",
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        dataType: "json",
        url: '/api/admin/kick/'+id_kelompok_detail,
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



    function deleteRow(r, id) {
      console.log("hi")
      let i = r.parentNode.parentNode.rowIndex;
      document.getElementById("kelompokTable").deleteRow(i);

      $('table#mahasiswa tbody button[data-id="'+id+'"]').removeAttr("disabled");
    }

    $(".add-anggota").click(function () {

      $(this).attr("disabled", true);

      let nama = $(this).data("nama");
      let nim = $(this).data("nim");
      let no = $(this).data("no");
      let id = $(this).data("id");

      console.log(nama);
      console.log(nim);

      $(".addAnggota").click(function () {
        var id_kelompok = $('#id_kelompok').val();
        var created_by = $('#created_by').val();

        $.ajax({
          type: "POST",
          headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
          url: "/api/admin/anggota/add",
          cache:false,
          dataType: "json",
          data: {'id_mahasiswa': id,'id_kelompok': id_kelompok, 'created_by': created_by},
          success: function(data){
              console.log(data);
              $("#openModal").modal('hide');
              toastr.options.closeButton = true;
              toastr.options.closeMethod = 'fadeOut';
              toastr.options.closeDuration = 100;
              toastr.success(data.message);
              window.location.reload();
          },
          error: function(error){
            console.log(error);
          }
        });
      });
    }); 
</script>
@endsection