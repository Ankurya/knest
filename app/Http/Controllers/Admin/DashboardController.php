<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
header('Cache-Control: no-store, private, no-cache, must-revalidate');
header('Cache-Control: pre-check=0, post-check=0, max-age=0, max-stale = 0', false);

class DashboardController extends Controller
{
    public function dashboard(Request $request){
    	if($request->isMethod('GET')){

    		return view('admin.pages.dashboard.dashboard');
    	}
    }
}
