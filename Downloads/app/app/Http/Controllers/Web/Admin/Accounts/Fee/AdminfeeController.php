<?php

namespace App\Http\Controllers\Web\Admin\Accounts\Fee;

use App\Http\Controllers\Controller;
use App\Models\Admin\Accounts\Fee\Feemaster;
use App\Models\Admin\Accounts\Fee\Feestudentpayment;
use App\Models\Admin\Student\Student;

class AdminfeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.accounts.fee.index');
    }

    public function createadminfeeindex()
    {
        return view('admin.accounts.fee.createfee.index');
    }

    public function createfee(Feemaster $feemaster)
    {
        $show = 1;
        return view('admin.accounts.fee.createfee.createfee', compact('feemaster', 'show'));
    }

    public function editfee(Feemaster $feemaster, $show)
    {
        return view('admin.accounts.fee.createfee.createfee', compact('feemaster', 'show'));
    }

    public function feecollected()
    {
        return view('admin.accounts.fee.feecollected.index');
    }

    public function feedue()
    {
        return view('admin.accounts.fee.feedue.index');
    }

    public function feewaived()
    {
        return view('admin.accounts.fee.feewaived.index');
    }

    public function feestudentinfo(Student $student)
    {
        return view('admin.accounts.fee.feestudentinfo.index', compact('student'));
    }

    public function feereceipt(Feestudentpayment $feestudentpayment)
    {
        return view('admin.accounts.fee.feecollected.feereceipt', compact('feestudentpayment'));
    }
}
