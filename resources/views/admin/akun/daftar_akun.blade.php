@extends('admin.base')
@section('content')
<!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0 text-dark">Daftar Akun</h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User Management</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
          @if (Session::has('alert-success'))
              <div class="alert alert-success">
                  <strong>{{ \Illuminate\Support\Facades\Session::get('alert-success') }}</strong>
              </div>
                <!-- @alert(['type' => 'success'])
                    {!! session('success') !!}
                @endalert -->
            @endif
            <div class="card-body">
              <form role="form">
                  <div class="col-sm-4">
                    <p>Saring berdasarkan</p>
                      <!-- select -->
                      <div class="form-group">
                          <select class="form-control form-control-sm">
                            <option selected>Semua User</option>
                            @foreach($roles as $role)
                            <option value="{{ $role->id_roles }}">{{ $role->nama }}</option>
                            @endforeach
                          </select>
                      </div>
                      <button type="submit" class="btn btn-default">Filter</button> <br><br>
                  </div>
                </form>
                <form role="form">
                  <div class="col-sm-12">
                  <a href="{{route('users.create')}}" class="btn btn-success float-right btn-sm"><i class="fas fa-plus"></i> Tambah Baru</a> <br><br>
                  </div>
                </form>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Username</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($user as $users)
                <tr>
                  <td>{{ $users->username }}</td>
                  <td class="text-center py-0 align-middle">
                      <a href="{{ route('users.edit', $users->id_users) }}" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></a>
                      <button class="btn btn-sm btn-danger deleteUser" data-id="{{ $users->id_users }}" onclick="return confirm('Yakin ingin menghapus data?')"><i class="fas fa-trash"></i></button>
                  </td>
                </tr>
                @endforeach
                </tbody>
              </table>
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

  $(document).ready(function(){
        $('.deleteUser').click(function(){
            var id = $(this).data('id');
            $.ajax({
                type: "DELETE",
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                dataType: "json",
                url: '/api/admin/users/'+id,
                data: {'id_pengumuman': id,},
                success: function (data) {
                    toastr.options.closeButton = true;
                    toastr.options.closeMethod = 'fadeOut';
                    toastr.options.closeDuration = 100;
                    toastr.success(data.message);
                    window.location.reload();
                }
            });
        });
    });
</script>
@endsection