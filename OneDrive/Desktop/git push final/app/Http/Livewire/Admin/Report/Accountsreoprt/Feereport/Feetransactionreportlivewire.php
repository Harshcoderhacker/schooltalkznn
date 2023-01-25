<?php

namespace App\Http\Livewire\Admin\Report\Accountsreoprt\Feereport;

use App\Exports\Admin\Report\Accounts\Fee\FeetransactionExport;
use App\Models\Admin\Accounts\Fee\Feestudentpayment;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Feetransactionreportlivewire extends Component
{
    use WithPagination;

    public $from_date, $to_date, $get_from_date, $get_to_date, $downloadtype;
    public $paginationlength = 10;
    public $searchTerm = null;

    public function Updatedgettodate()
    {
        $this->from_date = $this->get_from_date;
        $this->to_date = $this->get_to_date;
    }

    public function updatepagination()
    {
        $this->resetPage();
    }

    public function updatedSearchTerm()
    {
        $this->resetPage();
    }

    public function downloadfeetransaction()
    {
        $feestudentpaymentlist = Feestudentpayment::whereBetween('created_at', [$this->from_date, $this->to_date])->get();

        $exportype = collect(["1", "2", "3"]);

        if ($exportype->contains($this->downloadtype)) { //xlsx", "xls", "csv"
            return Excel::download(new FeetransactionExport($feestudentpaymentlist), 'Feetransaction.' . ["xlsx", "xls", "csv"][$this->downloadtype - 1]);
        }

        if ($this->downloadtype == 4) { // PDF
            $pdf = Pdf::loadView('admin.report.accountsreport.feereport.pdf.feetransactionreportpdf',
                compact('feestudentpaymentlist'))
                ->setPaper('a4', 'landscape')
                ->output();

            $this->dispatchBrowserEvent('successtoast', ['message' => 'Fee Transaction Report Download Intiated']);
            return response()->streamDownload(fn() => print($pdf), 'Feetransactionreport.pdf');
        }

    }

    public function render()
    {
        if ($this->from_date && $this->to_date) {
            $feestudentpaymentlist = Feestudentpayment::where(function ($query) {
                if ($this->from_date == $this->to_date) {
                    $query->whereDate('created_at', $this->from_date);
                } else {
                    $query->whereBetween('created_at', [$this->from_date, $this->to_date]);
                }
            })
                ->whereHas('student', fn($query) =>
                    $query->where('name', 'like', '%' . $this->searchTerm . '%')
                )
                ->paginate($this->paginationlength)->onEachSide(1);
        } else {
            $feestudentpaymentlist = [];
        }
        return view('livewire.admin.report.accountsreoprt.feereport.feetransactionreportlivewire', ['feestudentpaymentlist' => $feestudentpaymentlist]);
    }
}
