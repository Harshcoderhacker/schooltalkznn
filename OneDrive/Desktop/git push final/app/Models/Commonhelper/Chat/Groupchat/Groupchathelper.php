<?php

namespace App\Models\Commonhelper\Chat\Groupchat;

use App\Models\Admin\Auth\User;
use App\Models\Admin\Chat\Chatparticipant;
use App\Models\Admin\Student\Student;
use App\Models\Staff\Auth\Staff;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Groupchathelper extends Model
{

    protected static function adminsync($chatgroup)
    {
        User::isaccountactive()
            ->whereDoesntHave('chatparticipantable', fn(Builder $q) =>
                $q->where('chatgroup_id', $chatgroup->id)
            )->each(fn($eachadmin) =>
            $eachadmin->chatparticipantable()
                ->save(new Chatparticipant(['chatgroup_id' => $chatgroup->id])));

        User::isnotaccountactive()
            ->whereHas('chatparticipantable', fn(Builder $q) =>
                $q->where('chatgroup_id', $chatgroup->id)
            )->each(fn($eachadmin) =>
            $eachadmin->chatparticipantable()->delete());

    }

    protected static function staffsync($chatgroup)
    {
        // Eligible Staff added in group
        Staff::isaccountactive()
            ->whereHas('assignsubject', fn(Builder $q) =>
                $q->where('classmaster_id', $chatgroup->classmaster_id)
                    ->where('section_id', $chatgroup->section_id)
            )
            ->whereDoesntHave('chatparticipantable', fn(Builder $q) =>
                $q->where('chatgroup_id', $chatgroup->id)
            )->each(fn($eachstaff) =>
            $eachstaff->chatparticipantable()
                ->save(new Chatparticipant(['chatgroup_id' => $chatgroup->id])));

        // Remove Inactive Staff
        Staff::isnotaccountactive()
            ->whereHas('assignsubject', fn(Builder $q) =>
                $q->where('classmaster_id', $chatgroup->classmaster_id)
                    ->where('section_id', $chatgroup->section_id)
            )
            ->whereHas('chatparticipantable', fn(Builder $q) =>
                $q->where('chatgroup_id', $chatgroup->id)
            )->each(fn($eachstaff) =>
            $eachstaff->chatparticipantable()->delete());

        // Remove Not mapped Staff
        Staff::whereHas('chatparticipantable', fn(Builder $q) =>
            $q->where('chatgroup_id', $chatgroup->id)
        )->whereDoesntHave('assignsubject', fn(Builder $q) =>
            $q->where('classmaster_id', $chatgroup->classmaster_id)
                ->where('section_id', $chatgroup->section_id)
        )->each(fn($eachstaff) =>
            $eachstaff->chatparticipantable()->delete());

    }

    protected static function studentsync($chatgroup)
    {
        // Eligible Student added in group
        Student::isaccountactive()
            ->where('classmaster_id', $chatgroup->classmaster_id)
            ->where('section_id', $chatgroup->section_id)
            ->whereDoesntHave('chatparticipantable', fn(Builder $q) =>
                $q->where('chatgroup_id', $chatgroup->id)
            )->each(fn($eachstudent) =>
            $eachstudent->chatparticipantable()->save(new Chatparticipant(['chatgroup_id' => $chatgroup->id])));

        // Remove Inactive Student
        Student::isnotaccountactive()
            ->where('classmaster_id', $chatgroup->classmaster_id)
            ->where('section_id', $chatgroup->section_id)
            ->whereHas('chatparticipantable', fn(Builder $q) =>
                $q->where('chatgroup_id', $chatgroup->id)
            )->each(fn($eachstudent) =>
            $eachstudent->chatparticipantable()->delete());

        // Remove Not mapped Student
        Student::whereHas('chatparticipantable', fn(Builder $q) =>
            $q->where('chatgroup_id', $chatgroup->id)
                ->where(fn($q) => $q->where('classmaster_id', '<>', $chatgroup->classmaster_id)
                        ->orWhere('section_id', '<>', $chatgroup->section_id))

        )->each(fn($eachstudent) =>
            $eachstudent->chatparticipantable()->delete());

    }

    protected static function staffsubjectwisesync($chatgroup)
    {

        // Eligible Staff added in group
        Staff::isaccountactive()
            ->whereHas('assignsubject', fn(Builder $q) =>
                $q->where('classmaster_id', $chatgroup->classmaster_id)
                    ->where('section_id', $chatgroup->section_id)
                    ->where('subject_id', $chatgroup->subject_id)
            )
            ->whereDoesntHave('chatparticipantable', fn(Builder $q) =>
                $q->where('chatgroup_id', $chatgroup->id)
            )->each(fn($eachstaff) =>
            $eachstaff->chatparticipantable()
                ->save(new Chatparticipant(['chatgroup_id' => $chatgroup->id])));

        // Remove Inactive Staff
        Staff::isnotaccountactive()
            ->whereHas('assignsubject', fn(Builder $q) =>
                $q->where('classmaster_id', $chatgroup->classmaster_id)
                    ->where('section_id', $chatgroup->section_id)
                    ->where('subject_id', $chatgroup->subject_id)
            )
            ->whereHas('chatparticipantable', fn(Builder $q) =>
                $q->where('chatgroup_id', $chatgroup->id)
            )->each(fn($eachstaff) =>
            $eachstaff->chatparticipantable()->delete());

        // Remove Not mapped Staff
        Staff::whereHas('chatparticipantable', fn(Builder $q) =>
            $q->where('chatgroup_id', $chatgroup->id)
        )->whereDoesntHave('assignsubject', fn(Builder $q) =>
            $q->where('classmaster_id', $chatgroup->classmaster_id)
                ->where('section_id', $chatgroup->section_id)
                ->where('subject_id', $chatgroup->subject_id)
        )->each(fn($eachstaff) =>
            $eachstaff->chatparticipantable()->delete());

    }
}
