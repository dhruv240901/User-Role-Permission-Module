<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Module;

class UserAccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $module, $action): Response
    {
        if (auth()->user()->type == 'admin') {
            return $next($request);
        } else {
            if ($request->user()->hasModule($module)) {
                $moduleData = Module::where('name', $module)->first();
                if ($action == 'any') {
                    return $next($request);
                } else {
                    $pivotData = $request->user()->roles->flatMap->permissions->flatMap->modules->pluck('pivot')->toArray();
                    foreach ($pivotData as $item) {
                        if ($item["module_id"] === $moduleData->id) {
                            if ($item['add_access'] == 1 && $action == 'add') {
                                return $next($request);
                            }
                            if ($item['view_access'] == 1 && $action == 'view') {
                                return $next($request);
                            }
                            if ($item['edit_access'] == 1 && $action == 'edit') {
                                return $next($request);
                            }
                            if ($item['delete_access'] == 1 && $action == 'delete') {
                                return $next($request);
                            }
                        }
                    }
                }
            }
        }
        return response()->view('error.Unauthorized');
    }
}
