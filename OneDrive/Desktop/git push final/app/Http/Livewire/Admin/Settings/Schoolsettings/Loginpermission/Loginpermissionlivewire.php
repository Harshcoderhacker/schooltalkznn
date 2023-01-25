<?php

namespace App\Http\Livewire\Admin\Settings\Schoolsettings\Loginpermission;

use App\Models\Admin\Settings\Academicsetting\Classmaster;
use App\Models\Admin\Settings\Academicsetting\Section;
use App\Models\Admin\Settings\Staffsetting\Staffdepartment;
use App\Models\Admin\Student\Student;
use App\Models\Miscellaneous\Helper;
use App\Models\Staff\Auth\Staff;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Loginpermissionlivewire extends Component
{
    //Role
    // 1-Student
    // 2-Staff

    public $section, $class, $role;
    public $section_id, $class_id;

    public $classmaster_name, $section_name;

    public $student;

    public $studentorstaffid, $alertmodal = false;

    public $staff, $department, $department_id;

    public function mount()
    {
        $this->section = Section::where('active', true)
            ->get();

        $this->class = Classmaster::where('active', true)
            ->get();

        $this->department = Staffdepartment::where('active', true)
            ->get();
    }

    public function searchrole()
    {
        if ($this->role == 1) {
            $validated = $this->validate([
                'role' => 'required|numeric',
                'class_id' => 'required|numeric',
                'section_id' => 'required|numeric',
            ], [
                'role.required' => "Role is required",
                'role.numeric' => "Role is required",
                'class_id.required' => "Class is required",
                'class_id.numeric' => "Class is required",
                'section_id.numeric' => "Section is required",
                'section_id.required' => "Section is required",
            ]);
            $this->staff = null;
            $student = Student::query()
                ->where('classmaster_id', $this->class_id)
                ->where('section_id', $this->section_id)
                ->get();
            $classmaster_name = Classmaster::find($this->class_id)->name;
            $section_name = Section::find($this->section_id)->name;

            if (sizeof($student) != 0) {
                $this->student = $student;
                $this->classmaster_name = $classmaster_name;
                $this->section_name = $section_name;
            } else {
                $this->student = null;
                $this->classmaster_name = null;
                $this->section_name = null;
            }
        } elseif ($this->role == 2) {
            $validated = $this->validate([
                'role' => 'required|numeric',
                'department_id' => 'required|numeric',
            ], [
                'role.required' => "Role is required",
                'role.numeric' => "Role is required",
                'department_id.required' => "Department is required",
                'department_id.numeric' => "Department is required",
            ]);

            $this->resetErrorBag();
            $this->student = null;
            $this->classmaster_name = null;
            $this->section_name = null;

            $staff = Staff::query()
                ->where('staffdepartment_id', $this->department_id)
                ->get();

            if (sizeof($staff) != 0) {
                $this->staff = $staff;
            } else {
                $this->staff = null;
            }
        }
    }

    public function alertpopup($studentorstaffid)
    {
        $this->alertmodal = true;
        $this->studentorstaffid = $studentorstaffid;
    }

    public function closealertpopup()
    {
        $this->alertmodal = false;
        $this->studentorstaffid = null;
    }

    public function changepassword($studentorstaffid)
    {
        try {
            DB::beginTransaction();
            if ($this->role == 1) {
                $selectedstudent = Student::find($studentorstaffid);
                $selectedstudent->aparent->password = Carbon::parse($selectedstudent->dob)->format('d-m-Y') . substr($selectedstudent->aparent->phone, -4);
                $selectedstudent->aparent->save();
            } elseif ($this->role == 2) {
                $selectedstaff = Staff::find($studentorstaffid);
                $selectedstaff->password = Carbon::parse($selectedstaff->dob)->format('d-m-Y') . substr($selectedstaff->phone, -4);
                $selectedstaff->save();
            }
            Helper::trackmessage(auth()->user(),
                'Admin Password Reset ' . (isset($selectedstudent) ? $selectedstudent->uniqid : $selectedstaff->uniqid),
                'admin_web_student/staff_password_reset',
                session()->getId(),
                'WEB');

            DB::commit();

            $this->closealertpopup();
            $this->dispatchBrowserEvent('successtoast', ['message' => 'Password Reset Done']);

        } catch (Exception $e) {
            $this->exceptionerror('admin_web_password_reset' . ($selectedstudent ? $selectedstudent->uniqid : $selectedstaff->uniqid), 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('admin_web_password_reset' . ($selectedstudent ? $selectedstudent->uniqid : $selectedstaff->uniqid), 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('admin_web_password_reset' . ($selectedstudent ? $selectedstudent->uniqid : $selectedstaff->uniqid), 'three', $e);
        }
    }

    public function render()
    {
        return view('livewire.admin.settings.schoolsettings.loginpermission.loginpermissionlivewire');
    }

    protected function exceptionerror($msg, $type, $e)
    {
        DB::rollback();
        Log::error("SessionID: " . session()->getId() . ' Exception ' . $type . ': admin_web_student/staff_password_reset_' . $msg . '  Error: ' . $e->getMessage());
        $this->dispatchBrowserEvent('errortoast', ['message' => $e->getMessage()]);
    }
}
