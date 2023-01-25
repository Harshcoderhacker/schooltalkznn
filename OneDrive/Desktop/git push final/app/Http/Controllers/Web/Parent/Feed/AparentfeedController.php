<?php

namespace App\Http\Controllers\Web\Parent\Feed;

use App\Http\Controllers\Controller;

class AparentfeedController extends Controller
{
    public function aparentfeedlatest()
    {
        return view('parent.feed.aparentfeedlatest');
    }

    public function aparentfeedtrending()
    {
        return view('parent.feed.aparentfeedtrending');
    }

    public function aparentfeedmypost()
    {
        return view('parent.feed.aparentfeedmypost');
    }

    public function aparentfeedmyclass()
    {
        return view('parent.feed.aparentfeedmyclass');
    }
}
