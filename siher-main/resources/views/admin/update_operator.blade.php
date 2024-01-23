@extends('layout.BaseView',['title'=>"Update Data | Sistem Heregistarsi Mahasiswa"])
@section('content')
<div class="main-content container-fluid">
    <div class="page-title">
        <h3>{{$u->fname." ".$u->lname}}</h3>
    </div>
    <section class="section">
        <div class="row mb-4">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Form Input Data Operator</h4>
                    </div>

                    <div class="card-body">
                        <form action="{{url('update/operator/'.$u->nim)}}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fname">First Name</label>
                                        <input type="text" class="form-control @error('fname') is-invalid @enderror"
                                            placeholder="First Name" name="fname" value="{{old('fname')??$u->fname}}">
                                        @error('fname')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="helperText">Nip</label>
                                        <input type="text" class="form-control @error('nim') is-invalid @enderror"
                                            placeholder="Nip" name="nim" value="{{old('nim') ?? $u->nim}}">
                                        @error('nim')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <small class="text-muted">eg.<i>someone@example.com</i></small>
                                        <input type="text" class="form-control  @error('email') is-invalid @enderror"
                                            id="email" name="email" value="{{old('email') ?? $u->email}}">
                                        @error('email')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="lname">Last Name</label>
                                        <input type="text" class="form-control  @error('lname') is-invalid @enderror"
                                            placeholder="Last Name" name="lname" value="{{old('lname') ?? $u->lname}}">
                                        @error('lname')
                                        <div class="invalid-feedback">
                                            {{$message}}
                                        </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input type="text" class="form-control" readonly="readonly" value="123456"
                                            name="password">
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
