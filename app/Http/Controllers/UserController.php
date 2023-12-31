<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Hash;
use Mail;
use App\Models\Role;
use App\Models\User;
use App\Mail\AddUserMail;
use Illuminate\Http\Request;
use App\Traits\AjaxResponse;
use App\Traits\ModulesDisplay;

class UserController extends Controller
{
    use AjaxResponse,ModulesDisplay;

    /* function to display users list */
    public function index()
    {
        $users = User::whereNot('id', auth()->id())->whereNot('type', 'admin')->withTrashed()->get();
        $modules=$this->getChildModule();
        $parentModules=$this->getParentModule();
        return view('user.list', compact('users','modules','parentModules'));
    }

    /* function to render add user form */
    public function create()
    {
        $roles = Role::where('is_active', true)->get();
        $user = null;
        $modules=$this->getChildModule();
        $parentModules=$this->getParentModule();
        return view('user.addEdit', compact('roles', 'user','modules','parentModules'));
    }

    /* function to show user details by id */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $modules=$this->getChildModule();
        $parentModules=$this->getParentModule();
        return view('user.show', compact('user','modules','parentModules'));
    }

    /* function to store user in database */
    public function store(Request $request)
    {
        // Validate Add User Form Request
        $request->validate([
            'firstName' => 'required|string',
            'lastName'  => 'required|string',
            'email'     => 'unique:users|required|email',
            'roles'     => 'required|exists:roles,id'
        ]);

        // Store Add User Form Details in the database
        $randomPassword = rand(100000, 999999);
        $insertData = [
            'first_name'     => $request->firstName,
            'last_name'      => $request->lastName,
            'email'          => $request->email,
            'password'       => Hash::make($randomPassword),
            'is_active'      => true,
            'is_first_login' => true,
        ];

        $user = User::create($insertData);

        // Store Requested roles into the database
        if ($request->roles) {
            foreach ($request->roles as $key => $roleId) {
                $user->roles()->attach($request->roles[$key]);
            }
        }
        $authUser = Auth::user();

        // Send Mail to added user mail id on successfull User Stored with user current password
        if ($user) {
            dispatch(function () use ($user, $randomPassword, $authUser) {
                Mail::to($user['email'])->send(new AddUserMail($user, $randomPassword, $authUser));
            })->delay(now()->addSeconds(5));
        }

        return redirect()->route('add-user')->with('success', 'User Created Successfully');
    }

    /* function to render edit user form */
    public function edit(string $id)
    {
        $roles = Role::where('is_active', true)->get();
        $user = User::findOrFail($id);
        $modules=$this->getChildModule();
        $parentModules=$this->getParentModule();
        return view('user.addEdit', compact('user', 'roles','modules','parentModules'));
    }

    /* function to update user */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        // Validate Edit User Form Request
        $request->validate([
            'firstName' => 'required|string',
            'lastName'  => 'required|string',
            'roles'     => 'required|exists:roles,id'
        ]);

        // Update Edit User Form Request into the database
        $updateData = [
            'first_name' => $request->firstName,
            'last_name'  => $request->lastName,
        ];

        $userUpdate = $user->update($updateData);

        if ($request->roles) {

            // Delete Old Roles of requested user from the database
            foreach ($user->roles as $key => $roleId) {
                $user->roles()->detach($user->roles[$key]);
            }

            // Add New Roles of requested user in the database
            foreach ($request->roles as $key => $roleId) {
                $user->roles()->attach($request->roles[$key]);
            }
        }
        return redirect()->route('edit-user', $id)->with('success', 'User Updated Successfully');
    }

    /* function to soft delete user */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('user-list')->with('success', 'User Soft Deleted Successfully');
    }

    /* function to restore user */
    public function restore($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();
        return redirect()->route('user-list')->with('success', 'User Restored Successfully');
    }

    /* function to force delete user */
    public function forceDelete($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->forceDelete();
        return redirect()->route('user-list')->with('success', 'User Permanently Deleted Successfully');
    }

    /* function to update user status */
    public function updateStatus(Request $request)
    {
        // Validate Update User Status Request
        $request->validate([
            'checked' => 'required'
        ]);
        $user = User::findOrFail($request->id);

        // Inactivate user if user is Activated
        if ($request->checked == "false") {
            $user->update(['is_active' => false]);
            $message = "User Inactivated Successfully";
        }

        // Activate user if user is Inactivated
        if ($request->checked == "true") {
            $user->update(['is_active' => true]);
            $message = "User Activated Successfully";
        }
        $response=$this->success(200,$message);
        return $response;
    }

    /* function to render change password form */
    public function viewChangePassword()
    {
        $modules=$this->getChildModule();
        $parentModules=$this->getParentModule();
        return view('user.changePassword',compact('modules','parentModules'));
    }


    /* function to render update password */
    public function changePassword(Request $request)
    {
        // Validate Change Password form request
        $request->validate([
            'oldPassword'     => 'required|min:6',
            'newPassword'     => 'required|min:6',
            'confirmPassword' => 'required|min:6|same:newPassword'
        ]);

        // Update new password in the database 
        $currentUser = auth()->user();
        if (Hash::check($request->oldPassword, $currentUser->password)) {
            $currentUser->update(['password' => Hash::make($request->newPassword)]);
            return redirect()->route('index')->with('success', 'Password updated successfully');
        } else {
            return redirect()->route('index')->with('error', 'Old Password does not match');
        }
    }

    /* function to force logout user by id  */
    public function forceLogout($id)
    {
        $token = DB::table('personal_access_tokens')->where('tokenable_id', $id)->delete();
        return redirect()->back()->with('success', 'User logged out from other devices.');
    }

    /* function to view user profile */
    public function profile()
    {
        $modules=$this->getChildModule();
        $parentModules=$this->getParentModule();
        return view('user.profile',compact('modules','parentModules'));
    }
}
