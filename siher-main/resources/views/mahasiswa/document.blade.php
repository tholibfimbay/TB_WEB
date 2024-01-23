@extends('layout.BaseView',['title'=>"Document | Sistem Heregistarsi Mahasiswa"])
@section('content')
<div class="main-content container-fluid">
    <div class="page-title">
        <h3>Upload Document</h3>
    </div>
    <section class="section">
        <div class="row mb-4">
            @if (session()->has('pesan'))
            {!!session()->get('pesan')!!}
            @endif
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <form action="{{url('/document/simpan')}}" method="POST" enctype="multipart/form-data">
                          @csrf
                          <div class="row">
                              <div class="col">
                                  <div class="form-group">
                                      <label for="KHS">KHS</label>
                                      <input type="file" class="form-control @error('khs') is-invalid @enderror()"
                                          name="khs">
                                      <small id="helpId" class="form-text text-muted">File KHS Dengan Type Document
                                          ataupun Gambar (Max 2.5Mb)</small>
                                      @error('khs')
                                      <div class="invalid-feedback">
                                          {{$message}}
                                      </div>
                                      @enderror
                                  </div>
                                  <div class="form-group">
                                      <label for="KRS">KRS</label>
                                      <input type="file" class="form-control @error('krs') is-invalid @enderror()"
                                          name="krs">
                                      <small id="helpId" class="form-text text-muted">File KRS Dengan Type Document
                                          ataupun Gambar (Max 2.5Mb)</small>
                                      @error('krs')
                                      <div class="invalid-feedback">
                                          {{$message}}
                                      </div>
                                      @enderror
                                  </div>
                                  <div class="form-group">
                                      <label for="UK">Cicilan UK</label>
                                      <input type="file" class="form-control @error('uk') is-invalid @enderror()"
                                          name="uk">
                                      <small id="helpId" class="form-text text-muted">File Cicilan UK Dengan Type
                                          Document ataupun Gambar (Max 2.5Mb)</small>
                                      @error('krs')
                                      <div class="invalid-feedback">
                                          {{$message}}
                                      </div>
                                      @enderror
                                  </div>
                                  <div class="form-group">
                                      <input type="submit" class="btn btn-info btn-sm" value="Submit">
                                  </div>
                              </div>
                          </div>
                      </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
