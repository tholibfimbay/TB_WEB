<?php

namespace App\Http\Controllers;

use App\Biodata;
use App\Document;
use App\Heregistrasi;
use App\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 'Admin') {
            $data = [
                'query' => User::GetMhs(),
                'terdaftar' => User::GetTerdaftar(),
                'verifikasi' => User::GetVerifikasi(),
                'sukses' => User::GetSukses(),
                'gagal' => User::GetGagal(),
            ];

            return view('admin/dashboard', $data);
        } elseif (Auth::user()->role == 'Operator') {
            $data = [
                'query' => User::GetMhs(),
                'terdaftar' => User::GetTerdaftar(),
                'verifikasi' => User::GetVerifikasi(),
                'sukses' => User::GetSukses(),
                'gagal' => User::GetGagal(),
            ];
            return view('operator/dashboard', $data);
        } elseif (Auth::user()->role == 'Mahasiswa') {
            $nim = Auth::user()->nim;
            $data = [
                'u' => User::where('nim', $nim)->first(),
                'h' => Heregistrasi::where('nim', $nim)->first(),
                'b' => Biodata::where('nim', $nim)->first(),
                'd' => Document::where('nim', $nim)->first(),
            ];
            return view('mahasiswa/dashboard', $data);
        } else {
            Auth::logout();
            return redirect()->route('login');
        };

    }
}
