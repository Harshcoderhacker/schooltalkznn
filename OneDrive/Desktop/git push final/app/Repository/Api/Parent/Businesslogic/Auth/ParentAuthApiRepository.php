<?php

namespace App\Repository\Api\Parent\Businesslogic\Auth;

use App\Mail\OtpMail;
use App\Models\Admin\Settings\Devicetoken\Devicetoken;
use App\Models\Miscellaneous\Helper;
use App\Models\Parent\Auth\Aparent;
use App\Models\Parent\Parenthelper\Parenthelper;
use App\Models\Parent\Settings\Mobile\Parentappactivestudent;
use App\Repository\Api\Parent\Interfacelayer\Auth\IParentAuthApiRepository;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ParentAuthApiRepository implements IParentAuthApiRepository
{
    public function login()
    {
        if (request('email')) {
            $parent = Aparent::where('email', request('email'))->first();
            if ($parent && Auth::guard('aparent')->loginUsingId($parent->id)) {
                $user = Auth::guard('aparent')->user();
                $parent = Aparent::where('email', $user->email);
                $otp = rand(111111, 999999);
                $parent->update([
                    'otp' => $otp
                ]);

                $body = [
                    'name' => $user->name,
                    'otp' => $otp
                ];

                Mail::to($user->email)->send(new OtpMail($body));
                $data = [
                    'email' => request('email'),
                    'otp' => $otp
                ];
                return [true, $data, 'Otp send Successfully'];
            } else {
                return [false, 'please try again'];
            }
        } else {

            $parent = Aparent::where('phone', request('phone'))->first();
            // if (auth()->guard('staff')->attempt(['phone' => request('phone'), 'password' => request('password')])) {
            if ($parent && auth()->guard('aparent')->loginUsingId($parent['id'])) {
                $user = auth()->guard('aparent')->user();
                $otp = rand(111111, 999999);
                $curl = curl_init();
                $data = array();
                $data['api_id'] = "APIMHU3ampX100535";
                $data['api_password'] = "ZCOkMHl0";
                $data['sms_type'] = "OTP";
                $data['sms_encoding'] = "Unicode";
                $data['sender'] = "ECOPEZ";
                $data['number'] = request('phone');
                $data['message'] = "Greetings from Ecopez. Please use the code " . $otp . " to login on the SchoolTalkz app. Please do one share this code with anyone for security reasons.";
                $data['template_id'] = 127934;
                $data_string = json_encode($data);
                $ch = curl_init('http://bulksmsplans.com/api/send_sms');
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt(
                    $ch,
                    CURLOPT_HTTPHEADER,
                    array(
                        'Content-Type: application/json',
                        'Content-Length: ' . strlen($data_string)
                    )
                );
                $result = curl_exec($ch);
                $admin = Aparent::where('phone', request('phone'));
                $admin->update([
                    'otp' => $otp
                ]);
                $data = [
                    'email' => $user->email,
                    'otp' => $otp
                ];

                return [true, $data, 'Otp send Successfully'];

                // if (auth()->guard('aparent')->attempt(['phone' => request('phone'), 'password' => request('password')])) {
                // $user = auth()->guard('aparent')->user();
                // $success['token'] = $user->createToken('Edfish', ['parent'])->accessToken;
                // Helper::trackmessage($user, 'Parent Login', 'parent_api_login', substr($success['token'], -33), 'API');
                // Helper::deviceInfo($user, substr($success['token'], -33), 'API');
                // $student = $user->student()->where('active', true)->where('is_accountactive', true)->first();
                // Parentappactivestudent::updateOrCreate(['parenttokenid' => substr($success['token'], -33) . $user->uuid], [
                //     'student_id' => $student->id,
                //     'student_uuid' => $user->uuid,
                //     'aparent_id' => $user->id,
                //     'type' => 'api',
                //     'parenttokenid' => substr($success['token'], -33) . $user->uuid,
                // ]);
                //DB::commit();
                // return [true, $success, 'Parent Login Successfully'];
            } else {
                //DB::rollback();
                // return [false, 'Login Failed'];

                return [false, 'please try again'];
            }
        }
    }

    public function verifyOtp()
    {
        $parent = Aparent::where([['email', '=', request('email')], ['otp', '=', request('otp')]])->first();
        if ($parent &&  auth()->guard('aparent')->loginUsingId($parent->id)) {
            $user = auth()->guard('aparent')->user();
            $success['token'] = $user->createToken('Edfish', ['parent'])->accessToken;
            Helper::trackmessage($user, 'Parent Login', 'parent_api_login', substr($success['token'], -33), 'API');
            Helper::deviceInfo($user, substr($success['token'], -33), 'API');
            $student = $user->student()->where('active', true)->where('is_accountactive', true)->first();
            Parentappactivestudent::updateOrCreate(['parenttokenid' => substr($success['token'], -33) . $user->uuid], [
                'student_id' => $student->id,
                'student_uuid' => $user->uuid,
                'aparent_id' => $user->id,
                'type' => 'api',
                'parenttokenid' => substr($success['token'], -33) . $user->uuid,
            ]);
            $parent = Aparent::where('email', $user->email);
            $parent->update([
                'otp' => null
            ]);
            return [true, $success, 'Parent Login Successfully'];
        } else {
            return [false, 'Please Enter Valid Otp'];
        }
    }

    public function parentcreatedevicetoken()
    {
        return [
            true, auth()->user()
                ->devicetokenable()
                ->save(
                    new Devicetoken([
                        'token' => request('token'),
                        'model' => request('model'),
                        'brand' => request('brand'),
                        'manufacturer' => request('manufacturer'),
                    ])
                ), 'Created Device Token'
        ];
    }

    public function logout()
    {
        $user = auth()->user();

        if ($user) {
            Helper::trackmessage($user, 'Parent Logout', 'parent_api_logout', substr(request()->header('authorization'), -33), 'API');
            Parentappactivestudent::where('parenttokenid', substr(request()->header('authorization'), -33) . $user->uuid)->delete();
            Parentappactivestudent::whereDate('created_at', '<=', now()->subDays(365))->delete();
            $user->devicetokenable()->where('token', request('token'))->delete();
            $user->token()->revoke();
            DB::commit();
            return [true, 'done', 'Logout Successfully'];
        } else {
            DB::rollback();
            return [false, 'Logout Failed'];
        }
    }

    public function isstudentactive()
    {
        $user = Parenthelper::getstudent();
        if ($user) {
            return [true, $user->active ? 1 : 0, 'Is Student Active'];
        } else {
            return [false, 'Something Went to wrong...Is Student Active'];
        }
    }
}
