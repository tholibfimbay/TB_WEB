@extends('layout.BaseView',['title'=>'Menunggu Verifikasi | Sistem Heregistarsi Mahasiswa'])
@section('content')
<div class="main-content container-fluid">
    <div class="page-title">
        <h3>Menunggu Verifikasi</h3>
    </div>
    <section class="section">
        <div class="row mb-4">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Data Mahasiswa Yang Telah Melakukan Pengisian Biodata &amp; Document
                    </div>
                    <div class="card-body">
                        <table class='table table-striped' id="table1">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Nim</th>
                                    <th>Tgl Daftar</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($query as $i)
                                <tr>
                                    <td><a href="{{url('mahasiswa/'.$i->nim)}}">{{$i->fname." ".$i->lname}}</a></td>
                                    <td>{{$i->email}}</td>
                                    <td>{{$i->nim}}</td>
                                    <td>{{$i->created_at->format('d M Y')}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
