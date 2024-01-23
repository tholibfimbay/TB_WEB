<?php

namespace App\Http\Controllers;

use App\Biodata;
use App\Document;
use App\Heregistrasi;
use App\Http\Requests\DocumentRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class MahasiswaController extends Controller
{

    public function showBiodata()
    {
        return view('mahasiswa/biodata', $this->query());
    }

    public function simpanBiodata(Request $request)
    {
        $att = $request->validate([
            'ipk' => 'required',
            'semester' => 'required',
            'alamat' => 'required',
        ]);

        $att['nim'] = $request->nim;

        if ($this->query()['b']) {
            session()->flash('pesan', '<div class="alert alert-primary" role="alert">
            Kamu telah melakukan pengisian biodata pada tanggal ' . $this->query()['b']['created_at']->format('d M Y') . ' silahkan upload document kamu. Jika data yang sebelumnya salah silahkan laporkan ke admin
            </div>');
            return redirect()->route('document');
        }

        Biodata::create($att);
        $h = Heregistrasi::where('nim', $this->query()['u']->nim)->first();
        $h->update([
            'detail' => 'Biodata berhasil disimpan silahkan lanjut kan upload document yang di perlukan',
        ]);

        session()->flash('pesan', '<div class="alert alert-primary" role="alert">
           Selamat biodata ' . Auth::user()->fname . ' telah berhasil di simpan. Silahkan upload document yang di perlukan
        </div>');
        return redirect()->route('document');

    }

    public function showDocument()
    {
        return view('mahasiswa/document', $this->query());
    }

    public function simpanDocument(DocumentRequest $request)
    {
        if ($this->query()['d']) {
            session()->flash('pesan', '<div class="alert alert-primary" role="alert">
            Kamu telah melakukan pengisian document pada tanggal ' . $this->query()['d']['created_at']->format('d M Y') . ' silahkan tunggu proses verifikasi. Jika data yang sebelumnya salah silahkan laporkan ke admin
            </div>');
            return redirect()->route('kartu');
        }

        $docs = [
            'khs' => $request->file('khs'),
            'krs' => $request->file('krs'),
            'uk' => $request->file('uk'),
        ];
        //Membuat Folder Untuk Document
        File::makeDirectory('docs/' . $this->query()['u']->nim);

        $exKhs = $docs['khs']->getClientOriginalExtension();
        $exKrs = $docs['krs']->getClientOriginalExtension();
        $exUk = $docs['uk']->getClientOriginalExtension();

        $nameKhs = "khs-" . $this->query()['u']->nim . '.' . $exKhs;
        $nameKrs = "krs-" . $this->query()['u']->nim . '.' . $exKrs;
        $nameUk = "uk-" . $this->query()['u']->nim . '.' . $exUk;

        $docs['khs']->move('docs/' . $this->query()['u']->nim, $nameKhs);
        $docs['krs']->move('docs/' . $this->query()['u']->nim, $nameKrs);
        $docs['uk']->move('docs/' . $this->query()['u']->nim, $nameUk);

        Document::create([
            'nim' => $this->query()['u']->nim,
            'khs' => $nameKhs,
            'krs' => $nameKrs,
            'uk' => $nameUk,
        ]);

        $h = Heregistrasi::where('nim', $this->query()['u']->nim)->first();
        $h->update([
            'status' => 'Verifikasi',
            'detail' => 'Data berhasil disimpan silahkan tunggu proses verifikasi oleh admin. Jika kamu belum upload foto profil <a href="/profil">Klik disini</a> untuk melakukan pembaharuan',
        ]);

        session()->flash('pesan', '<div class="alert alert-primary" role="alert">
        Data berhasil disimpan silahkan tunggu proses verifikasi oleh admin. Jika kamu belum upload foto profil <a href="/profil">Klik disini</a> untuk melakukan pembaharuan</div>');

        return redirect()->route('dashboard');
    }

    public function Kartu()
    {
        if ($this->query()['h']['status'] == "Terdaftar") {
            session()->flash('pesan', '<div class="alert alert-primary" role="alert">
                Isi terlebih dahulu data dan document untuk melakukan pencetakan kartu
            </div>');
            return redirect()->route('dashboard');
        }
        return view('mahasiswa/cetak_kartu', $this->query());
    }

    public function resetAccount($nim)
    {
        $data = $this->query($nim);

        if ($data['u']['avatar'] != "default.png") {
            File::delete('images/avatar/' . $data['u']['avatar']);
        }

        $u = [
            'password' => Hash::make('123456'),
            'avatar' => 'default.png',
        ];

        $h = [
            'status' => 'Terdaftar',
            'detail' => 'Akun kamu telah di reset pada ' . now()->format('d M Y') . ' silahan lakukan upload foto profil dan lengkapi dokument serta data diri kamu',
        ];

        $data['u']->update($u);
        $data['h']->update($h);

        if ($data['b']) {
            $data['b']->delete();
        }

        if ($data['d']) {
            File::deleteDirectory('docs/' . $data['d']['nim']);
            $data['d']->delete();
        }

        session()->flash('pesan', '<div class="alert alert-primary" role="alert">
        Berhasil di reset silahkan login kembali dan lengkapi data diri kamu
        </div>');
        Auth::logout();

        return redirect()->route('login');
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
