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

class FungsiController extends Controller
{

    public function showPendaftaranMahasiswa()
    {
        return view('pendaftaran_mahasiswa');
    }

    public function simpanMahasiswa(Request $request)
    {
        $request->validate([
            'nim' => ['required', 'unique:App\User,nim'],
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required',
        ]);

        $u = $request->all();
        $u['password'] = Hash::make($request->password);
        $u['avatar'] = 'default.png';
        $u['role'] = 'Mahasiswa';
        User::create($u);
        Heregistrasi::create([
            'nim' => $request->nim,
            'status' => 'Terdaftar',
            'detail' => 'Pendaftaran berhasil silahkan lengkapi data diri anda',
        ]);

        session()->flash('pesan', '<div class="alert alert-primary" role="alert">
        <strong>' . $request->fname . '</strong> berhasil di daftarkan menjadi Mahasiswa
        </div>');
        return redirect()->route('dashboard');
    }

    public function showVerifikasi()
    {
        $data = [
            'query' => User::getVerifikasi(),
        ];

        return view('mahasiswa_verifikasi', $data);
    }

    public function showSukses()
    {
        $data = [
            'query' => User::getSukses(),
        ];

        return view('mahasiswa_sukses', $data);
    }

    public function showGagal()
    {
        $data = [
            'query' => User::getGagal(),
        ];

        return view('mahasiswa_gagal', $data);
    }

    public function detailMahasiswa($nim)
    {
        return view('detail_mahasiswa', $this->db($nim));
    }

    public function hapusMahasiswa($nim)
    {
        $data = $this->db($nim);
        //Menghapus data dari table Users
        if ($data['u']['avatar'] != "default.png") {
            File::delete('images/avatar/' . $data['u']['avatar']);
        }

        $data['u']->delete();
        $data['h']->delete();

        if ($data['b']) {
            $data['b']->delete();
        }

        if ($data['d']) {
            File::deleteDirectory('docs/'.$data['d']['nim']);
            $data['d']->delete();
        }

        session()->flash('pesan', '<div class="alert alert-primary" role="alert">
        <strong>Data ' . $data['u']['fname'] . ' telah berhasil di hapus dari sistem</strong>
        </div>');

        return redirect()->route('dashboard');
    }

    public function resetMahasiswa($nim)
    {
        $data = $this->db($nim);

        if ($data['u']['avatar'] != "default.png") {
            File::delete('images/avatar/' . $data['u']['avatar']);
        }

        $u = [
            'password' => Hash::make('123456'),
            'avatar' => 'default.png',
        ];

        $h = [
            'status' => 'Terdaftar',
            'detail' => 'Akun kamu telah di reset admin pada ' . now()->format('d M Y') . ' silahan lakukan upload foto profil dan lengkapi dokument serta data diri kamu',
        ];

        $data['u']->update($u);
        $data['h']->update($h);

        if ($data['b']) {
            $data['b']->delete();
        }

        if ($data['d']) {
            File::deleteDirectory('docs/'.$data['d']['nim']);
            $data['d']->delete();
        }

        session()->flash('pesan', 'Akun ' . $data['u']['fname'] . " " . $data['u']['lname'] . " berhasil di reset !!!");
        return redirect('mahasiswa/' . $data['u']['nim']);
    }

    public function tolakMahasiswa($nim, Request $request)
    {
        $data = $this->db($nim);

        if ($data['u']['avatar'] != "default.png") {
            File::delete('images/avatar/' . $data['u']['avatar']);
        }

        $data['u']->update([
            'avatar' => 'default.png',
        ]);
        $data['h']->update([
            'status' => 'Gagal',
            'detail' => $request->detail . ' - ' . Auth::user()->fname,
        ]);

        if ($data['b']) {
            $data['b']->delete();
        }

        if ($data['d']) {
            File::deleteDirectory('docs/'.$data['d']['nim']);
            $data['d']->delete();
        }

        session()->flash('pesan', 'Akun ' . $data['u']['fname'] . " " . $data['u']['lname'] . " telah di tolak untuk heregistrasi !!!");
        return redirect('mahasiswa/' . $data['u']['nim']);
    }

    public function suksesMahasiswa($nim)
    {
        $data = $this->db($nim);

        $data['h']->update([
            'status' => 'Sukses',
            'detail' => 'Proses Heregistrasi Telah Berhasil',
        ]);

        session()->flash('pesan', 'Akun ' . $data['u']['fname'] . " " . $data['u']['lname'] . " telah berhasil untuk heregistrasi !!!");
        return redirect('mahasiswa/' . $data['u']['nim']);
    }

    public function showError()
    {
        return view('laporan/error');
    }

    private function db($nim)
    {
        return $data = [
            'u' => User::where(['nim' => $nim, 'role' => 'Mahasiswa'])->firstOrFail(),
            'h' => Heregistrasi::where('nim', $nim)->first(),
            'b' => Biodata::where('nim', $nim)->first(),
            'd' => Document::where('nim', $nim)->first(),
        ];
    }

}
