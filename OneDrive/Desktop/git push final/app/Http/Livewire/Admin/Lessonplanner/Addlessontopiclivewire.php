<?php

namespace App\Http\Livewire\Admin\Lessonplanner;

use App\Models\Admin\Lessonplanner\Lesson;
use App\Models\Admin\Lessonplanner\Lessontopic;
use App\Models\Admin\Settings\Academicsetting\Assignsubject;
use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Addlessontopiclivewire extends Component
{
    public $name, $lesson_id, $lessontopicid;
    public $lessonlist, $assignsubject;
    public $user;

    protected $rules = [
        'name' => 'required',
        'lesson_id' => 'required',
    ];

    protected $messages = [
        'name.required' => 'Name is required.',
        'lesson_id.required' => 'Select lesson.',
    ];

    public function mount($user, $lessonlist, Assignsubject $assignsubject)
    {
        $this->user = $user;
        $this->lessonlist = $lessonlist;
        $this->assignsubject = $assignsubject;
    }

    public function lessontopicstore()
    {
        $validated_data = $this->validate();
        try {
            DB::beginTransaction();
            if (!empty($this->lessontopicid)) {
                $lessontopic = Lessontopic::find($this->lessontopicid);
                $lessontopic->update($validated_data);
            } else {
                $this->user
                    ->lessontopic()
                    ->save(new Lessontopic($validated_data));
            }

            Helper::trackmessage(auth()->user(), 'Admin Lesson topic Create/Edit', 'admin_web_lessontopic_create/edit', session()->getId(), 'WEB');
            DB::commit();
            $this->resefields();
            $this->dispatchBrowserEvent('successtoast', ['message' => 'Lesson topic Created!']);
            // redirect()->route('adminplanlesson');

        } catch (Exception $e) {
            $this->exceptionerror('lessontopicstore', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('lessontopicstore', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('lessontopicstore', 'three', $e);
        }
    }

    public function editlessontopic(Lessontopic $lessontopic)
    {
        $this->lessontopicid = $lessontopic->id;
        $this->name = $lessontopic->name;
        $this->lesson_id = $lessontopic->lesson_id;
    }

    public function deleteconfirm($lessontopicuuid)
    {
        $this->dispatchBrowserEvent('deletetoast', ['uuid' => $lessontopicuuid]);
    }

    public function delete($lessontopicuuid)
    {
        try {
            DB::beginTransaction();

            Lessontopic::where('uuid', $lessontopicuuid)->delete();
            Helper::trackmessage(auth()->user(), 'Admin Lesson Topic Delete', 'admin_web_lessontopic_delete', session()->getId(), 'WEB');

            DB::commit();
            $this->resefields();
            $this->dispatchBrowserEvent('deletemsg', ['message' => 'Lesson Topic Deleted!']);

        } catch (Exception $e) {
            $this->exceptionerror('deletelessontopic', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('deletelessontopic', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('deletelessontopic', 'three', $e);
        }
    }

    public function resefields()
    {
        $this->name = '';
        $this->lesson_id = '';
    }

    protected function exceptionerror($msg, $type, $e)
    {
        DB::rollback();
        Log::error("SessionID: " . session()->getId() . ' Exception ' . $type . ': admin_web_lessontopic_' . $msg . '  Error: ' . $e->getMessage());
        $this->dispatchBrowserEvent('errortoast', ['message' => $e->getMessage()]);
    }

    public function render()
    {
        $lesson = Lesson::whereHas('lessontopic')
            ->where(fn($query) => $query->where('classmaster_id', $this->assignsubject->classmaster_id))
            ->where(fn($query) => $query->where('section_id', $this->assignsubject->section_id))
            ->where(fn($query) => $query->where('section_id', $this->assignsubject->id))->get();
        return view('livewire.admin.lessonplanner.addlessontopiclivewire', compact('lesson'));
    }
}
