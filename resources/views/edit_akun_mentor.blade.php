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
              <h3 class="card-title">Edit User Mentor</h3>
            </div>
            <!-- /.card-header -->
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-8">
                            <form role="form">
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="nama" class="col-sm-3 col-form-label">Nama Lengkap</label>
                                        <div class="col-sm-9">
                                        <input type="text" class="form-control" id="nama" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="teusernamext" class="col-sm-3 col-form-label">Username</label>
                                        <div class="col-sm-9">
                                        <input type="text" class="form-control" id="username" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="password" class="col-sm-3 col-form-label">Password</label>
                                        <div class="col-sm-9">
                                        <input type="password" class="form-control" id="password" placeholder="">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="password" class="col-sm-3 col-form-label">Confirm Password</label>
                                        <div class="col-sm-9">
                                        <input type="password" class="form-control" id="password" placeholder="">
                                        </div>
                                    </div>
                                    <div class="d-flex flex-row justify-content-end">
                                        <span class="mr-2">
                                        <input type="submit" class="btn btn-danger" value="Cancel" />
                                        </span>
                                        <span>
                                        <input type="submit" class="btn btn-primary" value="Submit" />
                                        </span>
                                   </div>
                                </div>
                                <!-- /.card-body -->

                            </form>
                        </div>
                    </div>
                </div>
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
</script>
<!-- Summernote -->

@endsection