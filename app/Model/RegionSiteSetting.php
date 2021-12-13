<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class RegionSiteSetting extends Model
{
    protected $fillable = [
        'regional_id', 'key', 'value', 'array'
    ];

    public function region()
    {
        return $this->belongsTo(User::class, 'regional_id');
    }

    public function banner_image()
    {
        return $this->morphOne(Image::class, 'imageable')->where('type', 'banner_image');
    }
    public function about_image()
    {
        return $this->morphOne(Image::class, 'imageable')->where('type', 'about_image');
    }
    public function region_logo()
    {
        return $this->morphOne(Image::class, 'imageable')->where('type', 'region_logo');
    }
}
