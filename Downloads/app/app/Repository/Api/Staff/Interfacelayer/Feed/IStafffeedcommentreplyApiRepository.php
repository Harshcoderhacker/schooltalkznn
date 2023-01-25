<?php

namespace App\Repository\Api\Staff\Interfacelayer\Feed;

interface IStafffeedcommentreplyApiRepository
{
    public function staffcreatefeedpostcommentreply();

    public function staffgetcommentreplybycommentuuid();

    public function staffcommentreplyupdatebyuuid();

    public function staffcommentreplystatusupdate();

    public function staffcommentreplydelete();

}
