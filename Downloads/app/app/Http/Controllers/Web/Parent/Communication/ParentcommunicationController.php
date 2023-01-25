<?php

namespace App\Http\Controllers\Web\Parent\Communication;

use App\Http\Controllers\Controller;

class ParentcommunicationController extends Controller
{

    public function parentcommunication()
    {
        return view('parent/communication/communication');
    }
}
