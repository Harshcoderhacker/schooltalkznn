<?php

namespace App\Repository\Api\Admin\Businesslogic\Feed;

use App\Http\Resources\Admin\Feed\Feedpost\FeedpostCollection;
use App\Http\Resources\Admin\Feed\Feedpost\FeedpostResource;
use App\Models\Admin\Feeds\Feedpoll;
use App\Models\Admin\Feeds\Feedpost;
use App\Models\Admin\Feeds\Feedtag;
use App\Models\Commonhelper\Gamification\Gamificationfeedhelper;
use App\Models\Commontraits\Uploadtraits\Feedpost\FeedpostUploadTrait;
use App\Models\Miscellaneous\Helper;
use App\Repository\Api\Admin\Interfacelayer\Feed\IAdminfeedpostApiRepository;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Storage;

class AdminfeedpostApiRepository implements IAdminfeedpostApiRepository
{
    use FeedpostUploadTrait;

    public function admincreatefeedpost()
    {

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

        Helper::trackmessage(auth()->user(), 'Admin Feed Post Create ',
            'admin_api_admincreatefeedpost_type_' . config('feedarchive.feed_type')[request('type')],
            substr(request()->header('authorization'), -33),
            'API');

        DB::commit();

        // (request()->is_mediatype == 2) ? event(new FeedposttrimvideoEvent($feedpost)) : null;
        return [true, 'admincreatefeedpost'];
    }

    public function adminupdatefeedpost()
    {
        $feedpost = Feedpost::where('uuid', request('feedpostuuid'))->first();

        $feedpost->update([
            'post' => request('post'),
        ]);

        $this->feedposthashtag($feedpost);

        Helper::trackmessage(auth()->user(), 'Admin Feed Post Create ', 'admin_api_adminupdatefeedpost', substr(request()->header('authorization'), -33), 'API');
        DB::commit();

        return [true, 'adminupdatefeedpost'];
    }

    public function admingetallfeedpost()
    {
        return [true,
            new FeedpostCollection(
                Feedpost::withCount([
                    'feedpostlike' => fn(Builder $query) => $query->where('active', true),
                    'feedcomment' => fn(Builder $query) => $query->where('active', true),
                ])
                    ->with('feedpoll', 'feedtag')
                    ->where('active', true)
                    ->where('reported_stage', '<>', 4)
                    ->where('is_notstike', true)
                    ->latest()
                    ->paginate(15)),
            'admingetallfeedpost'];
    }

    public function admingetmyfeedpost()
    {
        return [true,
            new FeedpostCollection(
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
            'admingetmyfeedpost'];
    }

    public function admingetalltrendingfeedpost()
    {
        return [true,
            new FeedpostCollection(
                Feedpost::withCount([
                    'feedpostlike' => fn(Builder $query) => $query->where('active', true),
                    'feedcomment' => fn(Builder $query) => $query->where('active', true),
                    'feedpollcount',
                ])
                    ->with('feedpoll')
                    ->where('active', true)
                    ->where('reported_stage', '<>', 4)
                    ->where('is_notstike', true)
                    ->orderBy('feedcomment_count', 'desc') //based on what trending either comment or like, we can change it here
                    ->latest()
                    ->paginate(15)),
            'admingetalltrendingfeedpost'];
    }

    public function admingetbyuuidfeedpost()
    {
        return [true,
            ['feedpost' => [new FeedpostResource(
                Feedpost::where('uuid', request('feedpostuuid'))
                    ->withCount([
                        'feedpostlike' => fn(Builder $query) => $query->where('active', true),
                        'feedcomment' => fn(Builder $query) => $query->where('active', true),
                    ])->first()
            )]],
            'admingetbyuuidfeedpost'];
    }

    public function adminstatusupdatefeedpost()
    {
        Feedpost::where('uuid', request('feedpostuuid'))
            ->update([
                'active' => request('active'),
            ]);
        Helper::trackmessage(auth()->user(), 'Admin Feed Post Status Update ', 'admin_api_adminstatusupdatefeedpost', substr(request()->header('authorization'), -33), 'API');
        DB::commit();

        return [true, 'adminstatusupdatefeedpost'];
    }

    public function admindeletefeedpost()
    {
        $feedpost = Feedpost::where('uuid', request('feedpostuuid'))->first();

        foreach ($feedpost->feedcomment as $eachfeedcomment) {
            Gamificationfeedhelper::gamificationfeedengagepeercomment($eachfeedcomment->feedcommentable);
        }
        foreach ($feedpost->feedpostlike as $eachfeedpostlike) {
            Gamificationfeedhelper::gamificationfeedengagepeerlike($eachfeedpostlike->feedpostlikeable);
        }

        $feedpost->gamefunctionable()->delete();
        $feedpost->delete();

        Helper::trackmessage(auth()->user(), 'Admin Feed Post Delete ', 'admin_api_admindeletefeedpost', substr(request()->header('authorization'), -33), 'API');
        DB::commit();

        return [true, 'admindeletefeedpost'];
    }

    protected function feedpostlogic($payload)
    {

        switch (request()->is_mediatype) {
            case 0:
                return auth()->user()
                    ->feedpost()
                    ->save(new Feedpost($payload));
                break;
            case 1:
                return auth()->user()
                    ->feedpost()
                    ->save(new Feedpost(
                        array_merge($payload, ['image' => $this->postimage()])
                    ));
                break;
            case 2:
                return auth()->user()
                    ->feedpost()
                    ->save(new Feedpost(
                        array_merge($payload, ['video' => $this->postvideo()])
                    ));
                break;
            default:
                return [false, 'invalid type media type'];
        }

    }

    protected function feedpostachivement($payload)
    {
        return auth()->user()->feedpost()
            ->save(new Feedpost(
                (request()->is_mediatype == 1) ? array_merge($payload, ['image' => $this->postimage()]) : $payload
            ));

    }

    protected function feedpostpoll($payload)
    {
        $feedpost = auth()->user()->feedpost()
            ->save(new Feedpost($payload));

        foreach (json_decode(request('poll'), true) as $eachpoll) {
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
            'feed/post/video',
            request()->file('video'),
            'public'
        );
    }

}
