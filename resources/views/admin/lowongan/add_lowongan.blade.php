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
                <li class="breadcrumb-item active">Add</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
                <form action="{{ route('lowongan.store') }}" method="post">
                {{ csrf_field() }}
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Posisi *</label>
                            <input type="text" class="form-control" name="posisi" id="posisi" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Persyaratan *</label>
                            <textarea name="persyaratan" id="persyaratan" class="form-control {{ $errors->has('detail') ? 'is-invalid':'' }}"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Slot *</label>
                            <input type="number" class="form-control" name="slot" id="slot" placeholder="">
                        </div>
                        <div class="form-group">
                          <label>Instansi *</label>
                          <select name="instansi_id" class="form-control select2" style="width: 100%;">
                              <option selected disabled>Pilih Instansi</option>
                              @foreach($data as $instansi)
                              <option value="{{ $instansi->id }}">{{ $instansi->nama_lengkap }}</option>
                              @endforeach
                          </select >
                        </div>
                        <div class="form-group">
                          <label>Periode *</label>
                          <select name="periode_id" class="form-control select2" style="width: 100%;">
                              <option selected disabled>Pilih Periode</option>
                              @foreach($datas as $periode)
                              <option value="{{ $periode->id }}">{{ $periode->tahun }}</option>
                              @endforeach
                          </select >
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                      <div class="d-flex flex-row justify-content-end">
                          <span class="mr-2">
                          <button type="submit" class="btn btn-danger">Cancel</button>
                          </span>
                          <span>
                          <button type="submit" class="btn btn-primary">Submit</button>
                          </span>
                      </div>
                    </div>
                </form>
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
<script src="../../plugins/summernote/summernote-bs4.min.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();
  });
</script>
<!-- Summernote -->

<script>
  $(function () {
    // Summernote
    $('.textarea').summernote()
  })
</script>
@endsection