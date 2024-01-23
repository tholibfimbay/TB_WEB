<?php

namespace App\Http\Controllers;

use App\Biodata;
use App\Document;
use App\Heregistrasi;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function index()
    {
        return view('profil', $this->query());
    }

    public function simpan(Request $request, User $user)
    {

        $request->validate([
            'avatar' => ['required', 'mimes:jpeg,png'],
        ]);

        $file = $request->file('avatar');
        $name = md5($file->getClientOriginalName());
        $ex = $file->getClientOriginalExtension();
        $fileName = $name . '.' . $ex;

        if ($this->query()['u']->avatar != 'default.png') {
            File::delete('images/avatar/' . $this->query()['u']->avatar);
        }

        $file->move('images/avatar', $fileName);

        $user->update([
            'avatar' => $fileName,
        ]);
        $pesan = "Selamat foto profil kamu berhasil di update lanjut isi biodata kamu.";

        if ($request->password) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
            $pesan = "Selamat foto profil dan password kamu berhasil di update lanjut isi biodata kamu.";
        }

        session()->flash('pesan', '<div class="alert alert-primary" role="alert">
            ' . $pesan . '
        </div>');

        return redirect()->route('biodata');

    }

    private function query()
    {
        $nim = Auth::user()->nim;
        return $data = [
            'u' => User::where('nim', $nim)->first(),
            'h' => Heregistrasi::where('nim', $nim)->first(),
            'b' => Biodata::where('nim', $nim)->first(),
            'd' => Document::where('nim', $nim)->first(),
        ];
    }
}
