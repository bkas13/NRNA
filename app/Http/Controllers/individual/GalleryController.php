<?php

namespace App\Http\Controllers\individual;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Image as ModelImage;
use App\Model\News;
use App\Repository\INewsRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Image;

class GalleryController extends Controller
{
    protected $news;
    public function __construct(INewsRepository $news)
    {
        $this->news = $news;
    }

    public function gallery($news_slug)
    {
        $singleNews = $this->news->findBySlug($news_slug);
        if ($singleNews) {
            return view('individual.news.gallery', compact('singleNews'));
        } else {
            return redirect()->back()->with('error', 'Gallery Not Found! Please Reload Page.');
        }
    }
    public function get_gallery($news_id)
    {
        $singleNews = $this->news->findById($news_id);
        $images = $singleNews->gallery()->select(['id', 'path'])->get();
        foreach ($images as $image) {
            $image->url = getMediaUrl($image->path);
        }
        return $images;
    }

    public function upload(Request $request, $news_id)
    {
        $validator = Validator::make($request->all(), [
            'news_gallery_image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()->all()], 400);
        }
        if ($request->hasFile('news_gallery_image')) {
            $singleNews = $this->news->findById($news_id);
            $image = $request->file('news_gallery_image');
            $path = '/uploads/news/gallery/';
            $db_path = imageUpload($image, $path);
            $result = $singleNews->save();
            $singleNews->gallery()->create([
                'name' => $image->getClientOriginalName(),
                'type' => 'gallery',
                'path' => $db_path,
                'user_id' => Auth::id(),
            ]);
        }

        if ($result) {
            return response()->json("File Added", 200);
        } else {
            return response()->json("Error", 400);
        }
    }

    public function delete($gallery_id)
    {
        $image = ModelImage::findOrFail($gallery_id);
        $file_path = storage_path($image->path);
        $thumbnail_path = storage_path() . '/thumbnail/' . $image->path;
        if (file_exists($file_path)) {
            unlink($file_path);
        }
        if (file_exists($thumbnail_path)) {
            unlink($thumbnail_path);
        }
        if ($image->delete()) {
            return response()->json("File deleted", 200);
        } else {
            return response()->json("Error", 400);
        }
    }
}
