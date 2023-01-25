<?php

namespace App\Exports\Admin\Report\Accounts\Fee;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class FeetransactionExport implements FromView
{

    protected $feestudentpaymentlist;

    public function __construct($feestudentpaymentlist)
    {
        $this->feestudentpaymentlist = $feestudentpaymentlist;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    // public function collection()
    // {
    //     return feestudentpaymentlist::all();
    // }

    public function view(): View
    {
        return view('admin.report.accountsreport.feereport.pdf.feetransactionreportpdf', [
            'feestudentpaymentlist' => $this->feestudentpaymentlist,
        ]);
    }
}
