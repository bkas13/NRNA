<?php

namespace App\Repository\Eloquent;

use App\Model\IndividualProfile;
use App\Repository\IProfileRepository;

class ProfileRepository implements IProfileRepository{

    public function getProfileData($user)
    {
        $profiles = IndividualProfile::where('individual_id', $user->id)->get();
        foreach ($profiles as $data) {
            if ($data->array == 1) {
                $data->value = $data->custom;
            }
        }
        return $profiles->pluck('value', 'key')->toArray();
    }

    public function getProfileImages($user){
        $masterProfile = $this->getMasterProfile($user);
        if($masterProfile){
            $masterProfile->load([
                'profileImage',
                'profileBannerImage',
            ]);
        }
        return $masterProfile;
    }

    public function createData($request, $user)
    {
        // dd($request);
        $masterProfile = $this->getMasterProfile($user);
        foreach ($request as $key => $value) {
            if ($key == 'profileImage' || $key == 'profileBannerImage') {
                if ($value) {
                    $this->updateProfileImages($key, $value, $masterProfile);
                }
            } else {
                $this->updateMeta($key, $value, $user);
            }
        }
        return true;
    }

    private function updateMeta($key, $value, $individualUser, $array = false)
    {

        $individualUser->profileData()->updateOrCreate([
            'key' => $key
        ], [
            'array' => $array,
            'value' => $array ? json_encode($value) : $value,
        ]);
    }

    private function updateProfileImages($key, $value, $masterProfile)
    {
        switch ($key) {
            case "profileImage":
                $path = imageUpload($value, '/uploads/regional/settings/');
                $masterProfile->profileImage()->updateOrCreate([
                    'type' => 'profileImage',
                ], [
                    'name' => $value->getClientOriginalName(),
                    'path' => $path,
                ]);
                break;
            case "profileBannerImage":
                $path = imageUpload($value, '/uploads/regional/settings/');
                $masterProfile->profileBannerImage()->updateOrCreate([
                    'type' => 'profileBannerImage',
                ], [
                    'name' => $value->getClientOriginalName(),
                    'path' => $path,
                ]);
                break;
        }
    }

    private function getMasterProfile($user)
    {
        $masterProfile = $user->profileData()->where('key', 'Master')->first();
        if (!$masterProfile) {
            $masterProfile = $user->profileData()->updateOrCreate([
                'key' => 'Master'
            ],[
                'value' => $user->name,
            ]);
        }
        return $masterProfile;
    }

    public function updateDynamicMetas($dynamicData, $candidate)
    {
        $keys = array_keys($dynamicData['dynamic_title'] ?? []);
        $description = [];
        foreach ($keys as $key) {
            $description[] = [
                "title" => $dynamicData["dynamic_title"][$key],
                "description" => $dynamicData["dynamic_description"][$key]
            ];
        }
        $this->updateMeta("dynamic_description", $description, $candidate, true);
    }

}
