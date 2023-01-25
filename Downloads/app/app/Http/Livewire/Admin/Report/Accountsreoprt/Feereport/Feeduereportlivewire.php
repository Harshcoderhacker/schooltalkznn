<?php

namespace App\Http\Livewire\Admin\Report\Accountsreoprt\Feereport;

use App\Exports\Admin\Report\Accounts\Fee\FeedueExport;
use App\Models\Admin\Settings\Academicsetting\Classmaster;
use App\Models\Admin\Student\Student;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;

class Feeduereportlivewire extends Component
{
    use WithPagination;

    public $classmasterid, $sectionid, $downloadtype;
    public $searchTerm = null;
    public $classmaster;
    public $section = [];
    public $paginationlength = 15;

    public function mount()
    {
        $this->classmaster = Classmaster::where('active', true)->get();
    }

    public function updatedClassmasterid()
    {
        $this->sectionid = '';
        if ($this->classmasterid) {
            $this->section = Classmaster::find($this->classmasterid)->section;
        } else {
            $this->section = [];
        }
    }

    public function updatepagination()
    {
        $this->resetPage();
    }

    public function updatedSearchTerm()
    {
        $this->resetPage();
    }

    public function downloadfeedue()
    {
        $studentduelist = Student::isaccountactive()
            ->with('feeassignstudent')
            ->where(fn($query) => ($this->classmasterid) ? $query->where('classmaster_id', $this->classmasterid) : '')
            ->where(fn($query) => ($this->sectionid) ? $query->where('section_id', $this->sectionid) : '')->get();

        $exportype = collect(["1", "2", "3"]);

        if ($exportype->contains($this->downloadtype)) { //xlsx", "xls", "csv"
            return Excel::download(new FeedueExport($studentduelist), 'Feedue.' . ["xlsx", "xls", "csv"][$this->downloadtype - 1]);
        }

        if ($this->downloadtype == 4) { // PDF
            $pdf = Pdf::loadView('admin.report.accountsreport.feereport.pdf.feeduereportpdf',
                compact('studentduelist'))
                ->setPaper('a4', 'landscape')
                ->output();

            $this->dispatchBrowserEvent('successtoast', ['message' => 'Fee Due Report Download Intiated']);
            return response()->streamDownload(fn() => print($pdf), 'Feeduereport.pdf');
        }

    }

    public function render()
    {
        if ($this->classmasterid && $this->sectionid) {
            $studentduelist = Student::isaccountactive()
                ->with('feeassignstudent')
                ->where(fn($query) => ($this->classmasterid) ? $query->where('classmaster_id', $this->classmasterid) : '')
                ->where(fn($query) => ($this->sectionid) ? $query->where('section_id', $this->sectionid) : '')
                ->where('name', 'like', '%' . $this->searchTerm . '%')
                ->paginate($this->paginationlength)->onEachSide(1);
        } else {
            $studentduelist = [];
        }
        return view('livewire.admin.report.accountsreoprt.feereport.feeduereportlivewire', ['studentduelist' => $studentduelist]);
    }
}
