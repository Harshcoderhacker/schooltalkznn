<?php

namespace App\Repository\Api\Parent\Businesslogic\Profile;

use App\Models\Miscellaneous\Helper;
use App\Models\Parent\Parenthelper\Parenthelper;
use App\Repository\Api\Parent\Interfacelayer\Profile\IParentProfileApiRepository;
use Auth;
use Carbon\Carbon;
use DB;
use Hash;
use Image;
use Storage;

class ParentProfileApiRepository implements IParentProfileApiRepository
{
    public function getprofile()
    {
        $user = Parenthelper::getstudent()
            ->only('name', 'phone_no', 'email', 'dob', 'address', 'avatar');
        $user['dob'] = ($user['dob']) ? Carbon::parse($user['dob'])->format('d-M-Y') : null;
        return [true, $user, 'getprofile'];

    }

    public function updateprofile($data)
    {
        $user = Parenthelper::getstudent();
        $user->update($data);
        Helper::trackmessage($user, 'Parent Profile Update ', 'parent_api_updateprofile', substr(request()->header('authorization'), -33), 'API');
        DB::commit();
        return [true, 'Updated Parent Profile'];

    }

    public function changepassword()
    {
        $user = auth()->user();

        if (Hash::check(request('current_password'), $user->password)) {
            $user->update(['password' => request('password')]);
            Helper::trackmessage($user, 'Parent Change Password', 'parent_api_changepassword', substr(request()->header('authorization'), -33), 'API');
            DB::commit();
            return [true, '', 'Password Changed Successfully'];
        } else {
            DB::rollback();
            return [false, ['current_password' => ['Please Enter Valid Credentials']]];
        }
    }

    public function changeavatar()
    {
        $user = Parenthelper::getstudent();
        ($user->avatar) ? Storage::delete('public/' . $user->avatar) : '';

        $saveimage = Image::make(request('avatar'))
            ->resize(150, 150)
            ->encode('jpg', 90)
            ->stream();

        $user->avatar = $path = 'parent/image/studentprofile/' . time() . '.jpg';
        Storage::disk('public')->put($path, $saveimage, 'public');
        $user->save();
        Helper::trackmessage($user, 'Parent Change Avatar', 'parent_api_changeavatar', substr(request()->header('authorization'), -33), 'API');
        DB::commit();

        return [true, $user->avatar, 'changeavatar'];
    }
}
