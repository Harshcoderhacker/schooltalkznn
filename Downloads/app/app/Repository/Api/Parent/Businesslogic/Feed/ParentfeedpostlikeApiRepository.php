<?php

namespace App\Repository\Api\Parent\Businesslogic\Feed;

use App\Http\Resources\Admin\Feed\Feedpostlike\FeedpostlikelistCollection;
use App\Models\Admin\Feeds\Feedpost;
use App\Models\Admin\Feeds\Feedpostlike;
use App\Models\Commonhelper\Gamification\Gamificationfeedhelper;
use App\Models\Miscellaneous\Helper;
use App\Models\Parent\Parenthelper\Parenthelper;
use App\Repository\Api\Parent\Interfacelayer\Feed\IParentfeedpostlikeApiRepository;
use Illuminate\Support\Facades\DB;

class ParentfeedpostlikeApiRepository implements IParentfeedpostlikeApiRepository
{
    public function parentfeedpostliketoggle()
    {

        $student = Parenthelper::getstudent();

        $feedpost = Feedpost::where('uuid', request('feedpostuuid'))
            ->first();

        $feedpostlikecount = $student->feedpostlike->where('feedpost_id', $feedpost->id)->count();
        if ($feedpostlikecount == 0) {

            $student->feedpostlike()
                ->save(new Feedpostlike([
                    'feedpost_id' => $feedpost->id,
                ]));

            $toggle = 'attach';
        } else {
            $student->feedpostlike()->where('feedpost_id', $feedpost->id)->first()->delete();
            $toggle = 'detach';
        }

        Gamificationfeedhelper::gamificationfeedlike($feedpost);
        $modulo = Gamificationfeedhelper::gamificationfeedengagepeerlike($student);

        $reward_popup = ($modulo == 0 && $toggle == "attach") ? 'You Have Earned ' . config('gamificationarchive.student_gamification')[4] . ' Stars' : false;

        Helper::trackmessage($student,
            'Parent Feed Post Like ',
            'parent_api_parentfeedpostliketoggle_' . $toggle,
            substr(request()->header('authorization'), -33),
            'API');

        DB::commit();
        return [true,
            ['toggle' => $toggle, 'reward_popup' => $reward_popup, 'star_count' => 'Total Star : ' . $student->gamificationable->sum('star')],
            'parentfeedpostliketoggle'];
    }

    public function parentfeedpostlikelist()
    {
        return [true,
            new FeedpostlikelistCollection(
                Feedpost::where('uuid', request('feedpostuuid'))
                    ->first()
                    ->feedpostlike()
                    ->paginate(15)
            ),
            'parentfeedpostlikelist'];
    }

}
