<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Hash;
use Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function signup()
    {
        return view('signup');
    }

    public function customSignup(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'firstname'       =>'required',
            'email'           =>'unique:users|required|email',
            'password'        =>'required|min:6',
            'confirmpassword' =>'required|min:6|same:password'
       ],[  'email.unique'    => 'Email Id already exists']);

       if($validator->fails()) {
            return redirect()->route('signup')->withErrors($validator);
       }

       $insertdata=[
            'first_name'      =>$request->firstname,
            'last_name'       =>$request->lastname,
            'email'          =>$request->email,
            'password'       =>Hash::make($request->password),
            'is_first_login' =>'0'
        ];
        User::create($insertdata);
        return redirect()->route('login')->with('success','Account created successfully!');
    }

    public function login()
    {
        return view('login');
    }

    public function customLogin(Request $request)
    {
        $validator=$request->validate([
            'email'    =>'required|email',
            'password' =>'required|min:6'
        ]);

        $credentials=$request->only('email','password');
        if(Auth::attempt($credentials)){
                // if(auth()->user()->is_first_login=='1'){
                //     return redirect()->route('view-change-password')->with('success','Please change your password!');
                // }
                return redirect()->route('index')->with('success','Logged In successfully!');
        }
        return redirect()->route('login')->with('error','Invalid Credentials');
    }
}
