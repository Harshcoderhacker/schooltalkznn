<?php

namespace App\Http\Controllers\Web\Staff\Materials;

use App\Http\Controllers\Controller;

class StaffmaterialsController extends Controller
{
    public function staffmaterials()
    {
        $platform = "staff";
        return view('staff.materials.staffmaterials', compact('platform'));
    }
}
