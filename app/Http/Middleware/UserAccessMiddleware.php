<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserAccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $module, $action): Response
    {
        $modulesName = $request->user()->roles->flatMap->permissions->flatMap->modules->pluck('name')->toArray();
        $pivotData = $request->user()->roles->flatMap->permissions->flatMap->modules->pluck('pivot')->toArray();
        $modulesIds = $request->user()->roles->flatMap->permissions->flatMap->modules->pluck('id')->toArray();
        if (auth()->user()->type == 'admin') {
            return $next($request);
        } else {
            if (in_array($module, $modulesName) && $action=='any') {
                return $next($request);
            } else {
                if (in_array($module, $modulesName)) {
                    if ($action == 'add') {
                        $access = 'add_access';
                    } else if ($action == 'edit') {
                        $access = 'edit_access';
                    } else if ($action == 'view') {
                        $access = 'view_access';
                    } else if ($action == 'delete') {
                        $access = 'delete_access';
                    }
                    // Loop through array1
                    foreach ($modulesIds as $moduleId) {
                        // Find the first matching array in array2 based on module_id
                        $matchedArray = array_values(array_filter($pivotData, function ($item) use ($moduleId, $access) {
                            return $item['module_id'] === $moduleId && $item[$access] === 1;
                        }));
                    }

                    if ($matchedArray != null) {
                        return $next($request);
                    }
                }
            }
        }
        abort(403, 'Unauthorized action.');
    }
}
