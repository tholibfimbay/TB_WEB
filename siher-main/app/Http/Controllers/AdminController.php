<?php

namespace App\Http\Controllers;

use App\Http\Requests\OperatorRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function showOperator()
    {
        $data = [
            'query' => User::where('role', 'Operator')->get(),
        ];
        return view('admin/operator', $data);
    }

    public function detailOperator($nip)
    {
        $data = [
            'query' => User::where(['nim' => $nip, 'role' => 'Operator'])->firstOrFail(),
        ];

        return view('admin/detail_operator', $data);
    }

    public function showPendaftaranOperator()
    {
        return view('admin/pendaftaran_operator');
    }

    public function simpanOperator(OperatorRequest $request)
    {
        $att = [
            'fname' => $request->fname,
            'lname' => $request->lname,
            'name' => $request->fname . " " . $request->lname,
            'role' => 'Operator',
            'nim' => $request->nim,
            'email' => $request->email,
            'avatar' => 'default.png',
            'password' => Hash::make($request->password),
        ];
        User::create($att);

        session()->flash('pesan', '<div class="alert alert-primary" role="alert">
        <strong>' . $att['name'] . ' berhasil di daftarkan menjadi operator</strong>
    </div>');

        return redirect()->route('operator');
    }

    public function showUpdateOperator(User $user)
    {
        return view('admin/update_operator', ['u' => $user]);
    }

    public function updateOperator(Request $request, User $user)
    {
        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required',
            'nim' => 'required',
        ]);
        $att = [
            'fname' => $request->fname,
            'lname' => $request->lname,
            'name' => $request->fname . " " . $request->lname,
            'role' => 'Operator',
            'nim' => $request->nim,
            'email' => $request->email,
            'avatar' => 'default.png',
            'password' => Hash::make($request->password),
        ];
        $user->update($att);

        session()->flash('pesan', '<div class="alert alert-info" role="alert">
        <strong>' . $att['name'] . ' berhasil di update dari sistem</strong>
    </div>');

        return redirect()->route('operator');
    }

    public function deleteOperator(User $user)
    {
        if ($user->avatar != "default.png") {
            File::delete('images/avatar/' . $user->avatar);
        }
        $user->delete();

        session()->flash('pesan', '<div class="alert alert-primary" role="alert">
        <strong>Data ' . $user->fname . ' telah berhasil di hapus dari sistem</strong>
    </div>');

        return redirect()->route('operator');
    }

}
