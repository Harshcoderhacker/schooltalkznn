<?php

namespace App\Repository\Api\Admin\Interfacelayer\Exam\Offlineexam;

interface IAdminexamApiRepository
{
    public function admingetallexamlistbyclasssectionuuid();

    public function admingetexamschedulebyexamuuid();

    public function admingetstudentsmarklistbyclasssectionexamuuid();

    public function admingetstudentlistbyclasssectionuuid();

    public function admingetallexammarkbystudentuuid();

}
