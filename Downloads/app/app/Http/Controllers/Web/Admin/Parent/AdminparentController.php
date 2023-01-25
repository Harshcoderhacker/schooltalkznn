<?php

namespace App\Http\Controllers\Web\Admin\Parent;

use App\Http\Controllers\Controller;

class AdminparentController extends Controller
{
    public function adminparent()
    {
        return view('admin.parent.index');
    }
}
