@extends('admin.base')
@section('content')
<!-- Content Wrapper. Contains page content -->
    <!-- Content Header (Page header) -->
    <section class="content-header">
    </section>
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
                <form action="{{ route('pengumuman.update', $data->id_pengumuman) }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Judul *</label>
                            <input type="text" name="judul" id="judul" required  class="form-control" value="{{ $data->judul }}" maxlength="100">
                            <p class="text-muted"><small><i>*Max 100 karakter</i></small></p>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Deskripsi *</label>
                            <textarea name="deskripsi" id="deskripsi" required class="form-control" maxlength="1000">{{ $data->deskripsi }}</textarea>
                            <p class="text-muted"><small><i>*Max 1000 karakter</i></small></p>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Lampiran</label>
                              <div class="input-group">
                                <div class="custom-file">
                                  <input type="file" name="lampiran" id="lampiran" class="form-control" value="{{ $data->deskripsi }}">
                                  <!-- <input type="file" class="custom-file-input" id="exampleInputFile"> -->
                                  <label class="custom-file-label" for="lampiran">Choose file</label>
                                </div>
                              </div>
                              <p class="text-muted"><small><i>*jpg,png,jpeg</i></small></p>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                      <div class="d-flex flex-row justify-content-end">
                          <span class="mr-2">
                          <button type="reset" class="btn btn-danger">Cancel</button>
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


@endsection