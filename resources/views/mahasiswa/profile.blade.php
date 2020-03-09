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
            <!-- Main content -->
                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <br>
                    <div class="text-center">
                        <img class="profile-user-img img-fluid img-circle"
                        src="../../dist/img/user4-128x128.jpg"
                        alt="User profile picture">
                    </div>

                    <form action="/mahasiswa/editavatar/{{$mahasiswa->id}}" method="post" enctype="multipart/form-data">                                            
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                        <div class="box-body">
                            <div class="row justify-content-center">
                                <div class="col-md-9">     
                                </br>                           									
                                    <div class="input-group input-group-sm">
                                        <input type="file" class="form-control required" id="foto" name="foto">
                                        <input type="hidden" class="form-control required" id="id_mahasiswa" name="id_mahasiswa" value="5">                         
                                        <span class="input-group-append">
                                            <button type="submit" class="btn btn-info btn-flat" >Save</button>
                                        </span>
                                    </div>
                                        <p class="text-muted"><small><i>*Max ukuran 1 MB, JPG|PNG</i></small></p>					
                                </div>
                            </div>    
                        </div>
                    </form>
                    
                    <div class="box-body">
                        <div class="row justify-content-center">
                            <div class="col-md-12">     
                                </br>        
                                <h3 class="profile-username text-center"><b>{{ $mahasiswa->nama_lengkap }}</b></h3>
                                <div class="row justify-content-center">
                                    <div class="col-md-9">
                                        <ul class="list-group list-group-unbordered mb-3">
                                            <li class="list-group-item">
                                                <b>NIM </b> <a class="float-right">{{ $mahasiswa->nim }}</a>
                                            </li>
                                            <li class="list-group-item">
                                                <i class="nav-icon fas fa-users"></i> <a class="float-right">{{ $mahasiswa->nama }}</a>
                                            </li>
                                            <li class="list-group-item">
                                                <b>CV  </b> 
                                                <a data-toggle="modal" data-target="#modal-default" class="btn btn-warning view-pdf float-right text-center py-0 align-middle" ><i class="nav-icon fas fa-eye"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="modal-default">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">CV</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
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
        <div class="col-12">
            <!-- Main content -->
                <!-- Profile Image -->
                <div class="card card-primary card-outline">
                    <div class="box-body">
                        <div class="card-body ">
                            <div class="tab-content">
                                <div class="card-body card-primary table-responsive p-0">
                                    <table class="table no-border">
                                            <tr>
                                            <th>NIM</th>
                                            <th>Nama Lengkap</th>
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
                                </br>
                                <div class="box-footer float-right">
                                    <a href="/mahasiswa/editprofil/{{$mahasiswa->id}}" class="btn btn-info">Edit</a>                                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card -->
        </div>
        <!-- /.col -->
                            
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