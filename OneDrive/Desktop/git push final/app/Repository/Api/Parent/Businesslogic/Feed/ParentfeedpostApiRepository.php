<?php

namespace App\Repository\Api\Parent\Businesslogic\Feed;

use App\Http\Resources\Parent\Feed\Feedpost\ParentfeedpostCollection;
use App\Http\Resources\Parent\Feed\Feedpost\ParentfeedpostResource;
use App\Models\Admin\Auth\User;
use App\Models\Admin\Feeds\Feedpoll;
use App\Models\Admin\Feeds\Feedpost;
use App\Models\Admin\Feeds\Feedtag;
use App\Models\Admin\Feeds\Studentidealibrary;
use App\Models\Admin\Student\Student;
use App\Models\Commonhelper\Gamification\Gamificationfeedhelper;
use App\Models\Commontraits\Uploadtraits\Feedpost\FeedpostUploadTrait;
use App\Models\Miscellaneous\Helper;
use App\Models\Parent\Parenthelper\Parenthelper;
use App\Models\Staff\Auth\Staff;
use App\Repository\Api\Parent\Businesslogic\Feed\ParentfeedpostApiRepository;
use App\Repository\Api\Parent\Interfacelayer\Feed\IParentfeedpostApiRepository;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Storage;

class ParentfeedpostApiRepository implements IParentfeedpostApiRepository
{
    use FeedpostUploadTrait;

    public function parentcreatefeedpost()
    {
        $student = Parenthelper::getstudent();

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

        Gamificationfeedhelper::gamificationfeedpost($student, $feedpost, request('type'));

        Helper::trackmessage($student, 'Parent Feed Post Create ',
            'parent_api_parentcreatefeedpost_type_' . config('feedarchive.feed_type')[request('type')],
            substr(request()->header('authorization'), -33),
            'API');

        DB::commit();

        // (request()->is_mediatype == 2) ? event(new FeedposttrimvideoEvent($feedpost)) : null;

        if ($feedpost->idealibable) {
            return [true, ['reward_popup' => 'You Have Earned ' . $feedpost->idealibable->starvalue . ' Star',
                'star_count' => 'Total Star : ' . $student->gamificationable->sum('star')]];
        } elseif ($student->feedpost->where('type', request('type'))->whereNull('idealibable_id')->count() <= 10) {
            return [true, ['reward_popup' => 'You Have Earned ' . config('gamificationarchive.student_gamification')[request('type')] . ' Star',
                'star_count' => 'Total Star : ' . $student->gamificationable->sum('star')]];
        } else {
            return [true, ['reward_popup' => false]];
        }

    }

    public function parentupdatefeedpost()
    {
        $feedpost = Feedpost::where('uuid', request('feedpostuuid'))->first();
        if ($feedpost->feedpostable->uuid == Parenthelper::getstudentuuid()) {
            $feedpost->post = request('post');
            $feedpost->save();

            $this->feedposthashtag($feedpost);

            Helper::trackmessage(Parenthelper::getstudent(), 'Parent Feed Post Create ', 'parent_api_parentupdatefeedpost', substr(request()->header('authorization'), -33), 'API');
            DB::commit();
            return [true, 'parentupdatefeedpost'];
        } else {
            DB::rollback();
            return [false, "Invalid User", 'parentupdatefeedpost'];
        }
    }

