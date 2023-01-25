<?php

namespace App\Repository\Api\Admin\Businesslogic\Exam\Onlineassessment;

use App\Http\Resources\Admin\Exam\Onlineassessment\OAclasswiselist\AdminOAClasslistResource;
use App\Http\Resources\Admin\Exam\Onlineassessment\OAlist\AdminOAlistCollection;
use App\Http\Resources\Admin\Exam\Onlineassessment\OAstudentsmark\AdminOAstudentsmarkCollection;
use App\Models\Admin\Exam\Onlineassessment\Onlineassessment;
use App\Models\Admin\Exam\Onlineassessment\Onlineassessmentstudentlist;
use App\Models\Admin\Settings\Academicsetting\Classmaster;
use App\Repository\Api\Admin\Interfacelayer\Exam\Onlineassessment\IAdminonlineassessmentapiApiRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\App;

class AdminonlineassessmentapiApiRepository implements IAdminonlineassessmentapiApiRepository
{
    public function admingetallclassOA()
    {

        return [true,
            [
                'assessments' => AdminOAClasslistResource::collection(
                    Classmaster::with('onlineassessment')->where('active', true)->get()
                )],
            'admingetallclassOA'];
    }

    public function admingetOAbyclassuuid()
    {
        $academicyear_id = App::make('generalsetting')->academicyear_id;
        return [true,
            new AdminOAlistCollection(Onlineassessment::whereHas('classmaster', fn(Builder $q) => $q->where('uuid', request('class_uuid')))
                    ->where('academicyear_id', $academicyear_id)
                    ->get()),
            'admingetOAbyclassuuid'];
    }

    public function admingetstudentsmarkbyassessmentuuid()
    {
        return [true,
            new AdminOAstudentsmarkCollection(Onlineassessmentstudentlist::whereHas('onlineassessment', fn(Builder $q) => $q->where('uuid', request('assessment_uuid')))->get()),
            'admingetOAbyclassuuid'];
    }

}
