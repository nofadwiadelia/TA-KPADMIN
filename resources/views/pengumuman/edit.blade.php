@extends('welcome')
@section('content')
<!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
    </section>
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Edit Pengumuman</h3>
            </div>
            <!-- /.card-header -->
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Judul *</label>
                            <input type="text" class="form-control"  required id="judul" placeholder="">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Detail *</label>
                            <textarea name="detail" id="detail" required class="form-control {{ $errors->has('detail') ? 'is-invalid':'' }}"></textarea>
                        <div class="form-group">
                            <label for="exampleInputFile">Lampiran</label>
                            <div class="input-group">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="exampleInputFile">
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                            </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <div class="float-right">
                            <button type="submit" class="btn btn-primary">Submit</button>
                            <span >
                            <input type="submit" class="btn btn-danger" value="Cancel" />
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