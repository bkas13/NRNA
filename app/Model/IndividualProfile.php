<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class IndividualProfile extends Model
{
    protected $table = "individual_profiles";

    protected $fillable = [
        'key', 'value', 'individual_id', 'array'
    ];

    public function getCustomAttribute() {
        if ($this->array == 1) {
            return (json_decode($this->value));
        }
        return $this->value;
    }

    public function individualUser(){
        return $this->belongsTo(User::class, 'individual_id');
    }

    public function profileImage(){
        return $this->morphOne(Image::class, 'imageable')
            ->where('type', 'profileImage');
    }


    public function profileBannerImage(){
        return $this->morphOne(Image::class, 'imageable')
            ->where('type', 'profileBannerImage');
    }
}
