@extends('mahasiswa.base')
@section('content')
   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Profil Mahasiswa</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a>Mahasiswa</a></li>
              <li class="breadcrumb-item active">Profil Mahasiswa</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      
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

                            <h3 class="profile-username text-center">Dear Nasyita</h3>
                            <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>NIM  </b> <a class="float-right">17/415526/SV/12757</a>
                            </li>
                            <li class="list-group-item">
                                <i class="nav-icon fas fa-users"></i> <a class="float-right">Mahasiswa</a>
                            </li>
                            <li class="list-group-item">
                                <b>CV  </b> 
                                <a href="https://sutaryofe.staff.uns.ac.id/files/2011/09/SISTEMATIKA-PENULISAN-PAPER.pdf"class="btn btn-primary view-pdf float-right text-center py-0 align-middle" >lihat</a>
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
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="info">
                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <h2 style="font-weight: 600;">Dear Nasyita</h2>
                                            
                                        </div>
                                    </div></br>

                                    <div class="card-body card-primary card-outline table-responsive p-0"></br>
										<div class="row">
											<div class="col-12">
												<div class="row">
													<div class="col-md-3">
														<div class="form-group">
															<label for="fname">NIM </label>
															<input type="text" class="form-control" id="nim" name="nim" placeholder="NIM" >
															<input type="hidden" class="form-control required" id="id_mahasiswa" name="id_mahasiswa">
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															<label for="fname">Nama </label>
															<input type="text" class="form-control" id="nama" name="nama" placeholder="Nama" >
															<input type="hidden" class="form-control required" id="id_mahasiswa" name="id_mahasiswa">
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															<label for="fname">No.HP </label>
															<input type="text" class="form-control" id="nim" name="nim" placeholder="No.HP" >
															<input type="hidden" class="form-control required" id="id_mahasiswa" name="id_mahasiswa">
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group">
															<label for="fname">Email </label>
															<input type="text" class="form-control" id="email" name="email" placeholder="Email" >
															<input type="hidden" class="form-control required" id="id_mahasiswa" name="id_mahasiswa">
														</div>
													</div>
												</div>
											</div>
										</div>
										
										
											

											
											
                                                
                                        </table><br/>

                                        <strong><i class="fas fa-pencil-alt mr-1"></i> Keahlian</strong>
                                        <div class="row">
											<div class="col-md-12">
												<div class="form-group">
								
													<textarea type="text" class="form-control required" id="kemampuan" name="kemampuan" rows="5" maxlength="1000" placeholder="Contoh : Menguasai Bahasa pemrograman HTML, CSS, PHP, ..."></textarea>
													<p class="text-muted"><small><i>*Pisahkan dengan koma, Max 1000 karakter</i></small></p>
												</div>
											</div>
										</div>

										<strong><i class="far fa-file-alt mr-1"></i> Pengalaman </strong>

										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
												
													<textarea type="text" class="form-control required" id="pengalaman" name="pengalaman" rows="5" maxlength="1000" placeholder="Contoh : Project Penilaian PKL (Full-Stack Developer), ..."></textarea>
													<p class="text-muted"><small><i>*Pisahkan dengan koma, Max 1000 karakter</i></small></p>
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-6">
												<label for="fname">Foto Profil</label>     
												<div class="form-group">
													<input type="file" class="form-control required" id="cv" name="cv">
													<p class="text-muted"><small><i>*Format JPG. Max ukuran 3 MB</i></small></p>
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-6">
												<label for="fname">CV</label>     
												<div class="form-group">
													<input type="file" class="form-control required" id="cv" name="cv">
													<p class="text-muted"><small><i>*CV dalam format PDF. Max ukuran 3 MB</i></small></p>
												</div>
											</div>
										</div>
									</div>
									</br>
                                    <div class="box-footer float-right">
								        <a href="/editprofil" class="btn btn-default">Edit</a>
							          	<button type="submit" class="btn btn-primary"> Simpan </button>
                    </div>
                                </div>

                                
                                <div class="tab-pane" id="kelompok">
                                    <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="text-center">
                                                <img class="profile-user-img img-fluid img-circle"
                                                    src="../../dist/img/user4-128x128.jpg"
                                                    alt="User profile picture">
                                            </div>
                                            <h3 class="profile-username text-center">DEAR NASYITA</h3>
							               
                                        
                                            <div class="card-body box-profile">
                                                <ul class="list-group list-group-unbordered">
                                                    <li class="list-group-item">
                                                    <b>Nama</b> <a class="float-right">Dear Nasyita</a>
                                                    </li>
                                                    <li class="list-group-item">
                                                    <b>NIM</b> <a class="float-right" >17/410830/SV/12757</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <div class="text-center">
                                                <img class="profile-user-img img-fluid img-circle"
                                                    src="../../dist/img/user4-128x128.jpg"
                                                    alt="User profile picture">
                                            </div>
                                            <h3 class="profile-username text-center">FEBI FIOLANDA</h3>
                                            
                                        
                                            <div class="card-body box-profile ">
                                                <ul class="list-group list-group-unbordered">
                                                    <li class="list-group-item">
                                                    <b>Nama</b> <a class="float-right">Febi Fiolanda</a>
                                                    </li>
                                                    <li class="list-group-item">
                                                    <b>NIM</b> <a class="float-right">17/410836/SV/13378</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        

                                        

                                        <div class="col-md-6">
                                        </br></br>
                                            <div class="text-center">
                                                <img class="profile-user-img img-fluid img-circle"
                                                    src="../../dist/img/user4-128x128.jpg"
                                                    alt="User profile picture">
                                            </div>
                                            <h3 class="profile-username text-center">NOFA DWI ADELIA</h3>
							               
                                       
                                            <div class="card-body box-profile">
                                                <ul class="list-group list-group-unbordered">
                                                    <li class="list-group-item">
                                                    <b>Nama</b> <a class="float-right">Nofa Dwi Adelia</a>
                                                    </li>
                                                    <li class="list-group-item">
                                                    <b>NIM</b> <a class="float-right" >17/41188/SV/13391</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
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
                                                        <h5><i class="fa fa-user" ></i> Dibimbing Dosen <strong>IMAM FAHRURROZI M.Cs</strong></h5>
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
                                            <h3 class="profile-username text-center">IMAM FAHRURROZI M.Cs</h3>
							               
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body box-profile">
                                                <ul class="list-group list-group-unbordered">
                                                    <li class="list-group-item">
                                                    <b>Email</b> <a class="pull-right">imam.fahrurrozi@ugm.ac.id</a>
                                                    </li>
                                                    <li class="list-group-item">
                                                    <b>Nomor Telepon</b> <a class="pull-right" >083869281843</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>


                                        </hr>

                                        <div class="col-md-12 text-center">
                                            <div class="card-body box-profile">
                                                <ul class="list-group list-group-unbordered">
                                                    <li class="list-group-item list-group-unbordered">
                                                        <h5><i class="fas fa-building" ></i> Magang di <strong>PT KAI</strong></h5>
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
                                           
                                            <h3 class="profile-username text-center">PT KAI</h3>
							                <p class="text-muted text-center"><i class="fas fa-map-marker-alt"></i> Jakarta Timur, DKI Jakarta <br>13640</p>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="card-body box-profile">
                                                <ul class="list-group list-group-unbordered">
                                                    <li class="list-group-item">
                                                    <p><b>Posisi</b></p>
                                                    <p>Frontend </li>
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