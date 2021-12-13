<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\auth\LoginRequest;
use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }
    public function logout()
    {
        Auth::logout();
        return redirect()->route('auth.login');
    }

    public function loginSubmit(LoginRequest $request)
    {
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            Toastr::error("User not found", "Please try again");
            return redirect(route('auth.login'));
        } else {
            if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
                if($user->hasRole([User::ADMIN_ROLE, User::SUPER_ADMIN_ROLE])){
                    return redirect()->route('admin.dashboard');
                }elseif($user->hasRole(User::REGIONAL_ROLE)){
                    return redirect()->route('region.dashboard');
                }
                elseif($user->hasRole(User::INDIVIDUAL_ROLE)){
                    return redirect()->route('individual.dashboard');
                }
            }
            Toastr::error("Please try again", "Invalid Credentials");
            return redirect(route('auth.login'));
        }
    }
}
