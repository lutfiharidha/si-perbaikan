<?php

namespace App\Http\Middleware;

use Auth;
use Closure;

class Admin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        if (Auth::user()->level == 'sekolah') {
            return redirect()->route('sekolahDashboard');
        }

        if (Auth::user()->level == 'asrama') {
            return redirect()->route('asramaDashboard');
        }
        if (Auth::user()->level == 'admin') {
            return $next($request);
        }
    }
}
