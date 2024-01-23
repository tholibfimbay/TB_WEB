@extends('layout.BaseView',['title'=>'Data Operator | Sistem Heregistarsi Mahasiswa'])
@section('content')
<div class="main-content container-fluid">
    <div class="page-title">
        <h3>Data Operator</h3>
    </div>
    <section class="section">
       
        <div class="row mb-4">
            <div class="col">
            @if (session()->has('pesan'))
                {!!session()->get('pesan')!!}
            @endif
                <div class="card">
                    <div class="card-header">
                        Data Operator
                    </div>
                    <div class="card-body">
                        <table class='table table-striped' id="table1">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Nip</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($query as $i)
                                <tr>
                                    <td><a href="{{url('operator/'.$i->nim)}}">{{$i->fname." ".$i->lname}}</td>
                                    <td>{{$i->email}}</td>
                                    <td>{{$i->nim}}</td>
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
