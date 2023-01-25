<?php

namespace App\Mail\Payroll;

use App\Models\Admin\Staff\Payroll\Payrolleachmonth;
use App\Models\Miscellaneous\Numbertowords;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;

class Staffpayrollmail extends Mailable
{
    use Queueable, SerializesModels;

    public $payrolleachmonth;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($uuid)
    {
        $this->payrolleachmonth = Payrolleachmonth::where('uuid', $uuid)
            ->first();
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $staff_details = json_decode($this->payrolleachmonth->staff_details);
        $earning_breakup = json_decode($this->payrolleachmonth->earning_breakup);
        $deduction_breakup = json_decode($this->payrolleachmonth->deduction_breakup);
        $rupees = Numbertowords::Numbertowords($this->payrolleachmonth->net_salary);

        $payrolleachmonth = $this->payrolleachmonth;

        $pdf = Pdf::loadView('admin.staff.payroll.pdf.payrolleachmonth',
            compact('payrolleachmonth', 'staff_details', 'earning_breakup', 'deduction_breakup', 'rupees'));

        return $this->markdown('emails.payroll.staffpayrollmail')
            ->subject('Payslip Mail from ' . App::make('generalsetting')->schoolname)
            ->attachData($pdf->output(), "Payslip.pdf");
    }
}
