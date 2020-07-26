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
                <li class="breadcrumb-item active">Kelompok</li>
                <li class="breadcrumb-item active">Detail Magang</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-body">
                <h4>Kelompok {{$kelompok->nama_kelompok}}</h4><br>
                <div class="row">
                  <div class="col-md-12 text-center">
                      <div class="card-body box-profile">
                          <ul class="list-group list-group-unbordered">
                              <li class="list-group-item list-group-unbordered">
                              <h5><i class="fa fa-user" ></i> Dibimbing Dosen <strong> 
                                    @if (!empty($kelompok->nama))
                                    {{$kelompok->nama}}
                                    @else
                                    <p>-</p>
                                    @endif</strong></h5>

                                    @if (!empty($magang->instansi_nama))
                                      <p> <h5><i class="fas fa-building" ></i> Magang di <strong>{{$magang->instansi_nama}}</strong></h5></p>
                                    @else
                                    <p> <h5><i class="fas fa-building" ></i> Magang di <strong></strong></h5></p>
                                    @endif   
                              </li>
                          </ul>
                      </div>
                  </div>
                  <div class="col-md-4">
                    <div class="text-center">
                    @if (!empty($magang->foto))
                      <img class="profile-user-img img-fluid img-circle" src="{{ asset('uploads/avatar/'.$magang->foto) }}"  alt="User profile picture" > 
                    @else
                    <img class="profile-user-img img-fluid img-circle" src="{{ asset('/dist/img/default-avatar.png') }}"  alt="User profile picture" >
                    @endif 
                    </div>
                    @if (!empty($magang->instansi_nama))
                      <p> <h3 class="profile-username text-center">{{$magang->instansi_nama}}</h3></p>
                    @else
                    <p> <h3 class="profile-username text-center"></h3></p>
                    @endif 

                    @if (!empty($magang->alamat))
                    <p class="text-muted text-center"><i class="fas fa-map-marker-alt"></i> {{$magang->alamat}}</p>
                    @else
                    <p class="text-muted text-center"><i class="fas fa-map-marker-alt"></i></p>
                    @endif 
                  </div>
                  <div class="col-md-8">
                    <div class="card-body box-profile">
                        <ul class="list-group list-group-unbordered">
                            <li class="list-group-item">
                              <div class="row">
                                  <div class="col-6"><b>Website</b></div>
                                  @if (!empty($magang->website))
                                  <div class="col-6">{{$magang->website}}</div>
                                  @else
                                  <div class="col-6"></div>
                                  @endif 
                              </div>
                            </li>
                            
                            <li class="list-group-item">
                              <p><b>Deskripsi</b></p>
                              @if (!empty($magang->deskripsi))
                              <p>{{$magang->deskripsi}}</li>
                              @else
                              <p></li>
                              @endif 
                            </li>
                            <li class="list-group-item">
                              <div class="row">
                                <div class="col-6"><b>Waktu Magang</b></div>
                                @if (!empty($magang->tanggal_mulai) && ($magang->tanggal_selesai))
                                <div class="col-6">{{$magang->tanggal_mulai}} - {{$magang->tanggal_selesai}}</div>
                                @else
                                <div class="col-6"></div>
                                @endif
                              </div> 
                            </li>
                            <li class="list-group-item">
                              <p><b>Jobdesk</b></p>
                              @if (!empty($magang->jobdesk))
                              <p>{{$magang->jobdesk}}</li>
                              @else
                              <p></li>
                              @endif 
                            </li>
                            <li class="list-group-item">
                              <div class="col-6"><b>Laporan Akhir</b> &nbsp <a data-toggle="modal" data-target="#modal-default" class="btn btn-warning text-center py-0 align-middle show_laporan" ><i class="nav-icon fas fa-eye"></i></a></div>
                            </li>
                        </ul>
                    </div>
                  </div>
                </div>
                <br>

                <div class="modal fade" id="modal-laporan">
                  <div class="modal-dialog modal-lg">
                      <div class="modal-content">
                          <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                              </button>
                          </div>
                          
                          <div class="modal-body">
                              <div class="row justify-content-center">
                              @if(empty($laporan->berkas)) <p>Belum upload laporan</p>
                              @else
                              <iframe src="{{ asset('/uploads/users/mahasiswa/laporanakhir/' . $laporan->berkas) }}"
                                      style="width:700px; height:700px;" frameborder="0">
                              </iframe>
                              @endif
                              </div>
                              <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                              </div>
                              
                          </div>
                      </div>
                      <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
              </div>
              <!-- /.modal -->

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
                  @foreach($kelompoks as $kel)
                  <tr>
                    <td>{{$kel->nim}}</td>
                    <td>{{$kel->nama}}
                    </td>
                    <td>{{$kel->no_hp}}</td>
                    <td>{{$kel->status_keanggotaan}}</td>
                    <td class="text-center py-0 align-middle">
                        <div class="btn-group btn-group-sm">
                          <a href="/admin/mahasiswa/{{$kel->id_mahasiswa}}" class="btn btn-info"><i class="fas fa-eye"></i></a>
                        </div>
                      </td>
                  </tr>
                  @endforeach
                  </tbody>
                </table>
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
<!-- page script -->
<script>
    $(document).on('click', '.show_laporan', function(){
        $('#modal-laporan').modal('show');
    });

</script>
@endsection