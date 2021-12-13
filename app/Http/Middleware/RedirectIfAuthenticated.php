<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            $user = Auth::guard($guard)->user();
            if($user->hasRole(User::SUPER_ADMIN_ROLE) || $user->hasRole(User::ADMIN_ROLE)){
                return redirect()->route('admin.dashboard');
            }elseif($user->hasRole(User::REGIONAL_ROLE)){
                return redirect()->route('region.dashboard');
            }elseif($user->hasRole(User::INDIVIDUAL_ROLE)){
                return redirect()->route('individual.dashboard');
            }else{
                return redirect('/');
            }
        }

        return $next($request);
    }
}
