<?php

use App\Models\Admin\Chat\Chatgroup;
use Illuminate\Support\Facades\Broadcast;

// Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
//     return (int) $user->id === (int) $id;
// });

Broadcast::channel('chatbroadcast', function ($user) {
    return true;
});

Broadcast::channel('chatgroup.{chatgroup}', function ($user, Chatgroup $chatgroup) {
    return true;
    // return $chatgroup->chatparticipant()
    //     ->whereHas('chatparticipantable', fn($q) => $q->where('uuid', $user->uuid))
    //     ->count() > 0;

});

Broadcast::channel('testsss', function ($user) {
    return false;
});
