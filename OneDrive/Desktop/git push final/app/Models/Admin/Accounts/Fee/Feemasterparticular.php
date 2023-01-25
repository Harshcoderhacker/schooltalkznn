<?php

namespace App\Models\Admin\Accounts\Fee;

use App\Models\Admin\Settings\Feesetting\Feeparticular;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feemasterparticular extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime:d-M-Y h:i:s',
        'updated_at' => 'datetime:d-M-Y h:i:s',
    ];

    public function feeparticular()
    {
        return $this->belongsTo(Feeparticular::class);
    }
}
