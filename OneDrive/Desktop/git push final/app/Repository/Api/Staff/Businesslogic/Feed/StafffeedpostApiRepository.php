<?php

namespace App\Repository\Api\Staff\Businesslogic\Feed;

use App\Http\Resources\Staff\Feed\Feedpost\StafffeedpostCollection;
use App\Http\Resources\Staff\Feed\Feedpost\StaffFeedpostResource;
use App\Models\Admin\Feeds\Feedpoll;
use App\Models\Admin\Feeds\Feedpost;
use App\Models\Admin\Feeds\Feedtag;
use App\Models\Admin\Feeds\Stafffeedidealibrary;
use App\Models\Commonhelper\Gamification\Gamificationfeedhelper;
use App\Models\Commontraits\Uploadtraits\Feedpost\FeedpostUploadTrait;
use App\Models\Miscellaneous\Helper;
use App\Repository\Api\Staff\Businesslogic\Feed\StafffeedpostApiRepository;
use App\Repository\Api\Staff\Interfacelayer\Feed\IStafffeedpostApiRepository;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Storage;

class StafffeedpostApiRepository implements IStafffeedpostApiRepository
{
    use FeedpostUploadTrait;

    public function staffcreatefeedpost()
    {

        $user = auth()->user();

        $payload = [
            'post' => request()->post,
            'type' => request()->type,
            'is_mediatype' => request()->is_mediatype,
        ];

        switch (request('type')) {
            case 1:
                $feedpost = $this->feedpostlogic($payload);
                break;
            case 2:
                $feedpost = $this->feedpostachivement($payload);
                break;
            case 3:
                $feedpost = $this->feedpostpoll($payload);
                break;
            default:
                DB::rollback();
                return [false, 'invalid type'];
        }

        $this->feedposthashtag($feedpost);

        Gamificationfeedhelper::gamificationfeedpost($user, $feedpost, request('type'));

        Helper::trackmessage($user, 'Staff Feed Post Create ',
            'staff_api_staffcreatefeedpost_type_' . config('feedarchive.feed_type')[request('type')],
            substr(request()->header('authorization'), -33),
            'API');

        DB::commit();

        //  (request()->is_mediatype == 2) ? event(new FeedposttrimvideoEvent($feedpost)) : null;

        if ($feedpost->idealibable) {
            return [true, ['reward_popup' => 'You Have Earned ' . $feedpost->idealibable->starvalue . ' Star',
                'star_count' => 'Total Star : ' . $user->gamificationable->sum('star')]];
        } elseif ($user->feedpost->where('type', request('type'))->whereNull('idealibable_id')->count() <= 10) {
            return [true, ['reward_popup' => 'You Have Earned ' . config('gamificationarchive.staff_gamification')[request('type')] . ' Star',
                'star_count' => 'Total Star : ' . $user->gamificationable->sum('star')]];
        } else {
            return [true, ['reward_popup' => false]];
        }
    }

    public function staffupdatefeedpost()
    {
        $feedpost = Feedpost::where('uuid', request('feedpostuuid'))->first();
        $user = auth()->user();
        if ($feedpost->feedpostable->uuid == $user->uuid) {
            $feedpost->post = request('post');
            $feedpost->save();

            $this->feedposthashtag($feedpost);

            Helper::trackmessage($user, 'Staff Feed Post Create ', 'staff_api_staffupdatefeedpost', substr(request()->header('authorization'), -33), 'API');

            DB::commit();
            return [true, 'staffupdatefeedpost'];
        } else {
            DB::rollback();
            return [false, "Invalid User", 'staffupdatefeedpost'];
        }
    }

    public function staffgetallfeedpost()
    {
        return [true,
            new StafffeedpostCollection(
                Feedpost::withCount([
                    'feedpostlike' => fn(Builder $query) => $query->where('active', true),
                    'feedcomment' => fn(Builder $query) => $query->where('active', true),
                ])
                    ->with('feedpoll')
                    ->where('active', true)
                    ->where('reported_stage', '<>', 4)
                    ->where('is_notstike', true)
                    ->latest()
                    ->paginate(15)),
            'staffgetallfeedpost'];
    }

    public function staffgetmyfeedpost()
    {
        return [true,
            new StafffeedpostCollection(
                auth()->user()
                    ->feedpost()
                    ->withCount([
                        'feedpostlike' => fn(Builder $query) => $query->where('active', true),
                        'feedcomment' => fn(Builder $query) => $query->where('active', true),
                    ])
                    ->with('feedpoll')
                    ->where('active', true)
                    ->where('reported_stage', '<>', 4)
                    ->where('is_notstike', true)
                    ->latest()
                    ->paginate(15)),
            'staffgetmyfeedpost'];
    }

    public function staffgetalltrendingfeedpost()
    {
        return [true,
            new StafffeedpostCollection(
                Feedpost::withCount([
                    'feedpostlike' => fn(Builder $query) => $query->where('active', true),
                    'feedcomment' => fn(Builder $query) => $query->where('active', true),
                ])
                    ->with('feedpoll')
                    ->where('active', true)
                    ->where('reported_stage', '<>', 4)
                    ->where('is_notstike', true)
                    ->orderBy('feedcomment_count', 'desc') //based on what trending either comment or like, we can change it here
                    ->latest()
                    ->paginate(15)),
            'staffgetalltrendingfeedpost'];
    }

