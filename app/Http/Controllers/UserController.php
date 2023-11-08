<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use App\Models\User;
use App\Models\Role;
use Auth;
use Mail;
use App\Mail\AddUserMail;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users=User::withTrashed()->get();
        return view('user.userList',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles=Role::all();
        return view('user.create',compact('roles'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'firstname' =>'required',
            'lastname'  =>'required',
            'email'     =>'required|email|unique:users',
            'roles'     =>'required'
        ]);

        $randompassword=rand(100000,999999);
        $insertdata=[
            'first_name'    =>$request->firstname,
            'last_name'     =>$request->lastname,
            'email'         =>$request->email,
            'password'      =>Hash::make($randompassword),
            'is_first_login'=>'1'
        ];

        $user=User::create($insertdata);
        if($request->roles){
            foreach($request->roles as $key => $roleId){
                $user->roles()->attach($request->roles[$key]);
            }
        }
        $authuser=Auth::user();

        // if($user){
        //     // dispatch(function() use ($user, $randompassword,$authuser){
        //         Mail::to($user['email'])->send(new AddUserMail($user,$randompassword,$authuser));
        //     // })->delay(now()->addSeconds(5));
        // }

        return redirect()->route('add-user')->with('success','User Created Successfully');
    }

    public function edit(string $id)
    {
        $roles=Role::all();
        $user=User::findOrFail($id);
        return view('user.edit',compact('user','roles'));
    }

    public function update(Request $request, string $id)
    {
        $user=User::findOrFail($id);
        $request->validate([
            'firstname' =>'required',
            'lastname'  =>'required',
            'roles'     =>'required'
        ]);

        $randompassword=rand(100000,999999);
        $updatedata=[
            'first_name' =>$request->firstname,
            'last_name'  =>$request->lastname,
            'password'  =>Hash::make($randompassword),
        ];

        $userupdate=$user->update($updatedata);

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

    public function destroy(string $id)
    {
        $user=User::findOrFail($id)->delete();
        return redirect()->route('user-list')->with('success','User Soft Deleted Successfully');
    }

    public function restore($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();
        return redirect()->route('user-list')->with('success','User Restored Successfully');
    }

    public function forceDelete($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->forceDelete();
        return redirect()->route('user-list')->with('success','User Permanently Deleted Successfully');

    }
}
