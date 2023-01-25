<?php

namespace App\Http\Controllers\Web\Admin\Settings\Onlineassessment;

use App\Http\Controllers\Controller;

class MapboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.settings.onlineassessment.mapboard.index');
    }
}
