<?php

namespace App\Repository\Api\Staff\Businesslogic\Notification;

use App\Http\Resources\Admin\Feed\Feedpost\FeedpostResource;
use App\Http\Resources\Common\Notification\UsernotificationCollection;
use App\Models\Admin\Feeds\Feedpost;
use App\Repository\Api\Staff\Interfacelayer\Notification\IStaffnotificationApiRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class StaffnotificationApiRepository implements IStaffnotificationApiRepository
{
    public function getstaffnotification()
    {
        return [true,
            new UsernotificationCollection(auth()->user()->notifications()->paginate(15)),
            'getstaffnotification'];
    }

    public function staffmarkasreadnotification()
    {
        return [true, auth()->user()->unreadNotifications->markAsRead(), 'adminmarkasreadnotification'];
    }

    public function getstaffnotificationdetails()
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
                        'getstaffnotificationdetails'];

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

    public function getstaffpushnotificationdetails()
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
