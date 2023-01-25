<?php

namespace App\Http\Controllers\Web\Parent\Homework;

use App\Http\Controllers\Controller;

class ParenthomeworkclassController extends Controller
{
    public function index()
    {
        return view('parent.homework.index');
    }

    public function homeworksummary($homeworkid)
    {
        return view('parent.homework.aparenthomeworksummary', compact('homeworkid'));
    }
}
