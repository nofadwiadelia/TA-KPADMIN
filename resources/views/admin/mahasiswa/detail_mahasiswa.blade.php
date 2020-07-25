@extends('admin.base')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-12">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Mahasiswa</li>
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
            <div class="card-body">
                <!-- Main content -->
                <section class="content">
                <div class="container-fluid">
                    <div class="row">
                    <div class="col-md-3">

                        <!-- Profile Image -->
                        <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                            src="{{ asset('uploads/avatar/'.$mahasiswa->foto) }}"
                                alt="User profile picture" onerror="this.onerror=null;this.src='{{ asset('/dist/img/default-avatar.png') }}';" >
                        
                            </div>

                            <h3 class="profile-username text-center">{{ $mahasiswa->nama }}</h3>
                            <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>NIM  </b> <a class="float-right">{{ $mahasiswa->nim }}</a>
                            </li>
                            <li class="list-group-item">
                                <i class="nav-icon fas fa-users"></i> <a class="float-right">{{ $role->roles }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>CV  </b> <a data-toggle="modal" data-target="#modal-default" class="btn btn-warning float-right text-center py-0 align-middle show_cv" ><i class="nav-icon fas fa-eye"></i></a>
                            </li>
                        </div>
                        <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                        <div class="modal fade" id="modal-cv">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    
                                    <div class="modal-body">
                                        <div class="row justify-content-center">
                                        @if($mahasiswa->cv == null)
                                        <p>Belum upload cv</p>
                                        @else
                                        <iframe src="{{ asset('/uploads/users/mahasiswa/cv/' . $mahasiswa->cv) }}"
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
                        
                    </div>
                    <!-- /.col -->
                    <div class="col-md-9">
                        <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#info" data-toggle="tab">Info</a></li>
                                <li class="nav-item"><a class="nav-link" href="#kelompok" data-toggle="tab">Kelompok</a></li>
                                <li class="nav-item"><a class="nav-link" href="#magang" data-toggle="tab">Magang</a></li>
                                <li class="nav-item"><a class="nav-link" href="#logbook" data-toggle="tab">Logbook</a></li>
                                <li class="nav-item"><a class="nav-link" href="#nilai" data-toggle="tab">Nilai</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="info">
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <h2 style="font-weight: 600;">{{ $mahasiswa->nama }}</h2>
                                        </div>
                                    </div></br>
                                    <div class="card-body card-primary card-outline">
                                        <div class="row">
                                            <div class="col-md-3 text-center">
                                                <p><strong>NIM</strong></p>
                                                <p class="text-muted"> {{$mahasiswa->nim}}</p>
                                            </div>
                                            <div class="col-md-3 text-center">
                                                <p><strong>No HP</strong></p>
                                                <p class="text-muted"> {{$mahasiswa->no_hp}}</p>
                                            </div>
                                            <div class="col-md-3 text-center">
                                                <p><strong>Email</strong></p>
                                                <p class="text-muted"> {{$mahasiswa->email}}</p>
                                            </div>
                                            <div class="col-md-3 text-center">
                                                <p><strong>Alamat</strong></p>
                                                <p class="text-muted"> {{$mahasiswa->alamat}}</p>
                                            </div>
                                        </div><br><br>
                                        <strong><i class="fas fa-pencil-alt mr-1"></i> Keahlian</strong>
                                        <p class="text-muted">{{$mahasiswa->kemampuan}}</p><br/>
                                        <strong><i class="far fa-file-alt mr-1"></i> Pengalaman</strong>
                                        <p class="text-muted">{{$mahasiswa->pengalaman}}</p>
                                    </div>
                                    
                                </div>
                                <div class="tab-pane" id="kelompok">
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <div class="card-body box-profile">
                                                <ul class="list-group list-group">
                                                    <li class="list-group-item list-group-unbordered">
                                                        @if($kelompok->tahap =="diterima")
                                                        <h2 style="font-weight: 600;"> <font color="#4287f5">{{$kelompok->nama_kelompok}}</font></h2>
                                                            <p>Status : {{$kelompok->status_keanggotaan}}</p>
                                                        @elseif($kelompok->tahap =="diproses")
                                                        <h5 style="font-weight: 600;"> <font color="#4287f5">Kelompok belum disetujui</font></h5>
                                                            <p>Status : {{$kelompok->status_keanggotaan}}</p>
                                                        @elseif(empty($kelompok->tahap) || ($kelompok->tahap ="ditolak"))
                                                        <h5 style="font-weight: 600;"> <font color="#4287f5">Belum memiliki kelompok</font></h5>
                                                            <p>Status : -</p>
                                                        @endif
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-header">
                                        <h5 class="card-title">Anggota Lain</h5>
                                    </div>
                                    <!-- <div class="card-primary card-outline"> -->
                                    <div class="card-body"><br>
                                    @if($kelompok->tahap =="diterima")
                                        <div class="row">
                                        @foreach($anggota as $anggotas)
											<div class="col-md-6">
                                                <!-- Profile Image -->
                                                <div class="card card-primary card-outline">
                                                <div class="card-body box-profile">
                                                    <div class="text-center">
                                                    <img class="profile-user-img img-fluid img-circle" src="{{ asset('uploads/avatar/'.$anggotas->foto) }}"
                                                        alt="User profile picture" onerror="this.onerror=null;this.src='{{ asset('/dist/img/default-avatar.png') }}';" >
                                                    </div>
                                                    

                                                    <h3 class="profile-username text-center">{{$anggotas->nama}}</h3>
                                                    
                                                    <ul class="list-group list-group-unbordered mb-3">
                                                        <li class="list-group-item">
                                                            <b>NIM</b> <a class="float-right">{{$anggotas->nim}}</a>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <b>Nomor HP</b> <a class="float-right">{{$anggotas->no_hp}}</a>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <b>Status</b> <a class="float-right">{{$anggotas->status_keanggotaan}}</a>
                                                        </li>
                                                    </ul>
                                                    <a href="/admin/mahasiswa/{{$anggotas->id_mahasiswa}}" class="btn btn-success btn-block"><b>Detail Mahasiswa</b></a>
                                                    </div>
                                                    <!-- /.box-body -->
                                                </div>
                                                <!-- /.box -->
                                            </div>
                                            <!-- /.col -->
                                        @endforeach
										</div>   
                                        <br/>
                                    @endif
                                    </div>
                                    <!-- </div> -->
                                </div>
                                <!-- /.tab-pane -->

                                <div class="tab-pane" id="magang">
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <div class="card-body box-profile">
                                                <ul class="list-group list-group-unbordered">
                                                    <li class="list-group-item list-group-unbordered">
                                                        <h5><i class="fa fa-user" ></i> Dibimbing Dosen <strong>{{$magang->nama}}</strong></h5>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="text-center">
                                                    <img class="profile-user-img img-fluid img-circle"
                                                    src="{{ asset('uploads/avatar/'.$magang->foto) }}"
                                                        alt="User profile picture" onerror="this.onerror=null;this.src='{{ asset('/dist/img/default-avatar.png') }}';" >
                                            </div>
                                            <h3 class="profile-username text-center">{{$magang->nama}}</h3>
							                <p class="text-muted text-center">NIP <br>{{$magang->nip}}</p>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body box-profile">
                                                <ul class="list-group list-group-unbordered">
                                                    <li class="list-group-item">
                                                        <div class="row">
                                                            <div class="col-6"><b>Email</b></div>
                                                            <div class="col-6">{{$magang->email}}</div>
                                                        </div>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <div class="row">
                                                            <div class="col-6"><b>No HP</b></div>
                                                            <div class="col-6">{{$magang->no_hp}}</div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="col-md-12 text-center">
                                            <div class="card-body box-profile">
                                                <ul class="list-group list-group-unbordered">
                                                    <li class="list-group-item list-group-unbordered">
                                                    @if (!empty($instansi->nama))
                                                        <h5><i class="fas fa-building" ></i> Magang di <strong>{{$instansi->nama}}</strong></h5>
                                                    @else
                                                        <h5><i class="fas fa-building" ></i> Magang di <strong>-</strong></h5>
                                                    @endif
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="text-center">
                                            @if(!empty($instansi->foto))
                                            <img class="profile-user-img img-fluid img-circle"
                                                    src="{{ asset('uploads/avatar/'.$instansi->infot) }}"
                                                        alt="User profile picture" onerror="this.onerror=null;this.src='{{ asset('/dist/img/default-avatar.png') }}';" >
                                            @else
                                            <img class="profile-user-img img-fluid img-circle"
                                                    src="{{ asset('/dist/img/default-avatar.png') }}"
                                                        alt="User profile picture">
                                            @endif
                                            
                                            </div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body box-profile">
                                                <ul class="list-group list-group-unbordered">
                                                    <li class="list-group-item">
                                                    <p><b>Deskripsi Instansi</b></p>
                                                    @if (!empty($instansi->deskripsi))
                                                    <p>{{$instansi->deskripsi}}</p>
                                                    @else
                                                    <p>-</p>
                                                    @endif
                                                    
                                                    </li>
                                                    <li class="list-group-item">
                                                    <p><i style="color: #de0000" class="fa fa-map-marker"></i><b> Alamat Instansi</b></p>
                                                    @if (!empty($instansi->alamat))
                                                    <p>{{$instansi->alamat}}</p>
                                                    @else
                                                    <p>-</p>
                                                    @endif
                                                    </li>
                                                    <li class="list-group-item">
                                                    <p><b> Jobdesk</b></p>
                                                    @if (!empty($instansi->jobdesk))
                                                    <p>{{$instansi->jobdesk}}</p>
                                                    @else
                                                    <p>-</p>
                                                    @endif
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                            
                                <div class="tab-pane" id="logbook">
                                    <div class="card-header">
                                        <div class="row text-right">
                                            <div class="col-12"><b> <h5 class="float-right">Jumlah jam produktif : {{$jam_produktif->timediff}}</h5></b></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12"><b> <h5 class="float-right">Selama {{$hari_produktif}} hari</h5></b></div>
                                        </div>
                                        <!-- <h5 class="float-right">Jumlah jam produktif : 345jam</h5><br>
                                        <h5 class="float-right">Selama : 35hari</h5> -->
                                    </div><br>
                                    <div class="card-primary">
                                    <div class="table-responsive p-0">
                                        <table id="logbooks" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                            <th>No</th>
                                            <th>Tanggal</th>
                                            <th>Datang</th>
                                            <th>Pulang</th>
                                            <th>Kegiatan</th>
                                            <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php $no = 1; @endphp
                                            @foreach($bukuharian as $buku)
                                            <tr>
                                            <td>{{$no++}}</td>
                                            <td>{{$buku->tanggal}}</td>
                                            <td>{{$buku->waktu_mulai}}</td>
                                            <td>{{$buku->waktu_selesai}}</td>
                                            <td>{{$buku->kegiatan}}</td>
                                            <td class="text-center py-0 align-middle"><span class="badge bg-warning">{{$buku->status}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    </div>
                                    </div>

                                    
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="nilai">
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <p>Nilai Akhir</p>
                                            <p style="font-size: 40px"><b>{{$finalResult}}</b></p>
                                        </div>
                                    </div>
                                    <!-- ./row -->
                                    <div class="row">
                                        <div class="col-md-3 text-center">
                                            <p>Nilai Instansi (Mentor)</p>
                                            <p style="font-size: 40px"><b>{{$resultInstansi2}}</b></p>
                                        </div>
                                        <div class="col-md-3 text-center">
                                            <p>Nilai Dosen Pembimbing</p>
                                            <p style="font-size: 40px"><b>{{$resultDospem2}}</b></p>
                                        </div>
                                        <div class="col-md-3 text-center">
                                            <p>Nilai Tim Penguji</p>
                                            <p style="font-size: 40px"><b>{{$resultPenguji2}}</b></p>
                                        </div>
                                        <div class="col-md-3 text-center">
                                            <p>Nilai Total Teman</p>
                                            <p style="font-size: 40px"><b>{{$resultTeman2}}</b></p>
                                        </div>
                                    </div>
                                    <!-- ./row -->
                                    <div class="card-header">
                                        <h5 class="card-title">Penilaian Teman</h5>
                                    </div>
                                    <div class="card-primary card-outline">
                                    <div class="card-body table-responsive p-0">
                                        <table class="table no-border">
                                                <tr>
                                                    <th>Skill</th>
                                                    <th>Kerapihan</th>
                                                    <th>Sikap</th>
                                                    <th>Keaktifan</th>
                                                    <th>Perhatian</th>
                                                    <th>Kehadiran</th>
                                                    <th>Rata" Nilai</th>
                                                </tr>
                                                <tr>
                                                @if ($resultSkillM == 'nan')<td></td>@else<td>{{$resultSkillM}}</td>@endif
                                                @if ($resultkerapihanM == 'nan')<td></td>@else<td>{{$resultkerapihanM}}</td>@endif
                                                @if ($resultsikapM == 'nan')<td></td>@else<td>{{$resultsikapM}}</td>@endif
                                                @if ($resultkeaktifanM == 'nan')<td></td>@else<td>{{$resultkeaktifanM}}</td>@endif
                                                @if ($resultperhatianM == 'nan')<td></td>@else<td>{{$resultperhatianM}}</td>@endif
                                                @if ($resultkehadiranM == 'nan')<td></td>@else<td>{{$resultkehadiranM}}</td>@endif
                                                @if ($resultTeman1 == 'nan')<td></td>@else<td>{{$resultTeman1}}</td>@endif
                                                </tr>
                                        </table><br/>
                                    </div>
                                    </div>
                                    <div class="card-header">
                                        <h5 class="card-title">Penilaian Mentor</h5>
                                    </div>
                                    <div class="card-primary card-outline">
                                    <div class="card-body table-responsive p-0">
                                        <table class="table no-border">
                                                <tr>
                                                    <th>Skill</th>
                                                    <th>Kerapihan</th>
                                                    <th>Sikap</th>
                                                    <th>Keaktifan</th>
                                                    <th>Perhatian</th>
                                                    <th>Kehadiran</th>
                                                    <th>Rata" Nilai</th>
                                                </tr>
                                                <tr>
                                                @if ($nilaiInstansiSkill == 'nan')<td></td>@else<td>{{$nilaiInstansiSkill}}</td>@endif
                                                @if ($nilaiInstansiKerapihan == 'nan')<td></td>@else<td>{{$nilaiInstansiKerapihan}}</td>@endif
                                                @if ($nilaiInstansiSikap == 'nan')<td></td>@else<td>{{$nilaiInstansiSikap}}</td>@endif
                                                @if ($nilaiInstansiKeaktifan == 'nan')<td></td>@else<td>{{$nilaiInstansiKeaktifan}}</td>@endif
                                                @if ($nilaiInstansiPerhatian == 'nan')<td></td>@else<td>{{$nilaiInstansiPerhatian}}</td>@endif
                                                @if ($nilaiInstansiKehadiran == 'nan')<td></td>@else<td>{{$nilaiInstansiKehadiran}}</td>@endif
                                                @if ($resultInstansi1 == 'nan')<td></td>@else<td>{{$resultInstansi1}}</td>@endif
                                                </tr>
                                        </table><br/>
                                    </div>
                                    </div>
                                    <div class="card-header">
                                        <h5 class="card-title">Penilaian Dosen Penguji</h5>
                                    </div>
                                    <div class="card-primary card-outline">
                                    <div class="card-body table-responsive p-0">
                                        <table class="table no-border">
                                                <tr>
                                                    <th>Keterkaitan Isi</th>
                                                    <th>Kesesuaian Tema</th>
                                                    <th>Sistematika</th>
                                                    <th>Ketepatan Waktu</th>
                                                    <th>Kekompakan</th>
                                                    <th>Rata" Nilai</th>
                                                </tr>
                                                <tr>
                                                @if ($nilaiPengujiKeterkaitan == 'nan')<td></td>@else<td>{{$nilaiPengujiKeterkaitan}}</td>@endif
                                                @if ($nilaiPengujiKesesuaian == 'nan')<td></td>@else<td>{{$nilaiPengujiKesesuaian}}</td>@endif
                                                @if ($nilaiPengujiSistematika == 'nan')<td></td>@else<td>{{$nilaiPengujiSistematika}}</td>@endif
                                                @if ($nilaiPengujiKetepatan == 'nan')<td></td>@else<td>{{$nilaiPengujiKetepatan}}</td>@endif
                                                @if ($nilaiPengujiKekompakan == 'nan')<td></td>@else<td>{{$nilaiPengujiKekompakan}}</td>@endif
                                                @if ($resultPenguji1 == 'nan')<td></td>@else<td>{{$resultPenguji1}}</td>@endif
                                                </tr>
                                        </table><br/>
                                    </div>
                                    </div>
                                    <div class="card-header">
                                        <h5 class="card-title">Penilaian Dosen Pembimbing</h5>
                                    </div>
                                    <div class="card-primary card-outline">
                                    <div class="card-body table-responsive p-0">
                                        <table class="table no-border">
                                                <tr>
                                                    <th>Skill</th>
                                                    <th>Kebersamaan</th>
                                                    <th>Sikap</th>
                                                    <th>Keaktifan</th>
                                                    <th>Rata" Nilai</th>
                                                </tr>
                                                <tr>
                                                @if ($nilaiPembimbingSkill == 'nan')<td></td>@else<td>{{$nilaiPembimbingSkill}}</td>@endif
                                                @if ($nilaiPembimbingKebersamaan == 'nan')<td></td>@else<td>{{$nilaiPembimbingKebersamaan}}</td>@endif
                                                @if ($nilaiPembimbingSikap == 'nan')<td></td>@else<td>{{$nilaiPembimbingSikap}}</td>@endif
                                                @if ($nilaiPembimbingKeaktifan == 'nan')<td></td>@else<td>{{$nilaiPembimbingKeaktifan}}</td>@endif
                                                @if ($resultDospem1 == 'nan')<td></td>@else<td>{{$resultDospem1}}</td>@endif
                                                </tr>
                                        </table><br/>
                                    </div>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->

                            <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                        </div>
                        <!-- /.nav-tabs-custom -->
                    </div>
                    <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div><!-- /.container-fluid -->
                </section>
                <!-- /.content -->
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
    $("#logbooks").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
  });

    $(document).on('click', '.show_cv', function(){
        $('#modal-cv').modal('show');
    });

</script>
@endsection