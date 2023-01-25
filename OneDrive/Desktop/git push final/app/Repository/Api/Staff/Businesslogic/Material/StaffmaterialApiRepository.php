<?php

namespace App\Repository\Api\Staff\Businesslogic\Material;

use App\Http\Resources\Common\Material\Materiallist\MateriallistCollection;
use App\Http\Resources\Common\Material\MaterialResource;
use App\Http\Resources\Staff\Material\Classmaster\ClassmasterlistResource;
use App\Http\Resources\Staff\Material\Subject\SubjectlistResource;
use App\Models\Admin\Material\Material;
use App\Models\Admin\Material\Materiallist;
use App\Models\Admin\Settings\Academicsetting\Assignsubject;
use App\Models\Admin\Settings\Academicsetting\Classmaster;
use App\Models\Admin\Settings\Academicsetting\Subject;
use App\Repository\Api\Staff\Interfacelayer\Material\IStaffmaterialApiRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class StaffmaterialApiRepository implements IStaffmaterialApiRepository
{
    public function staffgetcontenttype()
    {
        return [true,
            config('archive.material_type'),
            'staffgetcontenttype'];
    }

    public function staffgetassignedclasslist()
    {
        return [true, ClassmasterlistResource::collection(
            Assignsubject::where('staff_id', auth()->user()->id)
                ->get()
                ->unique('classmaster_id')
        ), 'staffgetassignedclasslist'];
    }

    public function staffgetmaterialsubjectbyclassuuid()
    {
        return [true, SubjectlistResource::collection(
            Assignsubject::where('classmaster_id',
                Classmaster::where('uuid', request('classmaster_uuid'))
                    ->first()
                    ->id
            )
                ->where('staff_id', auth()->user()->id)
                ->get()
                ->unique('subject_id')
        ), 'staffgetmaterialsubjectbyclassuuid'];
    }

    public function staffgetmaterialbyclassmasteruuid()
    {
        return [true, MaterialResource::collection(
            Classmaster::where('uuid', request('classmaster_uuid'))
                ->first()
                ->materialwithtype
        ), 'staffgetmaterialbyclassmasteruuid'];
    }

    public function staffcreatematerial()
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

        return [true, 'success', 'staffcreatematerial'];
    }

    public function staffgetmateriallistbymaterialuuid()
    {
        return [true, new MateriallistCollection(
            Materiallist::where('material_id', Material::where('uuid', request('material_uuid'))
                    ->first()
                    ->id
            )
                ->where('active', true)
                ->paginate(30)
        ), 'staffgetmateriallistbymaterialuuid'];
    }

    public function staffdownloadmateriallistbyuuid()
    {
        return Storage::download(Materiallist::where('uuid', request('materiallist_uuid'))->first()->document);
    }

    public function staffdeletemateriallistbyuuid()
    {
        Materiallist::where('uuid', request('materiallist_uuid'))
            ->first()
            ->delete();

        return [true, 'success', 'staffdeletemateriallistbyuuid'];
    }

    protected function savedocument()
    {
        return request('document')
            ->storeAs('material/documents/', time() . '.' . request('document')->getClientOriginalExtension());
    }
}
