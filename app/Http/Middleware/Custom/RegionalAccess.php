<?php

namespace App\Http\Middleware\Custom;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class RegionalAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        if($user->hasRole(User::REGIONAL_ROLE)){
            return $next($request);
        }
        abort(403);
    }
}
