<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Closure;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param     \Illuminate\Http\Request; $request
     * @param      \Closure&nbsp; $next
     * @param&nbsp; string|null; $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        die('RedirectIfAuthenticated');
        if ($guard == "admin" && Auth::guard($guard)->check()) {

            return redirect('dashboard'); //name of the route to be redirected on successful admin login
        }
        if (Auth::guard($guard)->check()) {
            return redirect(dd('hlw')); //name of the route to be redirected on successful user login
        }
        return $next($request);
    }
}
