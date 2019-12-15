@extends('welcome')
@section('content')
<!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
    </section>
    <section class="content">
		<div class="row">
			<div class="col-md-12 text-center">
                <p><h2>Periode PKL <strong>2019</strong></h2><i class="text-muted">4 December 2019</i></p>
                    <div class="row justify-content-center">
                        <div class="col-md-6 col-md-offset-3 text-center">
                            <div class="alert alert-success alert-dismissible">
                                <i class="icon fas fa-calendar"></i> Saat ini adalah periode PKL.
                                <h3><b>2 December 2019</b> - <b>9 December 2019</b></h3>
                            </div>
                        </div>
                    </div>
					<div class="d-flex flex-row justify-content-center">
                        <div class="col-md-3 ">
                            <a href="https://pklkomsi.000webhostapp.com/admin/periode/periodeListing" class="btn bg-blue"><i class="fas fa-pencil-alt"></i> Setting Periode PKL</a>
                        </div>
                        <div class="col-md-3 ">
                            <a href="/periodeListing" class="btn bg-blue"><i class="far fa-clock"></i> List Periode PKL</a>
                        </div>
                    </div>
                    <br>
			</div>
		</div>
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
@endsection