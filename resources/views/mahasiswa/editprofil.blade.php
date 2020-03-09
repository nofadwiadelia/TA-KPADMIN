@extends('mahasiswa.base')
@section('content')
   <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Profil Mahasiswa</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a>Mahasiswa</a></li>
              <li class="breadcrumb-item active">Edit Profil Mahasiswa</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
	
		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<form action="/mahasiswa/editprofil/{{$mahasiswa->id}}" method="post" enctype="multipart/form-data">
					{{ csrf_field() }}
					{{ method_field('PUT') }}
						<div class="box-body">
							<div class="row">
								<div class="col-md-12">         
								<label>CV</label>                       
									<div class="input-group input-group">
										<input type="file" class="form-control required" id="cv" name="cv">
										<span class="input-group-append">
											<button type="button" class="btn btn-info btn-flat">Save</button>
										</span>
									</div>
								</div>
							</div>
						</div>
					
				</div>  
			</div>
		</div>


		<div class="col-12">
			<div class="card">
				<div class="card-body">
					<div class="card-body card-primary  table-responsive p-0"></br>
						<div class="row">
							<div class="col-12">
								<div class="row">
									<div class="col-md-3">
										<div class="form-group">
											<label for="fname">NIM </label>
											<input type="text" class="form-control" id="nim" name="nim" placeholder="NIM" value="{{ $mahasiswa->nim }}">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="fname">Nama Lengkap</label>
											<input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap" placeholder="Nama Lengkap" value="{{ $mahasiswa->nama_lengkap }}">
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="fname">No.HP </label>
											<input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="No.HP" value="{{ $mahasiswa->no_hp }}" >
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="fname">Email </label>
											<input type="text" class="form-control" id="email" name="email" placeholder="Email" value="{{ $mahasiswa->email }}" >
										</div>
									</div>
								</div>
							</div>
						</div><br/>
						<strong><i class="fas fa-pencil-alt mr-1"></i> Keahlian</strong>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<textarea type="text" class="form-control" id="keahlian" name="keahlian" maxlength="1000" placeholder="Contoh : Menguasai Bahasa pemrograman HTML, CSS, PHP, ..." value="{{ $mahasiswa->keahlian }}"></textarea>
									<p class="text-muted"><small><i>*Pisahkan dengan koma, Max 1000 karakter</i></small></p>
								</div>
							</div>
						</div>
						<strong><i class="far fa-file-alt mr-1"></i> Pengalaman </strong>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<input type="text" class="form-control" id="pengalaman" name="pengalaman" maxlength="1000" placeholder="Contoh : Project Penilaian PKL (Full-Stack Developer), ..." value="{{ $mahasiswa->pengalaman }}"></input>
									<p class="text-muted"><small><i>*Pisahkan dengan koma, Max 1000 karakter</i></small></p>
								</div>
							</div>
						</div>
					</div>
					</br>
					<div class="box-footer float-right">
						<button type="submit" class="btn btn-info"> Simpan </button>
					</div>
				</div>

									
			</form>
			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->
    </section>
    <!-- /.content -->
@endsection