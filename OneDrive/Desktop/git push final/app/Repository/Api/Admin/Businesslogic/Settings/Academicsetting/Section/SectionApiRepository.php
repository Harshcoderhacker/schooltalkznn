<?php

namespace App\Repository\Api\Admin\Businesslogic\Settings\Academicsetting\Section;

use App\Http\Resources\Admin\Settings\Academicsetting\Section\SectionCollection;
use App\Models\Admin\Settings\Academicsetting\Classmaster;
use App\Repository\Api\Admin\Interfacelayer\Settings\Academicsetting\Section\ISectionApiRepository;

class SectionApiRepository implements ISectionApiRepository
{
    public function getsectionbyclassmasteruuid()
    {
        return [true,
            new SectionCollection(Classmaster::where('uuid', request('classmaster_uuid'))
                    ->first()
                    ->section),
                'getsectionbyclassmasteruuid'];
        }
    }
