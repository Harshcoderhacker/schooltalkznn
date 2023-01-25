<?php

namespace App\Repository\Api\Staff\Businesslogic\Exam\Onlineassessment;

use App\Http\Resources\Staff\Exam\Onlineassessment\OAclasswiselist\StaffOAClasslistResource;
use App\Http\Resources\Staff\Exam\Onlineassessment\OAlist\StaffOAlistCollection;
use App\Http\Resources\Staff\Exam\Onlineassessment\OAstudentsmark\StaffOAstudentsmarkCollection;
use App\Models\Admin\Exam\Onlineassessment\Onlineassessment;
use App\Models\Admin\Exam\Onlineassessment\Onlineassessmentstudentlist;
use App\Models\Admin\Settings\Academicsetting\Assignsubject;
use App\Models\Admin\Settings\Academicsetting\Classmaster;
use App\Repository\Api\Staff\Interfacelayer\Exam\Onlineassessment\IStaffonlineassessmentapiApiRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\App;

class StaffonlineassessmentapiApiRepository implements IStaffonlineassessmentapiApiRepository
{
    public function staffgetallclassOA()
    {
        $classmaster_id = Assignsubject::where('staff_id', request()->user()->id)->pluck('classmaster_id');
        return [true,
            [
                'assessments' => StaffOAClasslistResource::collection(
                    Classmaster::whereIn('id', $classmaster_id)->with('onlineassessment')->where('active', true)->get()
                )],
            'admingetallclassOA'];
    }

    public function staffgetOAbyclassuuid()
    {
        $academicyear_id = App::make('generalsetting')->academicyear_id;
        return [true,
            new StaffOAlistCollection(Onlineassessment::whereHas('classmaster', fn(Builder $q) => $q->where('uuid', request('class_uuid')))
                    ->where('academicyear_id', $academicyear_id)
                    ->get()),
            'staffgetOAbyclassuuid'];
    }

    public function staffgetstudentsmarkbyassessmentuuid()
    {
        return [true,
            new StaffOAstudentsmarkCollection(Onlineassessmentstudentlist::whereHas('onlineassessment', fn(Builder $q) => $q->where('uuid', request('assessment_uuid')))->get()),
            'staffgetstudentsmarkbyassessmentuuid'];
    }

}
