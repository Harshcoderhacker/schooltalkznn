<?php

namespace App\Repository\Api\Parent\Businesslogic\Exam\Offlineexam;

use App\Http\Resources\Parent\Exam\Offlineexam\Exammarklist\ParentexammarklistCollection;
use App\Http\Resources\Parent\Exam\Offlineexam\Examschedule\ParentexamscheduleResource;
use App\Models\Admin\Exam\Offlineexam\Exam;
use App\Models\Admin\Exam\Offlineexam\Examstudentlist;
use App\Models\Admin\Exam\Offlineexam\Examsubject;
use App\Models\Admin\Exam\Onlineassessment\Onlineassessmentstudentlist;
use App\Models\Admin\Student\Student;
use App\Models\Parent\Parenthelper\Parenthelper;
use App\Repository\Api\Parent\Interfacelayer\Exam\Offlineexam\IParentofflineexamApiRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\App;

class ParentofflineexamApiRepository implements IParentofflineexamApiRepository
{
    public function parentexamindex()
    {
        $user = Parenthelper::getstudent();
        $onlineassessment = Onlineassessmentstudentlist::whereHas('student', fn(Builder $q) => $q->where('uuid', $user->uuid))->where('assessment_status', 0)->count();
        $exam = Examsubject::where('examdate', '>=', today())->orderBy('examdate', 'asc')->first();
        return [true, ['upcoming_exam' => $exam ? $exam->examdate->format('d-m-Y') : 'No Upcoming Exam', 'onlineassessment_count' => $onlineassessment],
            'parentexamindex'];
    }

    public function parentgetexamlist()
    {
        $user = Parenthelper::getstudent();
        $academicyear_id = App::make('generalsetting')->academicyear_id;

        $exam = Exam::where('active', true)
            ->where('academicyear_id', $academicyear_id)
            ->where('classmaster_id', $user->classmaster_id)
            ->whereJsonContains('section', (string) $user->section_id)
            ->select('name', 'uuid')
            ->get();
        return [true, $exam,
            'parentgetallhomeworksubject'];
    }

    public function parentgetexamschedulebyexamuuid()
    {
        $exam = Exam::where('uuid', request('exam_uuid'))->first();
        return [true,
            [
                'examschedule' => ParentexamscheduleResource::collection(
                    Examsubject::where('exam_id', $exam->id)
                        ->get()
                )], 'parentgetexamschedulebyexamuuid'];
    }

    public function parentgetallexamlistmonthwise()
    {
        $user = Parenthelper::getstudent();
        $academicyear_id = App::make('generalsetting')->academicyear_id;

        $exam = Exam::where('active', true)
            ->where('academicyear_id', $academicyear_id)
            ->where('classmaster_id', $user->classmaster_id)
            ->whereJsonContains('section', (string) $user->section_id)
            ->get();

        return [true, new ParentexammarklistCollection($exam->unique('month')),
            'parentgetallhomeworksubject'];
    }

    public function parentgetexammarlist()
    {
        $user = Parenthelper::getstudent();
        $exam = Exam::where('uuid', request('exam_uuid'))->with(['examsubject', 'examstudentsubjectlist' => function ($query) {
            $query->whereHas('examstudentlist', fn(Builder $q) => $q->where('student_id', Parenthelper::getstudent()->id));
        }])->first();
        $exam_mark = [];
        foreach ($exam->examsubject as $key => $value) {
            array_push($exam_mark, [
                'subject' => $value->subject->name,
                'exam_date' => $value->examdate->format('d-m-Y'),
                'exam_mark' => $value->mark,
                'mark_obtained' => $exam->examstudentsubjectlist[$key]->mark,
                'is_pass' => $exam->examstudentsubjectlist[$key]->is_pass ? true : false,
            ]);
        }
        $data['exam_name'] = $exam->name;
        $data['average'] = $exam->examstudentsubjectlist->avg('mark');
        $data['exam_mark'] = $exam_mark;
        return [true, $data, 'parentgetexammarlist'];
    }

    public function parentgetprogresscard()
    {
        $user = Parenthelper::getstudent();
        $total_mark = [];
        $rank = "-";
        $exam = Exam::where('uuid', request('exam_uuid'))->with(['examstudentsubjectlist' => function ($query) {
            $query->whereHas('examstudentlist', fn(Builder $q) => $q->where('student_id', Parenthelper::getstudent()->id));
        }])->first();
        $academicyear_id = App::make('generalsetting')->academicyear_id;
        $studentlist = Student::where('academicyear_id', $academicyear_id)
            ->where('classmaster_id', $user->classmaster_id)
            ->where('section_id', $user->section_id)
            ->get();
        $i = 0;
        foreach ($studentlist as $key => $eachstudent) {
            $examstudentlist = Examstudentlist::with('examstudentsubjectlist')->where('exam_id', $exam->id)->where('student_id', $eachstudent->id)->where('classmaster_id', $user->classmaster_id)
                ->where('section_id', $user->section_id)->get();
            if ($examstudentlist->isNotEmpty()) {
                if (sizeof($examstudentlist[0]->examstudentsubjectlist) == $examstudentlist[0]->examstudentsubjectlist->whereNotNull('is_pass')->where('is_pass', true)->count()) {
                    $total_mark[$i] = $examstudentlist[0]->examstudentsubjectlist->sum('mark');
                    $i++;
                }
            }
        }
        if ($total_mark) {
            rsort($total_mark);
            $rank = array_search($exam->examstudentsubjectlist->sum('mark'), $total_mark) + 1;
        }

        $exam_mark = [];
        foreach ($exam->examsubject as $key => $value) {
            array_push($exam_mark, [
                'subject' => $value->subject->name,
                'exam_date' => $value->examdate->format('d-m-Y'),
                'exam_mark' => $value->mark,
                'mark_obtained' => $exam->examstudentsubjectlist[$key]->mark,
                'is_pass' => $exam->examstudentsubjectlist[$key]->is_pass ? true : false,
            ]);
        }
        $data['exam_name'] = $exam->name;
        $data['rank'] = $rank;
        $data['average'] = round($exam->examstudentsubjectlist->avg('mark'));
        $data['exam_mark'] = $exam_mark;
        return [true, $data, 'parentgetprogresscard'];
    }

}
