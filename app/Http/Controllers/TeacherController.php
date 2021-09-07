<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    public function check(Request $request){
        $credentials = $request->only('email','password');
        if(Auth::guard('teacher')->attempt($credentials)){
            return redirect()->route('teacher.dashboard');
        }else{
            return redirect()->route('teacher.login')->with('fail','Incorrect credentials');
        }
    }

    public function logout(){
        Auth::guard('teacher')->logout();
        return redirect()->route('teacher.login')->with('success','Successfully Logout');
    }
}
