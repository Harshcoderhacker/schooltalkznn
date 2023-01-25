<?php

namespace App\Repository\Api\Admin\Businesslogic\Feed;

use App\Http\Resources\Admin\Feed\Feedpostlike\FeedpostlikelistCollection;
use App\Models\Admin\Feeds\Feedpost;
use App\Models\Admin\Feeds\Feedpostlike;
use App\Models\Miscellaneous\Helper;
use App\Repository\Api\Admin\Interfacelayer\Feed\IAdminfeedpostlikeApiRepository;
use Illuminate\Support\Facades\DB;

class AdminfeedpostlikeApiRepository implements IAdminfeedpostlikeApiRepository
{
    public function adminfeedpostliketoggle()
    {
        $user = auth()->user();

        $feedpost = Feedpost::where('uuid', request('feedpostuuid'))
            ->first();

        if ($user->feedpostlike->where('feedpost_id', $feedpost->id)->count() == 0) {

            $user->feedpostlike()
                ->save(new Feedpostlike([
                    'feedpost_id' => $feedpost->id,
                ]));

            $toggle = 'attach';
        } else {
            $user->feedpostlike()->where('feedpost_id', $feedpost->id)->first()->delete();
            $toggle = 'detach';
        }

        Helper::trackmessage($user,
            'Admin Feed Post Like ',
            'admin_api_adminfeedpostliketoggle_' . $toggle,
            substr(request()->header('authorization'), -33),
            'API');

        DB::commit();
        return [true, ['toggle' => $toggle], 'adminfeedpostliketoggle'];
    }

    public function adminfeedpostlikelist()
    {
        return [true,
            new FeedpostlikelistCollection(
                Feedpost::where('uuid', request('feedpostuuid'))
                    ->first()
                    ->feedpostlike()
                    ->paginate(15)
            ),
            'adminfeedpostlikelist'];
    }
}
