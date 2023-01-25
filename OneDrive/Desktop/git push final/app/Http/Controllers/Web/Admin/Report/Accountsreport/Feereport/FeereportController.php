<?php

namespace App\Http\Controllers\Web\Admin\Report\Accountsreport\Feereport;

use App\Http\Controllers\Controller;

class FeereportController extends Controller
{
    public function feestatementreport()
    {
        return view('admin.report.accountsreport.feereport.feestatementreport');
    }

    public function feeduereport()
    {
        return view('admin.report.accountsreport.feereport.feeduereport');
    }

    public function feetransactionreport()
    {
        return view('admin.report.accountsreport.feereport.feetransactionreport');
    }
}
