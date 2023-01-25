<?php

namespace App\Repository\Api\Parent\Interfacelayer\Material;

interface IParentmaterialApiRepository
{
    public function parentgetcontenttype();

    public function parentgetmaterialbycontenttype();

    public function parentgetmateriallistbymaterialuuid();

    public function parentdownloadmaterial();
}
