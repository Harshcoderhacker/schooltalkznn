<?php

namespace App\Repository\Api\Admin\Businesslogic\Material;

use App\Http\Resources\Common\Material\Materiallist\MateriallistCollection;
use App\Http\Resources\Common\Material\MaterialResource;
use App\Http\Resources\Common\Material\Subject\MaterialsubjectResource;
use App\Models\Admin\Material\Material;
use App\Models\Admin\Material\Materiallist;
use App\Models\Admin\Settings\Academicsetting\Assignsubject;
use App\Models\Admin\Settings\Academicsetting\Classmaster;
use App\Models\Admin\Settings\Academicsetting\Subject;
use App\Repository\Api\Admin\Interfacelayer\Material\IAdminmaterialApiRepository;
use DB;
use Storage;

class AdminmaterialApiRepository implements IAdminmaterialApiRepository
{
    public function getcontenttype()
    {
        return [true, config('archive.material_type'), 'getcontenttype'];
    }

    public function getmaterialsubjectbyclassuuid()
    {
        return [true, MaterialsubjectResource::collection(
            Assignsubject::where('classmaster_id', Classmaster::where('uuid', request('classmaster_uuid'))
                    ->first()
                    ->id
            )
                ->get()
                ->unique('subject_id')
        ), 'getmaterialsubjectbyclassuuid'];
    }

    public function getmaterialbyclassmasteruuid()
    {
        return [true, MaterialResource::collection(
            Classmaster::where('uuid', request('classmaster_uuid'))
                ->first()
                ->materialwithtype
        ), 'getmaterialbyclassmasteruuid'];
    }

    public function admincreatematerial()
    {
        $subject_id = Subject::where('uuid', request('subject_uuid'))
            ->first()
            ->id;

        $classmaster_id = Classmaster::where('uuid', request('classmaster_uuid'))
            ->first()
            ->id;

        if (request('subject_uuid')) {
            $material_id = Material::where('material_type', request('material_type'))
                ->where('classmaster_id', $classmaster_id)
                ->where('subject_id', $subject_id)
                ->first()
                ->id;
        } else {
            $material_id = Material::where('material_type', request('material_type'))
                ->where('classmaster_id', $classmaster_id)
                ->first()
                ->id;
        }

        $payload = [
            'title' => request('title'),
            'material_id' => $material_id,
            'classmaster_id' => $classmaster_id,
            "subject_id" => $subject_id,
            "description" => request('description'),
            "document" => $this->savedocument(),
            "document_type" => request('document')->getClientOriginalExtension(),
        ];

        auth()->user()
            ->materiallist()
            ->save(new Materiallist($payload));

        DB::commit();

        return [true, 'success', 'admincreatematerial'];
    }

    public function getmateriallistbymaterialuuid()
    {
        $material_id = Material::where('uuid', request('material_uuid'))
            ->first()
            ->id;

        return [true, new MateriallistCollection(
            Materiallist::where('material_id', $material_id)
                ->where('active', true)
                ->paginate(30)
        ), 'getmateriallistbymaterialuuid'];
    }

    public function downloadmateriallistbyuuid()
    {
        return Storage::download(Materiallist::where('uuid', request('materiallist_uuid'))->first()->document);
    }

    public function deletemateriallistbyuuid()
    {
        Materiallist::where('uuid', request('materiallist_uuid'))
            ->first()
            ->delete();

        return [true, 'success', 'deletemateriallistbyuuid'];
    }

    protected function savedocument()
    {
        return request('document')
            ->storeAs('material/documents/', time() . '.' . request('document')->getClientOriginalExtension());
    }
}
