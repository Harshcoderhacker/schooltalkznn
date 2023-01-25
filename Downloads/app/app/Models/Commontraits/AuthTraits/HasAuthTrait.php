<?php

namespace App\Models\Commontraits\AuthTraits;

use App\Models\Miscellaneous\Logininfo;
use App\Models\Miscellaneous\PasswordSecurity;
use App\Models\Miscellaneous\Tracking;
use Cache;
use Hash;

trait HasAuthTrait
{

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->uuid);
    }

    public function passwordSecurity()
    {
        return $this->hasOne(PasswordSecurity::class);
    }

    public function trackings()
    {
        return $this->morphMany(Tracking::class, 'trackable');
    }

    public function logininfos()
    {
        return $this->morphMany(Logininfo::class, 'logininformable');
    }
}
