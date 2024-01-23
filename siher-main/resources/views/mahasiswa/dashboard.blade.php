@extends('layout.BaseView',['title'=>'Dashboard | Sistem Heregistarsi Mahasiswa'])
@section('content')
<div class="main-content container-fluid">
    <div class="page-title">
        <h3>Dashboard</h3>
    </div>
    <section class="section">
   
        <div class="row mb-4">
            @if (session()->has('pesan'))
                {!!session()->get('pesan')!!}
            @endif
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Selamat Datang di Her-Registrasi Online</h3>
                    </div>
                    <div class="card-body">
                        <h3 class="text-left">Petunjuk :</h3>
                        <ol>
                            <li>Sebelum Registrasi Pastikan Telah Mengisi Biodata pada <b>SIAKAD</b> </li>
                            <li>Mahasiswa Login Melalui Website : <b>{{request()->url()}} </b></li>  
                            <li>Setiap Mahasiswa Mengisi Form <a href="{{route('biodata')}}">Biodata</a> dan <a href="{{route('document')}}">Document</a> dengan Lengkap dan Benar.</li>  
                            <li>Sebelum Mengisi Formulir Registrasi, Siapkan Berkas Untuk di Upload : </li>
                                <ul>
                                    <li><b>Pasfoto Terbaru 3x4 berlatar Merah/Biru menggunakan Uniform</b> <a href="{{route('profil')}}">Klik disini</a> untuk upload pasfoto</li>
                                    <img src="{{asset('images/pasfoto.jpg')}}" />
                                    <li>KRS Berjalan.</li>
                                    <li>KHS Semester Sebelumnya.</li>
                                    <li>Scan Slip Kwitansi/Slip Pembayaran yang Sah Cicilan UK.</li>
                                    <p><b>Note : Slip Kwitansi/Pembayaran Asli Wajib Disimpan</b></p>
                                </ul>  
                            <li>Administrator Melakukan Verifikasi dan Validasi Data dan Berkas.</li>
                            <li>Data dan Berkas Yang Telah di Verifikasi Dapat Dilihat Melalui Menu Registrasi Pada akun Mahasiswa.</li>
                            <li>Mahasiswa <b>Mencetak Bukti Her-Registrasi Online</b> Sebagai Bukti Registrasi Ulang.</li>
                        </ol> 
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
