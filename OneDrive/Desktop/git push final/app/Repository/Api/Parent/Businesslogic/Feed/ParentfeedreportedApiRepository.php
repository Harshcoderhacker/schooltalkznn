<?php

namespace App\Repository\Api\Parent\Businesslogic\Feed;

use App\Models\Admin\Feeds\Feedpost;
use App\Models\Admin\Feeds\Feedreported;
use App\Models\Admin\Feeds\Feedreportedpivot;
use App\Models\Miscellaneous\Helper;
use App\Models\Parent\Parenthelper\Parenthelper;
use App\Repository\Api\Parent\Interfacelayer\Feed\IParentfeedreportedApiRepository;
use Illuminate\Support\Facades\DB;

class ParentfeedreportedApiRepository implements IParentfeedreportedApiRepository
{
    public function parentgetallfeedreportedlist()
    {
        return [true,
            Feedreported::where('active', true)->select('name', 'uuid')->get(),
            'parentgetallfeedreportedlist'];
    }

    public function parentfeedreportedstatusupdate()
    {
        $student = Parenthelper::getstudent();

        $feedpost = Feedpost::where('uuid', request('feedpostuuid'))
            ->first();

        if ($student->feedreportedpivot->where('feedpost_id', $feedpost->id)->count() == 0) {

            $student->feedreportedpivot()
                ->save(new Feedreportedpivot([
                    'feedpost_id' => $feedpost->id,
                    'feedreported_id' => $feedreported = Feedreported::where('uuid', request('feedreporteduuid'))->first()->id,
                ]));

            $feedpost->reported_stage = 2;
            $feedpost->save();

            Helper::trackmessage(auth()->user(),
                'Parent Feed Post Reported ',
                'parent_api_parentfeedreportedpivottoggle_updated',
                substr(request()->header('authorization'), -33),
                'API');

            $message = 'Successfully Updated';
        } else {
            $message = 'Already Updated';
        }

        DB::commit();
        return [true, ['feedreported' => $message], 'parentfeedreportedstatusupdate'];

    }
}
