<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Hash;
use Auth;
use App\Models\User;
use Mail;
use App\Mail\ForgetPasswordMail;
use Illuminate\Support\Str;
use DB;
use Carbon\Carbon;

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
        return redirect()->route('index')->with('success','Logout Successfully');
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

    public function viewforgetpassword()
    {
        return view('forgetpassword');
    }

    public function forgetpassword(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'email' => 'required|email',
        ]);

        if($validation->fails()){
            return Redirect::back()->withErrors($validation)->withInput();
        }

        $user=User::where('email',$request->email)->first();
        if(!$user)
        {
            return redirect()->route('view-forget-password')->with('error','User not found');
        }
        else
        {
            $token=Str::random(100);
            DB::table('password_reset_tokens')->insert([
                'email'=>$user->email,
                'token'=>$token,
                'created_at'=>Carbon::now(),
            ]);

            dispatch(function() use ($user,$token){
                Mail::to($user->email)->send(new ForgetPasswordMail($user->name,$token));
            })->delay(now()->addSeconds(5));

            return redirect()->route('view-forget-password')->with('success','We have sent you a mail');
        }
    }

    public function viewresetpassword($token)
    {
        $password_reset_data=DB::table('password_reset_tokens')->where('token',$token)->first();

        if(!$password_reset_data || Carbon::now()->subminutes(10)>$password_reset_data->created_at)
        {
            return redirect("/")->with('error','Invalid password reset link or link expired.');
        }
        else{
            return view('resetPassword',compact('token'));
        }
    }

    public function resetpassword(Request $request,$token)
    {
        $password_reset_data=DB::table('password_reset_tokens')->where('token',$token)->first();
        // dd($password_reset_data);
        $email=$password_reset_data->email;
        $user=User::where('email',$email)->first();
        // dd($user->id);
        if(!$password_reset_data || Carbon::now()->subminutes(10)>$password_reset_data->created_at)
        {
            return redirect()->route('view-forget-password')->with('error','Invalid password reset link or link expired.');
        }


        else{
            $request->validate([
                'newpassword'     => 'required|min:6',
                'confirmpassword' => 'required|same:newpassword'
            ]);

            // $password_reset_data->delete();
            $user->update([
                'password'=>Hash::make($request->newpassword)
            ]);

            return redirect()->route('login')->with('success','Password reseted successfully.');
        }
    }
}
