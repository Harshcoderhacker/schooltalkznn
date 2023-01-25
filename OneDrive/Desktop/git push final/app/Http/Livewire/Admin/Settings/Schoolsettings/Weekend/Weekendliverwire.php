<?php

namespace App\Http\Livewire\Admin\Settings\Schoolsettings\Weekend;

use App\Models\Admin\Settings\Schoolsetting\Weekend;
use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Weekendliverwire extends Component
{
    public $searchTerm = null;

    public $sortColumnName = 'id';

    public $sortDirection = 'asc';

    public $isModalOpen = false;

    public $weekendobj;

    public $is_holiday, $isthisholiday = [];

    public function mount()
    {
        $allweekdays = Weekend::all();
        foreach ($allweekdays as $key => $eachday) {
            $this->isthisholiday[$eachday->id] = $eachday->is_holiday;
        }
    }

    public function confrimweekendopenformModal(Weekend $weekendobj)
    {
        $this->weekendobj = $weekendobj;
        $this->isModalOpen = true;
    }

    public function confrimweekendcloseFormModal()
    {
        return redirect()->to('/admin/settings/weekend');
    }

    public function active(Weekend $weekend)
    {
        try {
            DB::beginTransaction();

            $weekend->is_holiday = $weekend->is_holiday ? false : true;
            $weekend->save();
            Helper::trackmessage(auth()->user(), 'Admin weekend Active Status Updated', 'admin_web_weekend_active_status', session()->getId(), 'WEB');

            DB::commit();
            $this->isModalOpen = false;
            $this->dispatchBrowserEvent('successtoast', ['message' => 'Weekend  Updated Successfully!']);
            $this->isthisholiday[$weekend->id] = $weekend->is_holiday;

        } catch (Exception $e) {
            $this->exceptionerror('active_status', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('active_status', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('active_status', 'three', $e);
        }
    }

    public function render()
    {
        $weekend = Weekend::all();

        return view('livewire.admin.settings.schoolsettings.weekend.weekendliverwire', compact('weekend'));

    }

}
