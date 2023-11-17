<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use App\Models\User;
use App\Models\Role;
use Auth;
use Mail;
use App\Mail\AddUserMail;
use DB;

class UserController extends Controller
{
    /* function to display users list */
    public function index()
    {
        $users=User::whereNot('id',auth()->id())->whereNot('type','admin')->withTrashed()->get();
        return view('user.userList',compact('users'));
    }

    /* function to render add user form */
    public function create()
    {
        $roles=Role::where('is_active','1')->get();
        $user=null;
        return view('user.create',compact('roles','user'));
    }

    /* function to show user details by id */
    public function show($id)
    {
        $user=User::findOrFail($id);
        return view('user.show',compact('user'));
    }

    /* function to store user in database */
    public function store(Request $request)
    {
        $request->validate([
            'firstname' =>'required',
            'lastname'  =>'required',
            'email'     =>'unique:users|required|email',
            'roles'     =>'required'
        ]);

        $randomPassword=rand(100000,999999);
        $insertData=[
            'first_name'    =>$request->firstname,
            'last_name'     =>$request->lastname,
            'email'         =>$request->email,
            'password'      =>Hash::make($randomPassword),
            'is_active'     =>'1',
            'is_first_login'=>'1',
        ];

        $user=User::create($insertData);
        if($request->roles){
            foreach($request->roles as $key => $roleId){
                $user->roles()->attach($request->roles[$key]);
            }
        }
        $authUser=Auth::user();

        if($user){
            dispatch(function() use ($user, $randomPassword,$authUser){
                Mail::to($user['email'])->send(new AddUserMail($user,$randomPassword,$authUser));
            })->delay(now()->addSeconds(5));
        }

        return redirect()->route('add-user')->with('success','User Created Successfully');
    }

    /* function to render edit user form */
    public function edit(string $id)
    {
        $roles=Role::where('is_active','1')->get();
        $user=User::findOrFail($id);
        return view('user.create',compact('user','roles'));
    }

     /* function to update user */
    public function update(Request $request, string $id)
    {
        $user=User::findOrFail($id);
        $request->validate([
            'firstname' =>'required',
            'lastname'  =>'required',
            'roles'     =>'required'
        ]);

        $updateData=[
            'first_name' =>$request->firstname,
            'last_name'  =>$request->lastname,
        ];

        $userUpdate=$user->update($updateData);

        if($request->roles){
            // $user->roles()->detach();
            foreach ($user->roles as $key => $roleId) {
                $user->roles()->detach($user->roles[$key]);
            }

            foreach($request->roles as $key => $roleId){
                $user->roles()->attach($request->roles[$key]);
            }
        }
        return redirect()->route('edit-user',$id)->with('success','User Updated Successfully');
    }

    /* function to soft delete user */
    public function destroy(string $id)
    {
        $user=User::findOrFail($id);
        $user->delete();
        return redirect()->route('user-list')->with('success','User Soft Deleted Successfully');
    }

    /* function to restore user */
    public function restore($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();
        return redirect()->route('user-list')->with('success','User Restored Successfully');
    }

    /* function to force delete user */
    public function forceDelete($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->forceDelete();
        return redirect()->route('user-list')->with('success','User Permanently Deleted Successfully');

    }

    /* function to update user status */
    public function updateStatus(Request $request)
    {
        $user=User::findOrFail($request->id);
        if($request->checked=="false"){
            $user->update(['is_active'=>0]);
            $message="User Inactivated Successfully";
        }
        if($request->checked=="true"){
            $user->update(['is_active'=>1]);
            $message="User Activated Successfully";
        }
        return $message;
    }

    /* function to render change password form */
    public function viewChangePassword()
    {
        return view('user.changePassword');
    }


    /* function to render update password */
    public function changePassword(Request $request)
    {
        $request->validate([
            'oldpassword'     =>'required|min:6',
            'newpassword'     =>'required|min:6',
            'confirmpassword' =>'required|min:6|same:newpassword'
        ]);

        $currentUser=auth()->user();
        if(Hash::check($request->oldpassword,$currentUser->password))
        {
            $currentuser->update(['password'=>Hash::make($request->newpassword)]);
            return redirect()->route('index')->with('success','Password updated successfully');
        }
        else
        {
            return redirect()->route('index')->with('error','Old Password does not match');
        }
    }

    /* function to force logout user by id  */
    public function forceLogout($id)
    {
        $token=DB::table('personal_access_tokens')->where('tokenable_id',$id)->delete();
        
        if($token == null){
            Auth::guard('web')->logout();
            return route('login');
        }
        return redirect()->back()->with('success', 'User logged out from other devices.');
    }

    /* function to view user profile */
    public function profile()
    {
        return view('user.profile');
    }
}
