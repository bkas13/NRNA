<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CandidateMeta extends Model
{
    protected $fillable = [
        'candidate_id', 'key' , 'value', 'array'
    ];

    public function getCustomAttribute() {
        if ($this->array == 1) {
            return (json_decode($this->value));
        }
        return $this->value;
    }

    // public function getValueAttribute($val){
        // dd($val);
        // return $this->getCustomAttribute();
    // }

}
