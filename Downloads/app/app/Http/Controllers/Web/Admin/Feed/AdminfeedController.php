<?php

namespace App\Http\Controllers\Web\Admin\Feed;

use App\Http\Controllers\Controller;

class AdminfeedController extends Controller
{
    public function adminfeedlatest()
    {
        return view('admin.feed.adminfeedlatest');
    }

    public function adminfeedtrending()
    {
        return view('admin.feed.adminfeedtrending');
    }

    public function adminfeedmypost()
    {
        return view('admin.feed.adminfeedmypost');
    }

    public function adminfeedreportedpost()
    {
        return view('admin.feed.adminfeedreportedpost');
    }

    public function adminfeedhashtag()
    {
        return view('admin.feed.adminfeedhashtag');
    }
}
