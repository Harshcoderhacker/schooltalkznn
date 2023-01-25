<?php

namespace App\Repository\Api\Parent\Businesslogic\Feed;

use App\Http\Resources\Parent\Feed\Feedcommentreply\ParentfeedcommentreplyCollection;
use App\Models\Admin\Feeds\Feedcomment;
use App\Models\Admin\Feeds\Feedcommentreply;
use App\Models\Miscellaneous\Helper;
use App\Models\Parent\Parenthelper\Parenthelper;
use App\Repository\Api\Parent\Businesslogic\Feed\ParentfeedcommentreplyApiRepository;
use App\Repository\Api\Parent\Interfacelayer\Feed\IParentfeedcommentreplyApiRepository;
use DB;
use Illuminate\Database\Eloquent\Builder;

class ParentfeedcommentreplyApiRepository implements IParentfeedcommentreplyApiRepository
{
    public function parentcreatefeedpostcommentreply()
    {

        $feedcomment = Feedcomment::where('uuid', request('feedcommentuuid'))
            ->first();

        Parenthelper::getstudent()
            ->feedcommentreply()
            ->save(new Feedcommentreply([
                'feedpost_id' => $feedcomment->feedpost_id,
                'feedcomment_id' => $feedcomment->id,
                'reply' => request('reply'),
            ]));

        Helper::trackmessage(Parenthelper::getstudent(), 'Parent Feed Post Create ', 'parent_api_parentcreatefeedpostcommentreply', substr(request()->header('authorization'), -33), 'API');
        DB::commit();
        return [true, 'parentcreatefeedpostcommentreply'];
    }

    public function parentgetcommentreplybycommentuuid()
    {
        return [true, new ParentfeedcommentreplyCollection(
            Feedcommentreply::whereHas('feedcomment', fn(Builder $q) => $q->where('uuid', request('feedcommentuuid')))
                ->where('is_notstike', true)
                ->where('active', true)
                ->latest()
                ->paginate(15)),
            'parentgetcommentreplybycommentuuid'];
    }

    public function parentcommentreplyupdatebyuuid()
    {
        $feedcommentreply = Feedcommentreply::where('uuid', request('feedcommentreplyuuid'))->first();

        if ($feedcommentreply->feedcommentreplyable->uuid == Parenthelper::getstudentuuid()) {
            $feedcommentreply->update([
                'reply' => request('reply'),
            ]);

            Helper::trackmessage(Parenthelper::getstudent(), 'Parent Feed Post Create ', 'parent_api_parentcommentreplyupdatebyuuid',
                substr(request()->header('authorization'), -33),
                'API');

            DB::commit();

            return [true, 'parentcommentreplyupdatebyuuid'];
        } else {
            DB::rollback();
            return [false, 'invalid user', 'parentcommentreplyupdatebyuuid'];
        }
    }

    public function parentcommentreplystatusupdate()
    {
        $feedcommentreply = Feedcommentreply::where('uuid', request('feedcommentreplyuuid'))->first();

        if ($feedcommentreply->feedcommentreplyable->uuid == Parenthelper::getstudentuuid()) {
            $feedcommentreply->update([
                'active' => request('active'),
            ]);

            Helper::trackmessage(Parenthelper::getstudent(), 'Parent Feed Post Create ', 'parent_api_parentcommentreplystatusupdate',
                substr(request()->header('authorization'), -33),
                'API');

            DB::commit();
            return [true, 'parentcommentreplystatusupdate'];
        } else {
            DB::rollback();
            return [false, 'parentcommentreplystatusupdate'];
        }
    }

    public function parentcommentreplydelete()
    {
        $feedcommentreply = Feedcommentreply::where('uuid', request('feedcommentreplyuuid'))->first();

        if ($feedcommentreply->feedcommentreplyable->uuid == Parenthelper::getstudentuuid()) {
            $feedcommentreply->delete();

            Helper::trackmessage(Parenthelper::getstudent(), 'Parent Feed Post Create ', 'parent_api_parentcommentreplydelete',
                substr(request()->header('authorization'), -33),
                'API');

            DB::commit();
            return [true, 'parentcommentreplydelete'];
        } else {
            DB::rollback();
            return [false, 'parentcommentreplydelete'];
        }
    }
}
