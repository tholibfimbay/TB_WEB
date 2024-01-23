<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {
            session()->flash('pesan', '<div class="alert alert-info" role="alert">
            <strong>Silahkan login terlebih dahulu ...</strong>
             </div>');
            return route('login');
        }
    }
}
