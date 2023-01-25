<?php

namespace App\Http\Controllers\Web\Staff\Feed;

use App\Http\Controllers\Controller;

class StafffeedController extends Controller
{
    public function stafffeedlatest()
    {
        return view('staff.feed.stafffeedlatest');
    }

    public function stafffeedtrending()
    {
        return view('staff.feed.stafffeedtrending');
    }

    public function stafffeedmypost()
    {
        return view('staff.feed.stafffeedmypost');
    }
}
