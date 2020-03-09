@extends('admin.base')
@section('content')
<!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0 text-dark">Manajemen Lowongan</h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Lowongan</li>
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
            <div class="card-body ">
                <div class="col-sm-12">
                  <a href="{{route('lowongan.create')}}" class="btn btn-success float-right btn-sm"><i class="fas fa-plus"></i> Tambah Lowongan</a> <br><br>
                </div>
              <table id="example1" class="table table-bordered table-striped ">
                <thead>
                <tr>
                  <th>Posisi</th>
                  <th>Persyaratan</th>
                  <th>Kapasistas</th>
                  <th>Instansi</th>
                  <th>Periode</th>
                  <th>Detail</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @foreach($lowongan as $lowongans)
                <tr>
                  <td>{{ $lowongans->pekerjaan }}</td>
                  <td>{{ $lowongans->persyaratan }}</td>
                  <td>{{ $lowongans->kapasitas }}</td>
                  <td>{{ $lowongans->instansi->nama }}</td>
                  <td>{{ $lowongans->periode->tahun_periode }}</td>
                  <td class="text-center py-0 align-middle">
                      <a href="{{ route('lowongan.show', $lowongans->id_lowongan) }}" class="btn-sm btn-warning"><i class="fas fa-arrow-right"></i></a>
                  </td>
                  <td class="text-center py-0 align-middle">
                      <a href="{{ route('lowongan.edit', $lowongans->id_lowongan) }}" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></a>
                      <button class="btn btn-sm btn-danger deleteLowongan" data-id="{{ $lowongans->id_lowongan }}" onclick="return confirm('Yakin ingin menghapus data?')"><i class="fas fa-trash"></i></button>
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
        $('.deleteLowongan').click(function(){
            var id = $(this).data('id');
            $.ajax({
                type: "DELETE",
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                dataType: "json",
                url: '/api/admin/lowongan/'+id,
                data: {'id_lowongan': id,},
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