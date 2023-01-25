<?php

namespace App\Http\Controllers\Web\Admin\Settings\Logs;

use App\Http\Controllers\Controller;

class AdminuserlogsController extends Controller
{

    public function adminloginlogs()
    { // logininfos
        return view('admin.settings.logs.loginlogs.index');
    }

    public function adminuseractivitylogs()
    { // trackings
        return view('admin.settings.logs.useractivitylogs.index');
    }

}
