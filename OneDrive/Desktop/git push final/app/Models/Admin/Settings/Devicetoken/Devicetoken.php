<?php

namespace App\Models\Admin\Settings\Devicetoken;

use Illuminate\Database\Eloquent\Model;

class Devicetoken extends Model
{
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime:d-M-Y h:i:s',
        'updated_at' => 'datetime:d-M-Y h:i:s',
    ];

    public function devicetokenable()
    {
        return $this->morphTo();
    }
}
