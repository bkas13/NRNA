<?php

namespace App\Http\Middleware\Custom;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class AdminAccess
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
        if($user->hasRole(User::ADMIN_ROLE) || $user->hasRole(User::SUPER_ADMIN_ROLE)){
            return $next($request);
        }
        abort(403);
    }
}
