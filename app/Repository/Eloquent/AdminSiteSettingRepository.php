<?php

namespace App\Repository\Eloquent;

use App\Model\Banner;
use App\Model\RegionSiteSetting;
use App\Model\SiteSetting;
use App\Repository\IAdminSiteSettingRepository;
use Brian2694\Toastr\Facades\Toastr;

class AdminSiteSettingRepository implements IAdminSiteSettingRepository
{

    public function createData($request)
    {
        $masterSetting = $this->getMasterSetting();
        foreach ($request as $key => $value) {
            if ($key == 'about_image' || $key == 'region_logo') {
                if ($value) {
                    $this->updateSettingImages($key, $value, $masterSetting);
                }
            } else {
                $this->updateMeta($key, $value);
            }
        }
        return true;
    }
    public function createBanner($bannerRequests, $regional)
    {
        // $bannerRequests = collect($request)->only('banner_image', 'banner_title', 'banner_subtitle', 'link', 'status');
        // dd($bannerRequests->title);
        $banner = Banner::create([
            'title' => $bannerRequests->title,
            'subtitle' => $bannerRequests->subtitle,
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
    public function getBannerData($id)
    {
        $bannerData = Banner::where('user_id', $id)->get();
        return $bannerData;
    }
    public function getActiveBannerData($id)
    {
        // dd($regionalUser);
        $bannerData = Banner::where('status', 'Active')->where('user_id', $id)->get();
        return $bannerData;
    }

    private function updateMeta($key, $value, $array = false)
    {
        SiteSetting::updateOrCreate([
            'key' => $key,
            'user_id'=>null,
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
        }
    }
    private function getMasterSetting()
    {
        $masterSetting = SiteSetting::where('key', 'Master')
            ->where('user_id', null)
            ->first();
        if (!$masterSetting) {
            $masterSetting = SiteSetting::updateOrCreate([
                'key' => 'Master',
                'user_id' => null
            ],[
                'value' => 'Admin',
            ]);
        }
        return $masterSetting;
    }

    public function getSetting($regionalUser)
    {
        // dd($regionalUser);
        $settings = SiteSetting::where('user_id', $regionalUser)->get();
        foreach ($settings as $data) {
            if ($data->array == 1) {
                $data->value = $data->custom;
            }
        }
        return $settings->pluck('value', 'key')->toArray();
    }

    public function getSettingImages($user)
    {
        $masterSetting = $this->getMasterSetting($user);
        $masterSetting->load([
            'about_image',
            'region_logo',
        ]);
        return $masterSetting;
    }
}