    public function staffgetbyuuidfeedpost()
    {
        return [true,
            ['feedpost' => [new StaffFeedpostResource(
                Feedpost::where('uuid', request('feedpostuuid'))
                    ->withCount([
                        'feedpostlike' => fn(Builder $query) => $query->where('active', true),
                        'feedcomment' => fn(Builder $query) => $query->where('active', true),
                    ])->first()
            )]],
            'staffgetbyuuidfeedpost'];
    }

    public function staffstatusupdatefeedpost()
    {
        $feedpost = Feedpost::where('uuid', request('feedpostuuid'))->first();
        $user = auth()->user();

        if ($feedpost->feedpostable->uuid == $user->uuid) {
            $feedpost->update([
                'active' => request('active'),
            ]);

            Helper::trackmessage($user, 'Staff Feed Post Status Update ', 'staff_api_staffstatusupdatefeedpost', substr(request()->header('authorization'), -33), 'API');

            DB::commit();
            return [true, 'staffstatusupdatefeedpost'];
        } else {
            DB::rollback();
            return [false, "Invalid User", 'staffstatusupdatefeedpost'];
        }
    }

    public function staffdeletefeedpost()
    {
        $feedpost = Feedpost::where('uuid', request('feedpostuuid'))->first();
        $user = auth()->user();

        if ($feedpost->feedpostable->uuid == $user->uuid) {

            foreach ($feedpost->feedcomment as $eachfeedcomment) {
                Gamificationfeedhelper::gamificationfeedengagepeercomment($eachfeedcomment->feedcommentable);
            }
            foreach ($feedpost->feedpostlike as $eachfeedpostlike) {
                Gamificationfeedhelper::gamificationfeedengagepeerlike($eachfeedpostlike->feedpostlikeable);
            }

            $feedpost->gamefunctionable()->delete();
            $feedpost->delete();

            Helper::trackmessage($user, 'Staff Feed Post Delete ', 'staff_api_staffdeletefeedpost', substr(request()->header('authorization'), -33), 'API');

            DB::commit();
            return [true, 'staffdeletefeedpost'];
        } else {
            DB::rollback();
            return [true, 'staffdeletefeedpost'];
        }
    }

    protected function feedpostlogic($payload)
    {
        switch (request()->is_mediatype) {
            case 0:
                $payload = $payload;
                break;
            case 1:
                $payload = array_merge($payload, ['image' => $this->postimage()]);
                break;
            case 2:
                $payload = array_merge($payload, ['video' => $this->postvideo()]);
                break;
            default:
                return [false, 'invalid type media type'];
        }
        if (request()->idealibrary_uuid) {

            $feedpost = auth()->user()
                ->feedpost()
                ->save(new Feedpost($payload));

            $feedpost->idealibable()
                ->associate(Stafffeedidealibrary::where('uuid', request()->idealibrary_uuid)->first())
                ->save();

            return $feedpost;

        } else {
            return auth()->user()
                ->feedpost()
                ->save(new Feedpost($payload));
        }
    }

    protected function feedpostachivement($payload)
    {
        return auth()->user()
            ->feedpost()
            ->save(new Feedpost(
                (request()->is_mediatype == 1) ? array_merge($payload, ['image' => $this->postimage()]) : $payload
            ));

    }

    protected function feedpostpoll($payload)
    {
        $feedpost = auth()->user()
            ->feedpost()
            ->save(new Feedpost($payload));

        foreach (json_decode(request()->poll, true) as $eachpoll) {
            Feedpoll::create([
                'feedpost_id' => $feedpost->id,
                'name' => $eachpoll,
            ]);
        }
        return $feedpost;
    }

    protected function feedposthashtag($feedpost)
    {
        if (request('hashtag')) {
            $feedtagid = [];
            foreach (explode(',', request('hashtag')) as $eachtag) {
                $feedtag = Feedtag::where('name', trim($eachtag))->first();
                if ($feedtag) {
                    array_push($feedtagid, $feedtag->id);
                } else {
                    array_push($feedtagid, auth()->user()->feedtag()->create(
                        ['name' => trim($eachtag)]
                    )->id);
                }
            }
            $feedpost->feedtag()->sync($feedtagid);
        } else {
            $feedpost->feedtag()->detach();
        }
    }

    protected function postimage()
    {
        $insert = [];
        $images = [];
        $count = 1;
        for ($i = 0; $i < 10; $i++) {
            if (request()->hasFile('images' . $count)) {
                $images[$i] = request('images' . $count);
                $count += 1;
            }
        }
        foreach ($images as $key => $file) {
            $insert[$key]['images'] = $this->newimagefomrat($file);
        }
        return json_encode($insert);
    }

    protected function postvideo()
    {
        return Storage::disk('public')->put(
            'feed/post/video/',
            request()->file('video'),
            'public'
        );
    }

}
