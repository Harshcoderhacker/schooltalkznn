<?php

namespace App\Repository\Api\Staff\Interfacelayer\Feed;

interface IStafffeedpostcommentApiRepository
{
    public function staffcreatefeedpostcomment();

    public function staffupdatefeedpostcomment();

    public function staffgetallcommentbypostuuid();

    public function stafffeedpostcommentstatusupdate();

    public function staffdeletefeedpostcomment();
}
