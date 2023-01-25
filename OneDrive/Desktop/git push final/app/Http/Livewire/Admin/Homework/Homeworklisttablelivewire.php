<?php

namespace App\Http\Livewire\Admin\Homework;

use App\Events\Homeworkevent\HomeworklistEvent;
use App\Models\Miscellaneous\Helper;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Homeworklisttablelivewire extends Component
{

    public $user, $eachhomeworklist, $platform;
    public $marks;
    public $homework_status;

    public function mount($eachhomeworklist, $platform)
    {
        $this->platform = $platform;
        $this->eachhomeworklist = $eachhomeworklist;
        if ($platform == "admin") {
            $this->user = auth()->user();
        } elseif ($platform == "staff") {
            $this->user = auth()->guard('staff')->user();
        }
        $this->homework_status = $eachhomeworklist->homework_status;
        $this->marks = $this->eachhomeworklist->marks;

    }

    public function commenttoggle($homeworklist_id)
    {
        $this->emit('isChat', true, $homeworklist_id);
        $this->user
            ->homeworkcommentreceiver()
            ->where('homeworklist_id', $homeworklist_id)
            ->update(['read_at' => Carbon::now()]);
    }

    public function updatedMarks()
    {

        try {
            DB::beginTransaction();

            $this->validate(
                ['marks' => 'required|lte:' . $this->eachhomeworklist->homework->marks],
                [
                    'marks.lte' => 'Invalid mark',
                    'marks.required' => 'Enter the mark',
                ]
            );

            $this->eachhomeworklist->marks = $this->marks;
            $this->eachhomeworklist->save();

            Helper::trackmessage($this->user, 'Homework Mark Update', $this->platform == 'admin' ? 'admin_web_update_homework_mark' : 'staff_web_update_homework_mark', session()->getId(), 'WEB');

            DB::commit();
        } catch (Exception $e) {
            $this->exceptionerror('update homework mark', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('update homework mark', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('update homework mark', 'three', $e);
        }

    }

    public function downloadhomeworksubmission()
    {
        return Storage::download($this->eachhomeworklist->submissionfile);
    }

    public function updatedHomeworkStatus()
    {
        try {
            DB::beginTransaction();
            $this->eachhomeworklist->homework_status = $this->homework_status;
            $this->eachhomeworklist->update(['homework_status' => $this->homework_status, 'staff_homework_status' => 4]);
            Helper::trackmessage($this->user, $this->platform == 'admin' ? 'Admin Homework Status Updated' : 'Staff Homework Status Updated', $this->platform == 'admin' ? 'admin_web_home_work_status' : 'staff_web_home_work_status', session()->getId(), 'WEB');
            $this->emit('summaryrefresh');
            DB::commit();

            event(new HomeworklistEvent($this->eachhomeworklist, $this->user, 'REJECTED'));

        } catch (Exception $e) {
            $this->exceptionerror('homework_status', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('homework_status', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('homework_status', 'three', $e);
        }
    }

    public function render()
    {
        $is_read = $this->user->homeworkcommentreceiver()
            ->where('homeworklist_id', $this->eachhomeworklist->id)
            ->whereNull('read_at')
            ->count() ? true : false;
        return view('livewire.admin.homework.homeworklisttablelivewire', compact('is_read'));
    }
}
