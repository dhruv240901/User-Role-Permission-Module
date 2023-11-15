<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use App\Models\Module;

class HomeController extends Controller
{
    public function index()
    {
        $count['users']=User::count();
        $count['roles']=Role::count();
        $count['permissions']=Permission::count();
        $count['modules']=Module::count();
        return view('index',compact('count'));
    }
}
