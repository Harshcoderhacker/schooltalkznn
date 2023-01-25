<?php

namespace App\Repository\Api\Admin\Interfacelayer\Class\Classdetail;

interface IAdminclassdetailApiRepository
{
    public function getclassdetailbyuuid();

    public function classattedancebyclasssectionuuid();

    public function getclassroutinebyclassectionuuid();

    public function getprogressbyclassectionuuid();
}
