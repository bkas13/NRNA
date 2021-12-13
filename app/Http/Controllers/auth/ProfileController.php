<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\auth\ChangePasswordRequest;
use App\Repository\IUserRepository;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    protected $user;
    public function __construct(IUserRepository $user)
    {
        $this->user = $user;
    }

    public function profile(){
        $user = Auth::user();
        return view('commonDashboard.changePassword', compact('user'));
    }

    public function changePassword(ChangePasswordRequest $request){
        try{
            $data = $request->validated();
            $user = Auth::user();
            $this->user->changePassword($user, $data['new_password']);
            Toastr::success('Password changed','Operation Success');
            return redirect()->back();
        }catch(\Exception $e){
            Toastr::error($e->getMessage(), 400);
            return redirect()->back();
        }
    }
}
