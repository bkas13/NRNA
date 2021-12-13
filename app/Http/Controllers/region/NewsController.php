<?php

namespace App\Http\Controllers\region;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\news\NewsRequest;
use App\Http\Requests\news\UpdateNewsRequest;
use App\Model\News;
use App\Repository\INewsRepository;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    public function __construct(INewsRepository $news)
    {
        $this->news = $news;
    }

    public function index()
    {
        $regionId = Auth::id();
        $news = $this->news->getNewsByRegion($regionId);
        return view('region.news.index', compact('news'));
    }
    public function add()
    {
        return view('region.news.add');
    }
    public function addSubmit(NewsRequest $request)
    {
        try {
            $saveNews = $this->news->createData($request);
            if ($saveNews) {
                Toastr::success('News Data saved', 'Operation Success');
                return redirect()->route('region.news.all');
            } else {
                Toastr::error('Error! News Data not saved', 'Operation Error');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), "Error occurred");
            return redirect()->back();
        }
    }
    public function edit($slug)
    {
        $news = $this->news->findBySlug($slug);
        return view('region.news.edit', compact('news'));
    }
    public function update(NewsRequest $request)
    {
        // dd($request);

        try {
            $singleNews = $this->news->findById($request->news_id);
            $updateNews = $this->news->updateData($request, $singleNews);
            if ($updateNews) {
                Toastr::success('Success. Data Saved', 'Operation Success');
                return redirect()->route('region.news.all');
            } else {
                Toastr::error('Error. Data not Saved', 'Operation Error');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), "Error occurred");
            return redirect()->back();
        }
    }
    public function destroy($slug)
    {
        try {
            $singleNews = $this->news->findBySlug($slug);
            $featureImagePath = $singleNews->featureImage->path;
            $deleteNews = $this->news->deleteData($featureImagePath, $singleNews);
            if ($deleteNews) {
                Toastr::success('News Deleted', 'Operation Success');
                return redirect()->back();
            } else {
                Toastr::error('Error. Try Again', 'Operation Error');
                return redirect()->back();
            }
        } catch (\Exception $e) {
            Toastr::error($e->getMessage(), "Error occurred");
            return redirect()->back();
        }
    }
}
