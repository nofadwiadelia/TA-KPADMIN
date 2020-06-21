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
                <li class="breadcrumb-item active">Usulan</li>
                <li class="breadcrumb-item active">Detail</li>
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
              <h3 class="card-title">Detail Usulan</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
            <div class="col-12"> <br></div>
              <h4>Kelompok : {{$kelompok->nama_kelompok}}</h4>
              <div class="card-primary">
              <div class="table-responsive p-0">
              <table class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>NIM</th>
                  <th>Nama Mahasiswa</th>
                  <th>No.HP</th>
                  <th>Status</th>
                  <th>Detail</th>
                </tr>
                </thead>
                <tbody>
                @foreach($anggota as $kel)
                <tr>
                  <td>{{$kel->nim}}</td>
                  <td>{{$kel->nama}}
                  </td>
                  <td>{{$kel->no_hp}}</td>
                  <td>{{$kel->status_keanggotaan}}</td>
                  <td class="text-center py-0 align-middle">
                      <div class="btn-group btn-group-sm">
                        <a href="/admin/mahasiswa/{{$kel->id_mahasiswa}}/{{$kel->id_kelompok}}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                      </div>
                    </td>
                </tr>
                @endforeach
                </tbody>
              </table>
              </div>
              </div>
              <br>
              <p>Usulan</p>
              <div class="card-primary">
                <div class="table-responsive p-0">
                    <table class="table table-bordered">
                            <tr>
                                <th>No</th>
                                <th>Insatansi</th>
                                <th>Alamat</th>
                                <th>Website</th>
                                <th>Surat Keterangan</th>
                                <th>Keterangan Jobdesk</th>
                                <th>Terima</th>
                            </tr>
                            @php $no = 1; @endphp
                            @foreach($usulan as $usulans)
                            <tr>
                            <td>{{$no++}}</td>
                              <td>{{$usulans->nama_instansi}}</td>
                              <td>{{$usulans->alamat_instansi}}</td>
                              <td>{{$usulans->website_instansi}}</td>
                              <td><a href="{{ asset('/uploads/users/mahasiswa/usulan/' . $usulans->surat) }}" target="_blank" class="float-right">Surat</a></td>
                              <td>{{$usulans->jobdesk}}</td>
                              
                              <td class="text-center py-0 align-middle">
                                  <a href="#"  data-id="{{$usulans->id_usulan}}" class="btn btn-sm btn-info showaccusulan"><i class="fas fa-check" ></i></a>
                                  <button type="button" id="{{$usulans->id_usulan}}" class="btn btn-danger btn-sm declinebtn" ><i class="fas fa-times"></i></button>
                              <!-- <div class="form-check">
                                <input type="hidden" id="statusaccterima" value="diterima">
                                <input class="form-check-input" type="radio"  data-id="{{$usulans->id_usulan}}" name="id_usulan" aria-label="..." value="0" 
                                {{ ($usulans->status=="diterima")? "checked" : ""}}
                                >
                              </div> -->
                              </td>
                            </tr>

                            @endforeach
                    </table><br/>
                </div>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->

          <div class="modal fade" id="modal-default">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title">Pilih Instansi atau Tambah Instansi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <form id="UsulanForm">
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="instansi" class="col-sm-3 col-form-label">Instansi Terkait</label>
                            <div class="col-sm-9">
                              <select name="id_instansi" id="id_instansi" class="form-control select2" style="width: 100%;">
                                  <option selected disabled>Pilih Instansi</option>
                                  @foreach($instansi as $instansis)
                                  <option value="{{ $instansis->id_instansi }}">{{ $instansis->nama }}</option>
                                  @endforeach
                              </select ><br>
                              <div class="float-right">
                                <button type="submit" class="btn btn-primary accbtnInstansi" id="submitBtn">Submit</button>
                              </div>
                            </div><br><br>

                            <hr style="width:50%;text-align:left;margin-left:0" class="col-sm-5"><span><h6 class="text-center">Atau</h6></span><hr style="width:50%;text-align:right;margin-right:0"class="col-sm-5">
                          
                            <div class="col-sm-9">
                            <label>Setujui dengan menambahkan instansi baru</label><br><br>
                            <div class="float-left">
                            <button type="submit" class="btn btn-primary accbtn" id="submitBtn">Submit</button>
                            </div>
                            <input type="hidden" id="statusaccterima" value="diterima">
                            <input type="hidden" name="id_usulan" id="id_usulan">
                            <input type="hidden" class="form-control" id="nama_instansi" name="nama_instansi" value="">
                            <input type="hidden" class="form-control" id="deskripsi_instansi" name="deskripsi_instansi" value="">
                            <input type="hidden" class="form-control" id="alamat_instansi" name="alamat_instansi" value="">
                            <input type="hidden" class="form-control" id="website_instansi" name="website_instansi" value="">
                            <input type="hidden" class="form-control" id="jobdesk" name="jobdesk" value="">
                            <input type="hidden" id="id_kelompok" value="">
                            <input type="hidden" id="id_periode" value="">
                            <input type="hidden" class="form-control" id="user" name="user" value="">
                            </div>
                          
                        </div>
                    </div>
                    <!-- <div class="modal-footer justify-content-between">
                      <button type="submit" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                      <button type="submit" class="btn btn-primary accbtn" id="submitBtn">Submit</button>
                    </div> -->
                  </form>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
          <!-- /.modal -->

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
                  <label for="" class="col-sm-12 col-form-label">Yakin ingin menyetujui usulan KP?</label>
                  </div>
                  <div class="modal-footer">
                    <button type="reset" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" name="ok_button" id="ok_button" class="btn btn-primary">Setujui</button>
                  </div>
                </div>
            </div>
          </div>

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
//ACCINSTANSI
    $(document).on('click','.accbtnInstansi', function(e){
      e.preventDefault();
      $('#confirmModal').modal('show');

      // id_instansi = $('#id_instansi').val();
      // id_usulan = $('#id_usulan').val();
      // var status = $('#statusaccterima').val();
      // id_kelompok = $('#id_kelompok').val();
      // id_periode = $('#id_periode').val();
      // jobdesk = $('#jobdesk').val();
    });

  $(document).on('click','.accbtn', function(e){
    e.preventDefault();
    $('#confirmModal').modal('show');

    // id_usulan = $('#id_usulan').val();
    // var status = $('#statusaccterima').val();

    // username = $('#user').val();
    // password = $('#user').val();

    // nama = $('#nama_instansi').val();
    // deskripsi = $('#deskripsi_instansi').val();
    // alamat = $('#alamat_instansi').val();
    // website = $('#website_instansi').val();
    // jobdesk = $('#jobdesk').val();
    
    // id_kelompok = $('#id_kelompok').val();
    // id_periode = $('#id_periode').val();

  });

  $(document).on('click','.showaccusulan', function(e) {
    e.preventDefault();
    
    var id_usulan = $(this).data('id');
    $.get("/api/admin/usulan/" + id_usulan , function (data) {
        var id_usulan = $(this).data('id');
        $('#modal-default').modal('show');
          $('#id_usulan').val(data.id_usulan);
          $('#id_kelompok').val(data.id_kelompok);
          $('#id_periode').val(data.id_periode);
          $('#website_instansi').val(data.website_instansi);
          $('#nama_instansi').val(data.nama_instansi);
          $('#alamat_instansi').val(data.alamat_instansi);
          $('#deskripsi_instansi').val(data.deskripsi_instansi);
          $('#jobdesk').val(data.jobdesk);
          $('#user').val(data.nama_instansi);
    })
  });

  $('#ok_button').click(function(){

      id_instansi = $('#id_instansi').val();
      id_usulan = $('#id_usulan').val();
      var status = $('#statusaccterima').val();
      id_kelompok = $('#id_kelompok').val();
      id_periode = $('#id_periode').val();
      jobdesk = $('#jobdesk').val();

      username = $('#user').val();
      password = $('#user').val();

      nama = $('#nama_instansi').val();
      deskripsi = $('#deskripsi_instansi').val();
      alamat = $('#alamat_instansi').val();
      website = $('#website_instansi').val();

    $.ajax({
        type: "POST",
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        url: "/api/admin/persetujuanusulan/",
        cache:false,
        dataType: "json",
        data: {'id_instansi': id_instansi,'id_usulan': id_usulan, 'status': status
        , 'username': username, 'password': password, 'nama': nama, 'deskripsi': deskripsi, 'alamat': alamat, 'website': website, 'id_kelompok': id_kelompok , 'id_periode': id_periode ,'jobdesk': jobdesk 
        },
        success: function(data){
          toastr.options.closeButton = true;
          toastr.options.closeMethod = 'fadeOut';
          toastr.options.closeDuration = 100;
          toastr.success(data.message);
          window.location.reload();
        },
        error: function(error){
          console.log(error);
        }
    });
  });


  // DECLINE
  $(document).on('click','.declinebtn', function(e){
        e.preventDefault();

        id_kelompok = $(this).attr('id');

        $.ajax({
            type: "POST",
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            url: "/api/admin/tolak_kelompok/",
            cache:false,
            dataType: "json",
            data: {'id_kelompok': id_kelompok},
            success: function(data){
              toastr.options.closeButton = true;
              toastr.options.closeMethod = 'fadeOut';
              toastr.options.closeDuration = 100;
              toastr.success(data.message);
              $('#persetujuan_data').DataTable().ajax.reload();
            },
            error: function(error){
              console.log(error);
            }
        });
    });
</script>
@endsection