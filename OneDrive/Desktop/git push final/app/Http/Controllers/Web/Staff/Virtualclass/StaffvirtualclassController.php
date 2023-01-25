<?php

namespace App\Http\Controllers\Web\Staff\Virtualclass;

use App\Http\Controllers\Controller;

class StaffvirtualclassController extends Controller
{
    public function staffvirtualclass()
    {
        return view('staff/virtualclass/index');
    }

    public function staffcreatevirutalmeeting()
    {
        return view('staff/virtualclass/staffcreatevirutalmeeting');
    }

    public function staffvirtualclassschedules()
    {
        return view('staff/virtualclass/staffvirtualclassschedules');
    }
}
