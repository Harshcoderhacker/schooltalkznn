<?php

namespace App\Repository\Api\Staff\Businesslogic\Exam\Offlineexam;

use App\Http\Resources\Staff\Exam\Offlineexam\Examlist\StaffexamlistCollection;
use App\Http\Resources\Staff\Exam\Offlineexam\Examschedule\StaffexamscheduleResource;
use App\Http\Resources\Staff\Exam\Offlineexam\Examstudentlist\StaffexamstudentlistCollection;
use App\Http\Resources\Staff\Exam\Offlineexam\Examstudentmarklist\StaffexamstudentResource;
use App\Http\Resources\Staff\Exam\Offlineexam\Studentprogress\StaffstudentprogressResource;
use App\Models\Admin\Exam\Offlineexam\Exam;
use App\Models\Admin\Exam\Offlineexam\Examstudentlist;
use App\Models\Admin\Exam\Offlineexam\Examsubject;
use App\Models\Admin\Settings\Academicsetting\ClassmasterSection;
use App\Models\Admin\Student\Student;
use App\Repository\Api\Staff\Interfacelayer\Exam\Offlineexam\IStaffexamApiRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\App;

class StaffexamApiRepository implements IStaffexamApiRepository
{
    public function staffgetallexamlistbyclasssectionuuid()
    {
        $academicyear_id = App::make('generalsetting')->academicyear_id;
        $classmastersection = ClassmasterSection::where('uuid', request('classmastersection_uuid'))
            ->first();
        return [true,
            new StaffexamlistCollection(Exam::where('active', true)->where('academicyear_id', $academicyear_id)
                    ->where('classmaster_id', $classmastersection->classmaster_id)
                    ->whereJsonContains('section', (string) $classmastersection->section_id)
                    ->get()),
            'staffgetallexamlistbyclasssectionuuid'];
        return [true,
            "sucess",
            'staffgetallexamlistbyclasssectionuuid'];
    }

    public function staffgetexamschedulebyexamuuid()
    {
        $exam = Exam::where('uuid', request('exam_uuid'))->first();
        return [true,
            [
                'examschedule' => StaffexamscheduleResource::collection(
                    Examsubject::where('exam_id', $exam->id)
                        ->get()
                )], 'staffgetexamschedulebyexamuuid'];
    }

    public function staffgetallassignsubjectlist()
    {

    }

    public function staffgetstudentsmarklistbyclasssectionexamuuid()
    {
        $classmastersection = ClassmasterSection::where('uuid', request('classmastersection_uuid'))
            ->first();
        $examstudentlist = Examstudentlist::with('examstudentsubjectlist')
            ->wherehas('exam', fn(Builder $q) =>
                $q->where('uuid', request('exam_uuid'))
            )
            ->where('classmaster_id', $classmastersection->classmaster_id)
            ->where('section_id', $classmastersection->section_id)
            ->get();

        if ($examstudentlist) {
            return [true, StaffexamstudentResource::collection($examstudentlist), 'staffgetstudentsmarklistbyclasssectionexamuuid'];
        } else {
            return [true, 'staffgetstudentsmarklistbyclasssectionexamuuid'];
        }
    }

    public function staffgetstudentlistbyclasssectionuuid()
    {
        $academicyear_id = App::make('generalsetting')->academicyear_id;
        $classmastersection = ClassmasterSection::where('uuid', request('classmastersection_uuid'))
            ->first();
        return [true,
            new StaffexamstudentlistCollection(Student::where('active', true)->where('academicyear_id', $academicyear_id)
                    ->where('classmaster_id', $classmastersection->classmaster_id)
                    ->where('section_id', $classmastersection->section_id)
                    ->get()),
            'staffgetstudentlistbyclasssectionuuid'];
    }

    public function staffgetallexammarkbystudentuuid()
    {
        $studentprogress = Examstudentlist::with('examstudentsubjectlist')
            ->whereHas('student', fn(Builder $q) =>
                $q->where('uuid', request('student_uuid'))
            )
            ->get();
        return [true,
            [
                'student_name' => $studentprogress->first()->student->name,
                'exams_details' => StaffstudentprogressResource::collection($studentprogress),
            ],
            'staffgetallexammarkbystudentuuid'];
    }

}
