<?php

namespace App\Models\Miscellaneous;

use App\Models\Admin\Auth\User;
use App\Models\Admin\Settings\Schoolsetting\Holiday;
use App\Models\Admin\Settings\Schoolsetting\Weekend;
use App\Models\Miscellaneous\Helper;
use App\Models\Miscellaneous\Logininfo;
use App\Models\Miscellaneous\Tracking;
use App\Models\Parent\Parenthelper\Parenthelper;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Jenssegers\Agent\Agent;

class Helper extends Model
{
    public static function getNextSequenceId($digit, $name, $model)
    {
        $object = $model::withTrashed()
            ->orderBy('sequence_id', 'desc')
            ->first();

        $lastId = (!$object) ? 0 : $object->sequence_id;

        return $insertDataTwo = array(
            'uniqid' => $name . '-' . sprintf('%0' . $digit . 'd', intval($lastId) + 1),
            'sequence_id' => $lastId + 1,
            'sys_id' => md5(uniqid(rand(), true)),
        );
    }

    public static function saveOtp($email, $otp) {
        $user =Auth::user();
        $user->email = $email;
        $user->otp = $otp;
        $user->save();
        //$admin = User::where('email',$email)->update(['otp' => $otp]);
        return $user;
    }

    public static function trackmessage($user, $trackmsg, $function, $sessionid, $type)
    {
        $user->trackings()->save(new Tracking([
            'name' => $user->name,
            'uniqid' => $user->uniqid,
            'function' => $function,
            'trackmsg' => $trackmsg,
            'sessionid' => $sessionid,
            'type' => $type,
        ]));

    }

    public static function deviceInfo($user, $sessionid, $type)
    {
        $agent = new Agent();
        $user->logininfos()->save(new Logininfo([
            'device' => $agent->device(),
            'robot' => $agent->robot(),
            'browser' => $agent->browser(),
            'browser_v' => $agent->version($agent->browser()),
            'platform' => $agent->platform(),
            'platform_v' => $agent->version($agent->platform()),
            'languages' => json_encode($agent->languages()),
            'serverIp' => request()->ip(),
            'clientIp' => Helper::getIp(),
            'user_name' => $user->name,
            'user_uniqid' => $user->uniqid,
            'login_status' => true,
            'email' => $user->email,
            'sessionid' => $sessionid,
            'type' => $type,
        ]));
    }

    public static function getIp()
    {
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                        return $ip;
                    }
                }
            }
        }
    }

    public static function autogenerateid($digit, $sufix, $model)
    {
        $user = null;
        if (auth()->user()) {
            $user = auth()->user();
        } elseif (auth()->guard('staff')->check()) {
            $user = auth()->guard('staff')->user();
        } elseif (auth()->guard('aparent')->check()) {
            $user = Parenthelper::getstudentweb();
        }
        if ($digit) {
            $model->uuid = (string) Str::uuid();
            $model->user_id = $user ? $user->id : 1;
            $model->created_by = $user ? $user->name : 'Admin';

            $uniqueId = Helper::getNextSequenceId($digit, $sufix, $model);
            $model->sys_id = $uniqueId['sys_id'];
            $model->uniqid = $uniqueId['uniqid'];
            $model->sequence_id = $uniqueId['sequence_id'];
        } else {
            $model->updated_id = $user->id;
            $model->updated_by = $user->name;
        }
    }

    public static function holidaystatus($attendancedate)
    {

        if (Weekend::where('name', Carbon::parse($attendancedate)->format('l'))->first()->is_holiday) {
            return true;
        }

        if (Holiday::whereDate('start_date', '>=', Carbon::parse($attendancedate))
            ->whereDate('end_date', '<=', Carbon::parse($attendancedate))
            ->exists()) {

            return true;
        }

        return false;
    }

}
