<?php

namespace App\Models\Commonhelper\Chat\Groupchat;

use App\Models\Admin\Chat\Chatgroup;
use App\Models\Admin\Settings\Academicsetting\Subject;
use App\Models\Admin\Student\Student;
use App\Models\Staff\Auth\Staff;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Staffchatstudentonetoone extends Model
{

    public static function staffchatstudentgroup()
    {
        foreach (Staff::isaccountactive()->get() as $eachstaff) {
            foreach (Student::isaccountactive()->get() as $eachstudent) {

                $assignsubjectlist = $eachstaff->assignsubject()
                    ->getsubjectlist($eachstudent->classmaster_id, $eachstudent->section_id)
                    ->get();

                $chatgroup = $eachstaff->chatgroup()
                    ->where('chattype', 3)
                    ->whereHas('chatparticipant', fn(Builder $q) =>
                        $q->whereHasMorph('chatparticipantable', '*', fn(Builder $q) =>
                            $q->where('chatparticipantable_type', 'App\Models\Admin\Student\Student')
                                ->where('id', $eachstudent->id)))
                    ->first();

                $chatgroup ? $chatgroup->update([
                    'groupname' => $assignsubjectlist->count() ? implode(',', Subject::whereIn('id', $assignsubjectlist->pluck('subject_id'))->pluck('name')->toArray()) : null,
                    'is_groupactive' => $assignsubjectlist->count() ? true : false,
                    'classmaster_id' => $eachstudent->classmaster_id,
                    'section_id' => $eachstudent->section_id,
                    'subject_pluck' => $assignsubjectlist->count() ? $assignsubjectlist->pluck('subject_id') : null,
                    'assignsubject_pluck' => $assignsubjectlist->count() ? $assignsubjectlist->pluck('id') : null,
                    'staff_pluck' => $assignsubjectlist->count() ? $assignsubjectlist->pluck('staff_id') : null,
                    'staff_id' => $eachstaff->id,
                ]) : null;

                if (!$chatgroup) {
                    $chatgroupobj = Chatgroup::create([
                        'groupname' => $assignsubjectlist->count() ? implode(',', Subject::whereIn('id', $assignsubjectlist->pluck('subject_id'))->pluck('name')->toArray()) : null,
                        'shortname' => ' Staff Student',
                        'chattype' => 3, // STUDENTONETOONE
                        'classmaster_id' => $eachstudent->classmaster_id,
                        'section_id' => $eachstudent->section_id,
                        'subject_pluck' => $assignsubjectlist->count() ? $assignsubjectlist->pluck('subject_id') : null,
                        'assignsubject_pluck' => $assignsubjectlist->count() ? $assignsubjectlist->pluck('id') : null,
                        'staff_pluck' => $assignsubjectlist->count() ? $assignsubjectlist->pluck('staff_id') : null,
                        'staff_id' => $eachstaff->id,
                    ]);

                    $chatgroupobj->chatparticipant()->make()->chatparticipantable()->associate($eachstaff)->save();
                    $chatgroupobj->chatparticipant()->make()->chatparticipantable()->associate($eachstudent)->save();
                }
            }
        }
    }

}
