<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class News extends Model
{
    use HasSlug;

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug')
            ->slugsShouldBeNoLongerThan(50);
    }

    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function scopeLatest($query){
        return $query->orderBy('created_at','desc');
    }

    public function featureImage()
    {
        return $this->morphOne(Image::class, 'imageable')->where('type', 'feature_image');
    }
    public function gallery()
    {
        return $this->morphMany(Image::class, 'imageable')->where('type', 'gallery');
    }

    public function created_date(){
        return $this->created_at->format('M d, Y, l');
    }
}
