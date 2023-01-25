<?php

namespace App\Models\Admin\Chat;

use App\Models\Admin\Chat\Chatmessage;
use App\Models\Admin\Chat\Chatmessageread;
use App\Models\Admin\Chat\Chatparticipant;
use App\Models\Admin\Settings\Academicsetting\Assignsubject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Chatgroup extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime:d-M-Y h:i:s',
        'updated_at' => 'datetime:d-M-Y h:i:s',

        'subject_pluck' => 'array',
        'assignsubject_pluck' => 'array',
        'staff_pluck' => 'array',
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }

    // Is Class Section
    public function scopeIsclasssection($query, $classmaster_id, $section_id)
    {
        return $query->where('classmaster_id', $classmaster_id)
            ->where('section_id', $section_id);
    }

    public function chatmessage()
    {
        return $this->hasMany(Chatmessage::class);
    }

    public function chatmessageread()
    {
        return $this->hasMany(Chatmessageread::class);
    }

    public function assignsubject()
    {
        return $this->belongsTo(Assignsubject::class);
    }

    public function chatparticipant()
    {
        return $this->hasMany(Chatparticipant::class);
    }

    // public function chatparticipantpivot()
    // {
    //     return $this->belongsToMany(User::class, 'chat_participants')->withTimestamps();
    // }
}
