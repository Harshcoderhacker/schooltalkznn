<?php

namespace App\Http\Controllers\Web\Admin\Settings\Profile;

use App\Http\Controllers\Controller;

class AdminprofileController extends Controller
{

    public function profile()
    {
        return view('admin.settings.profile.profile.index');
    }

    public function resetpassword()
    {
        return view('admin.settings.profile.resetpassword.index');
    }

}
