<?php

namespace App\Repository\Api\Parent\Businesslogic\Feed;

use App\Http\Resources\Parent\Feed\Feedidealibrary\StudentidealibraryResource;
use App\Models\Admin\Feeds\Studentidealibrary;
use App\Models\Parent\Parenthelper\Parenthelper;
use App\Repository\Api\Parent\Interfacelayer\Feed\IParentfeedidealibraryApiRepository;
use Illuminate\Database\Eloquent\Builder;

class ParentfeedidealibraryApiRepository implements IParentfeedidealibraryApiRepository
{
    public function parentgetidealibrarylist()
    {
        $user = Parenthelper::getstudent();
        $used_idealibrary = Studentidealibrary::where('active', true)
            ->whereHas('idealibable', fn(Builder $q) =>
                $q->whereNotNull('idealibable_id')
                    ->whereHas('feedpostable', fn(Builder $q) =>
                        $q->where('uuid', $user->uuid)))
            ->whereHas('classmaster', fn(Builder $q) =>
                $q->where('classmaster_studentidealibrary.classmaster_id', $user->classmaster_id))
            ->get()->pluck('uuid');
        return [true, [
            'idealibrary' => StudentidealibraryResource::collection(Studentidealibrary::where('active', true)
                    ->whereHas('classmaster', fn(Builder $q) =>
                        $q->where('classmaster_studentidealibrary.classmaster_id', $user->classmaster_id))
                    ->whereNotIn('uuid', $used_idealibrary)->where('idea_category', request('idea_category'))->get()),
        ], 'parentgetidealibrarylist'];
    }
}
