<?php

namespace App\Http\Controllers;

use App\Models\Module;

class BaseController extends Controller
{
    protected function getParentModule()
    {
        $parentModules = Module::whereNull('parent_id')->where('is_active', 1)->where('is_in_menu', 1)->orderBy('display_order')->get();
        return $parentModules;
    }

    protected function getChildModule()
    {
        $modules = Module::whereNotNull('parent_id')->with('parent')
                    ->where([
                        ['is_active', 1],
                        ['is_in_menu', 1]
                    ])
                    ->orderBy('display_order')->get();
        return $modules;
    }
}
