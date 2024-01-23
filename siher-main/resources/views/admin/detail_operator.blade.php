@extends('layout.BaseView',['title'=>$query->fname." ".$query->lname." | Sistem Heregistarsi Mahasiswa"])
@section('content')
<div class="main-content container-fluid">
    <div class="page-title">
        <h3>{{$query->fname." ".$query->lname}}</h3>
    </div>
    <section class="section">
       
        <div class="row mb-4">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Data Operator
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <div class="card">
                                    <div class="card-body">
                                       <img src="{{asset('images/avatar/'.$query->avatar)}}" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card">
                                    <div class="card-body">
                                        <table>
                                            <tr>
                                                <td>Nama : </td>
                                                <th>{{$query->fname." ".$query->lname}}</th>
                                            </tr>
                                            <tr>
                                                <td>Nip : </td>
                                                <th>{{$query->nim}}</th>
                                            </tr>
                                            <tr>
                                                <td>Email : </td>
                                                <th><a href="mailto:{{$query->email}}">{{$query->email}}</a></th>
                                            </tr>
                                            <tr>
                                                <td>Tgl. Register : </td>
                                                <th>{{$query->created_at->format('d M yy')}}</th>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="main">
                                    <a href="{{url('operator/'.$query->nim.'/update')}}" class="btn btn-outline-warning btn-sm">Update</a>
                                    <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#hapus">
                                        Hapus Akun
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!--Danger theme Modal -->
<div class="modal fade text-left" id="hapus" tabindex="-1" role="dialog"
aria-labelledby="myModalLabel120" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
<div class="modal-content">
    <div class="modal-header bg-danger">
    <h5 class="modal-title white" id="myModalLabel120">Apakah Kamu Yakin ???</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <i data-feather="x"></i>
    </button>
    </div>
    <div class="modal-body">
    Penghapusan akun ini bersifat permanent, yang dapat mengakibatkan <b>{{$query->fname}}</b> tidak akan dapat login, dan menyelesaikan tugas sebagai <b>{{$query->role}}</b>.
    Jika kamu yakin dengan itu silahkan Accpet
    </div>
    <div class="modal-footer">
    <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
        <i class="bx bx-x d-block d-sm-none"></i>
        <span class="d-none d-sm-block">Close</span>
    </button>
    <form action="{{url('operator/'.$query->nim.'/delete')}}" method="POST"> 
        @method('DELETE')
        @csrf
        <input type="submit" class="btn btn-danger ml-1" value="Accept">
    </form>
    {{-- <button type="button" class="btn btn-danger ml-1" data-dismiss="modal">
        <i class="bx bx-check d-block d-sm-none"></i>
        <span class="d-none d-sm-block">Accept</span>
    </button> --}}
    </div>
</div>
</div>
</div>
@endsection
