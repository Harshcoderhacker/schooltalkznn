<?php

namespace App\Repository\Api\Admin\Businesslogic\Auth;

use App\Mail\OtpMail;
use App\Models\Admin\Auth\User;
use App\Models\Admin\Settings\Devicetoken\Devicetoken;
use App\Models\Miscellaneous\Helper;
use App\Repository\Api\Admin\Interfacelayer\Auth\IAdminAuthApiRepository;
use Auth;
use DB;
use Illuminate\Support\Facades\Mail;


class AdminAuthApiRepository implements IAdminAuthApiRepository
{
    public function login()
    {
        if (request('email')) {
            $admin = User::where('email', request('email'))->first();
            if ($admin && Auth::loginUsingId($admin->id)) {
                $user = Auth::user();
                $otp = rand(111111, 999999);
                $admin->update([
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
            // if (Auth::attempt(['phone' => request('phone'), 'password' => request('password')])) {
            $admin = User::where('phone', '=', request('phone'))->first();
            if ($admin && Auth::loginUsingId($admin['id'])) {
                $user = Auth::user();
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

                $admin = User::where('phone', request('phone'));
                $admin->update([
                    'otp' => $otp
                ]);
                $data = [
                    'email' => $user->email,
                    'otp' => $otp
                ];
                return [true, $data, 'Otp send Successfully'];


                // $success['token'] = $user->createToken('authToken', ['admin'])->accessToken;
                // Helper::trackmessage($user, 'Admin Login', 'admin_api_login', substr($success['token'], -33), 'API');
                // Helper::deviceInfo($user, substr($success['token'], -33), 'API');
                // DB::commit();
                // return [true, $success, 'Login Successfully'];
            } else {
                DB::rollback();
                return [false, 'please try again'];
            }
        }
    }

    public function verifyOtp()
    {
        // dd('fth');
        $admin = User::where([['email', '=', request('email')], ['otp', '=', request('otp')]])->first();
        if ($admin &&  Auth::loginUsingId($admin->id)) {
            $user = auth()->user();
            $success['token'] = $user->createToken('authToken', ['admin'])->accessToken;


            Helper::trackmessage($user, 'Admin Login', 'admin_api_login', substr($success['token'], -33), 'API');
            Helper::deviceInfo($user, substr($success['token'], -33), 'API');
            DB::commit();
            $admin->update([
                'otp' => null
            ]);
            return [true, $success, 'Login Successfully'];
        } else {
            dd('geher');
            return [false, 'Please Enter Valid Otp'];
        }
    }

    public function admincreatedevicetoken()
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
            Helper::trackmessage($user, 'Admin Logout', 'admin_api_logout', substr(request()->header('authorization'), -33), 'API');
            $user->devicetokenable()->where('token', request('token'))->delete();
            $user->token()->revoke();
            DB::commit();
            return [true, 'done', 'Logout Successfully'];
        } else {
            DB::rollback();
            return [false, 'Logout Failed'];
        }
    }

    public function isadminactive()
    {
        $user = Auth::user();
        if ($user) {
            return [true, $user->active ? 1 : 0, 'Is Admin Active'];
        } else {
            return [false, 'Something Went to wrong...Is Admin Active'];
        }
    }
}
