<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use App\Models\Module;
use App\Traits\ModulesDisplay;

class HomeController extends Controller
{
    use ModulesDisplay;

    /* function to render home page */
    public function index()
    {
        $count['users']       = User::count();
        $count['roles']       = Role::count();
        $count['permissions'] = Permission::count();
        $count['modules']     = Module::count();
        $modules=$this->getChildModule();
        $parentModules=$this->getParentModule();
        return view('index', compact('count','modules','parentModules'));
    }

    /* function to render coming soon page */
    public function comingSoon()
    {
        $modules=$this->getChildModule();
        $parentModules=$this->getParentModule();
        return view('comingSoon', compact('modules','parentModules'));
    }
}
