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

                            <h3 class="profile-username text-center">{{ $mahasiswa->nama_lengkap }}</h3>
                            <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>NIM  </b> <a class="float-right">17/415526/SV/12757</a>
                            </li>
                            <li class="list-group-item">
                                <i class="nav-icon fas fa-users"></i> <a class="float-right">{{ $mahasiswa->nama }}</a>
                            </li>
                            <li class="list-group-item">
                                <b>CV  </b> 
                                <a data-toggle="modal" data-target="#modal-default" class="btn btn-primary view-pdf float-right text-center py-0 align-middle" ><i class="nav-icon fas fa-eye"></i></a>
                            </li>
                        </div>
                        <!-- /.card-body -->


                        <div class="modal fade" id="modal-default">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h4 class="modal-title">CV</h4>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                          <div class="form-group row">
                                            
                                          </div>
                                          <div class="form-group row">
                                             
                                          </div>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                          
                                        </div>
                                      </div>
                                      <!-- /.modal-content -->
                                    </div>
                                    <!-- /.modal-dialog -->
                                  </div>
                                  <!-- /.modal -->
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
                                            <h2 style="font-weight: 600;">{{ $mahasiswa->nama_lengkap }}</h2>
                                            
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
                                                <td>{{ $mahasiswa->nim }}</td>
                                                <td>{{ $mahasiswa->nama_lengkap }}</td>
                                                <td>{{ $mahasiswa->no_hp }}</td>
                                                <td>{{ $mahasiswa->email }}</td>
                                                </tr>
                                        </table><br/>
                                        <strong><i class="fas fa-pencil-alt mr-1"></i> Keahlian</strong>
                                        <p class="text-muted">{{ $mahasiswa->keahlian }}</p><br/>
                                        <strong><i class="far fa-file-alt mr-1"></i> Pengalaman</strong>
                                        <p class="text-muted">{{ $mahasiswa->pengalaman }}</p>
                                    </div>
                                    <div class="box-footer float-right">
								        <a href="/mahasiswa/editprofil/{{$mahasiswa->id}}" class="btn btn-default">Edit</a>
							          	
                                     </div>
                                </div>

                                
                                <div class="tab-pane" id="kelompok">
                                    <div class="col-12">

                                    <div class="col-md-12 text-center">
                                            <div class="card-body box-profile">
                                                <ul class="list-group list-group">
                                                    <li class="list-group-item list-group-unbordered">
                                                        <h5><i class="fas fa-users" ></i> <strong>Anggota Kelompok</strong></h5>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    
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
                                    </br>
                                        <div class="col-md-12 text-center">
                                            <div class="card-body box-profile">
                                                <ul class="list-group list-group">
                                                    <li class="list-group-item list-group-unbordered">
                                                        <h5><i class="fas fa-clock" ></i> <strong>Jadwal Presentasi</strong></h5>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        
                                        <div class="row  justify-content-center">
                                            
                                            <div class="col-md-9">
                                        
                                                <div class="card-body box-profile ">
                                            
                                                    <ul class="list-group list-group">
                                                    <li class="list-group-item">
                                                        <i class="nav-icon fas fa-calendar-alt"> Hari,Tanggal</i> <a class="float-right">Jumat, 19 April 2020</a>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <i class="nav-icon fas fa-clock"> Waktu</i> <a class="float-right">14.00 WIB</a>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <i class="nav-icon fas fa-building"> Ruang</i> <a class="float-right">Lab Techno</a>
                                                    </li>
                                                    <li class="list-group-item">
                                                        <i class="nav-icon fas fa-user"> Penguji</i> <a class="float-right">Yusron Fuadi</a>
                                                    </li>
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
                                                <ul class="list-group list-group">
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


                                        </br>

                                        <div class="col-md-12 text-center">
                                            <div class="card-body box-profile">
                                                <ul class="list-group list-group">
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
                                                    <p><b>Deskripsi</b></p>
                                                    <p>Membuat SI Daftar barang , posisi : Frontend </li>
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

@section('scripts')
<!-- DataTables -->
<script src="../../plugins/datatables/jquery.dataTables.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();
  });
  (function(a){a.createModal=function(b){defaults={title:"",message:"Your Message Goes Here!",closeButton:true,scrollable:false};var b=a.extend({},defaults,b);var c=(b.scrollable===true)?'style="max-height: 420px;overflow-y: auto;"':"";html='<div class="modal fade" id="myModal">';html+='<div class="modal-dialog">';html+='<div class="modal-content">';html+='<div class="modal-header">';html+='<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>';if(b.title.length>0){html+='<h4 class="modal-title">'+b.title+"</h4>"}html+="</div>";html+='<div class="modal-body" '+c+">";html+=b.message;html+="</div>";html+='<div class="modal-footer">';if(b.closeButton===true){html+='<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>'}html+="</div>";html+="</div>";html+="</div>";html+="</div>";a("body").prepend(html);a("#myModal").modal().on("hidden.bs.modal",function(){a(this).remove()})}})(jQuery);

/*
* Here is how you use it
*/
$(function(){    
    $('.view-pdf').on('click',function(){
        var pdf_link = $(this).attr('href');
        var iframe = '<div class="iframe-container"><iframe src="'+pdf_link+'"></iframe></div>'
        $.createModal({
        title:'Laporan Akhir',
        message: iframe,
        closeButton:true,
        scrollable:false
        });
        return false;        
    });    
})
</script>

@endsection