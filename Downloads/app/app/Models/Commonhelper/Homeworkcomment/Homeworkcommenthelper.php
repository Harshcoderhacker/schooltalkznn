<?php

namespace App\Models\Commonhelper\Homeworkcomment;

use App\Models\Admin\Auth\User;
use App\Models\Admin\Homework\Homeworkcomment;
use App\Models\Commonhelper\Homeworkcomment\Homeworkcommenthelper;
use Illuminate\Database\Eloquent\Model;

class Homeworkcommenthelper extends Model
{
    public static function homeworkcommentpost($user, $body, $homeworklist)
    {
        Homeworkcommenthelper::read_at(
            $user->homeworkcomment()
                ->save(new Homeworkcomment([
                    'homework_id' => $homeworklist->homework_id,
                    'homeworklist_id' => $homeworklist->id,
                    'body' => $body,
                ])), $user, $homeworklist);
    }

    public static function read_at($homeworkcomment, $user, $homeworklist)
    {
        // STUDENT Read At record create
        if ($user->usertype != 'STUDENT') {
            $homeworkcomment->homeworkcommentpivot()
                ->make([
                    'homework_id' => $homeworklist->homework_id,
                    'homeworklist_id' => $homeworklist->id,
                ])
                ->homeworkcommentsender()->associate($user)
                ->homeworkcommentreceiver()->associate($homeworklist->student)
                ->save();
        }

        // STAFF Read At record create
        if ($user->usertype != 'STAFF' &&
            $homeworklist->homework->assignsubject &&
            $homeworklist->homework->assignsubject->staff_id) {

            $homeworkcomment->homeworkcommentpivot()
                ->make([
                    'homework_id' => $homeworklist->homework_id,
                    'homeworklist_id' => $homeworklist->id,
                ])
                ->homeworkcommentsender()->associate($user)
                ->homeworkcommentreceiver()->associate($homeworklist->homework->assignsubject->staff)
                ->save();
        }

        // ADMIN Read At record create
        if ($user->usertype == 'ADMIN') {
            User::isaccountactive()
                ->where('id', '<>', $user->id)
                ->get()
                ->each(fn($admin) =>
                    $homeworkcomment->homeworkcommentpivot()
                        ->make([
                            'homework_id' => $homeworklist->homework_id,
                            'homeworklist_id' => $homeworklist->id,
                        ])
                        ->homeworkcommentsender()->associate($user)
                        ->homeworkcommentreceiver()->associate($admin)
                        ->save()
                );

        } else { // all admin Read At
            User::isaccountactive()->get()
                ->each(fn($admin) =>
                    $homeworkcomment->homeworkcommentpivot()
                        ->make([
                            'homework_id' => $homeworklist->homework_id,
                            'homeworklist_id' => $homeworklist->id,
                        ])
                        ->homeworkcommentsender()->associate($user)
                        ->homeworkcommentreceiver()->associate($admin)
                        ->save()
                );

        }

    }

}
