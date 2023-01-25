<?php

namespace App\Repository\Api\Parent\Businesslogic\Feed;

use App\Http\Resources\Parent\Feed\Feedcomment\ParentfeedcommentCollection;
use App\Models\Admin\Feeds\Feedcomment;
use App\Models\Admin\Feeds\Feedpost;
use App\Models\Commonhelper\Gamification\Gamificationfeedhelper;
use App\Models\Miscellaneous\Helper;
use App\Models\Parent\Parenthelper\Parenthelper;
use App\Repository\Api\Parent\Interfacelayer\Feed\IParentfeedpostcommentApiRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class ParentfeedpostcommentApiRepository implements IParentfeedpostcommentApiRepository
{
    public function parentcreatefeedpostcomment()
    {
        $feedpost = Feedpost::where('uuid', request('feedpostuuid'))->first();
        $student = Parenthelper::getstudent();

        $student->feedcomment()
            ->save(new Feedcomment([
                'feedpost_id' => $feedpost->id,
                'comment' => request('feedcomment'),
                'commenttype' => request('commenttype'),
                'commenttype_uuid' => request('commenttype_uuid'),
            ]));

        Gamificationfeedhelper::gamificationfeedcomment($feedpost, 'create');
        $modulo = Gamificationfeedhelper::gamificationfeedengagepeercomment($student);
        $reward_popup = ($modulo == 0) ? 'You Have Earned ' . config('gamificationarchive.student_gamification')[5] . ' Stars' : false;

        Helper::trackmessage($student, 'Parent Feed Post Comment Create ', 'parent_api_parentcreatefeedpostcomment', substr(request()->header('authorization'), -33), 'API');

        DB::commit();
        return [true,
            ['reward_popup' => $reward_popup, 'star_count' => 'Total Star : ' . $student->gamificationable->sum('star')],
            'parentcreatefeedpostcomment'];
    }

    public function parentupdatefeedpostcomment()
    {
        $feedcomment = Feedcomment::where('uuid', request('feedcommentuuid'))->first();

        if ($feedcomment->feedcommentable->uuid == Parenthelper::getstudentuuid()) {
            $feedcomment->update([
                'comment' => request('feedcomment'),
                'commenttype' => request('commenttype'),
                'commenttype_uuid' => request('commenttype_uuid'),
            ]);

            Helper::trackmessage(Parenthelper::getstudent(), 'Parent Feed Post Comment Update ', 'parent_api_parentupdatefeedpostcomment', substr(request()->header('authorization'), -33), 'API');

            DB::commit();
            return [true, 'parentupdatefeedpostcomment'];
        } else {
            DB::rollback();
            return [false, 'invalid user', 'parentupdatefeedpostcomment'];
        }
    }

    public function parentgetallcommentbypostuuid()
    {
        return [true,
            new ParentfeedcommentCollection(
                Feedcomment::where('feedpost_id',
                    Feedpost::where('uuid', request('feedpostuuid'))
                        ->first()
                        ->id
                )
                    ->where('active', true)
                    ->withCount(['feedcommentreply' => fn(Builder $query) => $query->where('active', true)])
                    ->oldest()
                    ->paginate(15)
            ),
            'parentgetallcommentbypostuuid'];
    }

    public function parentgetcommenttempletelist()
    {
        return [true,
            config('feedarchive.feedcomment_' . ['post', 'archivement', 'poll'][request('post_type') - 1]),
            'parentgetcommenttempletelist'];
    }

    public function parentfeedpostcommentstatusupdate()
    {
        $feedcomment = Feedcomment::where('uuid', request('feedcommentuuid'))->first();

        if ($feedcomment->feedcommentable->uuid == Parenthelper::getstudentuuid()) {
            $feedcomment->update([
                'active' => request('active'),
            ]);

            Helper::trackmessage(Parenthelper::getstudent(), 'Parent Feed Post Comment Status Update ',
                'parent_api_parentfeedpostcommentstatusupdate',
                substr(request()->header('authorization'), -33),
                'API');

            DB::commit();
            return [true, 'parentfeedpostcommentstatusupdate'];
        } else {
            DB::rollback();
            return [false, 'invalid user', 'parentfeedpostcommentstatusupdate'];
        }
    }

    public function parentdeletefeedpostcomment()
    {
        $feedcomment = Feedcomment::where('uuid', request('feedcommentuuid'))->first();

        $student = Parenthelper::getstudent();

        if ($feedcomment->feedcommentable->uuid == $student->uuid) {
            Gamificationfeedhelper::gamificationfeedcomment(
                Feedpost::whereHas('feedcomment',
                    fn(Builder $q) => $q->where('uuid', request('feedcommentuuid')))
                    ->first(), 'delete'
            );
            Gamificationfeedhelper::gamificationfeedengagepeercomment($student);

            $feedcomment->delete();

            Helper::trackmessage(Parenthelper::getstudent(), 'parent Feed Post Comment Delete ', 'parent_api_parentdeletefeedpostcomment', substr(request()->header('authorization'), -33), 'API');
            DB::commit();
            return [true, 'parentdeletefeedpostcomment'];
        } else {
            DB::rollback();
            return [false, 'invalid user', 'parentdeletefeedpostcomment'];
        }
    }
}
