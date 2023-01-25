<?php

namespace App\Http\Livewire\Common\Login;

use App\Mail\OtpMail;
use App\Models\Admin\Auth\User;
use App\Models\Miscellaneous\Helper;
use App\Models\Parent\Auth\Aparent;
use App\Models\Parent\Settings\Mobile\Parentappactivestudent;
use App\Models\Staff\Auth\Staff;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Loginlivewire extends Component
{
    use LivewireAlert;

    public $panel;
    public $adminphone, $adminpassword, $adminemail;
    public $staffphone, $staffpassword, $aparentphone, $aparentpassword, $staffemail;
    public $parentemail;

    public function mount($panel)
    {
        $this->panel = $panel;

        if (env('APP_ENV') == 'local') {
            $this->adminphone = 0;
            $this->adminpassword = 0;

            $this->staffphone = 1234567890;
            $this->staffpassword = 12345678;

            $this->aparentphone = 1234567890;
            $this->aparentpassword = 12345678;
        }
    }

    public function toggle($panel)
    {
        $this->panel = $panel;
    }

    public function adminlogin()
    {

        $loginWithEmail = false;
        if ($this->adminemail != null) {
            $validate = $this->validate([
                'adminemail' => 'required|email',
            ], [
                'adminemail.required' => 'Email is Required',
                'adminemail.email' => 'Please Enter Valid Email',
            ]);
            $loginWithEmail = true;
        } else {
            $validate = $this->validate([
                'adminphone' => 'required|digits:10',
                // 'adminpassword' => 'required',
            ], [
                'adminphone.required' => 'Phone Number is Required',
                'adminphone.digits' => 'Phone Number Must be of 10 digits',
                // 'adminpassword.required' => 'Password is Required',
            ]);
        }

        try {
            if ($loginWithEmail) {
                $admin = User::where('email', '=', $this->adminemail)->first();
                if (!empty($admin)) {
                    if ($admin &&  Auth::loginUsingId($admin->id)) {
                        $user = auth()->user();
                        $otp = rand(111111, 999999);
                        $admin = User::where('email', $user->email);
                        $admin->update([
                            'otp' => $otp
                        ]);
                        $body = [
                            'name' => $user->name,
                            'otp' => $otp
                        ];

                        Mail::to($user->email)->send(new OtpMail($body));
                        toast('Hi ' . $user->email . ',Please check your email and Enter otp', 'success');
                        return redirect()->route('verifyotp', ['email' => $user->email, 'panel' => 'adminloginotp', 'type' => 'Admin']);
                    }
                } else {
                    // dd('email invalid');
                    DB::rollback();
                    Log::error('Admin: User failed to login');
                    $this->alert('warning', 'Invalid Phone Number or Email', [
                        'position' => 'top-end',
                        'timer' => 4000,
                        'toast' => true,
                    ]);
                }
            }
            DB::beginTransaction();
            // && isset($validate['adminpassword'])
            if ((isset($validate['adminphone']))) {
                $user = User::where('phone', '=', $validate['adminphone'])->first();
                if (!empty($user)) {
                    if ($user['is_accountactive'] != 1) {
                        DB::rollback();
                        Log::error('Admin Inactive user');
                        $this->alert('warning', 'Account Inactive', [
                            'position' => 'top-end',
                            'timer' => 4000,
                            'toast' => true,
                        ]);
                    } else {
                        Auth::login($user);
                        $otp = rand(111111, 999999);

                        $curl = curl_init();
                        $data = array();
                        $data['api_id'] = "APIMHU3ampX100535";
                        $data['api_password'] = "ZCOkMHl0";
                        $data['sms_type'] = "OTP";
                        $data['sms_encoding'] = "Unicode";
                        $data['sender'] = "ECOPEZ";
                        $data['number'] = $validate['adminphone'];
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

                        $admin = User::where('phone', $validate['adminphone']);
                        $admin->update([
                            'otp' => $otp
                        ]);
                        Helper::trackmessage($user, 'Admin Login', 'admin_web_postadminlogin', session()->getId(), 'WEB');
                        Helper::deviceInfo($user, session()->getId(), 'WEB');
                        DB::commit();
                        toast('Hi ' . $user['name'] . ', OTP sent Successfully!', 'success');
                        // return redirect()->route('admindashboard');
                        return redirect()->route('verifyotp', ['email' => $user['email'], 'panel' => 'adminloginotp', 'type' => 'Admin']);
                    }
                } else {
                    DB::rollback();
                    Log::error('User failed to login');
                    $this->alert('warning', 'Invalid Phone Number or Email', [
                        'position' => 'top-end',
                        'timer' => 4000,
                        'toast' => true,
                    ]);
                }
            } else {
                DB::rollback();
                Log::error('Admin: User failed to login');
                $this->alert('warning', 'Invalid Phone Number or Email', [
                    'position' => 'top-end',
                    'timer' => 4000,
                    'toast' => true,
                ]);
            }
        } catch (Exception $e) {
            DB::rollback();
            Log::error('Exception one: admin_web_postadminlogin  Error: ' . $e->getMessage());
            throw new \Exception('Please Try Again');
        } catch (QueryException $e) {
            DB::rollback();
            Log::error('Exception one: admin_web_postadminlogin  Error: ' . $e->getMessage());
            throw new \Exception('Please Try Again');
        } catch (PDOException $e) {
            DB::rollback();
            Log::error('Exception one: admin_web_postadminlogin  Error: ' . $e->getMessage());
            throw new \Exception('Please Try Again');
        }
    }

    public function stafflogin()
    {
        $loginWithEmail = false;
        if ($this->staffemail != null) {

            $validate = $this->validate([
                'staffemail' => 'required|email',
            ], [
                'staffemail.required' => 'Email is Required',
                'staffemail.email' => 'Please Enter Valid Email',
            ]);
            $loginWithEmail = true;
        } else {
            $validate = $this->validate([
                'staffphone' => 'required|digits:10',
                // 'staffpassword' => 'required',
            ], [
                'staffphone.required' => 'Phone Number is Required',
                'staffphone.digits' => 'Phone Number Must be of 10 digits',
                // 'staffpassword.required' => 'Password is Required',
            ]);
        }

        try {
            if ($loginWithEmail) {
                $staff = Staff::where('email', '=', $this->staffemail)->first();
                if ($staff &&  auth()->guard('staff')->loginUsingId($staff->id)) {
                    $staf = auth()->guard('staff')->user();
                    $otp = rand(111111, 999999);
                    $admin = Staff::where('email', $staf->email);
                    $admin->update([
                        'otp' => $otp
                    ]);
                    $body = [
                        'name' => $staf->name,
                        'otp' => $otp
                    ];
                    Mail::to($staf->email)->send(new OtpMail($body));
                    toast('Hi ' . $staf->email . ',Please check your email and Enter otp', 'success');
                    return redirect()->route('verifyotp', ['email' => $staf->email, 'panel' => 'staffloginotp', 'type' => 'Staff']);
                } else {
                    Log::error('Staff: User failed to login');
                    $this->alert('warning', 'Invalid Phone Number or Email', [
                        'position' => 'top-end',
                        'timer' => 4000,
                        'toast' => true,
                    ]);
                    return true;
                }
            }

            DB::beginTransaction();
            if (isset($validate['staffphone'])) {
                $user = Staff::where('phone', '=', $validate['staffphone'])->first();
                if (!empty($user)) {
                    if ($user['is_accountactive'] == false) {
                        DB::rollback();
                        Log::error('Staff Inactive user');
                        $this->alert('warning', 'Account Inactive', [
                            'position' => 'top-end',
                            'timer' => 4000,
                            'toast' => true,
                        ]);
                    } else {
                        auth()->guard('staff')->loginUsingId($user['id']);
                        $otp = rand(111111, 999999);
                        $curl = curl_init();
                        $data = array();
                        $data['api_id'] = "APIMHU3ampX100535";
                        $data['api_password'] = "ZCOkMHl0";
                        $data['sms_type'] = "OTP";
                        $data['sms_encoding'] = "Unicode";
                        $data['sender'] = "ECOPEZ";
                        $data['number'] = $validate['staffphone'];
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

                        $admin = Staff::where('phone', $validate['staffphone']);
                        $admin->update([
                            'otp' => $otp
                        ]);

                        Helper::trackmessage($user, 'Staff Login', 'staff_web_poststafflogin', session()->getId(), 'WEB');
                        Helper::deviceInfo($user, session()->getId(), 'WEB');
                        DB::commit();
                        toast('Hi ' . $user['name'] . ', You Have Logged In Successfully!', 'success');
                        // return redirect()->route('verifyotp', ['email' => $user['email'], 'panel' => 'adminloginotp', 'type' => 'Admin']);
                        return redirect()->route('verifyotp', ['email' => $user['email'], 'panel' => 'staffloginotp', 'type' => 'Staff']);
                        // return redirect()->route('staffdashboard');
                    }
                } else {
                    DB::rollback();
                    Log::error('Staff: User failed to login');
                    $this->alert('warning', 'Invalid Phone Number or Email', [
                        'position' => 'top-end',
                        'timer' => 4000,
                        'toast' => true,
                    ]);
                }
            } else {
                DB::rollback();
                Log::error('Staff: User failed to login');
                $this->alert('warning', 'Invalid Phone Number or Email', [
                    'position' => 'top-end',
                    'timer' => 4000,
                    'toast' => true,
                ]);
            }
        } catch (Exception $e) {
            DB::rollback();
            Log::error('Exception one: staff_web_poststafflogin  Error: ' . $e->getMessage());
            throw new \Exception('Please Try Again');
        } catch (QueryException $e) {
            DB::rollback();
            Log::error('Exception one: staff_web_poststafflogin  Error: ' . $e->getMessage());
            throw new \Exception('Please Try Again');
        } catch (PDOException $e) {
            DB::rollback();
            Log::error('Exception one: staff_web_poststafflogin  Error: ' . $e->getMessage());
            throw new \Exception('Please Try Again');
        }
    }

    public function parentlogin()
    {
        $loginWithEmail = false;
        if ($this->parentemail != null) {

            $validate = $this->validate([
                'parentemail' => 'required|email',
            ], [
                'parentemail.required' => 'Email is Required',
                'parentemail.email' => 'Please Enter Valid Email',
            ]);
            $loginWithEmail = true;
        } else {
            $validate = $this->validate([
                'aparentphone' => 'required|digits:10',
                // 'aparentpassword' => 'required',
            ], [
                'aparentphone.required' => 'Phone Number is Required',
                'aparentphone.digits' => 'Phone Number Must be of 10 digits',
                // 'aparentpassword.required' => 'Password is Required',
            ]);
        }
        try {

            if ($loginWithEmail) {
                $parent = Aparent::where('email', '=', $this->parentemail)->first();
                if ($parent &&  auth()->guard('aparent')->loginUsingId($parent->id)) {
                    $paren = auth()->guard('aparent')->user();
                    $otp = rand(111111, 999999);
                    $aparent = Aparent::where('email', $paren->email);
                    $aparent->update([
                        'otp' => $otp
                    ]);
                    $body = [
                        'name' => $paren->name,
                        'otp' => $otp
                    ];
                    Mail::to($paren->email)->send(new OtpMail($body));
                    toast('Hi ' . $paren->email . ',Please check your email and Enter otp', 'success');
                    return redirect()->route('verifyotp', ['email' => $paren->email, 'panel' => 'parentloginotp', 'type' => 'Parent']);
                } else {
                    Log::error('Staff: User failed to login');
                    $this->alert('warning', 'Invalid Phone Number or Email', [
                        'position' => 'top-end',
                        'timer' => 4000,
                        'toast' => true,
                    ]);
                    return true;
                }
            }

            DB::beginTransaction();

            if (isset($validate['aparentphone'])) {
                $user = Aparent::where('phone', '=', $validate['aparentphone'])->first();
                if (!empty($user)) {
                    if ($user['is_accountactive'] == false) {
                        DB::rollback();
                        Log::error('Staff Inactive user');
                        $this->alert('warning', 'Account Inactive', [
                            'position' => 'top-end',
                            'timer' => 4000,
                            'toast' => true,
                        ]);
                    } else {
                        auth()->guard('aparent')->loginUsingId($user['id']);
                        $otp = rand(111111, 999999);
                        $curl = curl_init();
                        $data = array();
                        $data['api_id'] = "APIMHU3ampX100535";
                        $data['api_password'] = "ZCOkMHl0";
                        $data['sms_type'] = "OTP";
                        $data['sms_encoding'] = "Unicode";
                        $data['sender'] = "ECOPEZ";
                        $data['number'] = $validate['aparentphone'];
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

                        $admin = Aparent::where('phone', $validate['aparentphone']);
                        $admin->update([
                            'otp' => $otp
                        ]);

                        Helper::trackmessage($user, 'Staff Login', 'staff_web_poststafflogin', session()->getId(), 'WEB');
                        Helper::deviceInfo($user, session()->getId(), 'WEB');
                        DB::commit();
                        toast('Hi ' . $user['name'] . ', You Have Logged In Successfully!', 'success');
                        return redirect()->route('verifyotp', ['email' => $user['email'], 'panel' => 'parentloginotp', 'type' => 'Parent']);
                        // return redirect()->route('staffdashboard');
                    }
                } else {
                    DB::rollback();
                    Log::error('Staff: User failed to login');
                    $this->alert('warning', 'Invalid Phone Number or Email', [
                        'position' => 'top-end',
                        'timer' => 4000,
                        'toast' => true,
                    ]);
                }
            } else {
                DB::rollback();
                Log::error('Staff: User failed to login');
                $this->alert('warning', 'Invalid Phone Number or Email', [
                    'position' => 'top-end',
                    'timer' => 4000,
                    'toast' => true,
                ]);
            }
            // if (isset($validate['aparentphone']) && isset($validate['aparentpassword']) && auth()->guard('aparent')->attempt(['phone' => $validate['aparentphone'], 'password' => $validate['aparentpassword']])) {
            //     $parent = auth()->guard('aparent')->user();

            //     if (
            //         $parent->is_accountactive == true &&
            //         $parent->student()->where('active', true)
            //         ->where('is_accountactive', true)
            //         ->count() > 0
            //     ) {

            //         $student = $parent->student()->where('active', true)->where('is_accountactive', true)->first();

            //         Parentappactivestudent::updateOrCreate(['parenttokenid' => session()->getId() . $parent->uuid], [
            //             'student_id' => $student->id,
            //             'student_uuid' => $student->uuid,
            //             'aparent_id' => $parent->id,
            //             'parenttokenid' => session()->getId() . $parent->uuid,
            //             'type' => 'web', // also modify to mobile app
            //         ]);
            //         Helper::trackmessage($parent, 'Parent Login', 'parent_web_postparentlogin', session()->getId(), 'WEB');
            //         Helper::deviceInfo($parent, session()->getId(), 'WEB');
            //         toast('Hi ' . $parent->name . ' You Have Logged In Successfully!', 'success');
            //         DB::commit();
            //         return redirect()->route('parentdashboard');
            //     } else {
            //         auth()->guard('aparent')->logout();
            //         DB::rollback();
            //         Log::error('Aparent: User failed to login');
            //         $this->alert('warning', 'If you have trouble signing please contact the school admin', [
            //             'position' => 'top-end',
            //             'timer' => 5000,
            //             'toast' => true,
            //         ]);
            //     }
            // } else {
            //     DB::rollback();
            //     Log::error('Aparent: User failed to login');
            //     $this->alert('warning', 'Invalid Phone Number or Password', [
            //         'position' => 'top-end',
            //         'timer' => 4000,
            //         'toast' => true,
            //     ]);
            // }
        } catch (Exception $e) {
            DB::rollback();
            Log::error('Exception one: aparent_web_postaparentlogin  Error: ' . $e->getMessage());
            throw new \Exception('Please Try Again');
        } catch (QueryException $e) {
            DB::rollback();
            Log::error('Exception one: aparent_web_postaparentlogin  Error: ' . $e->getMessage());
            throw new \Exception('Please Try Again');
        } catch (PDOException $e) {
            DB::rollback();
            Log::error('Exception one: aparent_web_postaparentlogin  Error: ' . $e->getMessage());
            throw new \Exception('Please Try Again');
        }
    }

    public function render()
    {
        return view('livewire.common.login.loginlivewire');
    }
}
