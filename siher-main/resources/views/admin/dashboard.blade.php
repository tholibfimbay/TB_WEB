@extends('layout.BaseView',['title'=>'Dashboard | Sistem Heregistarsi Mahasiswa'])
@section('content')
<div class="main-content container-fluid">
    <div class="page-title">
        <h3>Dashboard</h3>
    </div>
    <section class="section">
       @include('layout.Widget')
        @if (session()->has('pesan'))
            {!!session()->get('pesan')!!}
        @endif
        <div class="row mb-4">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Data Mahasiswa
                    </div>
                    <div class="card-body">
                        <table class='table table-striped' id="table1">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Nim</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($query as $i)
                                <tr>
                                    <td><a href="{{url('mahasiswa/'.$i->nim)}}">{{$i->fname." ".$i->lname}}</a></td>
                                    <td>{{$i->email}}</td>
                                    <td>{{$i->nim}}</td>
                                    <td>
                                        @if ($i->status == 'Terdaftar')
                                            <span class="badge bg-info">{{$i->status}}</span>
                                        @elseif($i->status == 'Verifikasi')
                                            <span class="badge bg-warning">{{$i->status}}</span>
                                        @elseif ($i->status == 'Sukses')
                                             <span class="badge bg-success">{{$i->status}}</span>
                                        @else
                                            <span class="badge bg-danger">{{$i->status}}</span>
                                        @endif
                                    </td>
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
