<?php

namespace App\Repository\Api\Admin\Businesslogic\Profile;

use App\Models\Miscellaneous\Helper;
use App\Repository\Api\Admin\Interfacelayer\Profile\IAdminProfileApiRepository;
use Auth;
use Carbon\Carbon;
use DB;
use Hash;
use Image;
use Storage;

class AdminProfileApiRepository implements IAdminProfileApiRepository
{
    public function getprofile()
    {
        $user = auth()->user()
            ->only('name', 'phone', 'email', 'dob', 'avatar');
        $user['dob'] = ($user['dob']) ? Carbon::parse($user['dob'])->format('d-M-Y') : null;

        return [true, ['profile' => $user], 'getprofile'];

    }

    public function updateprofile($data)
    {
        $user = auth()->user();
        $user->update($data);
        Helper::trackmessage($user, 'Admin Profile Update ', 'admin_api_updateprofile', substr(request()->header('authorization'), -33), 'API');
        DB::commit();
        return [true, '', 'Updated Admin Profile'];

    }

    public function changepassword()
    {
        $user = auth()->user();
        if (Hash::check(request('current_password'), $user->password)) {
            $user->update(['password' => request('password')]);
            Helper::trackmessage($user, 'Admin Change Password', 'admin_api_changepassword', substr(request()->header('authorization'), -33), 'API');
            DB::commit();
            return [true, '', 'Password Changed Successfully'];
        } else {
            DB::rollback();
            return [false, ['current_password' => ['Please Enter Valid Credentials']]];
        }
    }

    public function changeavatar()
    {
        $user = auth()->user();
        ($user->avatar) ? Storage::delete('public/' . $user->avatar) : '';

        $saveimage = Image::make(request('avatar'))
            ->resize(150, 150)
            ->encode('jpg', 90)
            ->stream();

        $user->avatar = $path = 'admin/image/userprofile/' . time() . '.jpg';
        Storage::disk('public')->put($path, $saveimage, 'public');
        $user->save();
        Helper::trackmessage($user, 'Admin Change Avatar', 'admin_api_changeavatar', substr(request()->header('authorization'), -33), 'API');
        DB::commit();

        return [true, $user->avatar, 'changeavatar'];
    }
}
