<?php

namespace App\Repository\Api\Parent\Interfacelayer\Homework;

interface IParenthomeworkApiRepository
{
    public function parentgetallhomeworksubject();

    public function parentgethomeworksubjectlistbyuuid();

    public function parentgethomeworkdetailsbyuuid();

    public function parentdownloadhomeworkattachment();

    public function parentposthomeworksubmission();

    public function parentgethomeworkcommentlistbyuuid();

    public function parentposthomeworkcomment();
}
