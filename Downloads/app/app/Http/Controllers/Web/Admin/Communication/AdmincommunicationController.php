<?php

namespace App\Http\Controllers\Web\Admin\Communication;

use App\Http\Controllers\Controller;

class AdmincommunicationController extends Controller
{
    public function index()
    {
        return view('admin.communication.index');
    }

    public function createclassgroup()
    {
        return view('admin.communication.createclassgroup');
    }

    public function createstaffgroup()
    {
        return view('admin.communication.createstaffgroup');
    }
}
