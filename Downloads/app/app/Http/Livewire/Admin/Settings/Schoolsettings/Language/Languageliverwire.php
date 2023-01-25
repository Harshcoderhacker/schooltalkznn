<?php

namespace App\Http\Livewire\Admin\Settings\Schoolsettings\Language;

use App\Models\Admin\Settings\Schoolsetting\Language;
use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class Languageliverwire extends Component
{
    use WithPagination;

    public $languageid, $name;

    public $searchTerm = null;

    public $sortColumnName = 'created_at';

    public $sortDirection = 'desc';

    public $paginationlength = 10;

    public $languagesubmitbtn = true;

    public $languageshowdata;

    public $isshowmodalopen = false;

    public function languageshowmodal()
    {
        $this->isshowmodalopen = true;
    }
    public function languageclosemodal()
    {
        $this->isshowmodalopen = false;
        $this->languageshowdata = [];
    }

    protected function rules()
    {
        return [
            'name' => 'required|min:1|max:35|unique:languages,name,' . $this->languageid,
        ];
    }

    public function updated($propertyName)
    {
        $this->languagesubmitbtn = true;
        $this->validateOnly($propertyName);
        $this->languagesubmitbtn = false;
    }

    public function createorupdate()
    {
        try {
            DB::beginTransaction();

            $validated = $this->validate();
            $user = auth()->user();

            if ($this->languageid) {
                $languagemodel = Language::find($this->languageid);

                $languagemodel->name = $this->name;

                if ($languagemodel->isDirty()) {
                    $languagemodel->save();

                    Helper::trackmessage(auth()->user(), 'Admin Language Update', 'admin_web_language_create', session()->getId(), 'WEB');
                    DB::commit();
                    $this->formreset();
                    $this->resetPage();
                    $this->dispatchBrowserEvent('updatetoast', ['message' => 'Language Updated Successfully!']);

                } else {
                    DB::rollback();
                    $this->dispatchBrowserEvent('warningtoast', ['message' => 'No Changes has been made!']);
                    $this->emit('language_field_focus_trigger');
                }
            } else {
                Language::create($validated);
                Helper::trackmessage(auth()->user(), 'Admin Language Create', 'admin_web_language_create', session()->getId(), 'WEB');

                DB::commit();
                $this->formreset();
                $this->resetPage();
                $this->dispatchBrowserEvent('successtoast', ['message' => 'Language Added Successfully!']);
            }
            $this->languagesubmitbtn = true;

        } catch (Exception $e) {
            $this->exceptionerror('createorupdate', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('createorupdate', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('createorupdate', 'three', $e);
        }

    }

    public function show(Language $language)
    {
        $this->languageshowdata = $language;
        $this->languageshowmodal();
    }

    public function edit(Language $language)
    {
        $this->name = $language->name;
        $this->languageid = $language->id;
        $this->emit('language_field_focus_trigger');
    }

    public function deleteconfirm($languageid)
    {
        $this->dispatchBrowserEvent('deletetoast', ['languageid' => $languageid]);
    }

    public function delete(Language $language)
    {
        try {
            DB::beginTransaction();

            $language->delete();
            Helper::trackmessage(auth()->user(), 'Admin Language Delete', 'admin_web_language_delete', session()->getId(), 'WEB');

            DB::commit();
            $this->formreset();
            $this->resetPage();
            $this->dispatchBrowserEvent('deletemsg', ['message' => 'Language Deleted!']);

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
        $this->languageid = null;
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

    public function changedefault(Language $language)
    {
        try {
            DB::beginTransaction();

            Language::where('is_default', true)
                ->update([
                    'is_default' => false,
                ]);

            $language->is_default = true;
            $language->save();
            Helper::trackmessage(auth()->user(), 'Admin Language Default', 'admin_web_language_default', session()->getId(), 'WEB');

            DB::commit();
            $this->formreset();
            $this->resetPage();
            $this->dispatchBrowserEvent('successtoast', ['message' => 'Default Language Changed!']);

        } catch (Exception $e) {
            $this->exceptionerror('delete', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('delete', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('delete', 'three', $e);
        }
    }

    public function render()
    {
        $language = Language::query()
            ->where('name', 'like', '%' . $this->searchTerm . '%')
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)->onEachSide(1);

        return view('livewire.admin.settings.schoolsettings.language.languageliverwire', compact('language'));
    }

    protected function exceptionerror($msg, $type, $e)
    {
        DB::rollback();
        Log::error("SessionID: " . session()->getId() . ' Exception ' . $type . ': admin_web_language_' . $msg . '  Error: ' . $e->getMessage());
        $this->dispatchBrowserEvent('errortoast', ['message' => $e->getMessage()]);
    }

}
