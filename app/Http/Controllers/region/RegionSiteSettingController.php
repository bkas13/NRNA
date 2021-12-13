<?php

namespace App\Http\Controllers\region;

use App\Http\Controllers\Controller;
use App\Http\Requests\regional\BannerRequest;
use App\Http\Requests\regional\RegionAboutRequest;
use App\Http\Requests\regional\UpdateBannerRequest;
use App\Repository\IRegionalRepository;
use App\Repository\IRegionalSettingRepository;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegionSiteSettingController extends Controller
{
    protected $regionalSetting, $regional;


    public function __construct(IRegionalSettingRepository $regionalSetting, IRegionalRepository $regional)
    {
        $this->regionalSetting = $regionalSetting;
        $this->regional = $regional;
    }
    public function index()
    {
        $regionalUser = Auth::user();
        $settingsData = $this->regionalSetting->getSetting($regionalUser);
        $settingsImages = $this->regionalSetting->getSettingImages($regionalUser);
        return view('region.siteSetting.index', compact('settingsData', 'settingsImages'));
    }
    public function addSiteSetting(RegionAboutRequest $request)
    {
        try {
            $regionalUser = Auth::user();
            $addSettingsData = $this->regionalSetting->createData($request->except(['_token', 'MAX_FILE_SIZE']), $regionalUser);
            if ($addSettingsData) {
                Toastr::success('Data Added', 'Operation Success');
                return redirect()->back();
            } else {
                Toastr::error('Data Added', 'Operation Failed');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 400);
            return redirect()->back();
        }
    }

    public function bannerIndex()
    {
        $banners = $this->regionalSetting->getBannerData(Auth::user());
        return view('region.siteSetting.bannerIndex', compact('banners'));
    }
    public function bannerAdd()
    {
        return view('region.siteSetting.bannerAdd');
    }
    public function bannerAddSubmit(BannerRequest $request)
    {
        try {
            // dd($request);
            $regional = Auth::user();
            $saveBanner = $this->regionalSetting->createBanner($request, $regional);
            if ($saveBanner) {
                Toastr::success('Banner Added', 'Operation Success');
                return redirect()->route('region.settings.bannerIndex');
            } else {
                Toastr::error('Error. Try Again', 'Operation Failed');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 400);
            return redirect()->back();
        }
    }
    public function bannerEdit($id)
    {
        // dd($id);
        $banner = $this->regionalSetting->findBanner($id);
        // dd($banner);
        return view('region.siteSetting.bannerEdit', compact('banner'));
    }
    public function bannerUpdate($id, UpdateBannerRequest $request)
    {
        try {
            // dd($request);
            $banner = $this->regionalSetting->findBanner($id);
            $updateBanner = $this->regionalSetting->updateBanner($banner, $request);
            if ($updateBanner) {
                Toastr::success('Banner Updated', 'Operation Success');
                return redirect()->route('region.settings.bannerIndex');
            } else {
                Toastr::error('Error. Try Again', 'Operation Failed');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 400);
            return redirect()->back();
        }
    }
    public function bannerDestroy($id)
    {
        try {
            $banner = $this->regionalSetting->findBanner($id);
            $deleteBanner = $this->regionalSetting->deleteBanner($banner);
            if ($deleteBanner) {
                Toastr::success('Banner Deleted', 'Operation Success');
                return redirect()->route('region.settings.bannerIndex');
            } else {
                Toastr::error('Error. Try Again', 'Operation Failed');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 400);
            return redirect()->back();
        }
    }
}
