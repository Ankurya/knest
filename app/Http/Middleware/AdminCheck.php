<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminCheck {

    public function handle($request, Closure $next, $guard='admin') {

        if(!Auth::guard($guard)->check()) { //error
            return redirect('admin/login');
        }
        return $next($request);
    }
}