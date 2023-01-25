<?php

namespace App\Repository\Api\Admin\Businesslogic\Exam\Offlineexam;

use App\Http\Resources\Admin\Exam\Offlineexam\Examlist\AdminexamlistCollection;
use App\Http\Resources\Admin\Exam\Offlineexam\Examschedule\AdminexamscheduleResource;
use App\Http\Resources\Admin\Exam\Offlineexam\Examstudentlist\AdminexamstudentlistCollection;
use App\Http\Resources\Admin\Exam\Offlineexam\Examstudentmarklist\ExamstudentResource;
use App\Http\Resources\Admin\Exam\Offlineexam\Studentprogress\AdminstudentprogressResource;
use App\Models\Admin\Exam\Offlineexam\Exam;
use App\Models\Admin\Exam\Offlineexam\Examstudentlist;
use App\Models\Admin\Exam\Offlineexam\Examsubject;
use App\Models\Admin\Settings\Academicsetting\Section;
use App\Models\Admin\Student\Student;
use App\Repository\Api\Admin\Interfacelayer\Exam\Offlineexam\IAdminexamApiRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\App;

class AdminexamApiRepository implements IAdminexamApiRepository
{
    public function admingetallexamlistbyclasssectionuuid()
    {
        $academicyear_id = App::make('generalsetting')->academicyear_id;
        $section_id = Section::where('uuid', request('section_uuid'))->first()->id;
        return [true,
            new AdminexamlistCollection(Exam::where('active', true)->where('academicyear_id', $academicyear_id)
                    ->whereHas('classmaster',
                        fn(Builder $q) => $q->where('uuid', request('class_uuid')))
                    ->whereJsonContains('section', (string) $section_id)
                    ->get()),
            'admingetallexamlistbyclasssectionuuid'];
    }

    public function admingetexamschedulebyexamuuid()
    {
        $exam = Exam::where('uuid', request('exam_uuid'))->first();
        return [true,
            [
                'examschedule' => AdminexamscheduleResource::collection(
                    Examsubject::where('exam_id', $exam->id)
                        ->get()
                )], 'admingetexamschedulebyexamuuid'];
    }

    public function admingetstudentsmarklistbyclasssectionexamuuid()
    {
        $examstudentlist = Examstudentlist::with('examstudentsubjectlist')
            ->wherehas('exam', fn(Builder $q) =>
                $q->where('uuid', request('exam_uuid'))
            )
            ->whereHas('classmaster',
                fn(Builder $q) => $q->where('uuid', request('class_uuid')))
            ->whereHas('section',
                fn(Builder $q) => $q->where('uuid', request('section_uuid')))
            ->get();

        if ($examstudentlist) {
            return [true, ExamstudentResource::collection($examstudentlist), 'admingetallexammarkbystudentuuid'];
        } else {
            return [true, 'admingetallexammarkbystudentuuid'];
        }
    }

    public function admingetstudentlistbyclasssectionuuid()
    {
        $academicyear_id = App::make('generalsetting')->academicyear_id;
        return [true,
            new AdminexamstudentlistCollection(Student::where('active', true)->where('academicyear_id', $academicyear_id)
                    ->whereHas('classmaster',
                        fn(Builder $q) => $q->where('uuid', request('class_uuid')))
                    ->whereHas('section',
                        fn(Builder $q) => $q->where('uuid', request('section_uuid')))
                    ->get()),
            'admingetstudentlistbyclasssectionuuid'];
    }

    public function admingetallexammarkbystudentuuid()
    {
        $studentprogress = Examstudentlist::with('examstudentsubjectlist')
            ->whereHas('student', fn(Builder $q) =>
                $q->where('uuid', request('student_uuid'))
            )
            ->get();
        return [true, ['student_name' => $studentprogress->first()->student->name, 'exams_details' => AdminstudentprogressResource::collection($studentprogress)], 'admingetallexammarkbystudentuuid'];
    }

}
