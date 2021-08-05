<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckUserStatus
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

        if(Auth::User()->deleted_at != "") { 
            http_response_code(403);
            echo json_encode(['result'=>'Failure','message'=>'Your account has been deleted by admin.']);exit;
        }elseif (Auth::User()->is_blocked == 1) {
            http_response_code(403);
            echo json_encode(['result'=>'Failure','message'=>'Your account has been blocked by admin.']);exit;
        }else{

        }
        
        return $next($request);
    }
}
