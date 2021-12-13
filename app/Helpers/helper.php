<?php

use App\Model\SiteSetting;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

function imageUpload($file, $orginalPath)
{
    $time = time();
    $filename = $time.str_replace(" ", "", $file->GetClientOriginalName());
    $db_path = 'uploads/images/' . $filename;
    if (!File::isDirectory('uploads/images')) {
        File::makeDirectory('uploads/images', 0777, true, true);
    }
    $originalPath = $file->storeAs('uploads/images', $filename);

    return $db_path;
}


function imageDelete($path)
{
    try{
        $delete = Storage::delete($path);
    }catch(\Exception $e){
        return;
    }
}

function checkFixed()
{
    if (Route::current()->getName() == "front.home" || Route::current()->getName() == "front.userHome") {
        return "";
    }
    return "fixed navbar_sticky";
}

function isHomePage()
{
    if (Route::current()->getName() == "front.home") {
        return true;
    }
    return false;
}

function isUserHome(){

}


function is_admin()
{
    $user = Auth::user();
    if ($user->hasRole(User::SUPER_ADMIN_ROLE) || $user->hasRole(User::ADMIN_ROLE)) {
        return true;
    }
    return false;
}

function is_regional()
{
    $user = Auth::user();
    if ($user->hasRole(User::REGIONAL_ROLE)) {
        return true;
    }
    return false;
}

function is_individual()
{
    $user = Auth::user();
    if ($user->hasRole(User::INDIVIDUAL_ROLE)) {
        return true;
    }
    return false;
}

function personal_logo($user)
{
    $master = $user->regionalMaster;
    if (!$master) {
        return null;
    }
    $logo = $master->region_logo;
    if ($logo) {
        return $logo->path;
    }
    return null;
}

function getAdminContactPage(){
    $user = Auth::user();
    if($user->hasRole(User::INDIVIDUAL_ROLE)){
        $route = route('individual.contact.all');
    }elseif($user->hasRole(User::REGIONAL_ROLE)){
        $route = route('region.contact.all');
    }else{
        $route = route('admin.contact.all');
    }
    return $route;
}

function getUserSettingMeta($currentUser, $key){
    $meta = SiteSetting::where('user_id', $currentUser->id)
        ->where('key', $key)
        ->first();
    if(!$meta){
        return null;
    }
    return $meta->value;
}

function getMediaUrl($path){
    if(!$path){
        return null;
    }
    if(config('app.env') == "production"){
        return Storage::url($path);
    }else{
        return asset($path);
    }
}
