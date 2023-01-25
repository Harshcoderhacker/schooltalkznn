<?php

namespace App\Http\Livewire\Admin\Settings\Leavesettings\Leavedefine;

use App\Models\Admin\Settings\Leavesetting\Leavedefine;
use App\Models\Admin\Settings\Schoolsetting\Academicyear;
use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class Leavedefineliverwire extends Component
{
    use WithPagination;

    public $leavedefineid, $name;

    public $searchTerm = null;

    public $sortColumnName = 'created_at';

    public $sortDirection = 'desc';

    public $paginationlength = 10;

    public $leavedefinesubmitbtn = true;

    public $leavedefineshowdata;

    public $isshowmodalopen = false;

    public $academicyear;
    public $academicyear_id;
    public $alloteddays, $monthlyleave;

    public function leavedefineshowmodal()
    {
        $this->isshowmodalopen = true;
    }
    public function leavedefineclosemodal()
    {
        $this->isshowmodalopen = false;
        $this->leavedefineshowdata = [];
    }

    public function mount()
    {
        $this->academicyear = Academicyear::where('active', true)->get();
    }

    protected function rules()
    {
        return [
            'academicyear_id' => 'required|numeric|unique:leavedefines,academicyear_id,' . $this->leavedefineid,
            'alloteddays' => 'required|numeric|min:1|max:99',
            'monthlyleave' => 'required|numeric|min:1|max:9',
        ];
    }

    public function updated($propertyName)
    {
        $this->leavedefinesubmitbtn = true;
        $this->validateOnly($propertyName);
        $this->leavedefinesubmitbtn = false;
    }

    public function createorupdate()
    {
        try {
            DB::beginTransaction();

            $validated = $this->validate();
            $user = auth()->user();

            if ($this->leavedefineid) {
                $leavedefinemodel = Leavedefine::find($this->leavedefineid);

                $leavedefinemodel->academicyear_id = $this->academicyear_id;
                $leavedefinemodel->alloteddays = $this->alloteddays;
                $leavedefinemodel->monthlyleave = $this->monthlyleave;

                if ($leavedefinemodel->isDirty()) {
                    $leavedefinemodel->save();

                    Helper::trackmessage(auth()->user(), 'Admin Leavedefine Update', 'admin_web_leavedefine_create', session()->getId(), 'WEB');
                    DB::commit();
                    $this->formreset();
                    $this->resetPage();
                    $this->dispatchBrowserEvent('updatetoast', ['message' => 'Leavedefine Updated Successfully!']);

                } else {
                    DB::rollback();
                    $this->dispatchBrowserEvent('warningtoast', ['message' => 'No Changes has been made!']);
                    $this->emit('leavedefine_field_focus_trigger');
                }
            } else {
                Leavedefine::create($validated);
                Helper::trackmessage(auth()->user(), 'Admin Leavedefine Create', 'admin_web_leavedefine_create', session()->getId(), 'WEB');

                DB::commit();
                $this->formreset();
                $this->resetPage();
                $this->dispatchBrowserEvent('successtoast', ['message' => 'Leavedefine Added Successfully!']);
            }
            $this->leavedefinesubmitbtn = true;

        } catch (Exception $e) {
            $this->exceptionerror('createorupdate', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('createorupdate', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('createorupdate', 'three', $e);
        }

    }

    public function show(Leavedefine $leavedefine)
    {
        $this->leavedefineshowdata = $leavedefine;
        $this->leavedefineshowmodal();
    }

    public function edit(Leavedefine $leavedefine)
    {
        $this->alloteddays = $leavedefine->alloteddays;
        $this->monthlyleave = $leavedefine->monthlyleave;

        $this->leavedefineid = $leavedefine->id;
        $this->academicyear_id = $leavedefine->academicyear_id;
        $this->emit('leavedefine_field_focus_trigger');
    }

    public function deleteconfirm($leavedefineid)
    {
        $this->dispatchBrowserEvent('deletetoast', ['leavedefineid' => $leavedefineid]);
    }

    public function delete(Leavedefine $leavedefine)
    {
        try {
            DB::beginTransaction();

            $leavedefine->delete();
            Helper::trackmessage(auth()->user(), 'Admin Leavedefine Delete', 'admin_web_leavedefine_delete', session()->getId(), 'WEB');

            DB::commit();
            $this->formreset();
            $this->resetPage();
            $this->dispatchBrowserEvent('deletemsg', ['message' => 'Leavedefine Deleted!']);

        } catch (Exception $e) {
            $this->exceptionerror('delete', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('delete', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('delete', 'three', $e);
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

    protected function formreset()
    {
        $this->alloteddays = null;
        $this->monthlyleave = null;
        $this->leavedefineid = null;
        $this->academicyear_id = null;
    }

    public function formcancel()
    {
        $this->formreset();
        $this->resetPage();
    }

    public function updatedSearchTerm()
    {
        $this->resetPage();
    }

    public function updatepagination()
    {
        $this->resetPage();
    }

    public function render()
    {
        $leavedefine = Leavedefine::query()
            ->whereIn('academicyear_id', Academicyear::select(['id'])
                    ->where('year', 'like', '%' . $this->searchTerm . '%')
            )
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)->onEachSide(1);

        return view('livewire.admin.settings.leavesettings.leavedefine.leavedefineliverwire', compact('leavedefine'));
    }

    protected function exceptionerror($msg, $type, $e)
    {
        DB::rollback();
        Log::error("SessionID: " . session()->getId() . ' Exception ' . $type . ': admin_web_leavedefine_' . $msg . '  Error: ' . $e->getMessage());
        $this->dispatchBrowserEvent('errortoast', ['message' => $e->getMessage()]);
    }
}
