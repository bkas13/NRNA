<?php

namespace App\Http\Controllers\front;

use App\Http\Controllers\Controller;
use App\Repository\INewsRepository;
use App\Repository\IRegionalRepository;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    protected $regional, $news;
    public function __construct(IRegionalRepository $regional, INewsRepository $news)
    {
        $this->regional = $regional;
        $this->news = $news;
    }
    public function index($userSlug){
        $currentUser = $this->regional->findAllUserByUsername($userSlug);
        if(!$currentUser){
            Toastr::error("Unknown regional","Error");
            return redirect()->back();
        }
        $allNews = $this->news->getActiveNewsByRegion($currentUser->id);
        // dd($news);
        return view('front.user.news',compact('allNews','currentUser'));
    }

    public function singleNews($userSlug, $newsSlug){
        $currentUser = $this->regional->findAllUserByUsername($userSlug);
        if(!$currentUser){
            Toastr::error("Unknown regional","Error");
            return redirect()->back();
        }
        $news = $this->news->findBySlug($newsSlug);
        $recentNews = $this->news->getRegionalRecentNews($currentUser, 4, $news->id);
        $news->load(['featureImage','gallery']);
        return view('front.user.singleNews', compact('currentUser', 'news', 'recentNews'));
    }
}
