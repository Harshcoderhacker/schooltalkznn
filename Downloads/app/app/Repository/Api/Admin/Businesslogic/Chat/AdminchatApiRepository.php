<?php

namespace App\Repository\Api\Admin\Businesslogic\Chat;

use App\Events\Chatgroupevent\ChatmessagesentEvent;
use App\Http\Resources\Admin\Chat\Chatgroupfilter\ChatgroupfilterCollection;
use App\Http\Resources\Admin\Chat\Chatgroup\ChatgroupCollection;
use App\Http\Resources\Admin\Chat\Chatmessage\ChatmessageCollection;
use App\Http\Resources\Admin\Chat\Chatparticipant\ChatparticipantResource;
use App\Models\Admin\Chat\Chatgroup;
use App\Models\Admin\Chat\Chatmessage;
use App\Models\Admin\Chat\Chatmessageread;
use App\Models\Admin\Chat\Chatparticipant;
use App\Models\Commonhelper\Chat\Groupchat\Chatengine;
use App\Repository\Api\Admin\Interfacelayer\Chat\IAdminchatApiRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class AdminchatApiRepository implements IAdminchatApiRepository
{

    public function adminchatrecentlist()
    {

        DB::beginTransaction();
        Chatgroup::where('active', true)
            ->whereIn('chattype', [1, 2, 4, 5])
            ->with(['chatmessage' => function ($q) {
                $q->latest();
            }])
            ->withCount(['chatmessageread' => function ($q) {
                $q->whereNull('read_at')
                    ->whereHas('chatmessagereadable',
                        fn($q) => $q->where('uuid', auth()->user()->uuid));
            }])
            ->get()
            ->sortByDesc('lastupdated_at')
            ->each(fn($eachchatgroup) =>
                [
                    Chatengine::subjectgroup($eachchatgroup),
                    Chatengine::classgroup($eachchatgroup),
                ]
            )
            ->sortByDesc('updated_at');

        Chatengine::adminchatonetoone();
        Chatengine::staffchatstudentonetoone();
        DB::commit();

        return [true,
            new ChatgroupCollection(Chatgroup::where('active', true)
                    ->whereIn('chattype', [1, 2, 4, 5])
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
            'adminchatrecentlist'];
    }

    public function adminchatgrouplist()
    {

        return [true,
            new ChatgroupCollection(
                Chatgroup::where('active', true)
                    ->whereIn('chattype', [1, 2])
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
            'adminchatgrouplist'];
    }

    public function adminchatcontactlist()
    {
        return [true,
            new ChatgroupCollection(
                Chatgroup::where('active', true)
                    ->whereIn('chattype', [4, 5])
                    ->with(['chatmessage' => function ($q) {
                        $q->latest();
                    }, 'chatparticipant.chatparticipantable' => function ($query) {
                        $query->where('uuid', '<>', auth()->user()->uuid);
                    }])
                    ->withCount(['chatmessageread' => function ($q) {
                        $q->whereNull('read_at')
                            ->whereHas('chatmessagereadable',
                                fn($q) => $q->where('uuid', auth()->user()->uuid));
                    }])
                    ->orderByDesc('lastupdated_at')
                    ->paginate(15)
            ),
            'adminchatcontactlist'];
    }

    public function adminchatgroupfilter()
    {
        switch (request('search_type')) {
            case 1: // RECENT FILTER
                return [true,
                    new ChatgroupfilterCollection(Chatmessage::whereHas('chatgroup',
                        fn(Builder $q) => $q->where('active', true)->whereIn('chattype', [1, 2, 4, 5]))
                            ->whereHasMorph('chatmessageable', '*', function (Builder $query) {
                                $query->where('body', 'like', '%' . request('search_term') . '%');
                            })->with('chatgroup')
                            ->latest()
                            ->paginate(15)),
                    'Recent Filter List'];
                break;

            case 2: //  GROUP FILTER
                return [true,
                    new ChatgroupfilterCollection(Chatmessage::whereHas('chatgroup',
                        fn(Builder $q) => $q->where('active', true)->whereIn('chattype', [1, 2]))
                            ->whereHasMorph('chatmessageable', '*', function (Builder $query) {
                                $query->where('body', 'like', '%' . request('search_term') . '%');
                            })->with('chatgroup')
                            ->latest()
                            ->paginate(15)),
                    'Group Filter List'];
                break;

            case 3: // CONTACT FILTER
                return [true,
                    new ChatgroupfilterCollection(Chatmessage::whereHas('chatgroup',
                        fn(Builder $q) => $q->where('active', true)->whereIn('chattype', [4, 5]))
                            ->whereHasMorph('chatmessageable', '*', function (Builder $query) {
                                $query->where('body', 'like', '%' . request('search_term') . '%');
                            })->with('chatgroup')
                            ->latest()
                            ->paginate(15)),
                    'Cotact Filter List'];
                break;
            default:
                return [false, 'Unknow Fiter Type'];
        }

        return [true, $chatgroup, 'adminchatcontactlist'];
    }

    public function adminchatgroupwisemessagelist()
    {
        return [true,
            new ChatmessageCollection(Chatgroup::where('active', true)
                    ->where('uuid', request('chatgroup_uuid'))
                    ->first()->chatmessage()
                    ->latest()
                    ->paginate(15)),
            'Chat Group List'];
    }

    public function adminchatgroupparticipantlist()
    {
        return [true,
            ChatparticipantResource::collection(
                Chatgroup::where('active', true)
                    ->where('uuid', request('chatgroup_uuid'))
                    ->first()
                    ->chatparticipant
            ),
            'Chat Group List'];
    }

    public function adminchatmessagesent()
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

        return [true, 'success', 'adminchatmessageupdateread'];

    }

    public function adminchatmessageupdateread()
    {
        return [true,
            auth()->user()
                ->chatmessagereadable()
                ->whereHas('chatgroup', fn(Builder $q) => $q->where('uuid', request('chatgroup_uuid')))
                ->update(['read_at' => Carbon::now()]),
            'adminchatmessageupdateread'];
    }

}
