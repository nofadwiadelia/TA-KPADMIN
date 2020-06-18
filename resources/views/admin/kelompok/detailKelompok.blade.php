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
              <div class="card-primary">
              <div class="table-responsive p-0">
              <table class="table table-bordered table-striped" id="kelompokTable">
                <thead>
                <tr>
                  <th>NIM</th>
                  <th>Nama Mahasiswa</th>
                  <th>No.HP</th>
                  <th>Status</th>
                  <th>Detail</th>
                </tr>
                </thead>
                <tbody>
                @foreach($kelompok as $kel)
                <tr>
                    <td>{{$kel->nim}}</td>
                    <td>{{$kel->nama}}</td>
                    <td>{{$kel->no_hp}}</td>
                    <td>{{$kel->status_keanggotaan}}</td>
                    <td class="text-center py-0 align-middle">
                        <div class="btn-group btn-group-sm">
                          <a href="/admin/mahasiswa/{{$kel->id_mahasiswa}}/{{$kel->id_kelompok}}" class="btn btn-info"><i class="fas fa-eye"></i></a>
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

// $(document).ready(function(){
//     var id_kelompok = 4;

//     $.ajax({
//             type: 'get',
//             url: ('/api/admin/detailkelompok/'+id_kelompok),
//             dataType: 'JSON',
//             success: function (response) {
//                 var len = response.length;
//                 for(var i=0; i<len; i++){
//                     var id_mahasiswa = response[i].id_mahasiswa;
//                     var nim = response[i].nim;
//                     var nama = response[i].nama;
//                     var no_hp = response[i].no_hp;
//                     var status_keanggotaan = response[i].status_keanggotaan;

//                     var tr_str = "<tr>" +
//                         "<td>" + nim + "</td>" +
//                         "<td>" + nama + "</td>" +
//                         "<td>" + no_hp + "</td>" +
//                         "<td>" + status_keanggotaan + "</td>" +
//                         "<td class='text-center py-0 align-middle'>"+
//                           "<div class='btn-group btn-group-sm'>"+
//                             "<a href='/admin/mahasiswa/"+id_mahasiswa+"' class='btn btn-info'><i class='fas fa-eye'></i></a>"+
//                           "</div>"+
//                         "</td>"+
//                         "</tr>";

//                     $("#kelompokTable tbody").append(tr_str);
//                 }
//             }
//         });
//   });

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
            $('#kelompokTable').DataTable().ajax.reload();
            toastr.options.closeButton = true;
            toastr.options.closeMethod = 'fadeOut';
            toastr.options.closeDuration = 100;
            toastr.success(data.message);
        }
    });
  });
</script>
@endsection