<?php

namespace App\Model;

use App\User;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    use HasSlug;

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['first_name', 'last_name'])
            ->saveSlugsTo('slug');
    }

    public function profileImage()
    {
        return $this->morphOne(Image::class, 'imageable')->where('type','profile_image');
    }
    public function candidateBanner(){
        return $this->morphOne(Image::class, 'imageable')->where('type','candidate_banner');
    }

    public function fullName(){
        return $this->first_name." ".$this->last_name;
    }

    public function region()
    {
        return $this->belongsTo(User::class, 'regional_id');
    }

    public function metaData(){
        return $this->hasMany(CandidateMeta::class, 'candidate_id');
    }

    public function designation(){
        $meta_data = $this->metaData()->where('key','designation')->first();
        return $meta_data->value ?? '';
    }
}
