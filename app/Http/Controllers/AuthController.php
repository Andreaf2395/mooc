<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class AuthController extends Controller
{
      public function signout(Request $request){
        $request->session()->flush();
        Auth::logout();
        return redirect('/');
    }
}
