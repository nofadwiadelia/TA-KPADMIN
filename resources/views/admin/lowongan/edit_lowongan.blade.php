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
                <li class="breadcrumb-item active">Lowongan</li>
                <li class="breadcrumb-item active">Edit</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
                <form id="editLowonganForm">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Posisi *</label>
                            <input type="text" class="form-control" name="pekerjaan" id="pekerjaan" value="{{$lowongan->pekerjaan}}">
                        </div>
                        <div class="form-group">
                        <label for="exampleInputPassword1">Persyaratan *</label>
                            <textarea name="persyaratan" id="persyaratan" class="form-control {{ $errors->has('persyaratan') ? 'is-invalid':'' }}" value="{{$lowongan->persyaratan}}"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Kapasitas *</label>
                            <input type="number" class="form-control" name="kapasitas" id="kapasitas" value="{{$lowongan->kapasitas}}">
                        </div>
                        <div class="form-group">
                          <label>Instansi *</label>
                          <select name="id_instansi" id="id_instansi" class="form-control select2" style="width: 100%;">
                              <option selected="selected">{{$lowongan->instansi->nama}}</option>
                              @foreach($instansi as $instansis)
                              <option value="{{ $instansis->id_instansi }}">{{ $instansis->nama }}</option>
                              @endforeach
                          </select >
                        </div>
                        <div class="form-group">
                          <label>Periode *</label>
                          <select name="id_periode" class="form-control select2" style="width: 100%;">
                              <option selected="selected">{{$lowongan->periode->tahun_periode}}</option>
                              @foreach($periode as $periodes)
                              <option value="{{ $periodes->id_periode }}">{{ $periodes->tahun_periode }}</option>
                              @endforeach
                          </select >
                        </div>
                        <input type="hidden" name="id_lowongan" id="id_lowongan" value="{{ $lowongan->id_lowongan }}">
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                      <div class="d-flex flex-row justify-content-end">
                          <span class="mr-2">
                          <button type="submit" class="btn btn-danger">Cancel</button>
                          </span>
                          <span>
                          <button type="submit" class="btn btn-primary">Submit</button>
                          </span>
                      </div>
                    </div>
                </form>
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
$(document).ready(function(){   
    $('#editLowonganForm').on('submit', function(e){
        e.preventDefault();

        var id = $('#id_lowongan').val();
        var pekerjaan = $('#pekerjaan').val();
        var persyaratan = $('#persyaratan').val();
        var kapasitas = $('#kapasitas').val();
        var id_instansi = $('#id_instansi').val();
        var id_periode = $('#id_periode').val();

        $.ajax({
            type: "PUT",
            headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
            url: "/api/admin/lowongan/"+id+"/edit",
            cache:false,
            dataType: "json",
            data: $('#editLowonganForm').serialize(),
            success: function(data){
                window.location = "/admin/lowongan";
                toastr.options.closeButton = true;
                toastr.options.closeMethod = 'fadeOut';
                toastr.options.closeDuration = 100;
                toastr.success(data.message);
            },
            error: function(error){
            console.log(error);
            }
        });
    });
});
</script>



@endsection