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
                <li class="breadcrumb-item active">Persetujuan</li>
                <li class="breadcrumb-item active">Kelompok</li>
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
            <div class="card-header">
              <h3 class="card-title">Buat Kelompok</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">

              <form id="kelompokForm" method="post"  role="form">             
                <div class="col-sm-12">
                  <div class="form-group row">
                    <label for="nama_kelompok" class="col-sm-3 col-form-label">Nama Kelompok <font color="red">*</font> </label>
                    <div class="col-sm-9">
                    <input type="text" class="form-control" id="nama_kelompok" name="nama_kelompok" >
                  </div>
                </div>
                <!-- <div class="col-sm-12">
                  <button type="submit" class="btn btn-primary float-right">Create</button>
                </div> <br><br>
              </form> -->

                <div class="col-sm-12">
                  <a href="javascript:void(0)" class="btn btn-success float-right btn-sm openAnggota"><i class="fas fa-plus"></i> Tambah Anggota</a> <br><br>
                </div>
              <div class="card-primary">

                <div id="openModal" class="modal fade" role="dialog">
                  <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title">Pilih Anggota</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <div class="table-responsive p-0">
                            <table class="table table-bordered table-striped" id="mahasiswa">
                              <thead>
                              <tr>
                                <th>No</th>
                                <th>NIM</th>
                                <th>Nama Mahasiswa</th>
                                <th>Tambah</th>
                              </tr>
                              </thead>
                              <tbody>
                              @php $no = 1; @endphp
                              @foreach($anggotas as $row)
                              <tr>
                                  <td>{{$no++}}</td>
                                  <td>{{$row->nim}}</td>
                                  <td>{{$row->nama}}</td>
                                  <td class="text-center py-0 align-middle">
                                      <div class="btn-group btn-group-sm">
                                      <button data-nama="{{$row->nama}}" data-id="{{$row->id_mahasiswa}}" data-nim="{{$row->nim}}" data-no="{{$row->no_hp}}" class="btn btn-warning add-anggota"><i class="fas fa-plus"></i></button>
                                      </div>
                                  </td>
                                  
                              </tr>
                              @endforeach
                              </tbody>
                            </table>
                          </div>
                        </div>
                        <input type="hidden" class="form-control" name="created_by" id="created_by" value="{{$userId}}">
                        <div class="modal-footer justify-content-between">
                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary ">Save changes</button>
                        </div>
                      </div>
                  </div>
                </div>

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
                          <button type="reset" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        </div>
                      </div>
                  </div>
                </div>

              <div class="table-responsive p-0">
              <table class="table table-bordered table-striped" id="kelompokTable">
                <thead>
                <tr>
                  <th>NIM</th>
                  <th>Nama Mahasiswa</th>
                  <th>No.HP</th>
                  <th>Detail</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
              </table>
              <button type="submit" class="btn btn-primary addAnggota">Submit</button>
              <a href="{{url()->previous()}}" class="btn btn-danger"> Cancel </a>
              </div>
              </div>
            </form>
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

<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.1/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script> -->
<!-- DataTables -->
<script src="../../plugins/datatables/jquery.dataTables.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#mahasiswa").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
  });

  // OpenAnggota
  $(document).on('click', '.openAnggota', function(){
      $('#openModal').modal('show');
    });

    function deleteRow(r, id) {
      // console.log("hi")
      let i = r.parentNode.parentNode.rowIndex;
      document.getElementById("kelompokTable").deleteRow(i);
      $('table#mahasiswa tbody button[data-id="'+id+'"]').removeAttr("disabled");
    }

  $(".add-anggota").click(function () {
    $(this).attr("disabled", true);
    let no = $(this).data("no");
    let nim = $(this).data("nim");
    let nama = $(this).data("nama");
    let id = $(this).data("id");

    console.log(nim);
    console.log(nama);
    console.log(id);

    let markup = 
    "<tr>"
    + "<td>" + nim + "</td>"
    + "<td>" + nama + "</td>"
    + "<td>" + no + "</td>"
    + "<td><button class='btn btn-danger' onclick='deleteRow(this, "+id+")' >Delete</button> <input type='hidden' name='list_anggota[]' value='"+ id +"' ></td>"
    + "</tr>";
    tableBody = $("table#kelompokTable tbody"); 
    tableBody.append(markup);

    $("#kelompokForm").on('submit',function (e) {
        e.preventDefault();
        created_by = $('#created_by').val();
        nama_kelompok = $('#nama_kelompok').val();
        $.ajax({
          type: "POST",
          headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
          url: "/api/admin/create_kelompok",
          cache:false,
          dataType: "json",
          data: {'id_mahasiswa': id,'nama_kelompok': nama_kelompok,'created_by': created_by},
          success: function(data){
              console.log(data);
              $("#openModal").modal('hide');
              toastr.options.closeButton = true;
              toastr.options.closeMethod = 'fadeOut';
              toastr.options.closeDuration = 100;
              toastr.success(data.message);
              window.location = "/admin/persetujuan_kelompok";
          },
          error: function(error){
            console.log(error);
          }
        });
      });

  });
</script>
@endsection