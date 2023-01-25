<?php

namespace App\Http\Controllers\Web\Admin\Settings;

use App\Http\Controllers\Controller;

class AdminsettingsController extends Controller
{

    public function adminsettings()
    {
        return view('admin/settings/settings/settings');
    }

}
