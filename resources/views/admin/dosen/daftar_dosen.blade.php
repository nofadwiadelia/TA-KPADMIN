@extends('admin.base')
@section('content')
<!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0 text-dark">Dosen</h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dosen</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
              <div class="card-primary">
                <div class="card-body table-responsive p-0">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>NIP</th>
                    <th>Nama</th>
                    <th>No.HP</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($data as $dosens)
                  <tr>
                    <td>{{$dosens->nip}}</td>
                    <td>{{ $dosens->nama}}</td>
                    <td>{{$dosens->no_hp}}</td>
                    <td class="text-center py-0 align-middle"> 
                    <input type="checkbox" data-id="{{ $dosens->id_dosen }}" name="status" class="js-switch" {{ $dosens->status == 'open' ? 'checked' : '' }}>
                    </td>
                    <td class="text-center py-0 align-middle">
                        <div class="btn-group btn-group-sm">
                          <a href="{{ route('dosen.show', $dosens->id_dosen) }}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                          <!-- <a href="#" class="btn btn-danger"><i class="fas fa-pencil-alt"></i></a> -->
                        </div>
                      </td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
                <div class="card-body table-responsive p-0">
                <table id="dosen_data" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>NIP</th>
                    <th>Nama</th>
                    <th>No.HP</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>

<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();
  });
</script>
<script>

$(document).ready(function(){
    fill_datatable();

    function fill_datatable(){
      var dataTable = $('#dosen_data').DataTable({
        processing: true,
        serverSide: true,
        ajax:{
          url: "/admin/dosen",
        },
        columns:[
          {
            data:'nip',
            name:'nip'
          },
          {
            data:'nama',
            name:'nama'
          },
          {
            data:'no_hp',
            name:'no_hp'
          },
          {data: 'status', 
          name: 'status', 
            render: function(data, type, full, meta){
              if (data != null){
                return '<input type="checkbox" data-id="{{ $dosens->id_dosen }}" name="status" class="js-switch" {{ $dosens->status == 'open' ? 'checked' : '' }}>';
              }
            },
            orderable: false
          },
          
          {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
      });
    }
  });

    let elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
    elems.forEach(function(html) {
        let switchery = new Switchery(html,  { size: 'small' });
    });
    $(document).ready(function(){
        $('.js-switch').change(function () {
          let status = $(this).prop('checked') === true ? 'open' : 'close';
          let dosenId = $(this).data('id');
            $.ajax({
                type: "POST",
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                dataType: "json",
                url: '/api/admin/dosen/change',
                data: {'status': status, 'dosen_id': dosenId},
                success: function (data) {
                    toastr.options.closeButton = true;
                    toastr.options.closeMethod = 'fadeOut';
                    toastr.options.closeDuration = 100;
                    toastr.success(data.message);
                }
            });
        });
    });
</script>

@endsection