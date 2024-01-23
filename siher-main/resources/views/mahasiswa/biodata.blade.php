@extends('layout.BaseView',['title'=>"Biodata | Sistem Heregistarsi Mahasiswa"])
@section('content')
<div class="main-content container-fluid">
    <div class="page-title">
        <h3>Isi Biodata</h3>
    </div>
    <section class="section">
        <div class="row mb-4">
            @if (session()->has('pesan'))
            {!!session()->get('pesan')!!}
            @endif
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Form Biodata</h4>
                    </div>
                    
                    <div class="card-body">
                        <form action="{{url('biodata/simpan')}}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>Nim</label>
                                        <input type="text" class="form-control" name="nim" value="{{$u->nim}}" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label>IP</label>
                                        <input type="text" class="form-control @error('ipk') is-invalid @enderror"
                                            placeholder="4.0" name="ipk" value="{{old('ipk')}}" required>
                                        @error('ipk')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                      <label for="Semseter">Semester</label>
                                      <select class="form-control @error('semester') is-invalid @enderror" name="semester" id="">
                                        <?php for($i=1;$i<=8;$i++){
                                            echo '<option value="'.$i.'">Semsester '.$i.'</option>';
                                        } ?>
                                      </select>
                                      @error('semsester')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Alamat</label>
                                        <textarea class="form-control @error('alamat') is-invalid @enderror" rows="7" name="alamat" required></textarea>
                                        @error('alamat')
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
