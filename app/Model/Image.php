<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Image extends Model
{
    protected $fillable = [
        'imageable_id', 'imageable_type', 'image_id', 'type', 'path',
        'name', 'user_id', 'attributes'
    ];

    protected $table = "images";

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            if (Auth::check()) {
                $model->user_id = Auth::user()->id;
            }
        });
    }

    public function imageable()
    {
        return $this->morphTo();
    }
}
