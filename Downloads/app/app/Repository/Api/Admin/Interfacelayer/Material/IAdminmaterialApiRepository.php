<?php

namespace App\Repository\Api\Admin\Interfacelayer\Material;

interface IAdminmaterialApiRepository
{
    public function getcontenttype();

    public function getmaterialsubjectbyclassuuid();

    public function getmaterialbyclassmasteruuid();

    public function admincreatematerial();

    public function getmateriallistbymaterialuuid();

    public function downloadmateriallistbyuuid();

    public function deletemateriallistbyuuid();
}
