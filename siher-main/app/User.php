<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'fname', 'lname', 'nim', 'email', 'avatar', 'password', 'role',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function reg()
    {
        return $this->belongsTo('App\Heregistrasi', 'nim', 'nim');
    }

    //=======================================================================================

    public function scopeGetMhs($query)
    {
        return $query->join('heregistrasis', 'heregistrasis.nim', '=', 'users.nim')->where('role', 'Mahasiswa')->get();
    }

    public function scopeJoinTable($query, $nim)
    {
        return $query->join('heregistrasis', 'heregistrasis.nim', '=', 'users.nim')->join('biodatas', 'biodatas.nim', '=', 'users.nim')->where(['users.nim' => $nim, 'users.role' => 'Mahasiswa'])->get();
    }

    //========================================================================================

    //Users Status
    public function scopeGetTerdaftar($query)
    {
        return $query->join('heregistrasis', 'heregistrasis.nim', 'users.nim')->where(['role' => 'Mahasiswa', 'status' => 'Terdaftar'])->get();
    }

    public function scopeGetVerifikasi($query)
    {
        return $query->join('heregistrasis', 'heregistrasis.nim', 'users.nim')->where(['role' => 'Mahasiswa', 'status' => 'Verifikasi'])->get();
    }

    public function scopeGetGagal($query)
    {
        return $query->join('heregistrasis', 'heregistrasis.nim', 'users.nim')->where(['role' => 'Mahasiswa', 'status' => 'Gagal'])->get();
    }

    public function scopeGetSukses($query)
    {
        return $query->join('heregistrasis', 'heregistrasis.nim', 'users.nim')->where(['role' => 'Mahasiswa', 'status' => 'Sukses'])->get();
    }

}
