<?php

namespace app\Traits;

use App\Models\Module;

trait UserAccess
{
    public function UserAccess($module, $action)
    {
        if (auth()->user()->type == 'admin') {
            return true;
        } else {
            if (auth()->user()->hasAccess($module,$action)) {
                return true;
            } else {
                return false;
            }
        }
    }
}
