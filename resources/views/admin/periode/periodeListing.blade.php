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
                <li class="breadcrumb-item active">Periode</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="col-12 text-center">
          @if (!empty($aktif))
            <p><h2>Periode KP <strong>{{$aktif->tahun_periode}}</strong></h2><i class="text-muted">{{$date}}</i></p>
          @else
            <p><h2>Periode KP <strong>tidak aktif</strong></h2></p>
          @endif
            <div class="row justify-content-center">
                <div class="col-md-6 col-md-offset-3 text-center">
                    <div class="alert alert-success alert-dismissible">
                      @if (!empty($aktif))
                        <i class="icon fas fa-calendar"></i> Saat ini adalah periode KP.
                        <h3><b>{{Carbon\Carbon::parse($aktif->tgl_mulai)->translatedFormat('d F Y')}}</b> - <b>{{Carbon\Carbon::parse($aktif->tgl_selesai)->translatedFormat('d F Y')}}</b></h3>
                      @else
                      <i class="icon fas fa-calendar"></i> Saat ini tidak ada periode KP yang aktif .
                      @endif
                        
                    </div>
                </div>
            </div>
          </div>
          <div class="card">
            <div class="card-body ">
                <form role="form">
                  <div class="col-sm-12">
                  <a href="{{route('periode.create')}}" class="btn btn-success float-right btn-sm"><i class="fas fa-plus"></i> Buat Periode</a> <br><br>
                  </div>
                </form>
              <div class="card-primary">
              <div class="table-responsive p-0">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Tahun Periode</th>
                  <th>Tanggal Mulai</th>
                  <th>Tanggal Selesai</th>
                  <th>Status</th>
                  <th>Aksi</th>
                </tr>
                </thead>
                <tbody>
                @php $no = 1; @endphp
                @foreach($periodes as $periode)
                <tr>
                  <td>{{$no++}}</td>
                  <td>{{ $periode->tahun_periode }}</td>
                  <td>{{Carbon\Carbon::parse($periode->tgl_mulai)->translatedFormat('d F Y')}}</td>
                  <td>{{Carbon\Carbon::parse($periode->tgl_selesai)->translatedFormat('d F Y')}}</td>
                  <td class="text-center py-0 align-middle">
                  <input type="checkbox" data-id="{{ $periode->id_periode }}" name="status" class="js-switch" {{ $periode->status == 'open' ? 'checked' : '' }}>
                  </td>
                  <td class="text-center py-0 align-middle">
                      <a href="{{ route('periode.edit', $periode->id_periode) }}" class="btn btn-info btn-sm"><i class="fas fa-pencil-alt"></i></a>
                      <button class="btn btn-sm btn-danger deletePeriode" data-id="{{ $periode->id_periode }}" onclick="return confirm('Yakin ingin menghapus data?')"><i class="fas fa-trash"></i></button>
                  </td>
                </tr>
                @endforeach
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
<script type="text/javascript">
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
            let periodeId = $(this).data('id');
            $.ajax({
                type: "POST",
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                dataType: "json",
                url: '/api/admin/periode/change',
                data: {'status': status, 'periode_id': periodeId},
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

    $(document).ready(function(){
        $('.deletePeriode').click(function(){
            var id = $(this).data('id');
            $.ajax({
                type: "DELETE",
                headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
                dataType: "json",
                url: '/api/admin/periode/'+id,
                data: {'id_periode': id,},
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