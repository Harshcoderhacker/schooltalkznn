<?php

namespace App\Repository\Api\Parent\Businesslogic\Notification;

use App\Http\Resources\Admin\Feed\Feedpost\FeedpostResource;
use App\Http\Resources\Common\Notification\UsernotificationCollection;
use App\Models\Admin\Feeds\Feedpost;
use App\Models\Parent\Parenthelper\Parenthelper;
use App\Repository\Api\Parent\Interfacelayer\Notification\IParentnotificationApiRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class ParentnotificationApiRepository implements IParentnotificationApiRepository
{
    public function getparentnotification()
    {
        return [true,
            new UsernotificationCollection(Parenthelper::getstudent()->notifications()->paginate(15)),
            'getparentnotification'];
    }

    public function parentmarkasreadnotification()
    {
        return [true, Parenthelper::getstudent()->unreadNotifications->markAsRead(), 'parentmarkasreadnotification'];
    }

    public function getparentnotificationdetails()
    {

        $notification = DB::table('notifications')->where('id', request('notification_uuid'))->first();
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
                        'getparentnotificationdetails'];

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
            default:
                DB::rollback();
                return [false, 'invalid notification type'];
        }

    }

    public function getparentpushnotificationdetails()
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
