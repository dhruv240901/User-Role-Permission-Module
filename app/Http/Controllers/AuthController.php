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
            'first_name'     =>$request->firstname,
            'last_name'      =>$request->lastname,
            'email'          =>$request->email,
            'password'       =>Hash::make($request->password),
            'is_first_login' =>'0',
            'is_active'      =>'0'
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
        $request->validate([
            'email'    =>'required|email',
            'password' =>'required|min:6'
        ]);

        $credentials=$request->only('email','password');
        if(Auth::attempt($credentials)){
                if(auth()->user()->is_first_login=='1'){
                    return redirect()->route('view-change-password')->with('success','Please change your password!');
                }
                if(auth()->user()->is_active==0){
                    Auth::logout();
                    return redirect()->route('login')->with('error','Your account is deactivated !');
                }
                return redirect()->route('index')->with('success','Logged In successfully!');
        }
        return redirect()->route('login')->with('error','Invalid Credentials');
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login')->with('success','Logout Successfully');
    }

    public function viewchangepassword()
    {
        return view('changePassword');
    }

    public function changepassword(Request $request)
    {
        $request->validate([
            'newpassword'     =>'required|min:6',
            'confirmpassword' =>'required|min:6|same:newpassword'
        ]);

        $user=User::findOrFail(auth()->id());
        $user->update(['password'=>Hash::make($request->newpassword),'is_first_login'=>'0']);
        return redirect()->route('index')->with('success','Password Changed successfully');
    }
}
