<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Repository\ICandidateRepository;
use App\Repository\INewsRepository;
use App\Repository\IProfileRepository;
use App\Repository\IRegionalRepository;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class CommitteeController extends Controller
{
    protected $regional, $candidate, $news, $profile;
    public function __construct(
        IRegionalRepository $regional,
        ICandidateRepository $candidate,
        INewsRepository $news,
        IProfileRepository $profile)
    {
        $this->regional = $regional;
        $this->candidate = $candidate;
        $this->news = $news;
        $this->profile = $profile;
    }

    public function index($regionalSlug, $candidateSlug){
        $currentUser = $this->regional->findByUsername($regionalSlug);
        if(!$currentUser){
            Toastr::error("Unknown profile","Error");
            return redirect()->back();
        }
        $candidate = $this->candidate->findBySlug($candidateSlug);
        if(!$candidate){
            Toastr::error("Candidate not found","Error");
            return redirect()->back();
        }
        $candidateData = $this->candidate->metaData($candidate);
        $recentNews = $this->news->getRegionalRecentNews($currentUser, 3);
        return view('front.user.committee', compact('currentUser','candidate','candidateData', 'recentNews'));
    }

    public function candidateProfile($individualSlug){
        $currentUser = $this->regional->findAllUserByUsername($individualSlug);
        if($currentUser->is_individual != true){
            Toastr::error("Unknown profile page", "Page not found");
        }
        $candidateData = $this->profile->getProfileData($currentUser);
        $candidateImages = $this->profile->getProfileImages($currentUser);
        $recentNews = $this->news->getRegionalRecentNews($currentUser, 3);
        return view('front.user.individualProfile', compact('currentUser','candidateData','candidateImages'));
    }
}
