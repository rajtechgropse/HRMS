<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use Closure;

class Authenticate
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

        if (!Auth::check()) {

            return redirect('login'); 
        }
        $user = (Auth::user());
        // dd($user);
        // dd($user->type);
       
        return $next($request);
    }
}
