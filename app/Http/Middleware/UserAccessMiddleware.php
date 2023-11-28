<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Traits\AjaxResponse;

class UserAccessMiddleware
{
    use AjaxResponse;
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
            if ($request->user()->hasAccess($module, $action)) {
                return $next($request);
            } else {
                if ($action == 'status') {
                    $response = $this->error(403, 'You cannot update status');
                    return $response;
                }
                return response()->view('error.Unauthorized');
            }
        }
    }
}
