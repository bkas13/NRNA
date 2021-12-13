<?php

namespace App;

use App\Model\IndividualProfile;
use App\Model\SiteSetting;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable, HasRoles, SoftDeletes;

    const SUPER_ADMIN_ROLE = 'Superadmin';
    const ADMIN_ROLE = 'Admin';
    const REGIONAL_ROLE = 'NCC';
    const INDIVIDUAL_ROLE = "Candidate";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'profile_image'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $with = ['roles'];

    public static function allRoles()
    {
        return [
            self::REGIONAL_ROLE,
            self::INDIVIDUAL_ROLE,
        ];
    }

    public function settingsData()
    {
        return $this->hasMany(SiteSetting::class, 'user_id');
    }

    public function regionalMaster(){
        return $this->hasOne(SiteSetting::class, 'user_id')
            ->where('key', 'Master');
    }

    public function profileData(){
        return $this->hasMany(IndividualProfile::class, 'individual_id');
    }

    public function masterProfileData(){
        return $this->hasOne(IndividualProfile::class, 'individual_id')
            ->where('key', 'Master');
    }
}
