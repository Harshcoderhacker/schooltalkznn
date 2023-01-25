<?php

namespace App\Repository\Api\Admin\Businesslogic\Payroll;

use App\Http\Resources\Admin\Staff\Payroll\PayrollCollection;
use App\Mail\Payroll\Staffpayrollmail;
use App\Models\Admin\Staff\Payroll\Payrolleachmonth;
use App\Models\Miscellaneous\Numbertowords;
use App\Models\Staff\Auth\Staff;
use App\Repository\Api\Admin\Interfacelayer\Payroll\IAdminpayrollApiRepository;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;

class AdminpayrollApiRepository implements IAdminpayrollApiRepository
{
    public function adminstaffpayrollbyuuid()
    {
        return [true, new PayrollCollection(
            Staff::where('uuid', request('staff_uuid'))
                ->first()
                ->payrolleachmonth()
                ->where('is_generated', true)
                ->paginate(15)
        ), 'adminstaffpayrollbyuuid'];
    }

    // Not used Yet
    public function adminstaffpayrolldownloadbyuuid($uuid)
    {
        $payrolleachmonth = Payrolleachmonth::where('uuid', $uuid)
            ->first();

        $staff_details = json_decode($payrolleachmonth->staff_details);
        $earning_breakup = json_decode($payrolleachmonth->earning_breakup);
        $deduction_breakup = json_decode($payrolleachmonth->deduction_breakup);
        $rupees = Numbertowords::Numbertowords($payrolleachmonth->net_salary);

        return Pdf::loadView('admin.staff.payroll.pdf.payrolleachmonth',
            compact('payrolleachmonth', 'staff_details', 'earning_breakup', 'deduction_breakup', 'rupees'));
    }

    public function adminstaffpayrollsendmailbyuuid($uuid)
    {
        if (auth()->user()->email) {
            // auth()->user()->email // Need to change later
            Mail::to('preparenext@gmail.com')->send(new Staffpayrollmail($uuid));
            return [true, 'adminstaffpayrollsendmailbyuuid'];
        } else {
            return [false, 'adminstaffpayrollsendmailbyuuid'];
        }
    }

}
