<?php

namespace App\Repository\Api\Admin\Interfacelayer\Feed;

interface IAdminfeedcommentreplyApiRepository
{
    public function admincreatefeedpostcommentreply();

    public function admingetcommentreplybycommentuuid();

    public function admincommentreplyupdatebyuuid();

    public function admincommentreplystatusupdate();

    public function admincommentreplydelete();

}
