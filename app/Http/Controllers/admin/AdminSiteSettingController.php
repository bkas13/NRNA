<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\regional\BannerRequest;
use App\Http\Requests\regional\RegionAboutRequest;
use App\Http\Requests\regional\UpdateBannerRequest;
use App\Model\Banner;
use App\Repository\IAdminSiteSettingRepository;
use App\Repository\IRegionalRepository;
use App\Repository\IRegionalSettingRepository;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminSiteSettingController extends Controller
{
    protected $adminSettings, $regional;


    public function __construct(IAdminSiteSettingRepository $adminSettings, IRegionalRepository $regional)
    {
        $this->adminSettings = $adminSettings;
        $this->regional = $regional;
    }
    public function index()
    {
        $regionalUser = Auth::user();
        $settingsData = $this->adminSettings->getSetting(null);
        $settingsImages = $this->adminSettings->getSettingImages($regionalUser);
        return view('admin.siteSetting.index', compact('settingsData', 'settingsImages'));
    }
    public function addSiteSetting(RegionAboutRequest $request)
    {
        try {
            // $regionalUser = Auth::user();
            $addSettingsData = $this->adminSettings->createData($request->except(['_token', 'MAX_FILE_SIZE']));
            if ($addSettingsData) {
                Toastr::success('Data Added', 'Operation Success');
                return redirect()->back();
            } else {
                Toastr::error('Error. Data not Added', 'Operation Failed');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), 400);
            return redirect()->back();
        }
    }

    public function bannerIndex()
    {
        // $banners = $this->adminSettings->getBannerData(null);
        $banners = $this->adminSettings->getBannerData(null);
        return view('admin.siteSetting.bannerIndex', compact('banners'));
    }
    public function bannerAdd()
    {
        return view('admin.siteSetting.bannerAdd');
    }
    public function bannerAddSubmit(BannerRequest $request)
    {
        try {
            DB::beginTransaction();
            $regional = null;
            $saveBanner = $this->adminSettings->createBanner($request, $regional);
            if ($saveBanner) {
                DB::commit();
                Toastr::success('Banner Added', 'Operation Success');
                return redirect()->route('admin.settings.bannerIndex');
            } else {
                Toastr::error('Error. Try Again', 'Operation Failed');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Toastr::error($e->getMessage(), 400);
            return redirect()->back();
        }
    }
    public function bannerEdit($id)
    {
        // dd($id);
        $banner = $this->adminSettings->findBanner($id);
        // dd($banner);
        return view('admin.siteSetting.bannerEdit', compact('banner'));
    }
    public function bannerUpdate($id, UpdateBannerRequest $request)
    {
        try {
            // dd($request);
            $banner = $this->adminSettings->findBanner($id);
            $updateBanner = $this->adminSettings->updateBanner($banner, $request);
            if ($updateBanner) {
                Toastr::success('Banner Updated', 'Operation Success');
                return redirect()->route('admin.settings.bannerIndex');
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
            $banner = $this->adminSettings->findBanner($id);
            $deleteBanner = $this->adminSettings->deleteBanner($banner);
            if ($deleteBanner) {
                Toastr::success('Banner Deleted', 'Operation Success');
                return redirect()->route('admin.settings.bannerIndex');
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
