<?php

namespace App\Http\Controllers\Web\Parent\Virtualclass;

use App\Http\Controllers\Controller;

class ParentvirtualclassController extends Controller
{

    public function parentvirtualclasstoday()
    {
        return view('parent/virtualclass/today');
    }

    public function parentvirtualclassupcoming()
    {
        return view('parent/virtualclass/upcoming');
    }
}
