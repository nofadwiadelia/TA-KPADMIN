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
                </tbody>
              </table>
              </div>
              <input type="text" value="{{$kelompok->id_kelompok}}" data-id="{{$kelompok->id_kelompok}}" id="id_kelompok">
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
    // var id_kelompok = $(this).data('id');
    var id_kelompok = 4;
    // var id_kelompok = $(this).attr('id');
    // var id_kelompok = $this('id_kelompok');

    $.ajax({
            type: 'get',
            url: ('/api/admin/detailkelompok/'+id_kelompok),
            dataType: 'JSON',
            success: function (response) {
                var len = response.length;
                for(var i=0; i<len; i++){
                    var id_mahasiswa = response[i].id_mahasiswa;
                    var nim = response[i].nim;
                    var nama = response[i].nama;
                    var no_hp = response[i].no_hp;
                    var status_keanggotaan = response[i].status_keanggotaan;

                    var tr_str = "<tr>" +
                        "<td>" + nim + "</td>" +
                        "<td>" + nama + "</td>" +
                        "<td>" + no_hp + "</td>" +
                        "<td>" + status_keanggotaan + "</td>" +
                        "<td class='text-center py-0 align-middle'>"+
                          "<div class='btn-group btn-group-sm'>"+
                            "<a href='/admin/mahasiswa/"+id_mahasiswa+"' class='btn btn-info'><i class='fas fa-eye'></i></a>"+
                          "</div>"+
                        "</td>"+
                        "</tr>";

                    $("#kelompokTable tbody").append(tr_str);
                }
            }
        });
  });
</script>
@endsection