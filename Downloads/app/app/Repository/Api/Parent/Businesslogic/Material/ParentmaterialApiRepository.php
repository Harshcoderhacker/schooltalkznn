<?php

namespace App\Repository\Api\Parent\Businesslogic\Material;

use App\Http\Resources\Common\Material\Materiallist\MateriallistCollection;
use App\Http\Resources\Common\Material\MaterialResource;
use App\Models\Admin\Material\Material;
use App\Models\Admin\Material\Materiallist;
use App\Models\Parent\Parenthelper\Parenthelper;
use App\Repository\Api\Parent\Interfacelayer\Material\IParentmaterialApiRepository;
use Storage;

class ParentmaterialApiRepository implements IParentmaterialApiRepository
{
    public function parentgetcontenttype()
    {
        return [true, config('archive.material_type'), 'parentgetcontenttype'];
    }

    public function parentgetmaterialbycontenttype()
    {
        return [true, MaterialResource::collection(
            Material::where('classmaster_id', Parenthelper::getstudent()->classmaster_id)
                ->where('material_type', request('material_type'))
                ->get()
        ), 'parentgetmaterialbycontenttype'];
    }

    public function parentgetmateriallistbymaterialuuid()
    {
        $material_id = Material::where('uuid', request('material_uuid'))
            ->first()
            ->id;

        return [true, new MateriallistCollection(
            Materiallist::where('material_id', $material_id)
                ->where('active', true)
                ->paginate(30)
        ), 'parentgetmateriallistbymaterialuuid'];
    }

    public function parentdownloadmaterial()
    {
        return Storage::download(Materiallist::where('uuid', request('materiallist_uuid'))->first()->document);
    }
}
