<?php

namespace App\Repository\Api\Parent\Businesslogic\Exam\Onlineexam;

use App\Http\Resources\Parent\Exam\Onlineexam\Assessmentanswer\ParentOAstudentanswerResource;
use App\Http\Resources\Parent\Exam\Onlineexam\Assessmentquestions\ParentgetonlineassessmentquestionsResource;
use App\Http\Resources\Parent\Exam\Onlineexam\Assessmentsubjectwise\ParentgetallassessmentsubjectwiseResource;
use App\Http\Resources\Parent\Exam\Onlineexam\Todayonlineassessment\ParenttodayonlineexamCollection;
use App\Models\Admin\Exam\Onlineassessment\Onlineassessment;
use App\Models\Admin\Exam\Onlineassessment\Onlineassessmentquestion;
use App\Models\Admin\Exam\Onlineassessment\Onlineassessmentstudentanswer;
use App\Models\Admin\Exam\Onlineassessment\Onlineassessmentstudentlist;
use App\Models\Admin\Settings\Academicsetting\Assignsubject;
use App\Models\Admin\Settings\Academicsetting\Subject;
use App\Models\Parent\Parenthelper\Parenthelper;
use App\Repository\Api\Parent\Interfacelayer\Exam\Onlineexam\IParentonlineexamApiRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class ParentonlineexamApiRepository implements IParentonlineexamApiRepository
{
    public function parenttodayonlineexam()
    {
        $user = Parenthelper::getstudent();
        $onlineassessment = Onlineassessmentstudentlist::whereHas('student', fn(Builder $q) => $q->where('uuid', $user->uuid))->whereHas('onlineassessment', fn(Builder $q) => $q->whereDate('start_date', today()))->take(10)->latest()->get();

        return [true, new ParenttodayonlineexamCollection($onlineassessment),
            'parenttodayonlineexam'];
    }

    public function parentgetassessmentcountsubjectwise()
    {
        $user = Parenthelper::getstudent();
        $assignsubject = Assignsubject::where('active', true)->where('classmaster_id', $user->classmaster_id)->where('section_id', $user->section_id)->get();
        $assessmentcount = [];
        foreach ($assignsubject as $key => $value) {
            array_push($assessmentcount, [
                'subject_uuid' => $value->subject->uuid,
                'subject_name' => $value->subject->name,
                'assessment_count' => Onlineassessmentstudentlist::whereHas('student', fn(Builder $q) => $q->where('uuid', $user->uuid))->whereHas('onlineassessment', fn(Builder $q) => $q->where('subject_id', $value->subject_id))->where('assessment_status', 0)->count(),
            ]);
        }
        return [true, $assessmentcount,
            'parenttodayonlineexam'];
    }

    public function parentgetallassessmentsubjectwise()
    {
        $user = Parenthelper::getstudent();
        $subject_name = Subject::where('uuid', request('subject_uuid'))->first()->name;

        $onlineassessment = Onlineassessmentstudentlist::whereHas('student', fn(Builder $q) => $q->where('uuid', $user->uuid))
            ->whereHas('onlineassessment', fn(Builder $q) =>
                $q->whereHas('subject', fn(Builder $q1) =>
                    $q1->where('uuid', request('subject_uuid'))))
            ->where(function ($query) {
                switch (request('assessment_type')) {
                    case 0:
                        $query->where('assessment_status', 0);
                        break;
                    case 1:
                        $query->where('assessment_status', 1);
                        break;
                }
            })
            ->get();

        return [true, [
            'subject' => $subject_name,
            'onlineassessment' => ParentgetallassessmentsubjectwiseResource::collection($onlineassessment)],
            'parentgetallassessmentsubjectwise'];
    }

    public function parentgetonlineassessment()
    {
        $assessment_info = [];
        $onlineassessment = Onlineassessment::where('uuid', request('assessment_uuid'))->first();
        $assessment_info['assessment_uuid'] = $onlineassessment->uuid;
        $assessment_info['assessment_name'] = $onlineassessment->name;
        $assessment_info['subject'] = $onlineassessment->subject->name;
        $assessment_info['no_of_questions'] = $onlineassessment->onlineassessmentquestion->count();
        $assessment_info['mark'] = $onlineassessment->total_mark;
        return [true, $assessment_info,
            'parentgetonlineassessment'];
    }

    public function parentgetonlineassessmentquestions()
    {
        $user = Parenthelper::getstudent();
        $onlineassessment = Onlineassessment::where('uuid', request('assessment_uuid'))->first();
        $onlineassessmentstudent = Onlineassessmentstudentlist::whereHas('onlineassessment', fn(Builder $q) => $q->where('uuid', request('assessment_uuid')))->where('student_id', $user->id)->first();
        $onlineassessmentstudent->update([
            'participated_date' => Carbon::today(),
            'start_time' => Carbon::now()->format('H:i:s'),
        ]);

        DB::commit();
        return [true, ['onlineassessment_questions' => ParentgetonlineassessmentquestionsResource::collection($onlineassessment->onlineassessmentquestion)],
            'parentgetonlineassessmentquestions'];
    }

    public function parentmarksanswer()
    {
        $user = Parenthelper::getstudent();
        $onlineassessmentquestion = Onlineassessmentquestion::where('id', request('assessment_question_id'))
            ->whereHas('onlineassessment', fn(Builder $q) => $q->where('uuid', request('assessment_uuid')))->first();
        $onlineassessmentstudentlist = Onlineassessmentstudentlist::where('student_id', $user->id)->whereHas('onlineassessment', fn(Builder $q) => $q->where('uuid', request('assessment_uuid')))->first();
        $onlineassessmentstudentanswer = Onlineassessmentstudentanswer::updateOrCreate([
            'onlineassessment_id' => $onlineassessmentquestion->onlineassessment_id,
            'onlineassessmentquestion_id' => $onlineassessmentquestion->id,
            'onlineassessmentstudentlist_id' => $onlineassessmentstudentlist->id,
            'student_id' => $user->id,
        ], [
            'answer' => request('answer'),
            'is_correct' => $onlineassessmentquestion->answer == request('answer') ? 1 : 0,
        ]);
        $onlineassessmentstudentlist->update([
            'mark' => ($onlineassessmentstudentanswer->where('student_id', $user->id)
                    ->where('onlineassessment_id', $onlineassessmentquestion->onlineassessment_id)
                    ->where('is_correct', true)
                    ->count() * config('archive.online_assessment.mark'))]);

        DB::commit();

        return [true, 'Answer Submitted Successfully!', 'parentmarksanswer'];
    }

    public function parentsubmitonlineassessment()
    {
        $user = Parenthelper::getstudent();
        $onlineassessment = Onlineassessmentstudentlist::whereHas('onlineassessment', fn(Builder $q) => $q->where('uuid', request('assessment_uuid')))
            ->where('student_id', $user->id)
            ->first();
        $start_time = strtotime($onlineassessment->start_time);
        $end_time = strtotime(Carbon::now()->format('H:i:s'));
        $time_taken = $start_time - $end_time;
        $onlineassessment->update([
            'assessment_status' => 1,
            'end_time' => Carbon::now()->format('H:i:s'),
            'time_taken' => gmdate("H:i:s", abs($time_taken)),
        ]);
        DB::commit();
        return [true, ['result' => 'you scored ' . $onlineassessment->mark . ' marks out of ' . $onlineassessment->onlineassessment->total_mark, 'percentage' => round(($onlineassessment->mark / $onlineassessment->onlineassessment->total_mark) * 100)],
            'parentgetonlineassessmentmark'];
    }

    public function parentonlineassessmentanswers()
    {
        $user = Parenthelper::getstudent();
        $onlineassessmentstudent = Onlineassessmentstudentlist::whereHas('onlineassessment', fn(Builder $q) => $q->where('uuid', request('assessment_uuid')))->where('student_id', $user->id)->first();
        return [true,
            [
                'Assessment_name' => $onlineassessmentstudent->onlineassessment_id ? $onlineassessmentstudent->onlineassessment->name : '',
                'subject_name' => $onlineassessmentstudent->onlineassessment_id ? $onlineassessmentstudent->onlineassessment->subject->name : '',
                'no_of_question' => $onlineassessmentstudent->onlineassessment_id ? $onlineassessmentstudent->onlineassessment->onlineassessmentquestion->count() : '',
                'Answer' => ParentOAstudentanswerResource::collection($onlineassessmentstudent->onlineassessmentstudentanswer)],
            'admingetOAbyclassuuid'];
    }

}
