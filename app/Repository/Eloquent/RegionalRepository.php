<?php

namespace App\Repository\Eloquent;

use App\Repository\IRegionalRepository;
use App\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use PDO;

class RegionalRepository implements IRegionalRepository
{
    public function saveData($requestData)
    {
        // dd($requestData);
        $user = new User();
        $user->name = $requestData->name;
        $user->username = $requestData->username;
        $user->email = $requestData->email;
        $user->password = Hash::make($requestData->password);
        $user->save();
        if($requestData->type){
            $user->assignRole($requestData->type);
        }
        return $user;
    }


    public function regionalRoleUsers()
    {
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', User::REGIONAL_ROLE);
        })->get();
        return $users;
    }

    public function individualRoleUsers()
    {
        $users = User::whereHas('roles', function ($query) {
            $query->where('name', User::INDIVIDUAL_ROLE);
        })->get();
        return $users;
    }


    public function allUsers(){
        $users = User::withTrashed()->whereHas('roles', function ($query) {
            $query->where('name', '!=',User::SUPER_ADMIN_ROLE);
        })->get();
        return $users;
    }

    public function fetchAllRoles()
    {
        $roles = User::allRoles();
        return $roles;
    }

    public function findById($regionalId)
    {
        $regionalUser = User::whereHas('roles', function ($q) {
            $q->where('name', User::REGIONAL_ROLE);
        })->where('id', $regionalId)->first();
        return $regionalUser;
    }

    public function findAllById($id)
    {
        return User::find($id);
    }
    public function findByUsername($regionalUsername)
    {
        $regionalUser = User::whereHas('roles', function ($q) {
            $q->where('name', User::REGIONAL_ROLE);
        })->where('username', $regionalUsername)->first();
        return $regionalUser;
    }

    public function findAllUserByUsername($username){
        $user = User::whereHas('roles', function ($q) {
            $q->where('name', User::REGIONAL_ROLE)
                ->orWhere('name', User::INDIVIDUAL_ROLE);
        })->where('username', $username)->first();
        if(!$user){
            return null;
        }
        if($user->hasRole(User::REGIONAL_ROLE)){
            $user->is_regional = true;
        }elseif($user->hasRole(User::INDIVIDUAL_ROLE)){
            $user->is_individual = true;
        }
        return $user;
    }

    public function updateData($data, $regionalUser)
    {
        $regionalUser->name = $data->name;
        $regionalUser->email = $data->email;
        $regionalUser->username = $data->username;
        if ($data->password) {
            $regionalUser->password = Hash::make($data->password);
        }
        if ($regionalUser->save())
            return true;
        else
            return false;
    }

    private function generateUsername($email)
    {
        $mailName = explode('@', $email);
        $username = $mailName = strtolower($mailName[0]);
        while (true) {
            $exists = User::where('username', $username)->count();
            if ($exists == 0) {
                break;
            }
            $chars = ['-', '@', '.', '_'];
            $randomElement = $chars[array_rand($chars)];
            $username = $mailName . $randomElement . rand(1, 100);
        }
        return $username;
    }

    public function toggleUserStatus($username)
    {
        $user = User::withTrashed()->where('username', $username)->first();
        if(!$user){
            throw new Exception("User not found", 400);
        }
        if($user->deleted_at == null){
            $user->delete();
        }else{
            $user->restore();
        }
    }
}
