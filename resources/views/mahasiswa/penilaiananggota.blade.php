@extends('mahasiswa.base')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Penilaian Kelompok</h1>
          </div>
            <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a>Mahasiswa</a></li>
              <li class="breadcrumb-item active">Penilaian Kelompok</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
<section class="content">

<div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Penilaian Anggota Kelompok</h3>
            </div>
            <div class="card-body">
                <form role="form">
					<div class="box-body">
						<div class="col-md-12 text-center">
                        <div class="col-md-1"> </div>
                        <div class="row justify-content-center">
                            <div class="col-md-2">
                                <span class="badge badge-success"> 5 </span>
                                <br>Sangat Baik
                            </div>
							
                            <div class="col-md-2"> 
                                <span class="badge badge-primary"> 4 </span>
                                <br>Baik
                            </div>

                            <div class="col-md-2">
                                <span class="badge badge-warning"> 3 </span>
                                <br>Cukup
                            </div>
							<div class="col-md-2">
                                <span class="badge badge-danger"> 2 </span>
                                <br>Kurang
                            </div>
							
                            <div class="col-md-2">
                                <span class="badge badge-secondary"> 1 </span>
                                <br>Sangat Kurang
                            </div>
						</div>
                    </div>
                    <!-- form start -->
                    <br>
					<br>

					<form role="form">
                  		<!-- <div class="col-sm-12">
                  			<a href="/formnilai" class="btn btn-success float-right btn-sm">
							  <i class="fas fa-plus"></i> Beri Nilai 
							</a> <br><br>
                 		 </div> -->
                	</form>
					<form role="form" id="editPenilaian" method="post">
						<div class="row">
								<div class="col-md-3">                                
									<div class="form-group text-center">
										<label for="fname">Nama Mahasiswa</label>
										<!-- <select class="form-control required" id="id_penilaian" name="id_penilaian">
                                            <option value="">Pilih Nama</option>
                                            <option value="2">Nofa</option>
                                            <option value="3">Febi</option>
                                        </select> -->
									</div>
								</div>
							
								<div class="col-md">
									<div class="form-group text-center">
										<label for="fname">Skill</label>
										<!-- <input type="number"  class="form-control required" id="kebersamaan" name="kebersamaan" value="3"> -->
									</div>
								</div>
								<div class="col-md">
									<div class="form-group text-center">
										<label for="fname">Kerapihan</label>
										<!-- <input type="number"  class="form-control required" id="sikap" name="sikap" value="4"> -->
									</div>
								</div>
								<div class="col-md">
									<div class="form-group text-center">
										<label for="fname">Sikap</label>
										<!-- <input type="number"  class="form-control required" id="sikap" name="sikap" value="4"> -->
									</div>
								</div>
							
								<div class="col-md">
									<div class="form-group text-center">
										<label for="fname">Keaktifan</label>
										<!-- <input type="number"  class="form-control required" id="keaktifan" name="keaktifan" value="5"> -->
									</div>
								</div>
								<div class="col-md">
									<div class="form-group text-center">
										<label for="fname">Perhatian</label>
										<!-- <input type="number"  class="form-control required" id="skill" name="skill" value="5"> -->
									</div>
								</div>
								<div class="col-md">
									<div class="form-group text-center">
										<label for="fname">Kehadiran</label>
										<!-- <input type="number"  class="form-control required" id="sikap" name="sikap" value="4"> -->
									</div>
								</div>
								<div class="col-md">
									<div class="form-group text-center">
										<label for="fname">Total</label>
									</div>
								</div>
							</div>
							
							<!-- isi nilai -->
							<div class="row">
								<div class="col-md-3">                                
									<div class="form-group text-center">
									<input type="text" class="form-control required" id="nama_mahasiswa" value="Nofa Dwi Adelia">

									</div>
								</div>
							
								<div class="col-md">
									<div class="form-group text-center">
										<input type="number" min="1" max="5" class="form-control required" id="kebersamaan" name="kebersamaan" value="3">
									</div>
								</div>
								<div class="col-md">
									<div class="form-group text-center">
										<input type="number" min="1" max="5" class="form-control required" id="sikap" name="sikap" value="4">
									</div>
								</div>
								<div class="col-md">
									<div class="form-group text-center">
										<input type="number" min="1" max="5" class="form-control required" id="sikap" name="sikap" value="4">
									</div>
								</div>
							
								<div class="col-md">
									<div class="form-group text-center">
										<input type="number" min="1" max="5" class="form-control required" id="keaktifan" name="keaktifan" value="5">
									</div>
								</div>
								<div class="col-md">
									<div class="form-group text-center">
										<input type="number" min="1" max="5" class="form-control required" id="skill" name="skill" value="5">
									</div>
								</div>
								<div class="col-md">
									<div class="form-group text-center">
										<input type="number" min="1" max="5" class="form-control required" id="sikap" name="sikap" value="4">
									</div>
								</div>
								<div class="col-md">
									<div class="form-group text-center">
									<span class="badge badge-success">29 </span>
									</div>
								</div>	
							</div>

							<div class="row">
								<div class="col-md-3">                                
									<div class="form-group text-center">
									<input type="text" class="form-control required" id="nama_mahasiswa" value="Dear Nasyita">

									</div>
								</div>
							
								<div class="col-md">
									<div class="form-group text-center">
										<input type="number" min="1" max="5" class="form-control required" id="kebersamaan" name="kebersamaan" value="3">
									</div>
								</div>
								<div class="col-md">
									<div class="form-group text-center">
										<input type="number" min="1" max="5" class="form-control required" id="sikap" name="sikap" value="4">
									</div>
								</div>
								<div class="col-md">
									<div class="form-group text-center">
										<input type="number" min="1" max="5" class="form-control required" id="sikap" name="sikap" value="4">
									</div>
								</div>
							
								<div class="col-md">
									<div class="form-group text-center">
										<input type="number" min="1" max="5" class="form-control required" id="keaktifan" name="keaktifan" value="5">
									</div>
								</div>
								<div class="col-md">
									<div class="form-group text-center">
										<input type="number" min="1" max="5" class="form-control required" id="skill" name="skill" value="5">
									</div>
								</div>
								<div class="col-md">
									<div class="form-group text-center">
										<input type="number" min="1" max="5" class="form-control required" id="sikap" name="sikap" value="4">
									</div>
								</div>
								<div class="col-md">
									<div class="form-group text-center">
									<span class="badge badge-success"> 25 </span>
									</div>
								</div>	
							</div>


							<br>


							<div class="row">
								<div class="col-md-12">                                
									<div class="form-group">
										<label for="fname">Keterangan</label>
										<ol>
											<li><b>Skill</b> : Kemampuan dalam menyelesaikan tugas</li>
											<li><b>Kerapihan</b> : Berpakaian, cara kerja, penampilan</li>
											<li><b>Sikap</b> : Kesopanan, menghormati, menghargai orang lain</li>
											<li><b>Keaktifan</b> : Bertanya, mengeluarkan pendapat, tidak malas-malasan</li>
											<li><b>Perhatian</b> :  Keingintahuan, kepatuhan dalam bimbingan</li>
											<li><b>Kehadiran</b> : Kehadiran PKL, efisien waktu</li>

											
											
										</ol>
									</div>
								</div>
							</div>
						</div><!-- /.box-body -->
						
						<div class="box-footer">
							<input type="submit" class="btn btn-success float-right " value="Simpan">
						</div>
					</form>
                </div>
           
            </div>
        </div>    
    </section>
@endsection