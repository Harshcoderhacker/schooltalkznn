<?php

namespace App\Http\Controllers\Web\Admin\Settings\Academicsetting;

use App\Http\Controllers\Controller;

class TimetableController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/settings/academicsettings/timetable/index');
    }
}
