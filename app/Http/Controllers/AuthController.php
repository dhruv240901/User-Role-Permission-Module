<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Auth;
use App\Models\User;
use Mail;
use App\Mail\ForgetPasswordMail;
use App\Mail\SignUpMail;
use Illuminate\Support\Str;
use DB;
use Carbon\Carbon;

class AuthController extends Controller
{
    /* function to render signup form */
    public function signup()
    {
        return view('signup');
    }

    /* function to store user in database */
    public function customSignup(Request $request)
    {
        // Validate Signup Form Request
        $request->validate([
            'firstName'       => 'required|string',
            'email'           => 'unique:users|required|email',
            'password'        => 'required|min:6|string',
            'confirmPassword' => 'required|min:6|same:password|string'
        ]);

        // Store Signup Form Details into the database
        $insertData = [
            'first_name'     => $request->firstName,
            'last_name'      => $request->lastName,
            'email'          => $request->email,
            'password'       => Hash::make($request->password),
            'is_first_login' => false,
            'is_active'      => false
        ];
        $user = User::create($insertData);
        $adminUser = User::where('type', 'admin')->first();

        // Send Mail on successfull signup to admin to approve user account
        if ($user) {
            dispatch(function () use ($adminUser, $user) {
                Mail::to($adminUser['email'])->send(new SignUpMail($adminUser, $user));
            })->delay(now()->addSeconds(5));
        }
        return redirect()->route('login')->with('success', 'Account created successfully. Please contact admin to active your account!');
    }

    /* function to render login page */
    public function login()
    {
        return view('login');
    }

    /* function to log user in */
    public function customLogin(Request $request)
    {
        // Validate Login Form Request
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required|min:6|string'
        ]);

        $credentials = $request->only('email', 'password');

        // Check if user with requested mail id exist or not
        $checkEmail = User::where('email', $request->email)->first();
        if ($checkEmail != null) {

            // Check if user account is active or not
            if ($checkEmail->is_active == false) {
                return redirect()->route('login')->with('error', 'Your account is deactivated !');
            }

            // Check if user credentials are valid or not and if valid then authenticate user
            if (Auth::attempt($credentials)) {
                Auth::user()->createToken('auth-token')->plainTextToken;
                if (auth()->user()->is_first_login == true) {
                    return redirect()->route('view-change-password')->with('success', 'Please change your password!');
                }
                return redirect()->route('index')->with('success', 'Logged In successfully!');
            }
            return redirect()->route('login')->with('error', 'Invalid Credentials');
        } else {
            return redirect()->route('login')->with('error', 'Invalid Credentials');
        }
    }

    /* function to logout user */
    public function logout()
    {
        // Delete auth user tokens from personal access tokens table
        Auth::user()->tokens()->delete();

        auth()->logout();
        return redirect()->route('index')->with('success', 'Logout Successfully');
    }

    /* function to render change password page */
    public function viewChangePassword()
    {
        return view('changePassword');
    }

    /* function to change user password */
    public function changePassword(Request $request)
    {
        // Validate ChangePassword Form Request
        $request->validate([
            'newPassword'     => 'required|min:6|string',
            'confirmPassword' => 'required|min:6|same:newPassword|string'
        ]);

        // Update new password in the database
        $user = User::findOrFail(auth()->id());
        $user->update(['password' => Hash::make($request->newPassword), 'is_first_login' => false]);
        return redirect()->route('index')->with('success', 'Password Changed successfully');
    }

    /* function to render forget password form */
    public function viewForgetPassword()
    {
        return view('forgetPassword');
    }

    /* function to submit forget password form */
    public function forgetPassword(Request $request)
    {
         // Validate ForgetPassword Form Request
        $request->validate([
            'email' => 'required|email',
        ]);

        // Check if user with requested mail id exist or not
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return redirect()->route('view-forget-password')->with('error', 'User not found');
        } else {

            // Store Password Reset Tokens in Database
            $token = Str::random(100);
            DB::table('password_reset_tokens')->insert([
                'email'      => $user->email,
                'token'      => $token,
                'created_at' => Carbon::now(),
            ]);

            // Send Password Reset Link via email to requested mail id
            dispatch(function () use ($user, $token) {
                Mail::to($user->email)->send(new ForgetPasswordMail($user->first_name, $user->last_name, $token));
            })->delay(now()->addSeconds(5));

            return redirect()->route('view-forget-password')->with('success', 'We have sent you a mail');
        }
    }

    /* function to view reset password form */
    public function viewResetPassword($token)
    {
        $password_reset_data = DB::table('password_reset_tokens')->where('token', $token)->first();

        // Check if requested token exist in the database and if the requested token is expired or not
        if (!$password_reset_data || Carbon::now()->subminutes(10) > $password_reset_data->created_at) {
            return redirect("/")->with('error', 'Invalid password reset link or link expired.');
        } else {
            return view('resetPassword', compact('token'));
        }
    }

    /* function to reset password */
    public function resetPassword(Request $request, $token)
    {
        $password_reset_data = DB::table('password_reset_tokens')->where('token', $token)->first();
        $email = $password_reset_data->email;
        $user = User::where('email', $email)->first();

        // Check if requested token exist in the database and if the requested token is expired or not
        if (!$password_reset_data || Carbon::now()->subminutes(10) > $password_reset_data->created_at) {
            return redirect()->route('view-forget-password')->with('error', 'Invalid password reset link or link expired.');
        } else {

            // Validate reset Password Form Request
            $request->validate([
                'newPassword'     => 'required|min:6|string',
                'confirmPassword' => 'required|same:newPassword|string'
            ]);

            // Update new password in the database 
            $user->update([
                'password' => Hash::make($request->newPassword)
            ]);

            return redirect()->route('login')->with('success', 'Password reseted successfully.');
        }
    }
}
