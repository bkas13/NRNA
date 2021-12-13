<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = ['title', 'subtitle', 'user_id', 'status', 'link'];

    public function banner_image()
    {
        return $this->morphOne(Image::class, 'imageable')->where('type','banner_image');
    }
}
