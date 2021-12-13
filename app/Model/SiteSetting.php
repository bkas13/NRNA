<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $fillable = [
        'user_id', 'key', 'value', 'array'
    ];

    public function getCustomAttribute(){
        return (array)json_decode($this->value);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function about_image()
    {
        return $this->morphOne(Image::class, 'imageable')->where('type', 'about_image');
    }
    public function region_logo()
    {
        return $this->morphOne(Image::class, 'imageable')->where('type', 'region_logo');
    }
    public function feature_image()
    {
        return $this->morphOne(Image::class, 'imageable')->where('type', 'feature_image');
    }

}
