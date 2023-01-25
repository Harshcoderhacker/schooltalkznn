<?php

namespace App\Repository\Api\Parent\Interfacelayer\Feed;

interface IParentfeedcommentreplyApiRepository
{
    public function parentcreatefeedpostcommentreply();

    public function parentgetcommentreplybycommentuuid();

    public function parentcommentreplyupdatebyuuid();

    public function parentcommentreplystatusupdate();

    public function parentcommentreplydelete();

}
