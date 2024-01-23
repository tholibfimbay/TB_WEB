@extends('layout.BaseView',['title'=>$u->fname." ".$u->lname." | Sistem Heregistarsi Mahasiswa"])
@section('content')
<div class="main-content container-fluid">
    <div class="page-title">
        <h3>{{$u->fname." ".$u->lname}}<span class="badge bg-info">{{$h->status}}</span> </h3>
    </div>
    @if (session()->has('pesan'))
    <div class="alert alert-info" role="alert">
        {{session()->get('pesan')}}
    </div>
    @endif
    <section class="section">
       
        <div class="row mb-4">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Data Mahasiswa
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-2">
                                <div class="card">
                                    <div class="card-body">
                                       <img src="{{asset('images/avatar/'.$u->avatar)}}" class="img-fluid ${3|rounded-top,rounded-right,rounded-bottom,rounded-left,rounded-circle,|}" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="card">
                                    <div class="card-header">
                                        <b>File Heregistrasi</b>
                                    </div>
                                    <hr>
                                    <div class="card-body">
                                        <table>
                                            @if ($d)
                                            <tr>
                                                <td> <a href="{{url('khs/'.$u->nim.'/download')}}" ><i data-feather="file"></i>File KHS</a></td>
                                            </tr>
                                            <tr>
                                                <td> <a href="{{url('krs/'.$u->nim.'/download')}}" ><i data-feather="file"></i>File KRS</a></td>
                                            </tr>
                                            <tr>
                                                <td> <a href="{{url('uk/'.$u->nim.'/download')}}" ><i data-feather="file"></i>File Cicilan UK</a></td>
                                            </tr>
                                            @else
                                            <tr>
                                                <td> <a href="#" ><i data-feather="file"></i>KHS Belum di upload</a></td>
                                            </tr>
                                            <tr>
                                                <td> <a href="#" ><i data-feather="file"></i>KRS Belum di upload</a></td>
                                            </tr>
                                            <tr>
                                                <td> <a href="#" ><i data-feather="file"></i>Cicilan UK Belum di upload</a></td>
                                            </tr>
                                            @endif
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="card">
                                    <div class="card-header">
                                       <b>Biodata Mahasiswa</b>
                                    </div>
                                    <hr>
                                    <div class="card-body">
                                        <table>
                                            <tr>
                                                <td>Nama : </td>
                                                <th>{{$u->fname." ".$u->lname}}</th>
                                            </tr>
                                            <tr>
                                                <td>Nim : </td>
                                                <th>{{$u->nim}}</th>
                                            </tr>
                                            <tr>
                                                <td>Email : </td>
                                                <th><a href="mailto:{{$u->email}}">{{$u->email}}</a></th>
                                            </tr>
                                            <tr>
                                                <td>Tgl. Register : </td>
                                                <th>{{$u->created_at->format('d M yy')}}</th>
                                            </tr>
                                            @if (!$b)
                                            <tr>
                                                <td>IPK : </td>
                                                <th>Data Belum Di Isi</th>
                                            </tr>
                                            <tr>
                                                <td>Alamat : </td>
                                                <th>Data Belum Di Isi</th>
                                            </tr>
                                            @else
                                            <tr>
                                                <td>IPK : </td>
                                                <th>{{$b->ipk}}</th>
                                            </tr>
                                            <tr>
                                                <td>Alamat : </td>
                                                <th>{{$b->alamat}}</th>
                                            </tr>
                                            @endif
                                        </table>
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                    </div>
                    
                </div>
                @if ($h->status =="Terdaftar")
                        Note : Mahasiswa Telah Mendaftar di Portal pada tanggal {{$h->created_at->format('d M Y')." perhitungan ".$h->created_at->diffForhumans()}}
                    @else
                        Note : {!!$h->detail!!}
                    @endif
                <div class="buttons">

                    <button type="button" class="btn btn-outline-warning btn-sm" data-toggle="modal" data-target="#reset">
                        Reset Akun
                    </button>
                    <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#hapus">
                        Hapus Akun
                    </button>
                    <button type="button" class="btn btn-outline-success btn-sm" data-toggle="modal" data-target="#tolak">
                        Tolak Proses
                    </button>
                    <button type="button" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#simpan">
                        Simpan Data
                    </button>
                </div>
            </div>
        </div>
    </section>
