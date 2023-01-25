<?php

namespace App\Repository\Api\Staff\Interfacelayer\Exam\Offlineexam;

interface IStaffexamApiRepository
{
    public function staffgetallexamlistbyclasssectionuuid();

    public function staffgetexamschedulebyexamuuid();

    public function staffgetallassignsubjectlist();

    public function staffgetstudentsmarklistbyclasssectionexamuuid();

    public function staffgetstudentlistbyclasssectionuuid();

    public function staffgetallexammarkbystudentuuid();

}
