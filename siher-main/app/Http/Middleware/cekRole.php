<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
class cekRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, ...$roles)
    {
       // dd($request->user()->role);
       if (in_array($request->user()->role, $roles)) {
        return $next($request);
       } else {
        session()->flash('pesan', '<div class="alert alert-danger" role="alert">
                <strong>Akses ditolak, silahkan login kembali</strong>
                 </div>');
                 Auth::logout();
                return redirect()->route('login');
    }
       
        

    }
}
