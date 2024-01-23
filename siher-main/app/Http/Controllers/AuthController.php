<?php

namespace App\Http\Controllers;

use App\Heregistrasi;
use App\Http\Requests\RegisterRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth/register');
    }

    public function register(RegisterRequest $request, User $user)
    {

        $att = [
            'fname' => $request->fname,
            'lname' => $request->lname,
            'name' => $request->fname . " " . $request->lname,
            'role' => 'Mahasiswa',
            'nim' => $request->nim,
            'email' => $request->email,
            'avatar' => 'default.png',
            'password' => Hash::make($request->password),
        ];

        User::create($att);
        Heregistrasi::create([
            'nim' => $request->nim,
            'status' => 'Terdaftar',
            'detail' => 'Pendaftaran berhasil silahkan lengkapi data diri anda',
        ]);
        session()->flash('pesan', '
        <div class="alert alert-primary" role="alert">
                            <strong>Akun ' . $att['name'] . ' berhasil di buat silahkan login untuk melanjutkan...</strong>
                        </div>');
        return redirect()->route('login');
    }

    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        };
        return view('auth/login');
    }

    public function login(Request $request)
    {

        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $email = $request->email;
        $password = $request->password;

        $user = User::where('email', $email)->first();
        if ($user) {
            if (Hash::check($password, $user->password)) {
                Auth::attempt(['email' => $email, 'password' => $password]);
                if (Auth::check() == true) {
                    return redirect()->route('dashboard');
                }

            } else {
                session()->flash('pesan', '<div class="alert alert-danger" role="alert">
                <strong>Password akun kamu tidak benar</strong>
                 </div>');
                return redirect()->route('login');
            }

        } else {
            session()->flash('pesan', '<div class="alert alert-danger" role="alert">
            <strong>Email tidak terdaftar pada sistem</strong>
             </div>');
            return redirect()->route('login');
        }

    }

    public function logout()
    {
        Auth::logout();
        session()->flash('pesan', '<div class="alert alert-info" role="alert">
            <strong>Logout Berhasil ...</strong>
             </div>');
        return redirect()->route('login');
    }

}
