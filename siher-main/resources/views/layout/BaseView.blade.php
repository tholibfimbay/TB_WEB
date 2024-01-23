<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{$title ?? 'Sistem Heregistrasi Mahasiswa'}}</title>

        <link rel="stylesheet" href="{{asset('/css/bootstrap.css')}}">
        <link rel="stylesheet" href="{{asset('vendors/simple-datatables/style.css')}}">

        <link rel="stylesheet" href="{{asset('/vendors/perfect-scrollbar/perfect-scrollbar.css')}}">
        <link rel="stylesheet" href="{{asset('/css/app.css')}}">
        <link rel="shortcut icon" href="{{asset('/images/favicon.svg')}}" type="image/x-icon">
        <link rel="stylesheet" media="print" href="{{asset('/cetak/cetak-registrasi.css')}}">
    </head>

    <body>
        <div id="app">
            <div id="sidebar" class='active'>
                <div class="sidebar-wrapper active">
                    <div class="sidebar-header">
                        <img src="{{asset('/images/logo.png')}}" alt="" srcset="">
                    </div>
                    <div class="sidebar-menu">
                        @if (Auth::user()->role == 'Admin')
                        <ul class="menu">
                            <li class='sidebar-title'>Main Menu</li>
                            <li class="sidebar-item {{request()->is('dashboard') ? 'active' : ''}}">
                                <a href="{{route('dashboard')}}" class='sidebar-link'>
                                    <i data-feather="home" width="20"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            <li class='sidebar-title'>Pendaftaran &amp; Data </li>
                            <li class="sidebar-item {{request()->is('pendaftaran/*') ? 'active' : ''}} has-sub">
                                <a href="#" class='sidebar-link'>
                                    <i data-feather="file-text" width="20"></i>
                                    <span>Pendaftaran</span>
                                </a>

                                <ul class="submenu {{request()->is('pendaftaran/*') ? 'active' : ''}}">
                                    <li>
                                        <a href="{{url('pendaftaran/operator')}}">Tambah Operator</a>
                                    </li>
                                    <li>
                                        <a href="{{url('pendaftaran/mahasiswa')}}">Tambah Mahasiswa</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="sidebar-item {{request()->is('mahasiswa/*') ? 'active' : ''}} has-sub">
                                <a href="#" class='sidebar-link'>
                                    <i data-feather="grid" width="20"></i>
                                    <span>Data Mahasiswa</span>
                                </a>

                                <ul class="submenu {{request()->is('mahasiswa/*') ? 'active' : ''}}">
                                    <li>
                                        <a href="{{route('verifikasi')}}">Menunggu Verifikasi</a>
                                    </li>
                                    <li>
                                        <a href="{{route('sukses')}}">Hergesitrasi Sukses</a>
                                    </li>
                                    <li>
                                        <a href="{{route('gagal')}}">Hergesitrasi Gagal</a>
                                    </li>
                                </ul>
                            </li>
                            <li class="sidebar-item  {{request()->is('operator') ? 'active' : ''}}">
                                <a href="{{route('operator')}}" class='sidebar-link'>
                                    <i data-feather="grid" width="20"></i>
                                    <span>Data Operator</span>
                                </a>
                            </li>
                        </ul>
                        @elseif (Auth::user()->role == 'Operator')
                        <ul class="menu">
                            <li class='sidebar-title'>Main Menu</li>
                            <li class="sidebar-item {{request()->is('dashboard') ? 'active' : ''}} ">
                                <a href="{{route('dashboard')}}" class='sidebar-link'>
                                    <i data-feather="home" width="20"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>

                            <li class='sidebar-title'>Pendaftaran &amp; Data </li>
                            <li class="sidebar-item {{request()->is('pendaftaran/*') ? 'active' : ''}} has-sub">
                                <a href="#" class='sidebar-link'>
                                    <i data-feather="file-text" width="20"></i>
                                    <span>Pendaftaran</span>
                                </a>

                                <ul class="submenu {{request()->is('pendaftaran/*') ? 'active' : ''}}">
                                    <li>
                                        <a href="{{url('pendaftaran/mahasiswa')}}">Tambah Mahasiswa</a>
                                    </li>
                                </ul>
                            </li>

                            <li class="sidebar-item {{request()->is('mahasiswa/*') ? 'active' : ''}} has-sub">
                                <a href="#" class='sidebar-link'>
                                    <i data-feather="grid" width="20"></i>
                                    <span>Data Mahasiswa</span>
                                </a>

                                <ul class="submenu {{request()->is('mahasiswa/*') ? 'active' : ''}}">
                                    <li>
                                        <a href="{{route('verifikasi')}}">Menunggu Verifikasi</a>
                                    </li>
                                    <li>
                                        <a href="{{route('sukses')}}">Hergesitrasi Sukses</a>
                                    </li>
                                    <li>
                                        <a href="{{route('gagal')}}">Hergesitrasi Gagal</a>
                                    </li>
                                </ul>
                            </li>

                        </ul>
                        @else
                        <ul class="menu">
                            <li class='sidebar-title'>Main Menu</li>
                            <li class="sidebar-item {{request()->is('dashboard') ? 'active' : ''}} ">
                                <a href="{{route('dashboard')}}" class='sidebar-link'>
                                    <i data-feather="home" width="20"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>
                            
                            <li class="sidebar-item {{request()->is('biodata') ? 'active' : ''}} ">
                                <a href="{{route('biodata')}}" class='sidebar-link'>
                                    <i data-feather="grid" width="20"></i>
                                    <span>Biodata</span>
                                </a>
                            </li>

                            <li class="sidebar-item  {{request()->is('document') ? 'active' : ''}}">
                                <a href="{{route('document')}}" class='sidebar-link'>
                                    <i data-feather="file" width="20"></i>
                                    <span>Document</span>
                                </a>
                            </li>

                            <li class="sidebar-item  {{request()->is('kartu') ? 'active' : ''}}">
                                <a href="{{route('kartu')}}" class='sidebar-link'>
                                    <i data-feather="file" width="20"></i>
                                    <span>Cetak Kartu</span>
                                </a>
                            </li>

                        </ul>
                        @endif
                    </div>
                    <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
                </div>
            </div>
            <div id="main">
                <nav class="navbar navbar-header navbar-expand navbar-light">
                    <a class="sidebar-toggler" href="#"><span class="navbar-toggler-icon"></span></a>
                    <button class="btn navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav d-flex align-items-center navbar-light ml-auto">
                            @if (Auth::user()->role == "Mahasiswa")
                            <li class="dropdown nav-icon">
                                <a href="#" data-toggle="dropdown"
                                    class="nav-link  dropdown-toggle nav-link-lg nav-link-user">
                                    <div class="d-lg-inline-block">
                                        <i data-feather="bell"></i>
                                    </div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-large">
                                    <h6 class='py-2 px-4'>Notifications</h6>
                                    <ul class="list-group rounded-none">
                                        <li class="list-group-item border-0 align-items-start">
                                            <div class="avatar bg-success mr-3">
                                                <span class="avatar-content"><i data-feather="info"></i></span>
                                            </div>
                                            <div>
                                                <h6 class='text-bold'>{{$h->updated_at->diffForHumans()}}</h6>
                                                <p class='text-xs'>
                                                    {!!$h->detail!!}
                                                </p>
                                            </div>
                                        </li>
                                    </ul>
                                </div> 
                            </li>
                            @endif
                            <li class="dropdown">
                                <a href="#" data-toggle="dropdown"
                                    class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                    <div class="avatar mr-1">
                                        <img src="{{asset('images/avatar/'.Auth::user()->avatar)}}" alt="" srcset="">
                                    </div>
                                    <div class="d-none d-md-block d-lg-inline-block">Hi, {{Auth::user()->fname}}</div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="{{route('profil')}}"><i data-feather="user"></i> Account</a>
                                    <form action="{{route('logout')}}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="dropdown-item"><i data-feather="log-out"></i> Logout</button>
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>

                @yield('content')

                <footer>
                    <div class="footer clearfix mb-0 text-muted">
                        <div class="float-left">
                            <p>2020 &copy; SISTEM HEREGISTRASI</p>
                        </div>
                        <div class="float-right">
                            <p>Crafted with <span class='text-danger'><i data-feather="heart"></i></span> by <a
                                    href="http://fb.com/icky.12">RMG</a></p>
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script src="{{asset('js/feather-icons/feather.min.js')}}"></script>
        <script src="{{asset('vendors/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
        <script src="{{asset('js/app.js')}}"></script>

        <script src="{{asset('vendors/simple-datatables/simple-datatables.js')}}"></script>
        <script src="{{asset('js/vendors.js')}}"></script>
        

        <script src="{{asset('js/main.js')}}"></script>
    </body>

</html>
