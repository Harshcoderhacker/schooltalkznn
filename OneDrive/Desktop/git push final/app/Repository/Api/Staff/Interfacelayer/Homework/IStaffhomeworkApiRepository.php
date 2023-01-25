<?php

namespace App\Repository\Api\Staff\Interfacelayer\Homework;

interface IStaffhomeworkApiRepository
{
    public function staffgetrecenthomeworklist();

    public function staffclasssectionwisesubjectlist();

    public function staffsubjectwisehomeworklist();

    public function staffhomeworkdetailsbyuuid();

    public function staffsubjectwisehomeworkpost();

    public function staffdownloadhomeworkattachment();

    public function staffdownloadstudenthomework();

    public function staffupdatehomeworkstatus();

    public function staffgethomeworkcommentlistbyuuid();

    public function staffposthomeworkcomment();
}
