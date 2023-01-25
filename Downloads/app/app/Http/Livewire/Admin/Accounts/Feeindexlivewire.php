<?php

namespace App\Http\Livewire\Admin\Accounts;

use App\Events\Accountsevent\Fee\FeereminderEvent;
use App\Models\Admin\Accounts\Fee\Feeassignstudent;
use App\Models\Admin\Accounts\Fee\Feemaster;
use App\Models\Admin\Accounts\Fee\Feestudentpayment;
use App\Models\Admin\Settings\Academicsetting\Classmaster;
use App\Models\Admin\Settings\Academicsetting\Section;
use App\Models\Admin\Student\Student;
use App\Models\Miscellaneous\Helper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class Feeindexlivewire extends Component
{
    use WithPagination;

    public $searchTerm = null;

    public $sortColumnName = 'created_at';

    public $sortDirection = 'desc';

    public $paginationlength = 10;

    public $classmasterid, $sectionid, $studentid;

    public $classmaster, $section, $feeassignstudent, $feestudentpayment;

    public $showsetremindermodal = false;

    public $selected_feemaster = [];

    public function mount()
    {
        $this->classmaster = Classmaster::where('active', true)->get();
        $this->section = [];
        $this->feeassignstudent = Feeassignstudent::where('is_selected', true)->get();
        $this->feestudentpayment = Feestudentpayment::where('active', true)->get();
    }

    public function setreminder()
    {
        try {
            Student::whereHas('feeassignstudent', fn(Builder $q) =>
                $q->where('due_amount', '<>', 0)
                    ->where('is_selected', true)
                    ->whereIn('feemaster_id', $this->selected_feemaster)
            )->each(fn($eachstudent) => event(new FeereminderEvent($eachstudent)));

            Helper::trackmessage(auth()->user(), 'Admin Fee reminder', 'admin_fee_reminder', session()->getId(), 'WEB');
            $this->dispatchBrowserEvent('successtoast', ['message' => 'Reminder sent successfully']);
            return redirect()->route('adminfee');
        } catch (Exception $e) {
            $this->exceptionerror('admin_fee_reminder', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('admin_fee_reminder', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('admin_fee_reminder', 'three', $e);
        }
    }

    protected function exceptionerror($msg, $type, $e)
    {
        Log::error("SessionID: " . session()->getId() . ' Exception ' . $type . ': admin_web_section_' . $msg . '  Error: ' . $e->getMessage());
        $this->dispatchBrowserEvent('errortoast', ['message' => $e->getMessage()]);
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

    public function opensetremindermodal()
    {
        $this->showsetremindermodal = true;
    }

    public function clossetreminderemodal()
    {
        $this->showsetremindermodal = false;
    }

    public function render()
    {
        $studentlist = Student::with('feeassignstudent')
            ->isaccountactive()
            ->whereHas('feeassignstudent', function (Builder $query) {
                $query->where('is_selected', true);
            })
            ->where(fn($query) => ($this->classmasterid) ? $query->where('classmaster_id', $this->classmasterid) : '')
            ->where(fn($query) => ($this->sectionid) ? $query->where('section_id', $this->sectionid) : '')
            ->where('name', 'like', '%' . $this->searchTerm . '%')
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)->onEachSide(1);

        $feereminderlist = Feemaster::with(['feeassignstudent' => fn($q) =>
            $q->where('due_amount', '<>', 0)
                ->where('is_selected', true),
        ])->get();
        $sectionlist = Section::where('active', true)->get();
        return view('livewire.admin.accounts.feeindexlivewire', compact('studentlist', 'feereminderlist', 'sectionlist'));
    }
}
