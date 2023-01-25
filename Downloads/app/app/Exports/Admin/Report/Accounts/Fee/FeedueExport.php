<?php

namespace App\Exports\Admin\Report\Accounts\Fee;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class FeedueExport implements FromView
{

    protected $studentduelist;

    public function __construct($studentduelist)
    {
        $this->studentduelist = $studentduelist;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    // public function collection()
    // {
    //     return studentduelist::all();
    // }

    public function view(): View
    {
        return view('admin.report.accountsreport.feereport.pdf.feeduereportpdf', [
            'studentduelist' => $this->studentduelist,
        ]);
    }
}
