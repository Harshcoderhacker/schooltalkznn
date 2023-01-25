<?php

namespace App\Repository\Api\Parent\Interfacelayer\Feed;

interface IParentfeedpostcommentApiRepository
{
    public function parentcreatefeedpostcomment();

    public function parentupdatefeedpostcomment();

    public function parentgetallcommentbypostuuid();

    public function parentgetcommenttempletelist();

    public function parentfeedpostcommentstatusupdate();

    public function parentdeletefeedpostcomment();
}
