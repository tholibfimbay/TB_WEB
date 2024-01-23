@extends('layout.AuthView',['title'=>'Register'])
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-7 col-sm-12 mx-auto">
            <div class="card pt-4">
                <div class="card-body">
                    <div class="text-center mb-5">
                        <img src="{{asset('images/favicon.svg')}}" height="48" class='mb-4'>
                        <h3>Register</h3>
                        <p>Silahkan isi kolom untuk melakukan pendaftaran</p>
                    </div>
                    <form action="/register" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" id="first-name-column" class="form-control @error('fname') is-invalid @enderror" name="fname" value="{{old('fname')}}">
                                @error('fname')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" id="last-name-column" class="form-control @error('lname') is-invalid @enderror" name="lname" value="{{old('lname')}}">
                                    @error('lname')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label>Nim</label>
                                    <input type="text" class="form-control @error('nim') is-invalid @enderror" name="nim" value="{{old('nim')}}">
                                    @error('nim')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{old('email')}}">
                                    @error('email')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" name="password">
                                    @error('password')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label>Confirmed Password</label>
                                    <input type="password" class="form-control" name="password_confir">
                                </div>
                            </div>
                        </diV>

                                <a href="{{url('auth/login')}}">Memiliki Akun? Login</a>
                        <div class="clearfix">
                            <input type="submit" class="btn btn-primary float-right" value="Submit">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection