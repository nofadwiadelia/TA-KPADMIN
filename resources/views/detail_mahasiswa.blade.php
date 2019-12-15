@extends('welcome')
@section('content')
<section class="content-header">
    </section>
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data User Mahasiswa</h3>
            </div>
            <!-- /.card-header -->
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

                            <h3 class="profile-username text-center">Nofa Dwi Adelia</h3>
                            <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>NIM  </b> <a class="float-right">17/415526/SV/13391</a>
                            </li>
                            <li class="list-group-item">
                                <i class="nav-icon fas fa-users"></i> <a class="float-right">Mahasiswa</a>
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
                                <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Absensi</a></li>
                                <li class="nav-item"><a class="nav-link" href="#kelompok" data-toggle="tab">Kelompok</a></li>
                                <li class="nav-item"><a class="nav-link" href="#nilai" data-toggle="tab">Penilaian</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="info">
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <h2 style="font-weight: 600;">Nofa Dwi Adelia</h2>
                                            <p class="text-muted">Saya adalah seorang mahasiswa yang rajin :D</p>
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
                                                <td>17/425526/SV/13391</td>
                                                <td>Nofa Dwi Adelia</td>
                                                <td>089622372993</td>
                                                <td>nofa.dwi.adelia@mail.ugm.ac.id</td>
                                                </tr>
                                        </table><br/>
                                        <strong><i class="fas fa-pencil-alt mr-1"></i> Keahlian</strong>
                                        <p class="text-muted">Laravel, Frontend Android, API</p><br/>
                                        <strong><i class="far fa-file-alt mr-1"></i> Pengalaman</strong>
                                        <p class="text-muted">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam fermentum enim neque.</p>
                                    </div>
                                </div>
                            
                                <div class="tab-pane" id="settings">
                                    <form class="form-horizontal">
                                    <div class="form-group row">
                                        <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                                        <div class="col-sm-10">
                                        <input type="email" class="form-control" id="inputName" placeholder="Name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-10">
                                        <input type="email" class="form-control" id="inputEmail" placeholder="Email">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputName2" class="col-sm-2 col-form-label">Name</label>
                                        <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputName2" placeholder="Name">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputExperience" class="col-sm-2 col-form-label">Experience</label>
                                        <div class="col-sm-10">
                                        <textarea class="form-control" id="inputExperience" placeholder="Experience"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="inputSkills" class="col-sm-2 col-form-label">Skills</label>
                                        <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputSkills" placeholder="Skills">
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                        <div class="checkbox">
                                            <label>
                                            <input type="checkbox"> I agree to the <a href="#">terms and conditions</a>
                                            </label>
                                        </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <div class="offset-sm-2 col-sm-10">
                                        <button type="submit" class="btn btn-danger">Submit</button>
                                        </div>
                                    </div>
                                    </form>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="nilai">
                                    <div class="card-header">
                                        <h5 class="card-title">Penilaian Supervisor</h5>
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
                                        <h5 class="card-title">Penilaian Dosen Pembimbing</h5>
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
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="kelompok">
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                        <a href=""><h2 style="font-weight: 600;">Cyber</h2></a>
                                        </div>
                                        <div class="col-md-12 text-center">
                                        <p>Status : Ketua</p>
                                        </div>
                                    </div>
                                    <div class="card-header">
                                        <h5 class="card-title">Anggota Lain</h5>
                                    </div>
                                    <div class="card-primary card-outline">
                                    <div class="card-body"><br>
                                        <div class="row">
											<div class="col-md-5">
                                                <!-- Profile Image -->
                                                <div class="card card-primary card-outline">
                                                <div class="card-body box-profile">
                                                    <div class="text-center">
                                                    <img class="profile-user-img img-responsive img-circle" src="../../dist/img/user4-128x128.jpg" alt="User profile picture">
                                                    </div>

                                                    <h3 class="profile-username text-center">Febi Fiolanda</h3>
                                                    
                                                    <ul class="list-group list-group-unbordered mb-3">
                                                        <li class="list-group-item">
                                                            <b>NIM</b> <a class="float-right">17/410000/SV/12908</a>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <b>Nomor HP</b> <a class="float-right">083869281843</a>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <b>Status</b> <a class="float-right">anggota</a>
                                                        </li>
                                                    </ul>
                                                    <a href="https://pklkomsi.000webhostapp.com/admin/mahasiswa/profilListing/2" class="btn btn-success btn-block"><b>Detail Mahasiswa</b></a>
                                                    </div>
                                                    <!-- /.box-body -->
                                                </div>
                                                <!-- /.box -->
                                            </div>
                                            <!-- /.col -->
                                            <div class="col-md-5">
                                                <!-- Profile Image -->
                                                <div class="card card-primary card-outline">
                                                <div class="card-body box-profile">
                                                    <div class="text-center">
                                                    <img class="profile-user-img img-responsive img-circle" src="../../dist/img/user4-128x128.jpg" alt="User profile picture">
                                                    </div>

                                                    <h3 class="profile-username text-center">Dear Nasyita</h3>
                                                    
                                                    <ul class="list-group list-group-unbordered mb-3">
                                                        <li class="list-group-item">
                                                            <b>NIM</b> <a class="float-right">17/410000/SV/12908</a>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <b>Nomor HP</b> <a class="float-right">083869281843</a>
                                                        </li>
                                                        <li class="list-group-item">
                                                            <b>Status</b> <a class="float-right">anggota</a>
                                                        </li>
                                                    </ul>
                                                    <a href="https://pklkomsi.000webhostapp.com/admin/mahasiswa/profilListing/2" class="btn btn-success btn-block"><b>Detail Mahasiswa</b></a>
                                                    </div>
                                                    <!-- /.box-body -->
                                                </div>
                                                <!-- /.box -->
                                            </div>
                                            <!-- /.col -->
										</div>   
                                        <br/>
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