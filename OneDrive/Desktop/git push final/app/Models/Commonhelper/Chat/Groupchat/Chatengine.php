<?php

namespace App\Models\Commonhelper\Chat\Groupchat;

use App\Models\Commonhelper\Chat\Groupchat\Adminchatonetoone;
use App\Models\Commonhelper\Chat\Groupchat\Groupchathelper;
use App\Models\Commonhelper\Chat\Groupchat\Staffchatstudentonetoone;
use Illuminate\Database\Eloquent\Model;

class Chatengine extends Model
{
    public static function classgroup($chatgroup)
    {
        Groupchathelper::adminsync($chatgroup);
        Groupchathelper::staffsync($chatgroup);
        Groupchathelper::studentsync($chatgroup);
    }

    public static function subjectgroup($chatgroup)
    {
        Groupchathelper::adminsync($chatgroup);
        Groupchathelper::staffsubjectwisesync($chatgroup);
        Groupchathelper::studentsync($chatgroup);
    }

    public static function adminchatonetoone()
    {
        Adminchatonetoone::adminchatwithstaffandstudentgroup();
    }

    public static function staffchatstudentonetoone()
    {
        Staffchatstudentonetoone::staffchatstudentgroup();
    }

}
