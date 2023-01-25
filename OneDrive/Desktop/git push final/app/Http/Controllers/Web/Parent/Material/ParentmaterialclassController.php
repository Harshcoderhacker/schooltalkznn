<?php

namespace App\Http\Controllers\Web\Parent\Material;

use App\Http\Controllers\Controller;

class ParentmaterialclassController extends Controller
{
    public function index()
    {
        $platform = "student";
        return view('parent.material.index', compact('platform'));
    }
}
