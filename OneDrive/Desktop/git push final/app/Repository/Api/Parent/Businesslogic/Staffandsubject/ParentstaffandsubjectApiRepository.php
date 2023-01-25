<?php

namespace App\Repository\Api\Parent\Businesslogic\Staffandsubject;

use App\Http\Resources\Parent\Staffandsubject\Staffdetails\ParentstaffdetailsCollection;
use App\Models\Admin\Exam\Offlineexam\Examstudentsubjectlist;
use App\Models\Admin\Settings\Academicsetting\Assignsubject;
use App\Models\Admin\Settings\Academicsetting\Subject;
use App\Models\Parent\Parenthelper\Parenthelper;
use App\Repository\Api\Parent\Interfacelayer\Staffandsubject\IParentstaffandsubjectApiRepository;
use Illuminate\Database\Eloquent\Builder;

class ParentstaffandsubjectApiRepository implements IParentstaffandsubjectApiRepository
{
    public function parentstaffdetails()
    {
        $student = Parenthelper::getstudent();

        return [true,
            new ParentstaffdetailsCollection(Assignsubject::where('classmaster_id', $student->classmaster_id)
                    ->where('section_id', $student->section_id)
                    ->get()),
            'Success'];
    }

    public function parentsubjectdetails()
    {
        $student = Parenthelper::getstudent();

        $subject = Subject::whereHas('Assignsubject',
            fn(Builder $q) => $q->where('classmaster_id', $student->classmaster_id)->where('section_id', $student->section_id))
            ->get();

        $arr = [];
        foreach ($subject as $eachsubject) {

            $exam = Examstudentsubjectlist::where('subject_id', $eachsubject->id)
                ->whereHas('examstudentlist',
                    fn(Builder $q) => $q->where('student_id', $student->id)->where('classmaster_id', $student->classmaster_id)
                        ->where('section_id', $student->section_id))
                ->with(['exam.examsubject' => function ($query) use ($eachsubject) {
                    $query->where('subject_id', $eachsubject->id);
                }])
                ->get();

            $percentage = collect();

            foreach ($exam as $eachexam) {
                $mark = ($eachexam->mark == null) ? 0 : $eachexam->mark;
                $percentage->push(round(($mark / $eachexam->exam->examsubject[0]->mark) * 100));
            }

            // logic
            array_push($arr, [
                'name' => $eachsubject->name,
                'value' => ($percentage->avg() == null) ? (string) 0 : (string) round($percentage->avg()),
            ]);
        }

        return [true, $arr, 'success'];

    }
}
