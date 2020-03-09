@extends('admin.base')
@section('content')
<!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h4 class="m-0 text-dark">Pengumuman</h4>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Pengumuman</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <!-- /.card-header -->
            <div class="card-body ">
                <form role="form">
                  <div class="col-sm-12">
                  <a href="{{route('pengumuman.create')}}" class="btn btn-success float-right btn-sm"><i class="fas fa-plus"></i> Buat Pengumuman</a> <br><br>
                  </div>
                </form>
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Judul</th>
                  <th>deskripsi</th>
                  <th>Lampiran</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($data as $datas)
                <tr>
                  <td>{{ $datas->judul }}</td>
                  <td>{{ $datas->deskripsi }}</td>
                  <td>
                    @if (!empty($datas->lampiran))
                        <img src="{{ asset('uploads/file/' . $datas->lampiran) }}" 
                            alt="{{ $datas->judul }}" width="50px" height="50px">
                    @else
                        <img src="http://via.placeholder.com/50x50" alt="{{ $datas->judul }}">
                    @endif
                </td>
                <td class="text-center py-0 align-middle">
                    <a href="{{ route('pengumuman.edit', $datas->id_pengumuman) }}" class="btn btn-info btn-sm"><i class="fas fa-edit"></i></a>
                    <button class="btn btn-sm btn-danger deletePengumuman" data-id="{{ $datas->id_pengumuman }}" onclick="return confirm('Yakin ingin menghapus data?')"><i class="fas fa-trash"></i></button>
                </form>
                </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center">Tidak ada data</td>
                </tr>
                @endforelse
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
        $('.deletePengumuman').click(function(){
            var id = $(this).data('id');
            $.ajax({
                type: "DELETE",
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                dataType: "json",
                url: '/api/admin/pengumuman/'+id,
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