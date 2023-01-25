<?php

namespace App\Http\Controllers\Web\Admin\Settings\Broadcast;

use App\Http\Controllers\Controller;

class FcmpushnotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.settings.boradcast.fcmpushnotification.index');
    }
}
