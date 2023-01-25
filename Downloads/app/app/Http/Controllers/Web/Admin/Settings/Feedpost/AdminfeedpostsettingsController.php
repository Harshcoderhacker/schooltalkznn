<?php

namespace App\Http\Controllers\Web\Admin\Settings\Feedpost;

use App\Http\Controllers\Controller;

class AdminfeedpostsettingsController extends Controller
{
    public function tagsettings()
    {
        return view('admin.settings.feedsettings.tag.index');
    }

    public function feedreportsettings()
    {
        return view('admin.settings.feedsettings.report.index');
    }
    public function feedstickersettings()
    {
        return view('admin.settings.feedsettings.sticker.index');
    }

    public function feedstudentidealibrarysettings()
    {
        return view('admin.settings.feedsettings.studentidealibrary.index');
    }

    public function feedstaffidealibrarysettings()
    {
        return view('admin.settings.feedsettings.staffidealibrary.index');
    }
}
