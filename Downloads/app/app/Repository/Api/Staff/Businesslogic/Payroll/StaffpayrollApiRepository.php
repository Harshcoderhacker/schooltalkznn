<?php

namespace App\Repository\Api\Staff\Businesslogic\Payroll;

use App\Http\Resources\Admin\Staff\Payroll\PayrollCollection;
use App\Models\Admin\Staff\Payroll\Payrolleachmonth;
use App\Models\Miscellaneous\Numbertowords;
use App\Repository\Api\Staff\Interfacelayer\Payroll\IStaffpayrollApiRepository;
use Barryvdh\DomPDF\Facade\Pdf;

class StaffpayrollApiRepository implements IStaffpayrollApiRepository
{
    public function getstaffpayrolllist()
    {
        return [true, new PayrollCollection(
            auth()->user()->payrolleachmonth()
                ->where('is_generated', true)
                ->paginate(15)
        ), 'getstaffpayrolllist'];

    }

    public function staffpayrolldownloadbyuuid()
    {
        $payrolleachmonth = Payrolleachmonth::where('staff_id', auth()->user()->id)
            ->where('uuid', request('payrolleachmonth_uuid'))
            ->first();

        $staff_details = json_decode($payrolleachmonth->staff_details);
        $earning_breakup = json_decode($payrolleachmonth->earning_breakup);
        $deduction_breakup = json_decode($payrolleachmonth->deduction_breakup);
        $rupees = Numbertowords::Numbertowords($payrolleachmonth->net_salary);

        return Pdf::loadView('admin.staff.payroll.pdf.payrolleachmonth',
            compact('payrolleachmonth', 'staff_details', 'earning_breakup', 'deduction_breakup', 'rupees'));

    }
}
