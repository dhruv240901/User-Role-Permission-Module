<?php

namespace app\Traits;

use App\Models\Module;

trait ModulesDisplay
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
