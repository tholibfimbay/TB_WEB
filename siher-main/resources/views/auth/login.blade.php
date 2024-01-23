@extends('layout.AuthView',['title'=>'Login'])
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-5 col-sm-12 mx-auto">
            <div class="card pt-4">
                <div class="card-body">
                    <div class="text-center mb-5">
                        <img src="{{asset('images/favicon.svg')}}" height="48" class='mb-4'>
                        <h3>Login</h3>
                        <p>Silahka login terlebih dahahulu untuk melanjutkan he-registrasi</p>
                    </div>
                    @if (session()->has('pesan'))
                        {!!session()->get('pesan')!!}
                    @endif
                    <form action="/login" method="POST">
                        @csrf
                        <div class="form-group position-relative has-icon-left">
                            <label for="email">Email</label>
                            <div class="position-relative">
                                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{old('email')}}">
                                <div class="form-control-icon">
                                    <i data-feather="user"></i>
                                </div>
                            </div>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group position-relative has-icon-left">
                            <label for="password">Password</label>
                            <div class="position-relative">
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password">
                                <div class="form-control-icon">
                                    <i data-feather="lock"></i>
                                </div>
                            </div>
                            @error('email')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class='form-check clearfix my-4'>
                            <div class="float-right">
                                <a href="{{url('auth/register')}}">Tidak memiliki akun ?</a>
                            </div>
                        </div>
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