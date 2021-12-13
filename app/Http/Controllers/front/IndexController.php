<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Repository\IAdminSiteSettingRepository;
use App\Repository\ICandidateRepository;
use App\Repository\IContactRepository;
use App\Repository\INewsRepository;
use App\Repository\IRegionalRepository;
use App\Repository\IRegionalSettingRepository;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class IndexController extends Controller
{
    protected $regional, $candidate, $news, $contact, $adminSettings, $regionalSettings;

    public function __construct(
        IRegionalRepository $regional,
        ICandidateRepository $candidate,
        INewsRepository $news,
        IContactRepository $contact,
        IAdminSiteSettingRepository $adminSettings,
        IRegionalSettingRepository $regionalSettings
    ) {
        $this->regional = $regional;
        $this->candidate = $candidate;
        $this->news = $news;
        $this->contact = $contact;
        $this->adminSettings = $adminSettings;
        $this->regionalSettings = $regionalSettings;
    }
    public function home()
    {
        $ncc = $this->regional->regionalRoleUsers();
        $ncc->load(['regionalMaster.region_logo']);
        $individuals = $this->regional->individualRoleUsers();
        $context = new Collection();
        $context->bannerData = $this->adminSettings->getActiveBannerData(null);
        $context->recentNews = $this->news->getAllRecentNews(4);
        $context->siteSettings=$this->adminSettings->getSetting(null);
        $context->siteSettingImages=$this->adminSettings->getSettingImages(null);
        return view('front.home', compact('ncc', 'individuals','context'));
    }

    public function homeContact(Request $request)
    {
        try {
            // dd($request);
            $saveContactData = $this->contact->saveData($request);
            if ($saveContactData) {
                Toastr::success('Your message is added', 'Operation success');
                return redirect()->back();
            } else {
                Toastr::error('Your message has not been added', 'Operation Failed');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), "Error occurred.");
            return redirect()->back();
        }
    }

    public function userHome($userSlug)
    {
        $currentUser = $this->regional->findAllUserByUsername($userSlug);
        if (!$currentUser) {
            Toastr::error("Unknown region", "Error");
            return redirect()->back();
        }
        $currentUser->load('regionalMaster.feature_image');
        $context = new Collection();
        $context->bannerData = $this->regionalSettings->getBannerData($currentUser);
        // dd($currentUser);
        $context->siteSettings = $this->regionalSettings->getSetting($currentUser);
        $context->siteSettingImages = $this->regionalSettings->getSettingImages($currentUser);
        $context->otherNcc = $this->regional->regionalRoleUsers();
        if($currentUser->is_regional == true){
            $context->committee = $this->candidate->candidateByRegion($currentUser);
            $context->otherNcc = $context->otherNcc->where('id','!=', $currentUser->id);
        }
        $context->otherCandidates = $this->regional->individualRoleUsers();
        if($currentUser->is_individual == true){
            $context->otherCandidates = $context->otherCandidates->where('id','!=',$currentUser->id);
        }
        $context->otherNcc->load('regionalMaster.feature_image');
        $context->otherCandidates->load('regionalMaster.feature_image');
        $context->featuredNews = $this->news->getRegionalRecentNews($currentUser, 4);
        return view('front.user.userHome', compact('currentUser', 'context'));
    }

    public function userContact($userSlug)
    {
        $currentUser = $this->regional->findAllUserByUsername($userSlug);
        $siteSettings = $this->regionalSettings->getSetting($currentUser);
        if (!$currentUser) {
            Toastr::error("Unknown regional", "Error");
            return redirect()->back();
        }
        return view('front.user.contact', compact('currentUser','siteSettings'));
    }

    public function userContactSubmit(Request $request, $userSlug)
    {
        try {
            $currentUser = $this->regional->findAllUserByUsername($userSlug);
            if (!$currentUser) {
                Toastr::error("Unknown regional", "Error");
                return redirect()->back();
            }
            $saveRegionContact = $this->contact->saveRegionalContact($currentUser, $request);
            if ($saveRegionContact) {
                Toastr::success('Your message is added', 'Operation success');
                return redirect()->back();
            } else {
                Toastr::error('Your message has not been added', 'Operation Failed');
                return redirect()->back();
            }
            // dd($request);
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), "Error occurred.");
            return redirect()->back();
        }
    }

    public function userAbout($userSlug)
    {
        $currentUser = $this->regional->findAllUserByUsername($userSlug);
        if (!$currentUser) {
            Toastr::error("Unknown regional", "Error");
            return redirect()->back();
        }
        $siteSettings = $this->regionalSettings->getSetting($currentUser);
        $siteSettingImages = $this->regionalSettings->getSettingImages($currentUser);
        // dd($siteSettingImages->about_image->path);
        $recentNews = $this->news->getRegionalRecentNews($currentUser, 4);
        return view('front.user.about', compact('currentUser', 'recentNews', 'siteSettings', 'siteSettingImages'));
    }
}
