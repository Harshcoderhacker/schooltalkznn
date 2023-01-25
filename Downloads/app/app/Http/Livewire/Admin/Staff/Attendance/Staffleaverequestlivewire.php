<?php

namespace App\Http\Livewire\Admin\Staff\Attendance;

use App\Models\Admin\Staff\Leave\Staffleaverequest;
use App\Models\Miscellaneous\Helper;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Staffleaverequestlivewire extends Component
{
    use WithPagination;

    public $paginationlength = 10;

    public $leaverequestshowdata, $leaverequestid;

    public $is_approved;
    public $approvestatus, $panel;
    public $diff;
    public $isshowmodalopen = false;

    public function mount($panel)
    {
        $this->panel = $panel;
        if ($panel == "pending") {
            $this->approvestatus = null;
        } elseif ($panel == "approved") {
            $this->approvestatus = true;
        } elseif ($panel == "decline") {
            $this->approvestatus = false;
        }
    }

    public function leaverequestshowmodal()
    {
        $this->isshowmodalopen = true;
    }
    public function leaverequestclosemodal()
    {
        $this->isshowmodalopen = false;
        $this->leaverequestshowdata = [];
    }

    public function openleaverequestmodal(Staffleaverequest $staffleaverequest)
    {
        $this->leaverequestshowdata = $staffleaverequest;
        $this->leaverequestid = $staffleaverequest->id;
        $this->is_approved = $staffleaverequest->is_approved;
        $from_date = Carbon::parse($staffleaverequest->from_date);
        $to_date = Carbon::parse($staffleaverequest->to_date);
        $this->diff = $to_date->diffInDays($from_date) + 1;

        $this->leaverequestshowmodal();
    }

    public function approveleave(Staffleaverequest $staffleaverequest)
    {
        try {
            DB::beginTransaction();
            $this->validate([
                'is_approved' => 'required|integer',
            ], [
                'is_approved.required' => 'Select Approval Status',
                'is_approved.integer' => 'Select Approval Status',
            ]);
            $user = auth()->user();
            $staffleaverequest->is_approved = $this->is_approved;
            $staffleaverequest->save();
            Helper::trackmessage(auth()->user(), 'Admin Leave Pending ', 'admin_web_staff_leave_request', session()->getId(), 'WEB');
            DB::commit();
            $this->dispatchBrowserEvent('successtoast', ['message' => 'Leave Approval Status Updated!']);
            $this->leaverequestclosemodal();

        } catch (Exception $e) {
            $this->exceptionerror('createorupdate', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('createorupdate', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('createorupdate', 'three', $e);
        }
    }

    public function updatepagination()
    {
        $this->resetPage();
    }

    public function render()
    {
        $staffleaverequest = Staffleaverequest::where('active', true)
            ->where('is_approved', $this->approvestatus)
            ->latest()
            ->paginate($this->paginationlength)->onEachSide(1);
        return view('livewire.admin.staff.attendance.staffleaverequestlivewire', compact('staffleaverequest'));
    }
}
