<?php

namespace App\Http\Controllers\Web\Admin\Settings\Academicsetting;

use App\Http\Controllers\Controller;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.settings.academicsettings.section.index');
    }

}
