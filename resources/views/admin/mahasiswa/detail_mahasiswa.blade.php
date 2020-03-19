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
                                src="../../dist/img/user4-128x128.jpg"
                                alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center">{{ $mahasiswa->nama }}</h3>
                            <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>NIM  </b> <a class="float-right">17/415526/SV/13391</a>
                            </li>
                            <li class="list-group-item">
                                <i class="nav-icon fas fa-users"></i> <a class="float-right">{{ $role->roles }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>CV  </b> <a class="float-right">CV.pdf</a>
                            </li>
                        </div>
                        <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
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
                                    <div class="card-body card-primary card-outline table-responsive p-0">
                                        <table class="table no-border">
                                                <tr>
                                                <th>NIM</th>
                                                <th>Nama</th>
                                                <th>No.HP</th>
                                                <th>Email</th>
                                                </tr>
                                                <tr>
                                                <td>{{$mahasiswa->nim}}</td>
                                                <td>{{$mahasiswa->nama}}</td>
                                                <td>{{$mahasiswa->no_hp}}</td>
                                                <td>{{$mahasiswa->email}}</td>
                                                </tr>
                                        </table><br/>
                                        <strong><i class="fas fa-pencil-alt mr-1"></i> Keahlian</strong>
                                        <p class="text-muted">{{$mahasiswa->kemampuan}}</p><br/>
                                        <strong><i class="far fa-file-alt mr-1"></i> Pengalaman</strong>
                                        <p class="text-muted">{{$mahasiswa->pengalaman}}</p>
                                    </div>
                                </div>
                                <div class="tab-pane" id="kelompok">
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                        <a href=""><h2 style="font-weight: 600;">{{$kelompok->nama_kelompok}}</h2></a>
                                        </div>
                                        <div class="col-md-12 text-center">
                                        <p>Status : {{$kelompok->status}}</p>
                                        </div>
                                    </div>
                                    <div class="card-header">
                                        <h5 class="card-title">Anggota Lain</h5>
                                    </div>
                                    <div class="card-primary card-outline">
                                    <div class="card-body"><br>
                                        <div class="row">
                                        @php
                                            $i=0;
                                            $jumlahData = 3;
                                        @endphp

                                        @foreach($anggota as $anggotas)

                                            @php
                                            if ($i++ % $jumlahData == 0) {
                                                echo "<div class='row margin-bottom-10'>";
                                            }
                                            @endphp
											<div class="col-md-5">
                                                <!-- Profile Image -->
                                                <div class="card card-primary card-outline">
                                                <div class="card-body box-profile">
                                                    <div class="text-center">
                                                    <img class="profile-user-img img-responsive img-circle" src="../../dist/img/user4-128x128.jpg" alt="User profile picture">
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
                                                            <b>Status</b> <a class="float-right">{{$anggotas->status}}</a>
                                                        </li>
                                                    </ul>
                                                    <a href="/admin/mahasiswa/{{$anggotas->id_mahasiswa}}" class="btn btn-success btn-block"><b>Detail Mahasiswa</b></a>
                                                    </div>
                                                    <!-- /.box-body -->
                                                </div>
                                                <!-- /.box -->
                                            </div>
                                            <!-- /.col -->
                                            @php
                                            if ($i % $jumlahData == 0 || $i == $anggota->count()) {
                                                echo "</div>";
                                            }
                                            @endphp
                                        @endforeach
										</div>   
                                        <br/>
                                    </div>
                                    </div>
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
                                                    src="../../dist/img/user4-128x128.jpg"
                                                    alt="User profile picture">
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
                                                        <h5><i class="fas fa-building" ></i> Magang di <strong>ICON+</strong></h5>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="text-center">
                                                <img class="profile-user-img img-fluid img-circle"
                                                    src="../../dist/img/user4-128x128.jpg"
                                                    alt="User profile picture">
                                            </div>
                                            <h3 class="profile-username text-center">ICON+</h3>
							                <p class="text-muted text-center"><i style="color: #de0000" class="fa fa-map-marker"></i> Jakarta Timur, DKI Jakarta <br>13640</p>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body box-profile">
                                                <ul class="list-group list-group-unbordered">
                                                    <li class="list-group-item">
                                                    <p><b>Deskripsi Instansi</b></p>
                                                    <p> Didirikan pada tanggal 3 Oktober 2000, PT Indonesia Comnets Plus (ICON+) berfokus pada penyediaan jaringan, jasa, dan content telekomunikasi, khusus untuk mendukung teknologi dan system informasi PT PLN (Persero) dan publik..</p>
                                                    </li>
                                                    <li class="list-group-item">
                                                    <p><b>Alamat Instansi</b></p>
                                                    <p> PT Indonesia Comnets Plus
                                                    Kawasan PLN Cawang,
                                                    Jl. Mayjend Sutoyo No. 1, Cililitan
                                                    Jakarta Timur, 13640.</p>
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
                                            <div class="col-12"><b> <h5 class="float-right">Jumlah jam produktif : {{$jam_produktif}}</h5></b></div>
                                        </div>
                                        <div class="row">
                                            <div class="col-12"><b> <h5 class="float-right">Selama {{$hari_produktif}} hari</h5></b></div>
                                        </div>
                                        <!-- <h5 class="float-right">Jumlah jam produktif : 345jam</h5><br>
                                        <h5 class="float-right">Selama : 35hari</h5> -->
                                    </div><br>
                                    <div class="card-primary">
                                    <div class="card-body table-responsive p-0">
                                        <table id="example1" class="table table-bordered table-striped">
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
                                            <p style="font-size: 40px"><b>4.4295</b></p>
                                        </div>
                                    </div>
                                    <!-- ./row -->
                                    <div class="row">
                                        <div class="col-md-3 text-center">
                                            <p>Nilai Instansi (Mentor)</p>
                                            <p style="font-size: 40px"><b>1.35</b></p>
                                        </div>
                                        <div class="col-md-3 text-center">
                                            <p>Nilai Dosen Pembimbing</p>
                                            <p style="font-size: 40px"><b>1.13</b></p>
                                        </div>
                                        <div class="col-md-3 text-center">
                                            <p>Nilai Tim Penguji</p>
                                            <p style="font-size: 40px"><b>1.3</b></p>
                                        </div>
                                        <div class="col-md-3 text-center">
                                            <p>Nilai Total Teman</p>
                                            <p style="font-size: 40px"><b>0.6495</b></p>
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
                                                    <th>Jumlah Nilai</th>
                                                </tr>
                                                <tr>
                                                <td>4</td>
                                                <td>5</td>
                                                <td>5</td>
                                                <td>4</td>
                                                <td>3</td>
                                                <td>5</td>
                                                <td>26</td>
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
                                                    <th>Jumlah Nilai</th>
                                                </tr>
                                                <tr>
                                                <td>4</td>
                                                <td>5</td>
                                                <td>5</td>
                                                <td>4</td>
                                                <td>3</td>
                                                <td>5</td>
                                                <td>26</td>
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
                                                    <th>Jumlah Nilai</th>
                                                </tr>
                                                <tr>
                                                <td>4</td>
                                                <td>5</td>
                                                <td>5</td>
                                                <td>4</td>
                                                <td>3</td>
                                                <td>26</td>
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
                                                    <th>Jumlah Nilai</th>
                                                </tr>
                                                <tr>
                                                <td>4</td>
                                                <td>5</td>
                                                <td>5</td>
                                                <td>4</td>
                                                <td>26</td>
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
    $("#example1").DataTable();
  });
</script>
@endsection