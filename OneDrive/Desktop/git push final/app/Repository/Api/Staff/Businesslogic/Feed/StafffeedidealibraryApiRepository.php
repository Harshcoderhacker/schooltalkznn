<?php

namespace App\Repository\Api\Staff\Businesslogic\Feed;

use App\Http\Resources\Staff\Feed\Feedidealibrary\StaffidealibraryResource;
use App\Models\Admin\Feeds\Stafffeedidealibrary;
use App\Repository\Api\Staff\Interfacelayer\Feed\IStafffeedidealibraryApiRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Http;

class StafffeedidealibraryApiRepository implements IStafffeedidealibraryApiRepository
{
    public function staffgetidealibrarylist()
    {
        $used_idealibrary = Stafffeedidealibrary::where('active', true)
            ->whereHas('idealibable', fn(Builder $q) =>
                $q->whereNotNull('idealibable_id')
                    ->whereHas('feedpostable', fn(Builder $q) =>
                        $q->where('uuid', auth()->user()->uuid)))
            ->get()->pluck('uuid');
        return [true, [
            'idealibrary' => StaffidealibraryResource::collection(Stafffeedidealibrary::where('active', true)->whereNotIn('uuid', $used_idealibrary)->get()),
        ], 'staffgetidealibrarylist'];
    }

    public function staffselectidealibrary()
    {
        $school_code = App::make('generalsetting')->code;
        $response = Http::post(config('archive.online_assessment.path') . '/getidealibrary', [
            'key' => config('archive.online_assessment.key'),
            'schoolcode' => $school_code,
            "searchterm" => '',
        ]);
        if ($response->successful()) {
            $response = json_decode($response->body());
            $idealibrary = collect($response->idealibrary);

        } else {
            $idealibrary = null;
        }
        return [true, $idealibrary->where('uuid', request('idealibrary_uuid'))->flatten(), 'staffselectidealibrary'];
    }

    public function staffusedidealibrary()
    {
        return [true, 'success', 'staffusedidealibrary'];
    }
}
