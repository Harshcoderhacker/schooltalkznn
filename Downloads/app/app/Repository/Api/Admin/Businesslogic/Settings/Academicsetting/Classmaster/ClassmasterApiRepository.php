<?php

namespace App\Repository\Api\Admin\Businesslogic\Settings\Academicsetting\Classmaster;

use App\Http\Resources\Admin\Settings\Academicsetting\Classmaster\ClassmasterCollection;
use App\Models\Admin\Settings\Academicsetting\Classmaster;
use App\Repository\Api\Admin\Interfacelayer\Settings\Academicsetting\Classmaster\IClassmasterApiRepository;

class ClassmasterApiRepository implements IClassmasterApiRepository
{
    public function getallclassmaster()
    {
        return [true,
            new ClassmasterCollection(Classmaster::where('active', true)
                    ->select('uuid', 'name')
                    ->get()),
            'getallclassmaster'];
    }
}
