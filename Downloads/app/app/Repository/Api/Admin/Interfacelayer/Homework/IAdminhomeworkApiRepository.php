<?php

namespace App\Repository\Api\Admin\Interfacelayer\Homework;

interface IAdminhomeworkApiRepository
{
    public function admingetrecenthomeworklist();

    public function adminclasssectionwisesubjectlist();

    public function adminsubjectwisehomeworklist();

    public function adminstudentwisehomeworkdetails();

    public function adminsubjectwisehomeworkpost();

    public function admindownloadhomeworkattachment();

    public function admindownloadstudenthomework();

    public function adminupdatehomeworkstatus();

    public function admingethomeworkcommentlistbyuuid();

    public function adminposthomeworkcomment();
}
