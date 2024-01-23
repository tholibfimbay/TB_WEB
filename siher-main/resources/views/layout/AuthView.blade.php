<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{$title.' | Sistem Heregistrasi Mahasiswa' ?? 'Sistem Heregistrasi Mahasiswa'}}</title>
        <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">

        <link rel="shortcut icon" href="{{asset('images/favicon.svg')}}" type="image/x-icon">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
    </head>
    <style>
        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;

        }

        .links>a {
            color: #ffffff;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

    </style>

    <body>
        @if (Route::has('login'))
        <div class="top-right links">
            @auth
            <a href="{{ url('/home') }}">Home</a>
            @else
            <a href="{{ route('login') }}">Login</a>

            @if (Route::has('register'))
            <a href="{{ route('register') }}">Register</a>
            @endif
            @endauth
        </div>
        @endif
        <div id="auth">
            @yield('content')
        </div>
        <script src="{{asset('js/feather-icons/feather.min.js')}}"></script>
        <script src="{{asset('js/app.js')}}"></script>

        <script src="{{asset('js/main.js')}}"></script>
    </body>

</html>
