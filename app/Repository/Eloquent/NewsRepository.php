<?php

namespace App\Repository\Eloquent;

use App\Repository\INewsRepository;
use App\Model\News;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class NewsRepository implements INewsRepository
{
    public function all()
    {
        $news = News::all();
        return $news;
    }
    public function getNewsByRegion($regionId)
    {
        $news = News::where('user_id', $regionId)->latest()->get();
        foreach($news as $n){
            $cleanDescription = strip_tags($n->description);
            $n->excerpt = html_entity_decode(substr($cleanDescription, 0, 200));
            $n->moreText = strlen($cleanDescription) > strlen($n->excerpt) ? 1 : 0;
        }
        return $news;
    }

    public function getActiveNewsByRegion($regionId)
    {
        return $this->getNewsByRegion($regionId)->where('status','Active');
    }

    public function findById($id)
    {
        $news = News::find($id);
        return $news;
    }
    public function findBySlug($slug)
    {
        $news = News::where('slug', $slug)->first();
        return $news;
    }
    public function createData($data)
    {
        $news = new News();
        $news->title = $data->title;
        $news->description = $data->description;
        $news->status = $data->status;
        $news->user_id = Auth::id();
        $result = $news->save();
        if ($data->hasFile('image')) {
            $image = $data->file('image');
            $path = '/uploads/news/';
            $db_path = imageUpload($image, $path);
            $news->featureImage()->create([
                'type' => 'feature_image',
                'path' => $db_path,
                'name' => $image->getClientOriginalName(),
            ]);
        }
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    public function updateData($data, $news)
    {
        if ($data->hasFile('image')) {
            if ($news->featureImage) {
                imageDelete($news->featureImage->path);
            }
            $image = $data->file('image');
            $path = '/uploads/news/';
            $db_path = imageUpload($image, $path);
            $news->featureImage()->updateOrCreate([
                'type' => 'feature_image'
            ], [
                'path' => $db_path,
                'name' => $image->getClientOriginalName()
            ]);
        }
        $news->title = $data->title;
        $news->description = $data->description;
        $news->status = $data->status;
        $result = $news->update();
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    public function deleteData($featureImagePath, $singleNews)
    {
        if ($singleNews->featureImage) {

            imageDelete($featureImagePath);
        }
        $deleteNews = $singleNews->delete();

        if ($deleteNews) {
            return true;
        } else {
            return false;
        }
    }

    public function getRegionalRecentNews($regionalUser, $count = 5, $exclude=null)
    {
        $news = News::latest()
            ->where('user_id', $regionalUser->id)
            ->where('id','!=',$exclude)
            ->with(['featureImage'])
            ->where('status', 'Active')
            ->take($count)
            ->get();
        foreach($news as $n){
            $cleanDescription = strip_tags($n->description);
            $n->excerpt = html_entity_decode(substr($cleanDescription, 0, 200));
            $n->moreText = strlen($cleanDescription) > strlen($n->excerpt) ? 1 : 0;
        }
        return $news;
    }

    public function getAllRecentNews($count = 5, $exclude = null)
    {
        $news = News::latest()
            ->where('id','!=',$exclude)
            ->where('status', 'Active')
            ->with(['featureImage'])
            ->take($count)
            ->get();
        foreach($news as $n){
            $cleanDescription = strip_tags($n->description);
            $n->excerpt = html_entity_decode(substr($cleanDescription, 0, 200));
            $n->moreText = strlen($cleanDescription) > strlen($n->excerpt) ? 1 : 0;
        }
        return $news;
    }
}
