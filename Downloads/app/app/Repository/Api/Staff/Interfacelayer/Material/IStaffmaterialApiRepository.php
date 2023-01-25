<?php

namespace App\Repository\Api\Staff\Interfacelayer\Material;

interface IStaffmaterialApiRepository
{
    public function staffgetcontenttype();

    public function staffgetassignedclasslist();

    public function staffgetmaterialsubjectbyclassuuid();

    public function staffgetmaterialbyclassmasteruuid();

    public function staffcreatematerial();

    public function staffgetmateriallistbymaterialuuid();

    public function staffdownloadmateriallistbyuuid();

    public function staffdeletemateriallistbyuuid();
}
