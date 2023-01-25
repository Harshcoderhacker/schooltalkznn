<?php

namespace App\Http\Controllers\Web\Admin\Settings\Schoolsetting;

use App\Http\Controllers\Controller;

class GeneralsettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.settings.schoolsettings.generalsetting.index');
    }
}
