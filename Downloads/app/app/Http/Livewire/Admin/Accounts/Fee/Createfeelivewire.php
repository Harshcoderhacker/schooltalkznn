<?php

namespace App\Http\Livewire\Admin\Accounts\Fee;

use App\Models\Admin\Accounts\Fee\Feeassignstudent;
use App\Models\Admin\Accounts\Fee\Feemaster;
use App\Models\Admin\Accounts\Fee\Feemasterparticular;
use App\Models\Admin\Settings\Academicsetting\Classmaster;
use App\Models\Admin\Settings\Academicsetting\Section;
use App\Models\Admin\Settings\Feesetting\Feeparticular;
use App\Models\Admin\Student\Student;
use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class Createfeelivewire extends Component
{
    use WithPagination;

    public $feemaster_id, $feemaster, $show, $classmaster, $feeparticular, $classmaster_name, $section_name;
    public $particular = [];
    public $section_data = [];
    public $selectedstudent = [];
    public $name, $classmaster_id, $section, $due_date;
    public $assigntype;
    public $feeassignstudentlock = false;
    public $total_amount = 0;
    public $validatedcreatefeeinfo;
    public $feemasterparticular;
    public $studentlist = [];
    public $searchTerm = null;
    public $sortColumnName = 'created_at';
    public $sortDirection = 'desc';

    public function mount($feemaster_id = null, $show)
    {
        if ($feemaster_id) {
            $this->feemaster_id = $feemaster_id;
            $feemaster = Feemaster::find($feemaster_id);
            $this->name = $feemaster->name;
            $this->classmaster_id = $feemaster->classmaster_id;
            $this->section_data = $feemaster->classmaster->section;
            $this->section = $feemaster->section;
            $this->due_date = $feemaster->due_date;

            $this->feemasterparticular = Feemasterparticular::where('feemaster_id', $feemaster_id)->get();
            foreach ($this->feemasterparticular as $key => $eachfeemasterparticular) {
                $this->particular[$key] = [
                    'feeparticular_id' => $eachfeemasterparticular->feeparticular_id,
                    'amount' => $eachfeemasterparticular->amount,
                ];
            }
            foreach ($this->particular as $key => $value) {
                $feeparticularselected = Feeparticular::find($value['feeparticular_id'])->name;
                $this->particular[$key] = array_merge($value, ['feeparticular_name' => $feeparticularselected]);
            }
            $this->calculateamount();

            $this->assigntype = $feemaster->assigntype;
            $feeassignstudent = Feeassignstudent::where('feemaster_id', $feemaster_id);
            $this->selectedstudent = $feeassignstudent->where('is_selected', true)->pluck('student_id');
            $this->feeassignstudentlock = $feeassignstudent->where('is_lock', true)->exists();

            $this->classmaster_name = $feemaster->classmaster->name;
            $this->section_name = Section::whereIn('id', $this->section)->pluck('name')->implode(', ');
            if ($this->classmaster_id && $this->section) {
                $this->studentlist = Student::isaccountactive()
                    ->where('classmaster_id', $this->classmaster_id)
                    ->whereIn('section_id', $this->section)
                    ->where('name', 'like', '%' . $this->searchTerm . '%')
                    ->orderBy($this->sortColumnName, $this->sortDirection)
                    ->get();
            }

        }
        $this->classmaster = Classmaster::where('active', true)->get();
        $this->feeparticular = Feeparticular::all();
        $this->show = $show;
        if ($feemaster_id == null) {
            $this->particular[] = [
                'feeparticular_id' => null,
                'amount' => null,
            ];
        }

    }

    public function hydrate()
    {
        $this->emit('loadSelect2Hydrate');
    }

    public function updatedClassmasterid()
    {
        if ($this->classmaster_id && is_numeric($this->classmaster_id)) {
            $classmaster = Classmaster::find($this->classmaster_id);
            $this->section_data = $classmaster->section;
            $this->classmaster_name = $classmaster->name;
        } else {
            $this->section_data = [];
        }
    }

    public function validatecreatefeeinfo()
    {
        $this->validatedcreatefeeinfo = $this->validate(
            ['name' => 'required|min:3|max:35',
                'classmaster_id' => 'required',
                'section' => 'required',
                'due_date' => 'required|date',
            ],
            [
                'name.required' => 'Name cannot be empty',
                'name.min' => 'Name should have minimum 3 letters',
                'name.max' => 'Name should not exceed 35 letters',
                'classmaster_id.required' => 'Select Class',
                'section.required' => 'Select Section',
                'due_date.required' => 'Select Due Date',

            ]);
        $this->section_name = Section::whereIn('id', $this->section)->pluck('name')->implode(', ');
        $this->show = 2;
    }

    public function validatefeeparticular()
    {
        $this->validate(['particular.*.feeparticular_id' => 'required',
            'particular.*.amount' => 'required',
        ],
            [
                'particular.*.feeparticular_id.required' => 'Select particulars',
                'particular.*.amount.required' => 'Amount cannot be empty.',

            ]);
        foreach ($this->particular as $key => $value) {
            $feeparticularselected = Feeparticular::find($value['feeparticular_id'])->name;
            $this->particular[$key] = array_merge($value, ['feeparticular_name' => $feeparticularselected]);
        }
        if ($this->classmaster_id && $this->section) {
            $this->studentlist = Student::isaccountactive()
                ->where('classmaster_id', $this->classmaster_id)
                ->whereIn('section_id', $this->section)
                ->where('name', 'like', '%' . $this->searchTerm . '%')
                ->orderBy($this->sortColumnName, $this->sortDirection)
                ->get();
        }

        $this->selectedstudent = $this->studentlist->pluck('id');
        $this->show = 3;
    }

    public function validateassignedstudent()
    {
        $this->validate([
            'assigntype' => 'required',
        ],
            [
                'assigntype.required' => 'Select Assign Fee',
            ]);
        $this->show = 4;
    }

    public function submitfee()
    {
        try {
            DB::beginTransaction();

            $feemaster = $this->createoreditfeemaster();
            $this->createoreditfeemasterparticular($feemaster);
            $this->createoreditfeeassignstudent($feemaster);

            Helper::trackmessage(auth()->user(), 'Admin fee Create/Edit', 'admin_web_fee_create/edit', session()->getId(), 'WEB');
            DB::commit();
            $this->dispatchBrowserEvent('successtoast', ['message' => 'Fee Created successfully']);
            redirect()->route('createadminfeeindex');

        } catch (Exception $e) {
            $this->exceptionerror('createorupdate', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('createorupdate', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('createorupdate', 'three', $e);
        }
    }

    protected function createoreditfeemaster()
    {
        $this->validatedcreatefeeinfo['assigntype'] = $this->assigntype;
        $this->validatedcreatefeeinfo['amount'] = $this->total_amount;
        $this->validatedcreatefeeinfo['feeparticular_name'] = collect($this->particular)->pluck('feeparticular_name')->implode(', ');

        if ($this->feemaster_id) {
            $feemaster = Feemaster::find($this->feemaster_id);
            $feemaster->update($this->validatedcreatefeeinfo);
        } else {
            $feemaster = Feemaster::create($this->validatedcreatefeeinfo);
        }
        return $feemaster;
    }

    protected function createoreditfeemasterparticular($feemaster)
    {

        if ($feemaster->feemasterparticular->count() != 0) {
            $feemaster->feemasterparticular->each->delete();
        }

        foreach ($this->particular as $key => $eachfeeparticular) {
            Feemasterparticular::create([
                'feemaster_id' => $feemaster->id,
                'feeparticular_id' => $eachfeeparticular['feeparticular_id'],
                'amount' => $eachfeeparticular['amount'],
            ]);
        }
    }

    protected function createoreditfeeassignstudent($feemaster)
    {
        $studentlist = Student::isaccountactive()
            ->where('classmaster_id', $this->classmaster_id)
            ->whereIn('section_id', $this->section)
            ->get();

        foreach ($studentlist as $key => $eachstudent) {
            $student_details = ['classmaster' => $eachstudent->classmaster->name,
                'section' => $eachstudent->section->name,
                'academicyear' => $eachstudent->academicyear->year,
                'aparent' => $eachstudent->aparent->name,
                'student' => $eachstudent->name];
            $feeassignstudent = Feeassignstudent::where('student_id', $eachstudent->id)
                ->where('feemaster_id', $feemaster->id)->first();
            Feeassignstudent::updateOrCreate(
                ['student_id' => $eachstudent->id, 'feemaster_id' => $feemaster->id],
                ['classmaster_id' => $eachstudent->classmaster_id,
                    'section_id' => $eachstudent->section_id,
                    'academicyear_id' => $eachstudent->academicyear_id,
                    'aparent_id' => $eachstudent->aparent_id,
                    'actual_amount' => $feeassignstudent ? $feeassignstudent->actual_amount : $this->total_amount,
                    'due_amount' => $feeassignstudent ? $feeassignstudent->due_amount : $this->total_amount,
                    'student_details' => json_encode($student_details),
                    'is_selected' => $this->assigntype == 1 ? true : collect($this->selectedstudent)->contains($eachstudent->id),
                ]);
        }
    }

    public function calculateamount()
    {
        $feeparticular_amount = collect($this->particular)->pluck('amount')->toArray();
        $this->total_amount = array_sum($feeparticular_amount);
    }

    public function addparticular()
    {
        $this->particular[] = [
            'feeparticular_id' => null,
            'amount' => null,
        ];

        $this->calculateamount();

    }

    public function removeparticular($key)
    {
        unset($this->particular[$key]);
        $this->calculateamount();
    }

    public function back($step)
    {
        $this->show = $step;
    }

    public function current($currentstep)
    {
        $this->show = $currentstep;
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

    protected function exceptionerror($msg, $type, $e)
    {
        DB::rollback();
        Log::error("SessionID: " . session()->getId() . ' Exception ' . $type . ': admin_web_fee_' . $msg . '  Error: ' . $e->getMessage());
        $this->dispatchBrowserEvent('errortoast', ['message' => $e->getMessage()]);
    }

    public function render()
    {
        return view('livewire.admin.accounts.fee.createfeelivewire');
    }
}
