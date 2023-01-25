<?php

namespace App\Repository\Api\Staff\Interfacelayer\Exam\Onlineassessment;

interface IStaffonlineassessmentapiApiRepository
{
    public function staffgetallclassOA();

    public function staffgetOAbyclassuuid();

    public function staffgetstudentsmarkbyassessmentuuid();
}
