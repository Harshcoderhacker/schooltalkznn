<?php

namespace App\Http\Controllers\Web\Admin\Settings\Integration;

use App\Http\Controllers\Controller;

class EmailintegrationController extends Controller
{
    public function index()
    {
        return view('admin.settings.integrationsettings.emailintegration.index');
    }
}
