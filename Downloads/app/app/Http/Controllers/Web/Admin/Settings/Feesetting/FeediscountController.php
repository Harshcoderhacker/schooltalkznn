<?php

namespace App\Http\Controllers\Web\Admin\Settings\Feesetting;

use App\Http\Controllers\Controller;

class FeediscountController extends Controller
{

    public function index()
    {
        return view('admin.settings.feesettings.feediscount.index');
    }

}
