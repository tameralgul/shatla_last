<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  ...$guards
     * @return mixed
     */
    public function handle(Request $request = null ,Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;

        $guard=null;
        //add guard
        switch ($guard) {
            case 'admin':
                if (Auth::guard($guard)->check()) {
                    return redirect('/dashboard');
                }
                break;
            default:
                // if (Auth::guard($guard)->check()) {
                //     return redirect('/dashboard');
                // }
                break;
        }

        return $next($request);
    }
}
