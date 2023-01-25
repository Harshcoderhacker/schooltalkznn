<?php

namespace App\Http\Livewire\Admin\Settings\Schoolsettings\Field;

use App\Models\Admin\Settings\Schoolsetting\Field;
use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class Fieldliverwire extends Component
{
    use WithPagination;

    public $fieldid, $name, $field_type, $field_for;

    public $searchTerm = null;

    public $sortColumnName = 'created_at';

    public $sortDirection = 'desc';

    public $paginationlength = 10;

    public $fieldshowdata;

    public $isshowmodalopen = false;

    public function fieldshowmodal()
    {
        $this->isshowmodalopen = true;
    }
    public function fieldclosemodal()
    {
        $this->isshowmodalopen = false;
        $this->fieldshowdata = [];
    }

    protected function rules()
    {
        return [
            'name' => 'required|min:1|max:35',
            'field_type' => 'required',
            'field_for' => 'required',
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

            if ($this->fieldid) {
                $fieldmodel = Field::find($this->fieldid);

                $fieldmodel->name = $this->name;
                $fieldmodel->field_type = $this->field_type;
                $fieldmodel->field_for = $this->field_for;

                if ($fieldmodel->isDirty()) {
                    $fieldmodel->save();

                    Helper::trackmessage(auth()->user(), 'Admin Field Update', 'admin_web_field_create', session()->getId(), 'WEB');
                    DB::commit();
                    $this->formreset();
                    $this->resetPage();
                    $this->dispatchBrowserEvent('updatetoast', ['message' => 'Field Updated Successfully!']);

                } else {
                    DB::rollback();
                    $this->dispatchBrowserEvent('warningtoast', ['message' => 'No Changes has been made!']);
                    $this->emit('field_field_focus_trigger');
                }
            } else {
                Field::create($validated);
                Helper::trackmessage(auth()->user(), 'Admin Field Create', 'admin_web_field_create', session()->getId(), 'WEB');

                DB::commit();
                $this->formreset();
                $this->resetPage();
                $this->dispatchBrowserEvent('successtoast', ['message' => 'Field Added Successfully!']);
            }

        } catch (Exception $e) {
            $this->exceptionerror('createorupdate', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('createorupdate', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('createorupdate', 'three', $e);
        }

    }

    public function show(Field $field)
    {
        $this->fieldshowdata = $field;
        $this->fieldshowmodal();
    }

    public function edit(Field $field)
    {
        $this->name = $field->name;
        $this->field_type = $field->field_type;
        $this->field_for = $field->field_for;
        $this->fieldid = $field->id;
        $this->emit('field_field_focus_trigger');
    }

    public function deleteconfirm($fieldid)
    {
        $this->dispatchBrowserEvent('deletetoast', ['fieldid' => $fieldid]);
    }

    public function delete(Field $field)
    {

        try {
            DB::beginTransaction();

            $field->delete();
            Helper::trackmessage(auth()->user(), 'Admin Field Delete', 'admin_web_field_delete', session()->getId(), 'WEB');

            DB::commit();
            $this->formreset();
            $this->resetPage();
            $this->dispatchBrowserEvent('deletemsg', ['message' => 'Field Deleted!']);

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
        $this->field_type = null;
        $this->field_for = null;
        $this->fieldid = null;
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
        $field = Field::query()
            ->where('name', 'like', '%' . $this->searchTerm . '%')
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)->onEachSide(1);

        return view('livewire.admin.settings.schoolsettings.field.fieldliverwire', compact('field'));
    }

    protected function exceptionerror($msg, $type, $e)
    {
        DB::rollback();
        Log::error("SessionID: " . session()->getId() . ' Exception ' . $type . ': admin_web_field_' . $msg . '  Error: ' . $e->getMessage());
        $this->dispatchBrowserEvent('errortoast', ['message' => $e->getMessage()]);
    }
}
