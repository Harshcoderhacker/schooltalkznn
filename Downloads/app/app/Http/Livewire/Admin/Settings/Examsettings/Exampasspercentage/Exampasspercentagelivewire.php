<?php

namespace App\Http\Livewire\Admin\Settings\Examsettings\Exampasspercentage;

use App\Models\Admin\Settings\Examsetting\Exampasspercentage;
use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class Exampasspercentagelivewire extends Component
{

    use WithPagination;

    public $passpercentageid, $pass_percentage;

    public $searchTerm = null;

    public $sortColumnName = 'created_at';

    public $sortDirection = 'desc';

    public $paginationlength = 10;

    public $sectionshowdata;

    public $percentagebtn = true;

    protected function rules()
    {
        return [
            'pass_percentage' => 'required|integer|unique:exampasspercentages,pass_percentage,' . $this->passpercentageid,
        ];
    }

    public function updated($propertyName)
    {
        $this->percentagebtn = true;
        $this->validateOnly($propertyName);
        $this->percentagebtn = false;
    }

    public function createorupdate()
    {
        try {
            DB::beginTransaction();

            $validated = $this->validate();
            $user = auth()->user();
            $passpercentagemodel = Exampasspercentage::where('active', true)->get();
            if (sizeof($passpercentagemodel) > 0) {
                $passpercentagemodel->first()->update(['pass_percentage' => $this->pass_percentage]);
                Helper::trackmessage(auth()->user(), 'Admin Pass Percentage Update', 'admin_web_pass_percentage_create', session()->getId(), 'WEB');
                DB::commit();
                $this->formreset();
                $this->resetPage();
                $this->dispatchBrowserEvent('updatetoast', ['message' => 'Pass Percentage Updated Successfully!']);
            } else {
                Exampasspercentage::create(['pass_percentage' => $this->pass_percentage]);
                Helper::trackmessage(auth()->user(), 'Admin Pass Percentage Create', 'admin_web_pass_percentage_create', session()->getId(), 'WEB');

                DB::commit();
                $this->formreset();
                $this->resetPage();
                $this->dispatchBrowserEvent('successtoast', ['message' => 'Pass Percentage Added Successfully!']);
            }
            // if ($this->passpercentageid) {
            //     $passpercentagemodel = Exampasspercentage::find($this->passpercentageid);

            //     $passpercentagemodel->pass_percentage = $this->pass_percentage;

            //     if ($passpercentagemodel->isDirty()) {
            //         $passpercentagemodel->save();

            //         Helper::trackmessage(auth()->user(), 'Admin Pass Percentage Update', 'admin_web_pass_percentage_create', session()->getId(), 'WEB');
            //         DB::commit();
            //         $this->formreset();
            //         $this->resetPage();
            //         $this->dispatchBrowserEvent('updatetoast', ['message' => 'Pass Percentage Updated Successfully!']);

            //     } else {
            //         DB::rollback();
            //         $this->dispatchBrowserEvent('warningtoast', ['message' => 'No Changes has been made!']);
            //     }
            // } else {
            //     Exampasspercentage::create($validated);
            //     Helper::trackmessage(auth()->user(), 'Admin Pass Percentage Create', 'admin_web_pass_percentage_create', session()->getId(), 'WEB');

            //     DB::commit();
            //     $this->formreset();
            //     $this->resetPage();
            //     $this->dispatchBrowserEvent('successtoast', ['message' => 'Pass Percentage Added Successfully!']);
            // }

            $this->percentagebtn = true;

        } catch (Exception $e) {
            $this->exceptionerror('createorupdate', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('createorupdate', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('createorupdate', 'three', $e);
        }

    }

    public function edit(Exampasspercentage $passpercentage)
    {
        $this->pass_percentage = $passpercentage->pass_percentage;
        $this->passpercentageid = $passpercentage->id;
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
        $this->pass_percentage = null;
        $this->passpercentageid = null;
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
        $passpercentage = Exampasspercentage::query()
            ->where('pass_percentage', 'like', '%' . $this->searchTerm . '%')
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)->onEachSide(1);

        return view('livewire.admin.settings.examsettings.exampasspercentage.exampasspercentagelivewire', compact('passpercentage'));
    }

    protected function exceptionerror($msg, $type, $e)
    {
        DB::rollback();
        Log::error("SessionID: " . session()->getId() . ' Exception ' . $type . ': admin_web_passpercentage_' . $msg . '  Error: ' . $e->getMessage());
        $this->dispatchBrowserEvent('errortoast', ['message' => $e->getMessage()]);
    }

}
