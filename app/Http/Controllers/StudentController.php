<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    public function create(StudentRequest $request){
        //dd(($request->all()));

        //1st way without custom Request
//        $this->validate($request, [
//            'name' => 'required',
//            'email' => 'required|email|unique:students',
//            'phone' => 'required|unique:students'
//        ]);
//        Form::create($request->all());

        //2nd way without custom Request

//        $messages = [
//            'name.required' => 'Name is required',
//            'email.required' => 'Email have to be unique',
//            'phone.required' => 'Phone have to be unique',
//            'password.required' => 'password is required'
//        ];
//
//        $validatedData = $request->validate([
//            'name' => 'required',
//            'email' => 'required|email|unique:students',
//            'phone' => 'required|unique:students',
//            'password' => 'required'
//        ]);


        $save = Student::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        //return redirect()->to('student/dashboard');
        //return redirect()->route('student.dashboard')->with('success','Successfully Registered');
        if( $save ){
            return redirect()->back()->with('success','You are now registered successfully');
        }else{
            return redirect()->back()->with('fail','Something went wrong, failed to register');
        }
    }


    public function check(Request $request){
        $credentials = $request->only('email','password');
        if(Auth::guard('student')->attempt($credentials)){
            return redirect()->route('student.dashboard');
        }else{
            return redirect()->route('student.login')->with('fail','Incorrect credentials');
        }
    }

    public function logout(){
        Auth::guard('student')->logout();
        return redirect()->route('student.login')->with('success','Successfully Logout');
    }
}
