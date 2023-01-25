<?php

namespace App\Http\Controllers\Web\Admin\Settings\Examsetting;

use App\Http\Controllers\Controller;

class ExamgradeController extends Controller
{
    public function index()
    {
        return view('admin.settings.examsettings.examgrade.index');
    }
}
