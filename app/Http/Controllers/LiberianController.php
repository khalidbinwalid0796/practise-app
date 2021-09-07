<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class LiberianController extends Controller
{
    public function check(Request $request){
        $credentials = $request->only('email','password');
        if(Auth::guard('liberian')->attempt($credentials)){
            return redirect()->route('liberian.dashboard');
        }else{
            return redirect()->route('liberian.login')->with('fail','Incorrect credentials');
        }
    }

    public function logout(){
        Auth::guard('liberian')->logout();
        return redirect()->route('liberian.login')->with('success','Successfully Logout');
    }
}
