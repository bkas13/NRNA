<?php

namespace App\Repository\Eloquent;

use App\Repository\IUserRepository;
use Illuminate\Support\Facades\Hash;

class UserRepository implements IUserRepository
{
    public function changePassword($user, $password)
    {
        $user->password = Hash::make($password);
        $user->save();
    }
}
