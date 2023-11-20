<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Closure;
use DB;
use Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if (! $request->expectsJson()) {
            session()->flash('error', 'Please Login!.');
            return route('login');
        }
    }

    public function handle($request, Closure $next, ...$guards)
    {
        $this->authenticate($request, $guards);

        $token = DB::table('personal_access_tokens')->where('tokenable_id', auth()->id())->first();

        if ($token == null) {
            Auth::guard('web')->logout();
            return redirect()->route('login')->with('error','You are logged out');
        }

        return $next($request);
    }
}
