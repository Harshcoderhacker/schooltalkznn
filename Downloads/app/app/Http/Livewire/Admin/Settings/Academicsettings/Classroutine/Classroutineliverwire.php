<?php

namespace App\Http\Livewire\Admin\Settings\Academicsettings\Classroutine;

use App\Models\Admin\Settings\Academicsetting\Classroutine;
use App\Models\Miscellaneous\Helper;
use App\Models\Staff\Auth\Staff;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class Classroutineliverwire extends Component
{
    use WithPagination;

    public $classroutineid, $name, $start_time, $end_time, $is_break = false;

    public $searchTerm = null;

    public $sortColumnName = 'created_at';

    public $sortDirection = 'desc';

    public $paginationlength = 10;

    public $classroutineshowdata;

    public $isshowmodalopen = false;

    public function classroutineshowmodal()
    {
        $this->isshowmodalopen = true;
    }
    public function classroutineclosemodal()
    {
        $this->isshowmodalopen = false;
        $this->classroutineshowdata = [];
    }

    protected function rules()
    {
        return [
            'name' => 'required|min:1|max:35|unique:classroutines,name,' . $this->classroutineid,
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'is_break' => 'nullable|boolean',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function createorupdate()
    {
        try {
            DB::beginTransaction();

            $validated = $this->validate();
            $user = auth()->user();

            if ($this->classroutineid) {
                $classroutinemodel = Classroutine::find($this->classroutineid);

                $classroutinemodel->name = $this->name;
                $classroutinemodel->start_time = $this->start_time;
                $classroutinemodel->end_time = $this->end_time;
                $classroutinemodel->is_break = $this->is_break;

                if ($classroutinemodel->isDirty()) {
                    $classroutinemodel->save();

                    Helper::trackmessage(auth()->user(), 'Admin Class Routine Update', 'admin_web_classroutine_create', session()->getId(), 'WEB');
                    DB::commit();
                    $this->formreset();
                    $this->resetPage();
                    $this->dispatchBrowserEvent('updatetoast', ['message' => 'Class Routine Updated Successfully!']);

                } else {
                    DB::rollback();
                    $this->dispatchBrowserEvent('warningtoast', ['message' => 'No Changes has been made!']);
                    $this->emit('classroutine_field_focus_trigger');
                }

            } else {
                Classroutine::create($validated)->id;

                foreach (Staff::all() as $eachstaff) {
                    $eachstaff->classroutine()
                        ->sync(Classroutine::where('active', true)
                                ->pluck('id'));
                }

                Helper::trackmessage(auth()->user(), 'Admin Class Routine Create', 'admin_web_classroutine_create', session()->getId(), 'WEB');

                DB::commit();
                $this->formreset();
                $this->resetPage();
                $this->dispatchBrowserEvent('successtoast', ['message' => 'Class Routine Added Successfully!']);
            }

        } catch (Exception $e) {
            $this->exceptionerror('createorupdate', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('createorupdate', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('createorupdate', 'three', $e);
        }

    }

    public function show(Classroutine $classroutine)
    {
        $this->classroutineshowdata = $classroutine;
        $this->classroutineshowmodal();
    }

    public function edit(Classroutine $classroutine)
    {
        $this->name = $classroutine->name;
        $this->start_time = $classroutine->start_time->toTimeString();
        $this->end_time = $classroutine->end_time->toTimeString();
        $this->classroutineid = $classroutine->id;
        $this->is_break = $classroutine->is_break;
    }

    public function deleteconfirm($classroutineid)
    {
        $this->dispatchBrowserEvent('deletetoast', ['classroutineid' => $classroutineid]);
    }

    public function delete(Classroutine $classroutine)
    {
        try {
            DB::beginTransaction();

            $classroutine->delete();
            Helper::trackmessage(auth()->user(), 'Admin Class Routine Delete', 'admin_web_classroutine_delete', session()->getId(), 'WEB');

            DB::commit();
            $this->formreset();
            $this->resetPage();
            $this->dispatchBrowserEvent('deletemsg', ['message' => 'Class Routine Deleted!']);

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
        $this->name = null;
        $this->start_time = null;
        $this->end_time = null;
        $this->is_break = null;
        $this->classroutineid = null;
        $this->resetErrorBag();
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
        $classroutine = Classroutine::query()
            ->where('name', 'like', '%' . $this->searchTerm . '%')
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)->onEachSide(1);

        return view('livewire.admin.settings.academicsettings.classroutine.classroutineliverwire', compact('classroutine'));
    }

    protected function exceptionerror($msg, $type, $e)
    {
        DB::rollback();
        Log::error("SessionID: " . session()->getId() . ' Exception ' . $type . ': admin_web_classroutine_' . $msg . '  Error: ' . $e->getMessage());
        $this->dispatchBrowserEvent('errortoast', ['message' => $e->getMessage()]);
    }
}