</div>

<!--RESET-->
<div class="modal fade text-left" id="reset" tabindex="-1" role="dialog"
aria-labelledby="myModalLabel120" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
<div class="modal-content">
    <div class="modal-header bg-warning">
    <h5 class="modal-title white" id="myModalLabel120">Apakah Kamu Yakin ???</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <i data-feather="x"></i>
    </button>
    </div>
    <div class="modal-body">
    Dengan me-reset akun <b>{{$h->fname}}</b> akan kehilangan data document dan biodata yang telah disis sebelumnya dan akan mengubah password akun menjadi default yaitu : <b>123456</b>.
    Jika anda yakin silahkan lanjut.
    </div>
    <div class="modal-footer">
    <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
        <i class="bx bx-x d-block d-sm-none"></i>
        <span class="d-none d-sm-block">Close</span>
    </button>
    <form action="{{url('mahasiswa/'.$h->nim.'/reset')}}" method="POST"> 
        @method('PUT')
        @csrf
        <input type="submit" class="btn btn-warning ml-1" value="Accept">
    </form>
    </div>
</div>
</div>
</div>

<!--HAPUS-->
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
    Penghapusan akun ini bersifat permanent, yang dapat mengakibatkan <b>{{$h->fname}}</b> tidak akan dapat login, dan menyelesaikan tugas sebagai <b>{{$h->role}}</b>.
    Semua berkas Document dan Biodata akan di hapus juga melalui sistem
    </div>
    <div class="modal-footer">
    <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
        <i class="bx bx-x d-block d-sm-none"></i>
        <span class="d-none d-sm-block">Close</span>
    </button>
    <form action="{{url('mahasiswa/'.$h->nim.'/delete')}}" method="POST"> 
        @method('DELETE')
        @csrf
        <input type="submit" class="btn btn-danger ml-1" value="Accept">
    </form>
    </div>
</div>
</div>
</div>

<!--TOLAK-->
<div class="modal fade text-left" id="tolak" tabindex="-1" role="dialog"
aria-labelledby="myModalLabel120" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
<div class="modal-content">
    <div class="modal-header bg-success">
    <h5 class="modal-title white" id="myModalLabel120">Apakah Kamu Yakin ???</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <i data-feather="x"></i>
    </button>
    </div>
    <form action="{{url('mahasiswa/'.$h->nim.'/tolak')}}" method="POST" class="d-inline"> 
    <div class="modal-body">
    Proses heregistrasi <b>{{$h->fname}}</b> akan <b>Ditolak</b> yang akan mengakibatkan data Document dan Biodata akan di hapus dari sistem. 
    Tinggalkan sebuah pesan masukan kepada Mahasiswa untuk memperbaiki kesalahan heregistrasi
        <textarea class="form-control" rows="10" name="detail" required></textarea>
</div>
    <div class="modal-footer">
    <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
        <i class="bx bx-x d-block d-sm-none"></i>
        <span class="d-none d-sm-block">Close</span>
    </button>
    
        @method('PUT')
        @csrf
        <input type="submit" class="btn btn-success ml-1" value="Accept">
    </form>
    </div>
</div>
</div>
</div>

<!--SIMPAN-->
<div class="modal fade text-left" id="simpan" tabindex="-1" role="dialog"
aria-labelledby="myModalLabel120" aria-hidden="true">
<div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
<div class="modal-content">
    <div class="modal-header bg-info">
    <h5 class="modal-title white" id="myModalLabel120">Apakah Kamu Yakin ???</h5>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <i data-feather="x"></i>
    </button>
    </div>
    <div class="modal-body">
    Dengan menyimpan data <b>{{$h->fname}}</b> staus heregistrasi di nyatakan telah berhasil. Apakah semua data sudah benar. Jika ya silahkan di simpan
    </div>
    <div class="modal-footer">
    <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
        <i class="bx bx-x d-block d-sm-none"></i>
        <span class="d-none d-sm-block">Close</span>
    </button>
    <form action="{{url('mahasiswa/'.$h->nim.'/sukses')}}" method="POST"> 
        @method('PUT')
        @csrf
        <input type="submit" class="btn btn-info ml-1" value="Accept">
    </form>
    </div>
</div>
</div>
</div>
@endsection
