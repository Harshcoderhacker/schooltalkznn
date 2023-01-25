<?php

namespace App\Repository\Api\Admin\Businesslogic\Notification;

use App\Http\Resources\Admin\Feed\Feedpost\FeedpostResource;
use App\Http\Resources\Common\Notification\UsernotificationCollection;
use App\Models\Admin\Feeds\Feedpost;
use App\Repository\Api\Admin\Interfacelayer\Notification\IAdminnotificationApiRepository;
use DB;
use Illuminate\Database\Eloquent\Builder;

class AdminnotificationApiRepository implements IAdminnotificationApiRepository
{
    public function getadminnotification()
    {
        return [true,
            new UsernotificationCollection(auth()->user()->notifications()->paginate(15)),
            'getadminnotification'];
    }

    public function adminmarkasreadnotification()
    {
        return [true, auth()->user()->unreadNotifications->markAsRead(), 'adminmarkasreadnotification'];
    }

    public function getadminnotificationdetails()
    {

        $notification = DB::table('notifications')->where('id', request('notification_uuid'))->first();
        if ($notification) {
            $data = json_decode($notification->data);

            switch ($data->type) {
                case 'FEEDPOST':

                    $feedpost = Feedpost::withCount([
                        'feedpostlike' => fn(Builder $query) => $query->where('active', true),
                        'feedcomment' => fn(Builder $query) => $query->where('active', true),
                    ])->where('id', $data->feedpost_id)
                        ->first();

                    if ($feedpost) {

                        return [true,
                            ['feedpost' => [new FeedpostResource($feedpost)]],
                            'getadminnotificationdetails'];

                    } else {
                        return [false, 'Oops! Posts Deleted'];
                    }

                    break;
                case 'CHAT':
                    // Will do later
                    break;
                case 'HOMEWORK':
                    // Will do later
                    break;
                    return [false, 'invalid notification type'];
            }
        } else {
            return [false, 'invalid notification id : ' . request('notification_uuid')];
        }

    }

    public function getadminpushnotificationdetails()
    {

        switch (request('type')) {
            case 'FEEDPOST':

                $feedpost = Feedpost::withCount([
                    'feedpostlike' => fn(Builder $query) => $query->where('active', true),
                    'feedcomment' => fn(Builder $query) => $query->where('active', true),
                ])->where('uuid', request('pushnotification_uuid'))
                    ->first();

                if ($feedpost) {
                    return [true, ['feedpost' => [new FeedpostResource($feedpost)]], 'getadminpushnotificationdetails'];

                } else {
                    return [false, 'Oops! Posts Deleted'];
                }

                break;
            case 'CHAT':
                // Will do later
                break;
            case 'HOMEWORK':
                // Will do later
                break;
                return [false, 'invalid notification type'];
        }

    }

}
