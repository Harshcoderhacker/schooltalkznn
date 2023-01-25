<?php

namespace App\Http\Controllers\Web\Admin\Materials;

use App\Http\Controllers\Controller;

class AdminmaterialsController extends Controller
{
    public function index()
    {
        $platform = "admin";
        return view('admin.materials.index', compact('platform'));
    }
}
