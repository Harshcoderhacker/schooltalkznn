<?php

namespace App\Http\Livewire\Admin\Settings\Broadcast\Fcmpushnotification;

use App\Events\FCMbroadcastevent\FcmpushnotificationEvent;
use App\Models\Admin\Settings\Broadcast\Fcmpushnotification;
use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class Fcmpushnotificationliverwire extends Component
{

    use WithPagination;

    public $fcmpushnotificationid, $title, $body;
    public $is_admin = false;
    public $is_staff = false;
    public $is_student = false;

    public $searchTerm = null;

    public $sortColumnName = 'created_at';

    public $sortDirection = 'desc';

    public $paginationlength = 10;

    public $fcmpushnotificationsubmitbtn = true;

    public $fcmpushnotificationshowdata;

    public $isshowmodalopen = false;

    public function fcmpushnotificationshowmodal()
    {
        $this->isshowmodalopen = true;
    }
    public function fcmpushnotificationclosemodal()
    {
        $this->isshowmodalopen = false;
        $this->fcmpushnotificationshowdata = [];
    }

    protected function rules()
    {
        return [
            'title' => 'required|min:3|max:45|unique:fcmpushnotifications,title,' . $this->fcmpushnotificationid,
            'body' => 'required|min:1|max:85',
            'is_admin' => 'nullable|boolean',
            'is_staff' => 'nullable|boolean',
            'is_student' => 'nullable|boolean',
        ];
    }

    public function updated($propertyName)
    {
        $this->fcmpushnotificationsubmitbtn = true;
        $this->validateOnly($propertyName);
        $this->fcmpushnotificationsubmitbtn = false;
    }

    public function createorupdate()
    {
        try {
            DB::beginTransaction();

            $validated = $this->validate();
            $user = auth()->user();

            if ($this->fcmpushnotificationid) {
                $fcmpushnotificationmodel = Fcmpushnotification::find($this->fcmpushnotificationid);

                $fcmpushnotificationmodel->title = $this->title;

                if ($fcmpushnotificationmodel->isDirty()) {
                    $fcmpushnotificationmodel->save();

                    Helper::trackmessage(auth()->user(), 'Admin Fcmpushnotification Update', 'admin_web_fcmpushnotification_create', session()->getId(), 'WEB');
                    DB::commit();
                    $this->formreset();
                    $this->resetPage();
                    $this->dispatchBrowserEvent('updatetoast', ['message' => 'Fcmpushnotification Updated Successfully!']);

                } else {
                    DB::rollback();
                    $this->dispatchBrowserEvent('warningtoast', ['message' => 'No Changes has been made!']);
                    $this->emit('fcmpushnotification_field_focus_trigger');
                }
            } else {

                event(new FcmpushnotificationEvent(Fcmpushnotification::create($validated)));

                Helper::trackmessage(auth()->user(), 'Admin Fcmpushnotification Create', 'admin_web_fcmpushnotification_create', session()->getId(), 'WEB');

                DB::commit();
                $this->formreset();
                $this->resetPage();
                $this->dispatchBrowserEvent('successtoast', ['message' => 'Fcmpushnotification Added Successfully!']);
            }
            $this->fcmpushnotificationsubmitbtn = true;

        } catch (Exception $e) {
            $this->exceptionerror('createorupdate', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('createorupdate', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('createorupdate', 'three', $e);
        }

    }

    public function show(Fcmpushnotification $fcmpushnotification)
    {
        $this->fcmpushnotificationshowdata = $fcmpushnotification;
        $this->fcmpushnotificationshowmodal();
    }

    public function edit(Fcmpushnotification $fcmpushnotification)
    {
        $this->title = $fcmpushnotification->title;
        $this->body = $fcmpushnotification->body;
        $this->is_admin = $fcmpushnotification->is_admin;
        $this->is_staff = $fcmpushnotification->is_staff;
        $this->is_student = $fcmpushnotification->is_student;

        $this->fcmpushnotificationid = $fcmpushnotification->id;
        $this->emit('fcmpushnotification_field_focus_trigger');
    }

    public function deleteconfirm($fcmpushnotificationid)
    {
        $this->dispatchBrowserEvent('deletetoast', ['fcmpushnotificationid' => $fcmpushnotificationid]);
    }

    public function delete(Fcmpushnotification $fcmpushnotification)
    {
        try {
            DB::beginTransaction();

            $fcmpushnotification->delete();
            Helper::trackmessage(auth()->user(), 'Admin Fcmpushnotification Delete', 'admin_web_fcmpushnotification_delete', session()->getId(), 'WEB');

            DB::commit();
            $this->formreset();
            $this->resetPage();
            $this->dispatchBrowserEvent('deletemsg', ['message' => 'Fcmpushnotification Deleted!']);

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
        $this->title = null;
        $this->body = null;

        $this->is_admin = false;
        $this->is_staff = false;
        $this->is_student = false;

        $this->fcmpushnotificationid = null;
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
        $fcmpushnotification = Fcmpushnotification::query()
            ->where('title', 'like', '%' . $this->searchTerm . '%')
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)->onEachSide(1);

        return view('livewire.admin.settings.broadcast.fcmpushnotification.fcmpushnotificationliverwire', compact('fcmpushnotification'));
    }

    protected function exceptionerror($msg, $type, $e)
    {
        DB::rollback();
        Log::error("SessionID: " . session()->getId() . ' Exception ' . $type . ': admin_web_fcmpushnotification_' . $msg . '  Error: ' . $e->getMessage());
        $this->dispatchBrowserEvent('errortoast', ['message' => $e->getMessage()]);
    }

}
