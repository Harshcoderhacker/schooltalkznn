<?php

namespace App\Http\Controllers\Web\Admin\Settings\Examsetting;

use App\Http\Controllers\Controller;

class ExampasspercentageController extends Controller
{
    public function index()
    {
        return view('admin.settings.examsettings.exampasspercentage.index');
    }
}
