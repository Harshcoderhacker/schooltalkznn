<?php

namespace App\Repository\Api\Staff\Businesslogic\Chat;

use App\Events\Chatgroupevent\ChatmessagesentEvent;
use App\Http\Resources\Staff\Chat\Chatgroupfilter\StaffchatgroupfilterCollection;
use App\Http\Resources\Staff\Chat\Chatgroup\StaffchatgroupCollection;
use App\Http\Resources\Staff\Chat\Chatmessage\StaffchatmessageCollection;
use App\Http\Resources\Staff\Chat\Chatparticipant\StaffchatparticipantResource;
use App\Models\Admin\Chat\Chatgroup;
use App\Models\Admin\Chat\Chatmessage;
use App\Models\Admin\Chat\Chatmessageread;
use App\Repository\Api\Staff\Interfacelayer\Chat\IStaffchatApiRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class StaffchatApiRepository implements IStaffchatApiRepository
{
    public function staffchatrecentlist()
    {

        return [true,
            new StaffchatgroupCollection(
                Chatgroup::where('active', true)
                    ->whereRelation('chatparticipant.chatparticipantable', 'uuid', auth()->user()->uuid)
                    ->whereIn('chattype', [1, 2, 3, 4])
                    ->where(function (Builder $q) {
                        return $q->whereJsonContains('staff_pluck', auth()->user()->id)
                            ->orWhereHas('assignsubject', fn($q) => $q->where('staff_id', auth()->user()->id));
                    })
                    ->with(['chatmessage' => function ($q) {
                        $q->latest();
                    }])
                    ->withCount(['chatmessageread' => function ($q) {
                        $q->whereNull('read_at')
                            ->whereHas('chatmessagereadable',
                                fn($q) => $q->where('uuid', auth()->user()->uuid));
                    }])
                    ->orderByDesc('lastupdated_at')
                    ->paginate(100)
            ),
            'staffchatrecentlist'];
    }

    public function staffchatgrouplist()
    {

        return [true,
            new StaffchatgroupCollection(
                Chatgroup::where('active', true)
                    ->whereIn('chattype', [1, 2])
                    ->where(function (Builder $q) {
                        return $q->whereJsonContains('staff_pluck', auth()->user()->id)
                            ->orWhereHas('assignsubject', fn($q) => $q->where('staff_id', auth()->user()->id));
                    })
                    ->with(['chatmessage' => function ($q) {
                        $q->latest();
                    }])
                    ->withCount(['chatmessageread' => function ($q) {
                        $q->whereNull('read_at')
                            ->whereHas('chatmessagereadable',
                                fn($q) => $q->where('uuid', auth()->user()->uuid));
                    }])
                    ->orderByDesc('lastupdated_at')
                    ->paginate(15)
            ),
            'staffchatgrouplist'];
    }

    public function staffchatcontactlist()
    {
        return [true,
            new StaffchatgroupCollection(
                Chatgroup::where('active', true)
                    ->whereIn('chattype', [3, 4])
                    ->where(function (Builder $q) {
                        return $q->whereJsonContains('staff_pluck', auth()->user()->id)
                            ->orWhereHas('assignsubject', fn($q) => $q->where('staff_id', auth()->user()->id));
                    })
                    ->with(['chatmessage' => function ($q) {
                        $q->latest();
                    }])
                    ->withCount(['chatmessageread' => function ($q) {
                        $q->whereNull('read_at')
                            ->whereHas('chatmessagereadable',
                                fn($q) => $q->where('uuid', auth()->user()->uuid));
                    }])
                    ->orderByDesc('lastupdated_at')
                    ->paginate(15)
            ),
            'staffchatcontactlist'];
    }

    public function staffchatgroupfilter()
    {
        switch (request('search_type')) {
            case 1: // RECENT FILTER
                return [true,
                    new StaffchatgroupfilterCollection(
                        Chatmessage::whereHas('chatgroup',
                            fn(Builder $q) => $q->where('active', true)
                                ->whereIn('chattype', [1, 2, 3, 4])
                                ->where(function (Builder $q) {
                                    return $q->whereJsonContains('staff_pluck', auth()->user()->id)
                                        ->orWhereHas('assignsubject', fn($q) => $q->where('staff_id', auth()->user()->id));
                                }))
                            ->whereHasMorph('chatmessageable', '*', fn(Builder $q) =>
                                $q->where('body', 'like', '%' . request('search_term') . '%')
                            )->with('chatgroup')
                            ->latest()
                            ->paginate(15)),
                    'Recent Filter List'];
                break;

            case 2: //  GROUP FILTER
                return [true,
                    new StaffchatgroupfilterCollection(
                        Chatmessage::whereHas('chatgroup',
                            fn(Builder $q) => $q->where('active', true)
                                ->whereIn('chattype', [1, 2])
                                ->where(function (Builder $q) {
                                    return $q->whereJsonContains('staff_pluck', auth()->user()->id)
                                        ->orWhereHas('assignsubject', fn($q) => $q->where('staff_id', auth()->user()->id));
                                }))
                            ->whereHasMorph('chatmessageable', '*', fn(Builder $q) =>
                                $q->where('body', 'like', '%' . request('search_term') . '%')
                            )->with('chatgroup')
                            ->latest()
                            ->paginate(15)),
                    'Group Filter List'];
                break;

            case 3: // CONTACT FILTER
                return [true,
                    new StaffchatgroupfilterCollection(
                        Chatmessage::whereHas('chatgroup',
                            fn(Builder $q) => $q->where('active', true)
                                ->whereIn('chattype', [3, 4])
                                ->where(function (Builder $q) {
                                    return $q->whereJsonContains('staff_pluck', auth()->user()->id)
                                        ->orWhereHas('assignsubject', fn($q) => $q->where('staff_id', auth()->user()->id));
                                }))
                            ->whereHasMorph('chatmessageable', '*', fn(Builder $q) =>
                                $q->where('body', 'like', '%' . request('search_term') . '%')
                            )->with('chatgroup')
                            ->latest()
                            ->paginate(15)),
                    'Cotact Filter List'];
                break;
            default:
                return [false, 'Unknow Fiter Type'];
        }

        return [true, $chatgroup, 'staffchatcontactlist'];
    }

    public function staffchatgroupwisemessagelist()
    {
        return [true,
            new StaffchatmessageCollection(
                Chatgroup::where('active', true)
                    ->where('uuid', request('chatgroup_uuid'))
                    ->first()->chatmessage()
                    ->latest()
                    ->paginate(15)),
            'Chat Group List'];
    }

    public function staffchatgroupparticipantlist()
    {
        return [true,
            StaffchatparticipantResource::collection(
                Chatgroup::where('active', true)
                    ->where('uuid', request('chatgroup_uuid'))
                    ->first()
                    ->chatparticipant
            ),
            'Chat Group List'];
    }

    public function staffchatmessagesent()
    {

        $user = auth()->user();
        $chatgroup = Chatgroup::where('uuid', request('chatgroup_uuid'))->first();
        $chatgroup->update(['lastupdated_at' => Carbon::now()]);

        $chatmessage = $user->chatmessageable()
            ->save(
                new Chatmessage([
                    'body' => request('body'),
                    'messagetype' => request('messagetype'),
                    'chatgroup_id' => $chatgroup->id,
                ]),
            );

        $chatgroup->chatparticipant()
            ->whereHas('chatparticipantable',
                fn(Builder $q) => $q->where('uuid', '<>', $user->uuid))
            ->each(fn($eachchatparticipant) =>
                $eachchatparticipant->chatparticipantable
                    ->chatmessagereadable()->save(
                    new Chatmessageread([
                        'chatgroup_id' => $chatgroup->id,
                        'chatmessage_id' => $chatmessage->id,
                    ]),
                )
            );

        DB::commit();

        broadcast(new ChatmessagesentEvent($user, $chatmessage, $chatgroup))->toOthers();

        return [true, 'success', 'staffchatmessageupdateread'];

    }

    public function staffchatmessageupdateread()
    {
        return [true,
            auth()->user()
                ->chatmessagereadable()
            //  ->whereRelation('chatgroup', 'uuid', request('chatgroup_uuid')) // need to check later
                ->whereHas('chatgroup', fn(Builder $q) => $q->where('uuid', request('chatgroup_uuid')))
                ->update(['read_at' => Carbon::now()]),
            'staffchatmessageupdateread'];
    }
}
