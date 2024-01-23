
@extends('layout.AuthView',['title'=>'Home Page'])
@section('content')

<div class="container">
    <div class="row">
        <div class="col col-sm-12 mx-auto">
            <div class="card pt-4">
                <div class="card-body">
                    <div class="text-center mb-5">
                        <img src="{{asset('images/logo.png')}}" height="48" class='mb-4'>
                        <hr>
                    </div>
                    SIHER - Sistem Heregistrasi Mahasiswa Online adalah sebuah aplikasi web yang ditujukan untuk
                    mempermudah mahasiswa/i dalam melakukan heregistrasi. Dengan mendapatkan data diri seperti
                    Biodata mahasiswa dan Document pendukung. Sistem ini bersifat open source

                    informasi lebih lanjut silahkan cek di <a href="https://github.com/rickyginting/siher">Github</a>
                    <hr>
                    Created <a href="https://fb.com/icky.12">Ricky Martin Ginting</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection