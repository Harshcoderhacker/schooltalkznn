<?php

namespace App\Http\Livewire\Admin\Settings\Frontdesksettings\Source;

use App\Models\Admin\Settings\Frontdesksetting\Source;
use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class Sourceliverwire extends Component
{
    use WithPagination;

    public $sourceid, $name;

    public $searchTerm = null;

    public $sortColumnName = 'created_at';

    public $sortDirection = 'desc';

    public $paginationlength = 10;

    public $sourcesubmitbtn = true;

    public $sourceshowdata;

    public $isshowmodalopen = false;

    public function sourceshowmodal()
    {
        $this->isshowmodalopen = true;
    }
    public function sourceclosemodal()
    {
        $this->isshowmodalopen = false;
        $this->sourceshowdata = [];
    }

    protected function rules()
    {
        return [
            'name' => 'required|min:1|max:35|unique:sources,name,' . $this->sourceid,
        ];
    }

    public function updated($propertyName)
    {
        $this->sourcesubmitbtn = true;
        $this->validateOnly($propertyName);
        $this->sourcesubmitbtn = false;
    }

    public function createorupdate()
    {
        try {
            DB::beginTransaction();

            $validated = $this->validate();
            $user = auth()->user();

            if ($this->sourceid) {
                $sourcemodel = Source::find($this->sourceid);

                $sourcemodel->name = $this->name;

                if ($sourcemodel->isDirty()) {
                    $sourcemodel->save();

                    Helper::trackmessage(auth()->user(), 'Admin Source Update', 'admin_web_source_create', session()->getId(), 'WEB');
                    DB::commit();
                    $this->formreset();
                    $this->resetPage();
                    $this->dispatchBrowserEvent('updatetoast', ['message' => 'Source Updated Successfully!']);

                } else {
                    DB::rollback();
                    $this->dispatchBrowserEvent('warningtoast', ['message' => 'No Changes has been made!']);
                    $this->emit('source_field_focus_trigger');
                }
            } else {
                Source::create($validated);
                Helper::trackmessage(auth()->user(), 'Admin Source Create', 'admin_web_source_create', session()->getId(), 'WEB');

                DB::commit();
                $this->formreset();
                $this->resetPage();
                $this->dispatchBrowserEvent('successtoast', ['message' => 'Source Added Successfully!']);
            }
            $this->sourcesubmitbtn = true;

        } catch (Exception $e) {
            $this->exceptionerror('createorupdate', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('createorupdate', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('createorupdate', 'three', $e);
        }

    }

    public function show(Source $source)
    {
        $this->sourceshowdata = $source;
        $this->sourceshowmodal();
    }

    public function edit(Source $source)
    {
        $this->name = $source->name;
        $this->sourceid = $source->id;
        $this->emit('source_field_focus_trigger');
    }

    public function deleteconfirm($sourceid)
    {
        $this->dispatchBrowserEvent('deletetoast', ['sourceid' => $sourceid]);
    }

    public function delete(Source $source)
    {
        try {
            DB::beginTransaction();

            $source->delete();
            Helper::trackmessage(auth()->user(), 'Admin Source Delete', 'admin_web_source_delete', session()->getId(), 'WEB');

            DB::commit();
            $this->formreset();
            $this->resetPage();
            $this->dispatchBrowserEvent('deletemsg', ['message' => 'Source Deleted!']);

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
        $this->sourceid = null;
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
        $source = Source::query()
            ->where('name', 'like', '%' . $this->searchTerm . '%')
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)->onEachSide(1);

        return view('livewire.admin.settings.frontdesksettings.source.sourceliverwire', compact('source'));
    }

    protected function exceptionerror($msg, $type, $e)
    {
        DB::rollback();
        Log::error("SessionID: " . session()->getId() . ' Exception ' . $type . ': admin_web_source_' . $msg . '  Error: ' . $e->getMessage());
        $this->dispatchBrowserEvent('errortoast', ['message' => $e->getMessage()]);
    }
}
