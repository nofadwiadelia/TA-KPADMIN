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
                            <option selected>Semua Periode</option>
                            @foreach($periode as $row)
                            <option value="{{ $row->id_periode }}">{{ $row->tahun_periode }}</option>
                            @endforeach
                          </select>
                      </div>
                  </div>
                </form>
                <div class="col-sm-12">
                  <a href="/admin/mahasiswa/create" class="btn btn-success float-right btn-sm"><i class="fas fa-plus"></i> &nbsp; Tambah Mahasiswa</a> <br><br>
                </div>
                <div class="col-sm-12">
                  <a href="{{ route('exportmahasiswa') }}" class="btn btn-primary float-right btn-sm"><i class="fas fa-download"></i> &nbsp; Export to Excel</a> <br><br>
                </div>
              <div class="card-primary">
                <div class="table-responsive p-0">
                <table id="mahasiswa_data" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Periode</th>
                    <th>Kelompok</th>
                    <th>Status</th>
                    <th>Nilai</th>
                    <th>Status Magang</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
                <div>
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
            name:'nama_kelompok'
          },
          {
            data:'status_keanggotaan',
            name:'status_keanggotaan'
          },
          {
            data:'status_keanggotaan',
            name:'status_keanggotaan',
          },
          {
            data:'status',
            name:'status',
            render: function(data, type, full, meta){
              if (data == 'belum magang'){
                return "<span class='badge bg-warning'>"+ data + "</span>";
              }else if(data == 'magang'){
                return "<span class='badge bg-success'>"+ data + "</span>";
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
</script>
@endsection