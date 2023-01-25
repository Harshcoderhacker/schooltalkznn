<?php

namespace App\Http\Controllers\Web\Admin\Dashboard;

use App\Http\Controllers\Controller;
use ProtoneMedia\LaravelFFMpeg\Support\FFMpeg as FFMpeg;

class AdmindashboardController extends Controller
{

    public function admindashboard()
    {
        if (env('SCHOOLTALKZ')) {
            return view('admin.dashboard.schooltalkzdashboard');
        }
        return view('admin.dashboard.dashboard');
    }

    public function adminschooltalkzdashboard()
    {
        return view('admin.dashboard.schooltalkzdashboard');
    }

    public function adminemotioncapturedashboard()
    {
        return view('admin.dashboard.emotioncapturedashboard');
    }

    public function admintest()
    {

        // return url('http://127.0.0.1:8000/storage/feed/post/video/fyYeKZ0VcYfGI2J4nMxQEGDgc5xo71oLTBQSM9to.mp4');
        //   FFMpeg::open('http://127.0.0.1:8000/storage/feed/post/video/fyYeKZ0VcYfGI2J4nMxQEGDgc5xo71oLTBQSM9to.mp4');

        // FFMpeg::open('http://127.0.0.1:8000/storage/feed/post/video/fyYeKZ0VcYfGI2J4nMxQEGDgc5xo71oLTBQSM9to.mp4')
        //     ->export()
        //     ->inFormat(new Aac)
        //     ->save('yesterday.aac');

        try {
            FFMpeg::open(url('storage/feed/post/video/fyYeKZ0VcYfGI2J4nMxQEGDgc5xo71oLTBQSM9to.mp4'))
                ->export()
                ->inFormat(new Aac)
                ->save('yesterday.aac');
        } catch (EncodingException $exception) {
            $command = $exception->getCommand();
            $errorLog = $exception->getErrorOutput();
        }

        return view('admin/dashboard/dashboard');
    }

}
