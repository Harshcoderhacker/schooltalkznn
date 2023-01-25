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


class Verifyotp extends Component
{
    use LivewireAlert;

    public $panel;
    public $otp = [], $email;


    public function render()
    {
        return view('livewire.common.login.verifyotp');
    }


    public function resendemail($email, $panel)
    {
        dd('done');
    }

    public function email($email, $panel, $isresendemail)
    {
        if ($isresendemail) {
            if ($panel == 'adminloginotp') {
                $admin = User::where('email', '=', $email)->first();
                if ($admin &&  Auth::loginUsingId($admin->id)) {
                    $user = auth()->user();
                    $otp = rand(111111, 999999);
                    $admin = User::where('email', $user->email);
                    $admin->update([
                        'otp' => $otp
                    ]);
                    toast('Hi ' . $user->email . ',Please check your email and Enter otp', 'success');
                    $body = [
                        'name' => $user->name,
                        'otp' => $otp
                    ];

                    Mail::to($user->email)->send(new OtpMail($body));
                    return redirect()->route('verifyotp', ['email' => $user->email, 'panel' => 'adminloginotp', 'type' => 'Admin']);
                } else {
                    Log::error('Admin: User failed to login');
                    $this->alert('warning', 'Invalid  Email', [
                        'position' => 'top-end',
                        'timer' => 4000,
                        'toast' => true,
                    ]);
                    return true;
                }
            } elseif ($panel == 'parentloginotp') {
                $parent = Aparent::where('email', '=', $email)->first();
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
                    $this->alert('warning', 'Invalid  Email', [
                        'position' => 'top-end',
                        'timer' => 4000,
                        'toast' => true,
                    ]);
                    return true;
                }
            } elseif ($panel == 'staffloginotp') {
                $staff = Staff::where('email', '=', $email)->first();
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
                    $this->alert('warning', 'Invalid  Email', [
                        'position' => 'top-end',
                        'timer' => 4000,
                        'toast' => true,
                    ]);
                    return true;
                }
            }
        } else {
            $this->otp = implode('', $this->otp);
            $validate = $this->validate([
                'otp' => 'required|digits:6',
            ], [
                'otp.required' => 'OTP Number is Required',
                'otp.digits' => 'OTP Number Must be of 6 digits',
            ]);

            try {
                if ($panel == 'adminloginotp') {
                    $user = User::where([['email', '=', $email], ['otp', '=', $validate['otp']]])->first();
                    if ($user) {
                        User::where('email', '=', $email)->update(['otp' => null]);
                        $user = auth()->user();
                        if ($user->is_accountactive == false) {
                            DB::rollback();
                            Log::error('Admin Inactive user');
                            $this->alert('warning', 'Account Inactive', [
                                'position' => 'top-end',
                                'timer' => 4000,
                                'toast' => true,
                            ]);
                        } else {
                            Helper::trackmessage($user, 'Admin Login', 'admin_web_postadminlogin', session()->getId(), 'WEB');
                            Helper::deviceInfo($user, session()->getId(), 'WEB');
                            DB::commit();
                            toast('Hi ' . $user->name . ', You Have Logged In Successfully!', 'success');
                            return redirect()->route('admindashboard');
                        }
                    } else {
                        $this->alert('warning', 'Invalid  Otp', [
                            'position' => 'top-end',
                            'timer' => 4000,
                            'toast' => true,
                        ]);
                    }
                } elseif ($panel == 'parentloginotp') {
                    DB::beginTransaction();
                    $aparent = Aparent::where([['email', '=', $email], ['otp', '=', $validate['otp']]])->first();
                    if ($aparent) {
                        $parent = auth()->guard('aparent')->user();
                        if (
                            $parent->is_accountactive == true &&
                            $parent->student()->where('active', true)
                            ->where('is_accountactive', true)
                            ->count() > 0
                        ) {

                            $student = $parent->student()->where('active', true)->where('is_accountactive', true)->first();

                            Parentappactivestudent::updateOrCreate(['parenttokenid' => session()->getId() . $parent->uuid], [
                                'student_id' => $student->id,
                                'student_uuid' => $student->uuid,
                                'aparent_id' => $parent->id,
                                'parenttokenid' => session()->getId() . $parent->uuid,
                                'type' => 'web', // also modify to mobile app
                            ]);
                            Helper::trackmessage($parent, 'Parent Login', 'parent_web_postparentlogin', session()->getId(), 'WEB');
                            Helper::deviceInfo($parent, session()->getId(), 'WEB');
                            toast('Hi ' . $parent->name . ' You Have Logged In Successfully!', 'success');
                            DB::commit();
                            Aparent::where('email', '=', $email)->update(['otp' => null]);
                            return redirect()->route('parentdashboard');
                        } else {
                            auth()->guard('aparent')->logout();
                            DB::rollback();
                            Log::error('Aparent: User failed to login');
                            $this->alert('warning', 'If you have trouble signing please contact the school admin', [
                                'position' => 'top-end',
                                'timer' => 5000,
                                'toast' => true,
                            ]);
                        }
                    } else {
                        $this->alert('warning', 'Invalid  Otp', [
                            'position' => 'top-end',
                            'timer' => 4000,
                            'toast' => true,
                        ]);
                    }
                } elseif ($panel == 'staffloginotp') {
                    $staff = Staff::where([['email', '=', $email], ['otp', '=', $validate['otp']]])->first();
                    if ($staff) {
                        Staff::where('email', '=', $email)->update(['otp' => null]);
                        $user = auth()->guard('staff')->user();
                        if ($user->is_accountactive == false) {
                            DB::rollback();
                            Log::error('Staff Inactive user');
                            $this->alert('warning', 'Account Inactive', [
                                'position' => 'top-end',
                                'timer' => 4000,
                                'toast' => true,
                            ]);
                        } else {
                            Helper::trackmessage($user, 'Staff Login', 'staff_web_poststafflogin', session()->getId(), 'WEB');
                            Helper::deviceInfo($user, session()->getId(), 'WEB');
                            DB::commit();
                            toast('Hi ' . $user->name . ', You Have Logged In Successfully!', 'success');
                            return redirect()->route('staffdashboard');
                        }
                    } else {
                        $this->alert('warning', 'Invalid  Otp', [
                            'position' => 'top-end',
                            'timer' => 4000,
                            'toast' => true,
                        ]);
                    }
                }
            } catch (PDOException $e) {

                Log::error('Exception one: admin_web_postadminlogin  Error: ' . $e->getMessage());
                throw new \Exception('Please Try Again');
            }
        }
    }
}
