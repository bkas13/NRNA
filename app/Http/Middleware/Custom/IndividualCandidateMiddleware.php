<?php

namespace App\Http\Middleware\Custom;

use App\User;
use Closure;
use Illuminate\Support\Facades\Auth;

class IndividualCandidateMiddleware
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
        if($user->hasRole(User::INDIVIDUAL_ROLE)){
            return $next($request);
        }
        abort(403);
    }
}
