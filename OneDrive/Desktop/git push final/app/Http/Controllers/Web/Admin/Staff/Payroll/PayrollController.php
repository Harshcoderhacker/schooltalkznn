<?php

namespace App\Http\Controllers\Web\Admin\Staff\Payroll;

use App\Http\Controllers\Controller;
use App\Models\Admin\Staff\Payroll\Payroll;

class PayrollController extends Controller
{
    public function payroll()
    {
        return view('admin.staff.payroll.payroll.index');
    }

    public function payrollstafflist($payrollid)
    {
        return view('admin.staff.payroll.staff.index', compact('payrollid'));
    }

    public function generatepayroll($payrollid, $staffpayrollid)
    {
        return view('admin.staff.payroll.staff.generatepayroll', compact('payrollid', 'staffpayrollid'));
    }

    public function staffpaydetails()
    {
        return view('admin.staff.payroll.old.staffpaydetails');
    }

}