    public function parentgetallfeedpost()
    {
        return [true,
            new ParentfeedpostCollection(
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
            'parentgetallfeedpost'];
    }

    public function parentgetmyfeedpost()
    {

        /// Need to verify later
        return [true,
            new ParentFeedpostCollection(
                Parenthelper::getstudent()
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
            'parentgetmyfeedpost'];
    }

    public function parentgetmyclassfeedpost()
    {
        return [true,
            new ParentfeedpostCollection(
                Feedpost::withCount([
                    'feedpostlike' => fn(Builder $q) => $q->where('active', true),
                    'feedcomment' => fn(Builder $q) => $q->where('active', true),
                ])->whereHasMorph(
                    'feedpostable',
                    [User::class, Staff::class, Student::class],
                    function (Builder $q, $type) {
                        $column = $type === Student::class ? 'classmaster_id' : 'uuid';
                        $q->where('usertype', '<>', 'ADMIN');
                        if ($column == 'classmaster_id') {
                            $q->where($column, Parenthelper::getstudent()->classmaster_id);
                        } else {
                            $q->whereIn($column, Staff::whereHas('assignsubject',
                                fn(Builder $q) => $q->where('classmaster_id', Parenthelper::getstudent()->classmaster_id))
                                    ->pluck('uuid'));
                        }
                    }
                )
                    ->with('feedpoll')
                    ->where('active', true)
                    ->where('reported_stage', '<>', 4)
                    ->where('is_notstike', true)->latest()
                    ->paginate(15)),
            'parentgetmyclassfeedpost'];
    }

    public function parentgetalltrendingfeedpost()
    {
        return [true,
            new ParentFeedpostCollection(
                Feedpost::withCount([
                    'feedpostlike' => fn(Builder $query) => $query->where('active', true),
                    'feedcomment' => fn(Builder $query) => $query->where('active', true),
                ])
                    ->with('feedpoll')
                    ->where('active', true)
                    ->where('reported_stage', '<>', 4)
                    ->where('is_notstike', true)
                    ->latest()
                    ->orderBy('feedcomment_count', 'desc') //based on what trending either comment or like, we can change it here
                    ->paginate(15)),
            'parentgetalltrendingfeedpost'];
    }

    public function parentgetbyuuidfeedpost()
    {
        return [true,
            ['feedpost' => [new ParentfeedpostResource(
                Feedpost::where('uuid', request('feedpostuuid'))
                    ->withCount([
                        'feedpostlike' => fn(Builder $query) => $query->where('active', true),
                        'feedcomment' => fn(Builder $query) => $query->where('active', true),
                    ])->first()
            )]],
            'parentgetbyuuidfeedpost'];
    }

    public function parentstatusupdatefeedpost()
    {
        $feedpost = Feedpost::where('uuid', request('feedpostuuid'))->first();
        if ($feedpost->feedpostable->uuid == Parenthelper::getstudentuuid()) {
            $feedpost->update([
                'active' => request('active'),
            ]);
            Helper::trackmessage(Parenthelper::getstudent(), 'Parent Feed Post Status Update ', 'parent_api_parentstatusupdatefeedpost', substr(request()->header('authorization'), -33), 'API');
            DB::commit();

            return [true, 'parentstatusupdatefeedpost'];
        } else {
            DB::rollback();
            return [false, "Invalid User", 'parentstatusupdatefeedpost'];
        }
    }

    public function parentdeletefeedpost()
    {
        $feedpost = Feedpost::where('uuid', request('feedpostuuid'))->first();
        if ($feedpost->feedpostable->uuid == Parenthelper::getstudentuuid()) {

            foreach ($feedpost->feedcomment as $eachfeedcomment) {
                Gamificationfeedhelper::gamificationfeedengagepeercomment($eachfeedcomment->feedcommentable);
            }
            foreach ($feedpost->feedpostlike as $eachfeedpostlike) {
                Gamificationfeedhelper::gamificationfeedengagepeerlike($eachfeedpostlike->feedpostlikeable);
            }

            $feedpost->gamefunctionable()->delete();
            $feedpost->delete();
            Helper::trackmessage(Parenthelper::getstudent(), 'Parent Feed Post Delete ', 'parent_api_parentdeletefeedpost', substr(request()->header('authorization'), -33), 'API');
            DB::commit();
            return [true, 'parentdeletefeedpost'];
        } else {
            DB::rollback();
            return [true, 'parentdeletefeedpost'];
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

            $feedpost = Parenthelper::getstudent()
                ->feedpost()
                ->save(new Feedpost($payload));

            $feedpost->idealibable()
                ->associate(Studentidealibrary::where('uuid', request()->idealibrary_uuid)->first())
                ->save();

            return $feedpost;

        } else {
            return Parenthelper::getstudent()
                ->feedpost()
                ->save(new Feedpost($payload));
        }

    }

    protected function feedpostachivement($payload)
    {
        return Parenthelper::getstudent()
            ->feedpost()
            ->save(new Feedpost(
                (request()->is_mediatype == 1) ? array_merge($payload, ['image' => $this->postimage()]) : $payload
            ));
    }

    protected function feedpostpoll($payload)
    {
        $feedpost = Parenthelper::getstudent()
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
                    array_push($feedtagid, Parenthelper::getstudent()->feedtag()->create(
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
