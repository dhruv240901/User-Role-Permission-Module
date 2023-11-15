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
    public function show($id)
    {
        $user=User::findOrFail($id);
        return view('user.show',compact('user'));
    }

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
            'is_active'     =>'1',
            'is_first_login'=>'1',
            'created_by'    =>auth()->id()
        ];

        $user=User::create($insertdata);
        if($request->roles){
            foreach($request->roles as $key => $roleId){
                $user->roles()->attach($request->roles[$key]);
            }
        }
        $authuser=Auth::user();

        if($user){
            dispatch(function() use ($user, $randompassword,$authuser){
                Mail::to($user['email'])->send(new AddUserMail($user,$randompassword,$authuser));
            })->delay(now()->addSeconds(5));
        }

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
            'password'   =>Hash::make($randompassword),
            'updated_by' =>auth()->id()
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
        $user=User::findOrFail($id);
        $user->delete();
        $user->update(['deleted_by'=>auth()->id(),'is_deleted'=>'1']);
        return redirect()->route('user-list')->with('success','User Soft Deleted Successfully');
    }

    public function restore($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();
        $user->update(['deleted_by'=>null,'is_deleted'=>'0']);
        return redirect()->route('user-list')->with('success','User Restored Successfully');
    }

    public function forceDelete($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->forceDelete();
        return redirect()->route('user-list')->with('success','User Permanently Deleted Successfully');

    }

    public function updatestatus(Request $request)
    {
        $user=User::findOrFail($request->id);
        if($request->checked=="false"){
            $user->update(['is_active'=>0]);
        }
        if($request->checked=="true"){
            $user->update(['is_active'=>1]);
        }
    }

    public function viewchangepassword()
    {
        return view('user.changePassword');
    }

    public function changepassword(Request $request)
    {
        $request->validate([
            'oldpassword'     =>'required|min:6',
            'newpassword'     =>'required|min:6',
            'confirmpassword' =>'required|min:6|same:newpassword'
        ]);

        $currentuser=auth()->user();
        if(Hash::check($request->oldpassword,$currentuser->password))
        {
            $currentuser->update(['password'=>Hash::make($request->newpassword)]);
            return redirect()->route('index')->with('success','Password updated successfully');
        }
        else
        {
            return redirect()->route('index')->with('error','Old Password does not match');
        }
    }
}
