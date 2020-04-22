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
                <li class="breadcrumb-item active">Lowongan</li>
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
              <h3 class="card-title">Detail Lowongan</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-2"><b class="badge badge-info">Instansi</b></div>
                    <div class="col-3">: {{ $lowongan->instansi->nama }}</div>
                  </div>
                  <div class="row">
                    <div class="col-2"><b class="badge badge-info">Posisi</b>
                    </div>
                    <div class="col-3">: {{ $lowongan->pekerjaan }}
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-2"><b class="badge badge-info">Persyaratan</b>
                    </div>
                    <div class="col-3">: {{ $lowongan->persyaratan }}</div>
                  </div>
                  <div class="row">
                    <div class="col-2"><b class="badge badge-info">Kapasitas</b>
                    </div>
                    <div class="col-3">: {{ $lowongan->kapasitas }}</div>
                  </div>
                  <div class="row">
                    <div class="col-2"><b class="badge badge-info">Slot</b>
                    </div>
                    <div class="col-3">: {{ $lowongan->slot }}</div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="card-primary">
                    <div class="table-responsive p-0">
                    <!-- <table id="daftar_lowongan" class="table table-bordered table-striped ">
                      <thead>
                      <tr>
                        <th scope="col">No</th>
                        <th scope="col">Kelompok</th>
                        <th scope="col">Nama Ketua</th>
                        <th scope="col">Status</th>
                        <th scope="col">Pesetujuan</th>
                        <th scope="col">Detail</th>
                      </tr>
                      </thead>
                      <tbody>
                    </table> -->
                        <table class="table table-bordered table-striped">
                              <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Kelompok</th>
                                    <th>Nama Ketua</th>
                                    <th>Status</th>
                                    <th class="text-center py-0 align-middle">Detail</th>
                                    <th class="text-center py-0 align-middle">Terima</th>
                                </tr>
                              </thead>
                              <tbody>
                              @php $no = 1; @endphp
                              @foreach($applylowongan as $row)
                                <tr>
                                  <td>{{$no++}}</td>
                                  <td>{{$row->nama_kelompok}}</td>
                                  <td>{{$row->nama}}</td>
                                  <td>{{$row->status}}</td>
                                  <td class="text-center py-0 align-middle">
                                    <a href="/admin/kelompok/{{$row->id_kelompok}}" class="btn-sm btn-info"><i class="fas fa-list-alt"></i></a>
                                  </td>
                                  <td class="text-center py-0 align-middle">
                                    <input type="hidden" id="statusacc" value="diterima">
                                    <button id="{{$row->id_daftar_lowongan}}" class="btn btn-sm btn-info accbtn"><i class="fas fa-check" value="diterima"></i></button>
                                    <input type="hidden" id="statusdecline" value="ditolak">
                                    <button type="button" id="{{$row->id_daftar_lowongan}}" class="btn btn-danger btn-sm declinebtn"><i class="fas fa-times" value="ditolak"></i></button>
                                  </td>
                                </tr> 
                              @endforeach
                              </tbody>
                        </table><br/>
                        <div class="d-flex flex-row justify-content-end">
                              <span class="mr-2">
                              <input type="submit" class="btn btn-danger" value="Cancel" />
                              </span>
                              <span>
                              <input type="submit" class="btn btn-primary" value="Submit" />
                              </span>
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

  $(document).on('click','.accbtn', function(e){
    e.preventDefault();

    id_daftar_lowongan = $(this).attr('id');
    var status = $('#statusacc').val();

    $.ajax({
        type: "POST",
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        url: "/api/admin/persetujuanlowongan/",
        cache:false,
        dataType: "json",
        data: {'id_daftar_lowongan': id_daftar_lowongan, 'status': status},
        success: function(data){
          toastr.options.closeButton = true;
          toastr.options.closeMethod = 'fadeOut';
          toastr.options.closeDuration = 100;
          toastr.success(data.message);
          // $('#persetujuan_data').DataTable().ajax.reload();
        },
        error: function(error){
          console.log(error);
        }
    });
  });

  $(document).on('click','.declinebtn', function(e){
    e.preventDefault();

    id_daftar_lowongan = $(this).attr('id');
    var statusdecline = $('#statusdecline').val();

    $.ajax({
        type: "POST",
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        url: "/api/admin/persetujuanlowongan/",
        cache:false,
        dataType: "json",
        data: {'id_daftar_lowongan': id_daftar_lowongan, 'status': statusdecline},
        success: function(data){
          toastr.options.closeButton = true;
          toastr.options.closeMethod = 'fadeOut';
          toastr.options.closeDuration = 100;
          toastr.success(data.message);
          // $('#persetujuan_data').DataTable().ajax.reload();
        },
        error: function(error){
          console.log(error);
        }
    });
  });

  // $(document).ready(function(){
  //     var dataTable = $('#daftar_lowongan').DataTable({
  //       processing: true,
  //       serverSide: true,
  //       ajax:{
  //         url: "/admin/showlowongan/8",
  //       },
  //       columns:[
  //         {
  //           data: 'DT_RowIndex', 
  //           name: 'DT_RowIndex', 
  //           orderable: false,
  //           searchable: false
  //         },
  //         {
  //           data:'nama_kelompok',
  //           name:'nama_kelompok'
  //         },
  //         {
  //           data:'nama_kelompok',
  //           name:'nama_kelompok'
  //         },
  //         {
  //           data:'nama_kelompok',
  //           name:'nama_kelompok'
  //         },
  //         {
  //           data:'nama_kelompok',
  //           name:'nama_kelompok'
  //         },
  //         // {
  //         //   data:'persetujuan',
  //         //   name:'persetujuan',
  //         //   render: function(data, type, full, meta){
  //         //     if (data == 'diproses'){
  //         //       return "<span class='badge bg-warning'>"+ data + "</span>";
  //         //     }else if(data == 'diterima'){
  //         //       return "<span class='badge bg-success'>"+ data + "</span>";
  //         //     }else if(data =='ditolak'){
  //         //       return "<span class='badge bg-danger'>"+ data + "</span>"
  //         //     }
  //         //   },
  //         //   orderable: false
  //         // },
  //         {
  //           data: 'action',
  //           name: 'action', 
  //           orderable: false, 
  //           searchable: false
  //         },
  //         // {
            
  //         //   data: 'id_kelompok',
  //         //   name: 'id_kelompok', 
  //         //   render: function(data, type, full, meta){
  //         //     return '<a href="/admin/kelompok/'+data+'" class="btn-sm btn-info"><i class="fas fa-list-alt"></i></a>';
  //         //   },
  //         //   orderable: false
            
  //         // },
  //       ]
  //     });
    
  // });
</script>
@endsection