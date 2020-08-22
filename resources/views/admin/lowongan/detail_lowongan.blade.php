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
              <h3 class="card-title">Detail Lowongan</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-2"><b>Instansi</b></div>
                    <div class="col-3">: {{ $lowongan->instansi->nama }}</div>
                  </div>
                  <div class="row">
                    <div class="col-2"><b>Posisi</b>
                    </div>
                    <div class="col-3">: {{ $lowongan->pekerjaan }}
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-2"><b>Persyaratan</b>
                    </div>
                    <div class="col-9">: {{ $lowongan->persyaratan }}</div>
                  </div>
                  <div class="row">
                    <div class="col-2"><b>Kapasitas</b>
                    </div>
                    <div class="col-3">: {{ $lowongan->kapasitas }}</div>
                  </div>
                  <div class="row">
                    <div class="col-2"><b>Slot</b>
                    </div>
                    <div class="col-3">: {{ $lowongan->slot }}</div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="card-primary">
                    <div class="table-responsive p-0">
                        <table class="table table-bordered table-striped">
                              <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Kelompok</th>
                                    <th>Nama Ketua</th>
                                    <th>Tanggal Daftar</th>
                                    <th>Status</th>
                                    <th class="text-center py-0 align-middle">Detail</th>
                                    <th class="text-center py-0 align-middle">Persetujuan</th>
                                </tr>
                              </thead>
                              <tbody>
                              @php $no = 1; @endphp
                              @foreach($applylowongan as $row)
                                <tr>
                                  <td>{{$no++}}</td>
                                  <td>{{$row->nama_kelompok}}</td>
                                  <td>{{$row->nama}}</td>
                                  <td>{{$row->tanggal_daftar}}</td>
                                  @if ($row->status == 'melamar')
                                  <td><span class='badge bg-warning'>{{$row->status}}</span></td>
                                  @elseif ($row->status == 'diterima')
                                  <td><span class='badge bg-success'>{{$row->status}}</span></td>
                                  @else ($row->status == 'ditolak')
                                  <td><span class='badge bg-danger'>{{$row->status}}</span></td>
                                  @endif
                                  <td class="text-center py-0 align-middle">
                                    <a href="/admin/kelompok/{{$row->id_kelompok}}" class="btn-sm btn-info"><i class="fas fa-list-alt"></i></a>
                                  </td>                                  
                                  <td class="text-center py-0 align-middle">
                                    <button data-id="{{$row->id_pelamar}}" data-idperiode="{{$row->id_periode}}" data-idkelompok="{{$row->id_kelompok}}" data-idinstansi="{{$row->id_instansi}}" data-jobdesk="{{$row->pekerjaan}}" class="btn btn-sm btn-info accbtn" <?php if($row->status!='melamar') {echo ' disabled=disabled ';}?>><i class="fas fa-check" ></i></button>
                                    <button type="button" id="{{$row->id_pelamar}}" class="btn btn-danger btn-sm declinebtn" <?php if($row->status!='melamar') {echo ' disabled=disabled ';}?>><i class="fas fa-times"></i></button>
                                  </td>
                                </tr> 
                              @endforeach
                              </tbody>
                        </table><br/>
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
                                  <label for="" class="col-sm-12 col-form-label">Yakin ingin menyetujui ?</label>
                                  </div>
                                  <input type="hidden" id="id_lowongan" value="{{$lowongan->id_lowongan}}">
                                  <input type="hidden" id="created_by" value="{{$userId}}">
                                  <div class="modal-footer">
                                    <button type="reset" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    <button type="button" name="ok_button" id="ok_button" class="btn btn-primary">Setujui</button>
                                  </div>
                                </div>
                            </div>
                          </div>
                          
                          <div id="confirmTolak" class="modal fade" role="dialog">
                              <div class="modal-dialog">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title">Confirmation</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      <h6 align="center" style="margin:0;">Anda yakin ingin menolak lamaran?</h6>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" name="button_tolak" id="button_tolak" class="btn btn-danger">OK</button>
                                      <button type="reset" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    </div>
                                  </div>
                              </div>
                          </div>
                    </div>
                  </div>
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
<script src="{{asset('/plugins/datatables/jquery.dataTables.js') }}"></script>
<script src="{{ asset('/plugins/datatables-bs4/js/dataTables.bootstrap4.js') }}"></script>
<script>

  $(document).on('click','.accbtn', function(e){
    $('#confirmModal').modal('show');

    e.preventDefault();
    id_kelompok = $(this).data("idkelompok");
    id_periode = $(this).data("idperiode");
    id_instansi = $(this).data("idinstansi");
    jobdesk = $(this).data("jobdesk");
    id_pelamar = $(this).data("id");
  });

  $('#ok_button').click(function(){

    id_lowongan = $('#id_lowongan').val();
    created_by = $('#created_by').val();

    $.ajax({
        type: "POST",
        headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        url: "/api/admin/persetujuanlowongan",
        cache:false,
        dataType: "json",
        data: {'id_pelamar': id_pelamar, 'id_lowongan': id_lowongan, 'id_kelompok': id_kelompok,'created_by': created_by, 'id_instansi': id_instansi, 'id_periode': id_periode, 'jobdesk': jobdesk},
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

  $(document).on('click','.declinebtn', function(e){
    e.preventDefault();

    id_pelamar = $(this).attr('id');
    $('#confirmTolak').modal('show');

  });
  
    $('#button_tolak').click(function(){
        $.ajax({
            type: "POST",
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            url: "/api/admin/declinelowongan",
            cache:false,
            dataType: "json",
            data: {'id_pelamar': id_pelamar},
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

  
</script>
@endsection