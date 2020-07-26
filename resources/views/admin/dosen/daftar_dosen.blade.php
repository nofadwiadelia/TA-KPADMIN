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
              <div class="col-sm-12">
                <a href="/admin/dosen/create" class="btn btn-success float-right btn-sm"><i class="fas fa-plus"></i> &nbsp; Tambah Dosen</a> <br><br>
              </div>
              <div class="card-primary">
                <div class="card-body table-responsive p-0">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>NIP</th>
                    <th>Nama</th>
                    <th>No.HP</th>
                    <th>Kapasitas</th>
                    <th>Slot</th>
                    <th>Keterangan</th>
                    <th  width="15%">Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($data as $dosens)
                  <tr>
                    <td>{{$dosens->nip}}</td>
                    <td>{{ $dosens->nama}}</td>
                    <td>{{$dosens->no_hp}}</td>
                    <td>{{$dosens->kapasitas}}</td>
                    <td>{{$dosens->slot}}</td>
                    <td class="text-center py-0 align-middle"> 
                    <input type="checkbox" data-id="{{ $dosens->id_dosen }}" name="status" class="js-switch" {{ $dosens->status == 'open' ? 'checked' : '' }}>
                    </td>
                    <td class="text-center py-0 align-middle">
                        <div class="btn-group btn-group-sm">
                          <a href="/admin/dosen/{{$dosens->id_dosen}}/edit" class="btn btn-info"><i class="fas fa-pencil-alt"></i></a>
                          <!-- <a href="#" class="btn btn-danger"><i class="fas fa-pencil-alt"></i></a> -->
                        </div>
                        <div class="btn-group btn-group-sm">
                          <button type="button" name="delete" id="{{$dosens->id_users}}" class="btn btn-danger btn-sm deleteUser" ><i class="fas fa-trash"></i></button>
                        </div>
                        <div class="btn-group btn-group-sm">
                          <a href="/admin/dosen/{{$dosens->id_dosen}}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                        </div>
                        
                      </td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
                <!-- <div class="card-body table-responsive p-0">
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
              </div> -->
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/switchery/0.8.2/switchery.min.js"></script>

<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();
  });
</script>
<script>

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

  $(document).on('click', '.deleteUser', function(){
    user_id = $(this).attr('id');
    $('#confirmModal').modal('show');
  });
  $('#ok_button').click(function(){
    $.ajax({
        type: "PUT",
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        dataType: "json",
        url: '/api/admin/dosen/delete/'+user_id,
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
</script>

@endsection