<?php

namespace App\Repository\Api\Admin\Interfacelayer\Feed;

interface IAdminfeedpostcommentApiRepository
{
    public function admincreatefeedpostcomment();

    public function adminupdatefeedpostcomment();

    public function admingetallcommentbypostuuid();

    public function adminfeedpostcommentstatusupdate();

    public function admindeletefeedpostcomment();
}
