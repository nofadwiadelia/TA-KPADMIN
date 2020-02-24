@extends('mahasiswa.base')
@section('content')
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Pengumuman</h1>
          </div>
          <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a>Mahasiswa</a></li>
                <li class="breadcrumb-item active">Pengumuman</li>
              </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
        <!-- Timelime example  -->
        <div class="row">
          <div class="col-md-12">
            <!-- The time line -->
            @foreach ($data as $datas)
            <div class="timeline">
              
              <!-- timeline time label -->
              <div class="time-label">
                <span class="bg-red">{{ $datas->created_at->format('d F Y') }}</span>
              </div>
              <!-- /.timeline-label -->
              <!-- timeline item -->
              <div>
                <i class="fas fa-angle-right bg-blue"></i>
                <div class="timeline-item">
                  <h3 class="timeline-header"><a>{{ $datas->judul }}</a></h3>
                  <div class="timeline-body">
                  {{ $datas->detail }}
                    <div class="row justify-content-center">
                      <button type="button" class="btn">
                        <b><a  data-toggle="modal" data-target="#modal-lg">tampilkan lampiran</a></b>
                      </button>
                    </div>
                   
                  </div> 
                  
                </div>
                </br>
                @endforeach 
              </div>
              <!-- END timeline item -->
              <!-- timeline item -->
              
            </div>                     
          </div>
        </div>
          <!-- /.col -->
          <div class="modal fade show" id="modal-lg">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Lampiran</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
              <div class="modal-body">
                <div class="form-group row">
                  <div class="modal-footer justify-content-between">
                  <img src="{{ URL::to('uploads/file/'.$datas->photo)}}" style="width: 600px; height: 500px;">
                  
                  
                  </div>
                  
                </div>
             </div>
                                    <!-- /.modal-dialog -->
          </div>
                                  <!-- /.modal -->
        </div>
      </div>
      <!-- /.timeline -->

    </section>
@endsection