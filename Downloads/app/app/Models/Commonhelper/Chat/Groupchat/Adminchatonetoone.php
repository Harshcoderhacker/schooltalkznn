<?php

namespace App\Models\Commonhelper\Chat\Groupchat;

use App\Models\Admin\Auth\User;
use App\Models\Admin\Chat\Chatgroup;
use App\Models\Admin\Student\Student;
use App\Models\Staff\Auth\Staff;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Adminchatonetoone extends Model
{

    public static function adminchatwithstaffandstudentgroup()
    {
        foreach (User::isaccountactive()->get() as $eachadmin) {
            foreach (Staff::isaccountactive()->get() as $eachstaff) {

                $chatgroup = $eachadmin->chatgroup()
                    ->where('chattype', 4)
                    ->whereHas('chatparticipant', fn(Builder $q) =>
                        $q->whereHasMorph('chatparticipantable', '*', fn(Builder $q) =>
                            $q->where('chatparticipantable_type', 'App\Models\Staff\Auth\Staff')
                                ->where('id', $eachstaff->id)))
                    ->first();

                $chatgroup ? $chatgroup->update(['is_groupactive' => true]) : null;

                if (!$chatgroup) {
                    $chatgroupobj = Chatgroup::create([
                        'groupname' => ' Admin Staff',
                        'shortname' => ' Admin Staff',
                        'chattype' => 4, // STAFFONETOONE
                    ]);
                    $chatgroupobj->chatparticipant()->make()->chatparticipantable()->associate($eachadmin)->save();
                    $chatgroupobj->chatparticipant()->make()->chatparticipantable()->associate($eachstaff)->save();
                }
            }
        }

        foreach (User::isaccountactive()->get() as $eachadmin) {
            foreach (Student::isaccountactive()->get() as $eachstudent) {

                $chatgroup = $eachadmin->chatgroup()
                    ->where('chattype', 5)
                    ->whereHas('chatparticipant', fn(Builder $q) =>
                        $q->whereHasMorph('chatparticipantable', '*', fn(Builder $q) =>
                            $q->where('chatparticipantable_type', 'App\Models\Admin\Student\Student')
                                ->where('id', $eachstudent->id)))
                    ->first();

                $chatgroup ? $chatgroup->update([
                    'is_groupactive' => true,
                    'classmaster_id' => $eachstudent->classmaster_id,
                    'section_id' => $eachstudent->section_id]) : null;

                if (!$chatgroup) {
                    $chatgroupobj = Chatgroup::create([
                        'groupname' => ' Admin Student',
                        'shortname' => ' Admin Student',
                        'chattype' => 5, // STUDENTONETOONE
                    ]);
                    $chatgroupobj->chatparticipant()->make()->chatparticipantable()->associate($eachadmin)->save();
                    $chatgroupobj->chatparticipant()->make()->chatparticipantable()->associate($eachstudent)->save();
                }
            }
        }

        User::isnotaccountactive()->get()
            ->each(fn($eachadmin) =>
                $eachadmin->chatparticipantable()
                    ->each(fn($eachparticipant) => $eachparticipant->chatgroup()
                            ->whereIn('chattype', [3, 4, 5])
                            ->update(['is_groupactive' => false]))
            );

        Staff::isnotaccountactive()->get()
            ->each(fn($eachstaff) =>
                $eachstaff->chatparticipantable()
                    ->each(fn($eachparticipant) => $eachparticipant->chatgroup()
                            ->whereIn('chattype', [3, 4, 5])
                            ->update(['is_groupactive' => false]))
            );

        Student::isnotaccountactive()->get()
            ->each(fn($eachstaff) =>
                $eachstaff->chatparticipantable()
                    ->each(fn($eachparticipant) => $eachparticipant->chatgroup()
                            ->whereIn('chattype', [3, 4, 5])
                            ->update(['is_groupactive' => false]))
            );
    }

}
