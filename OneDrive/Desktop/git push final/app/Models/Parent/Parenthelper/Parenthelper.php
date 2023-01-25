<?php

namespace App\Models\Parent\Parenthelper;

use App\Models\Admin\Student\Student;
use App\Models\Parent\Settings\Mobile\Parentappactivestudent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Parenthelper extends Model
{
    // FOR API
    public static function getstudentid()
    {
        return Parentappactivestudent::where('parenttokenid', substr(request()->header('authorization'), -33) . auth()->user()->uuid)
            ->first()
            ->student_id;
    }

    public static function getstudentuuid()
    {
        return Parentappactivestudent::where('parenttokenid', substr(request()->header('authorization'), -33) . auth()->user()->uuid)
            ->first()
            ->student_uuid;
    }

    public static function getstudent()
    {
        return Student::find(Parenthelper::getstudentid());
    }

    // FOR WEB
    public static function getstudentidweb()
    {
        return Parentappactivestudent::where('parenttokenid', session()->getId() . Auth::guard('aparent')->user()->uuid)
            ->first()
            ->student_id;
    }

    public static function getstudentuuidweb()
    {
        return Parentappactivestudent::where('parenttokenid', session()->getId() . Auth::guard('aparent')->user()->uuid)
            ->first()
            ->student_uuid;
    }

    public static function getstudentweb()
    {
        return Student::find(Parenthelper::getstudentidweb());
    }

}
