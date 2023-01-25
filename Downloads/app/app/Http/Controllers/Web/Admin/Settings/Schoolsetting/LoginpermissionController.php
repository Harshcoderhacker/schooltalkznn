<?php

namespace App\Http\Controllers\Web\Admin\Settings\Schoolsetting;

use App\Http\Controllers\Controller;

class LoginpermissionController extends Controller
{
    public function index()
    {
        return view('admin.settings.schoolsettings.loginpermission.index');
    }
}
