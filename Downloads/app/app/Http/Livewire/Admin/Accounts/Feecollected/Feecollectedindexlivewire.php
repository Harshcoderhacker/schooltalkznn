<?php

namespace App\Http\Livewire\Admin\Accounts\Feecollected;

use App\Models\Admin\Accounts\Fee\Feestudentpayment;
use App\Models\Admin\Settings\Academicsetting\Classmaster;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class Feecollectedindexlivewire extends Component
{
    use WithPagination;

    public $searchTerm = null;

    public $sortColumnName = 'created_at';

    public $sortDirection = 'desc';

    public $paginationlength = 10;

    public $classmasterid, $sectionid, $studentid;

    public $classmaster, $section;

    public $today_payment, $week_payment, $month_payment, $total_payment;

    public function mount()
    {
        $this->classmaster = Classmaster::where('active', true)->get();
        $this->section = [];
        $this->today_payment = Feestudentpayment::whereDate('created_at', Carbon::today())->sum('total_paid_amount');
        $this->week_payment = Feestudentpayment::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->sum('total_paid_amount');
        $this->month_payment = Feestudentpayment::whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)->sum('total_paid_amount');
        $this->total_payment = Feestudentpayment::sum('total_paid_amount');
    }

    public function updatedClassmasterid()
    {
        $this->sectionid = '';
        if ($this->classmasterid && is_numeric($this->classmasterid)) {
            $this->section = Classmaster::find($this->classmasterid)->section;
        } else {
            $this->section = [];
        }
    }

    public function sortBy($columnName)
    {
        if ($this->sortColumnName === $columnName) {
            $this->sortDirection = $this->swapSortDirection();
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortColumnName = $columnName;
    }

    public function swapSortDirection()
    {
        return $this->sortDirection === 'asc' ? 'desc' : 'asc';
    }

    public function updatedSearchTerm()
    {
        $this->resetPage();
    }

    public function updatepagination()
    {
        $this->resetPage();
    }

    public function downloadfeeinvoice(Feestudentpayment $feestudentpayment)
    {
        $pdf = Pdf::loadView('admin.accounts.fee.feecollected.feereceipt', compact('feestudentpayment'))
            ->setPaper('a4', 'landscape')
            ->output();
        // $this->dispatchBrowserEvent('successtoast', ['message' => 'Student Fee Statuement Download Intiated']);
        return response()->streamDownload(fn() => print($pdf), 'Studentfeestatement.pdf');
    }

    public function render()
    {
        $feestudentpaymentlist = Feestudentpayment::with('student')
            ->where(fn($query) => ($this->classmasterid) ? $query->where('classmaster_id', $this->classmasterid) : '')
            ->where(fn($query) => ($this->sectionid) ? $query->where('section_id', $this->sectionid) : '')
            ->whereHas('student', fn($query) =>
                $query->where('name', 'like', '%' . $this->searchTerm . '%')
            )
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)->onEachSide(1);
        return view('livewire.admin.accounts.feecollected.feecollectedindexlivewire', ['feestudentpaymentlist' => $feestudentpaymentlist]);
    }
}
