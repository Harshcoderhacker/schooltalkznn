<?php

namespace App\Models\Miscellaneous;

use App\Models\Admin\Auth\User;
use Illuminate\Database\Eloquent\Model;

class PasswordSecurity extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
