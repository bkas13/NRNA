<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class RegionContact extends Model
{

    protected $fillable = [
        'name', 'email', 'subject', 'phone', 'message', 'read_at', 'regional_id'
    ];

    public function region(){
        return $this->belongsTo(User::class, 'regional_id');
    }
}
