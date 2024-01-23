@extends('layout.BaseView')
@section('content')
<script>
    function printContent(el){
        var restorepage = document.body.innerHTML;
        var printcontent = document.getElementById(el).innerHTML;
        document.body.innerHTML = printcontent;
        window.print();
        document.body.innerHTML = restorepage;
    }
</script>
    
<div class="main-content container-fluid">
    <section class="section">
   
        <div class="row mb-4">
            @if (session()->has('pesan'))
                {!!session()->get('pesan')!!}
            @endif
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        @if ($h->status == "Verifikasi")
                        <div class="alert alert-info" role="alert">
                            {{Auth::user()->fname}} proses heregistrasi sedang diverifikasi oleh admin,
                            silahkan menunggu untuk melanjutkan pencetakan kartu hasil.
                        </div>
                        @if ($u->avatar == "default.png")
                            <ul>
                                <li>Foto profil kamu juga belum di update, silahkan upload <a href="{{route('profil')}}">disini</a> untuk proses persetujuan heregistrasi</li>
                            </ul>
                        @endif
                        @elseif ($h->status == "Sukses")
                        <div class="alert alert-info" role="alert">
                            {{Auth::user()->fname}} proses heregistrasi sudah berhasil silahkan cetak kartu hasil heregistrasi kamu .
                        </div>
                        <center><button onclick="printContent('kartu')" class="btn btn-info">Cetak Kartu</button></center
                        @elseif($h->status == "Gagal")
                        <div class="alert alert-danger" role="alert">
                            {{Auth::user()->fname}} proses heregistrasi gagal.<br>
                            {{$h->detail}}
                        </div>
                        <center>
                        <button type="button" class="btn btn-outline-warning btn-sm" data-toggle="modal" data-target="#reset">
                            Reset Akun
                        </button>
                        </center>
                        <hr>
                        <ul>
                            <li>Silahkan lakukan reset akun terlebih dahulu atau hubungi admin unutk info lebih lanjut.</li>
                        </ul>
                        @endif
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>


<!----------------------------------------DIALOG------------------------------------------------------------->
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
    Dengan me-reset akun KAMU akan kehilangan data document dan biodata yang telah disis sebelumnya dan akan mengubah password akun menjadi default yaitu : <b>123456</b>.
    Jika anda yakin silahkan lanjut.
    </div>
    <div class="modal-footer">
    <button type="button" class="btn btn-light-secondary" data-dismiss="modal">
        <i class="bx bx-x d-block d-sm-none"></i>
        <span class="d-none d-sm-block">Close</span>
    </button>
    <form action="{{url('account/'.Auth::user()->nim.'/reset')}}" method="POST"> 
        @method('PUT')
        @csrf
        <input type="submit" class="btn btn-warning ml-1" value="Accept">
    </form>
    </div>
</div>
</div>
</div>


@if ($u and $h and $b and $d)
<!----------------------------------------PRINT AREA--------------------------------------------------------->
    <div class="print-area" id="kartu" style="display: none">
        
        <div class="banner">
            <img src="{{asset('cetak/banner-penusa.png')}}" alt="Banner">
        </div>
        <div class="title row align-items-center justify-content-center">
            <div class="col-auto">
                <h1><u>Cetak Bukti Her-Registrasi Online</u></h1>
            </div>
        </div>
        <br><br>
        <div class="row">
            <div class="col-auto ml-3">
                <table>
                    <tr>
                        <td>NAMA</td>
                        <td>:</td>
                        <td>{{$u->fname ." ". $u->lname}}</td>
                    </tr>
                    <tr>
                        <td>NIM</td>
                        <td>:</td>
                        <td>{{$u->nim}}</td>
                    </tr>
                    <tr>
                        <td>SEMESTER</td>
                        <td>:</td>
                        <td>{{$b->semester}}</td>
                    </tr>
                    <tr>
                        <td>EMAIL</td>
                        <td>:</td>
                        <td>{{Auth::user()->email}}</td>
                    </tr>
                    <tr>
                        <td>IPK TERAKHIR</td>
                        <td>:</td>
                        <td>{{$b->ipk}}</td>
                    </tr>
                </table>
            </div>
            <div class="col-3 ml-auto">
                <img src="{{asset('images/avatar/'.$u->avatar.'')}}" class="img-fluid" alt="Foto">
            </div>
        </div>
        <div class="file-list">
            <p>Kelengkapan Berkas :</p>
            <table>
                <thead>
                    <tr>
                        <td>No</td>
                        <td>Nama Berkas</td>
                        <td>Pemeriksaan</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Upload Kartu Hasil Studi (KHS) Semester terakhir</td>
                        <td>[✓]</td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Upload Kartu Rencana Studi (KHS) Semester berjalan</td>
                        <td>[✓]</td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Upload Kwitansi Cicilan Uang Kuliah</td>
                        <td>[✓]</td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Pengisian Biodata Mahasiswa di Website Siakad Penusa (siakad.penusa.ac.id)</td>
                        <td>[✓]</td>
                    </tr>
                </tbody>
            </table>
        </div>
    
        <div class="signature row">
            <div class="col-auto">
                <p>Medan, 06 September 2020</p>
                <p>Administrator Her-Registrasi Online</p>
                <p>STMIK Pelita Nusantara.</p>
                <img src="{{asset('cetak/stamp.jpg')}}" alt="Stamp" id="stamp-image" />
            </div>
        </div>
    </div>
@endif
@endsection