<?php

namespace App\Http\Controllers\Web\Admin\Settings\Leavesetting;

use App\Http\Controllers\Controller;

class LeavetypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.settings.leavesettings.leavetype.index');
    }

}
