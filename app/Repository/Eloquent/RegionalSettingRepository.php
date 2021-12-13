<?php

namespace App\Repository\Eloquent;

use App\Model\Banner;
use App\Model\SiteSetting;
use App\Repository\IRegionalSettingRepository;

class RegionalSettingRepository implements IRegionalSettingRepository
{

    public function createData($request, $user)
    {
        // dd($request);
        $masterSetting = $this->getMasterSetting($user);
        foreach ($request as $key => $value) {
            if ($key == 'about_image' || $key == 'region_logo' || $key == 'feature_image') {
                if ($value) {
                    $this->updateSettingImages($key, $value, $masterSetting);
                }
            } else {
                $this->updateMeta($key, $value, $user);
            }
        }
        return true;
    }
    public function createBanner($bannerRequests, $user)
    {
        // $bannerRequests = collect($request)->only('banner_image', 'banner_title', 'banner_subtitle', 'link', 'status');
        // dd($bannerRequests->title);
        $banner = Banner::create([
            'title' => $bannerRequests->title,
            'subtitle' => $bannerRequests->subtitle,
            'user_id' => $user->id,
            'link' => $bannerRequests->link,
            'status' => $bannerRequests->status,
        ]);
        if ($bannerRequests->hasFile('image')) {
            $bannerImage = $bannerRequests->file('image');
            $publicPath = '/uploads/region/banners/';
            $imagePath = imageUpload($bannerImage, $publicPath);
            // dd($imagePath);
            $banner->banner_image()->create([
                'type' => 'banner_image',
                'path' => $imagePath,
                'name' => $bannerImage->getClientOriginalName(),
            ]);
        }
        if ($banner) {
            return true;
        } else {
            return false;
        }
    }
    public function updateBanner($banner, $bannerRequests)
    {
        $banner->update([
            'title' => $bannerRequests->title,
            'subtitle' => $bannerRequests->subtitle,
            'link' => $bannerRequests->link,
            'status' => $bannerRequests->status,
        ]);
        if ($bannerRequests->hasFile('image')) {
            if ($banner->banner_image) {
                imageDelete($banner->banner_image->path);
            }
            $bannerImage = $bannerRequests->file('image');
            $bannerImagePath = imageUpload($bannerImage, '/uploads/region/banners/');
            $saveBannerImage = $banner->banner_image()->updateOrCreate([
                'type' => 'banner_image',
            ], [
                'path' => $bannerImagePath,
                'name' => $bannerImage->getClientOriginalName(),
            ]);
        }
        if ($banner) {
            return true;
        } else {
            return false;
        }
    }
    public function findBanner($id)
    {
        return Banner::find($id);
    }
    public function deleteBanner($banner)
    {
        if ($banner->banner_image) {
            $filepath = $banner->banner_image->path;
            $deleteBannerImage = imageDelete($filepath);
        }
        $deleteBanner = $banner->delete();
        if ($deleteBanner) {
            return true;
        } else {
            return false;
        }
    }
    public function getActiveBannerData($user)
    {
        $bannerData=Banner::where('status','Active')->where('user_id',$user->id)->get();
        return $bannerData;
    }
    public function getBannerData($user)
    {
        $bannerData=Banner::where('user_id',$user->id)->get();
        return $bannerData;
    }


    private function updateMeta($key, $value, $regional, $array = false)
    {

        $regional->settingsData()->updateOrCreate([
            'key' => $key
        ], [
            'array' => $array,
            'value' => $array ? json_encode($value) : $value,
        ]);
    }
    private function updateSettingImages($key, $value, $masterSetting)
    {
        switch ($key) {
            case "about_image":
                $path = imageUpload($value, '/uploads/regional/settings/');
                $masterSetting->about_image()->updateOrCreate([
                    'type' => 'about_image',
                ], [
                    'name' => $value->getClientOriginalName(),
                    'path' => $path,
                ]);
                break;
            case "region_logo":
                $path = imageUpload($value, '/uploads/regional/settings/');
                $masterSetting->region_logo()->updateOrCreate([
                    'type' => 'region_logo',
                ], [
                    'name' => $value->getClientOriginalName(),
                    'path' => $path,
                ]);
                break;
            case "feature_image":
                $path = imageUpload($value, '/uploads/regional/settings/');
                $masterSetting->feature_image()->updateOrCreate([
                    'type' => 'feature_image',
                ], [
                    'name' => $value->getClientOriginalName(),
                    'path' => $path,
                ]);
                break;
        }
    }
    private function getMasterSetting($user)
    {
        $masterSetting = $user->settingsData()->where('key', 'Master')->first();
        if (!$masterSetting) {
            $masterSetting = $user->settingsData()->updateOrCreate([
                'key' => 'Master'
            ],[
                'value' => $user->name,
            ]);
        }
        return $masterSetting;
    }

    public function getSetting($user)
    {
        $settings = SiteSetting::where('user_id', $user->id)->get();
        foreach ($settings as $data) {
            if ($data->array == 1) {
                $data->value = $data->custom;
            }
        }
        return $settings->pluck('value', 'key')->toArray();
    }

    public function getSettingImages($regional)
    {
        $masterSetting = $this->getMasterSetting($regional);
        if($masterSetting){
            $masterSetting->load([
                'about_image',
                'region_logo',
                'feature_image'
            ]);
        }
        return $masterSetting;
    }
}
