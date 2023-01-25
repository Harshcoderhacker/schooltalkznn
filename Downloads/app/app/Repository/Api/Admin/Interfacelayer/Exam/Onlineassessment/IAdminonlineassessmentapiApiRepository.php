<?php

namespace App\Repository\Api\Admin\Interfacelayer\Exam\Onlineassessment;

interface IAdminonlineassessmentapiApiRepository
{
    public function admingetallclassOA();

    public function admingetOAbyclassuuid();

    public function admingetstudentsmarkbyassessmentuuid();
}
