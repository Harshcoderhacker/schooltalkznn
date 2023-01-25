<?php

namespace App\Repository\Api\Parent\Businesslogic\Chat;

use App\Events\Chatgroupevent\ChatmessagesentEvent;
use App\Http\Resources\Parent\Chat\Chatgroupfilter\ParentchatgroupfilterCollection;
use App\Http\Resources\Parent\Chat\Chatgroup\ParentchatgroupCollection;
use App\Http\Resources\Parent\Chat\Chatmessage\ParentchatmessageCollection;
use App\Http\Resources\Parent\Chat\Chatparticipant\ParentchatparticipantResource;
use App\Models\Admin\Chat\Chatgroup;
use App\Models\Admin\Chat\Chatmessage;
use App\Models\Admin\Chat\Chatmessageread;
use App\Models\Parent\Parenthelper\Parenthelper;
use App\Repository\Api\Parent\Interfacelayer\Chat\IParentchatApiRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class ParentchatApiRepository implements IParentchatApiRepository
{
    public function parentchatrecentlist()
    {
        $student = Parenthelper::getstudent();
        return [true,
            new ParentchatgroupCollection(Chatgroup::where('active', true)
                    ->isclasssection($student->classmaster_id, $student->section_id)
                    ->whereIn('chattype', [1, 2, 3, 5])
                    ->with(['chatmessage' => function ($q) {
                        $q->latest();
                    }])
                    ->withCount(['chatmessageread' => function ($q) {
                        $q->whereNull('read_at')
                            ->whereHas('chatmessagereadable',
                                fn($q) => $q->where('uuid', Parenthelper::getstudent()->uuid));
                    }])
                    ->orderByDesc('lastupdated_at')
                    ->paginate(15)
            ),
            'parentchatrecentlist'];
    }

    public function parentchatgrouplist()
    {
        $student = Parenthelper::getstudent();
        return [true,
            new ParentchatgroupCollection(
                Chatgroup::where('active', true)
                    ->isclasssection($student->classmaster_id, $student->section_id)
                    ->whereIn('chattype', [1, 2])
                    ->with(['chatmessage' => function ($q) {
                        $q->latest();
                    }])
                    ->withCount(['chatmessageread' => function ($q) {
                        $q->whereNull('read_at')
                            ->whereHas('chatmessagereadable',
                                fn($q) => $q->where('uuid', Parenthelper::getstudent()->uuid));
                    }])
                    ->orderByDesc('lastupdated_at')
                    ->paginate(15)
            ),
            'parentchatgrouplist'];
    }

    public function parentchatcontactlist()
    {
        $student = Parenthelper::getstudent();
        return [true,
            new ParentchatgroupCollection(
                Chatgroup::where('active', true)
                    ->isclasssection($student->classmaster_id, $student->section_id)
                    ->whereIn('chattype', [3, 5])
                    ->with(['chatmessage' => function ($q) {
                        $q->latest();
                    }])
                    ->withCount(['chatmessageread' => function ($q) {
                        $q->whereNull('read_at')
                            ->whereHas('chatmessagereadable',
                                fn($q) => $q->where('uuid', Parenthelper::getstudent()->uuid));
                    }])
                    ->orderByDesc('lastupdated_at')
                    ->paginate(15)
            ),
            'parentchatcontactlist'];
    }

    public function parentchatgroupfilter()
    {

        $student = Parenthelper::getstudent();
        switch (request('search_type')) {
            case 1: // RECENT FILTER
                return [true,
                    new ParentchatgroupfilterCollection(
                        Chatmessage::whereHas('chatgroup', fn(Builder $q) =>
                            $q->where('active', true)
                                ->isclasssection($student->classmaster_id, $student->section_id)
                                ->whereIn('chattype', [1, 2, 3, 5]
                                ))
                            ->whereHasMorph('chatmessageable', '*', function (Builder $query) {
                                $query->where('body', 'like', '%' . request('search_term') . '%');
                            })->with('chatgroup')
                            ->latest()
                            ->paginate(15)),
                    'Recent Filter List'];
                break;

            case 2: //  GROUP FILTER
                return [true,
                    new ParentchatgroupfilterCollection(
                        Chatmessage::whereHas('chatgroup', fn(Builder $q) =>
                            $q->where('active', true)
                                ->isclasssection($student->classmaster_id, $student->section_id)
                                ->whereIn('chattype', [1, 2]
                                ))
                            ->whereHasMorph('chatmessageable', '*', function (Builder $query) {
                                $query->where('body', 'like', '%' . request('search_term') . '%');
                            })->with('chatgroup')
                            ->latest()
                            ->paginate(15)),
                    'Group Filter List'];
                break;

            case 3: // CONTACT FILTER
                return [true,
                    new ParentchatgroupfilterCollection(
                        Chatmessage::whereHas('chatgroup', fn(Builder $q) =>
                            $q->where('active', true)
                                ->isclasssection($student->classmaster_id, $student->section_id)
                                ->whereIn('chattype', [3, 5]
                                ))
                            ->whereHasMorph('chatmessageable', '*', function (Builder $query) {
                                $query->where('body', 'like', '%' . request('search_term') . '%');
                            })->with('chatgroup')
                            ->latest()
                            ->paginate(15)),
                    'Contact Filter List'];
                break;
            default:
                return [false, 'Unknow Fiter Type'];
        }

        return [true, $chatgroup, 'parentchatcontactlist'];
    }

    public function parentchatgroupwisemessagelist()
    {
        $student = Parenthelper::getstudent();
        return [true,
            new ParentchatmessageCollection(
                Chatgroup::where('active', true)
                    ->isclasssection($student->classmaster_id, $student->section_id)
                    ->where('uuid', request('chatgroup_uuid'))
                    ->first()->chatmessage()
                    ->latest()
                    ->paginate(15)),
            'Chat Group List'];
    }

    public function parentchatgroupparticipantlist()
    {
        $student = Parenthelper::getstudent();
        return [true,
            ParentchatparticipantResource::collection(
                Chatgroup::where('active', true)
                    ->isclasssection($student->classmaster_id, $student->section_id)
                    ->where('uuid', request('chatgroup_uuid'))
                    ->first()
                    ->chatparticipant
            ),
            'Chat Group List'];
    }

    public function parentchatmessagesent()
    {

        $student = Parenthelper::getstudent();

        $chatgroup = Chatgroup::where('uuid', request('chatgroup_uuid'))
            ->isclasssection($student->classmaster_id, $student->section_id)
            ->first();

        $chatgroup->update(['lastupdated_at' => Carbon::now()]);

        $chatmessage = $student->chatmessageable()
            ->save(
                new Chatmessage([
                    'body' => request('body'),
                    'messagetype' => request('messagetype'),
                    'chatgroup_id' => $chatgroup->id,
                ]),
            );

        $chatgroup->chatparticipant()
            ->whereHas('chatparticipantable',
                fn(Builder $q) => $q->where('uuid', '<>', $student->uuid))
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

        broadcast(new ChatmessagesentEvent($student, $chatmessage, $chatgroup))->toOthers();

        return [true, 'success', 'parentchatmessageupdateread'];

    }

    public function parentchatmessageupdateread()
    {
        return [true,
            Parenthelper::getstudent()
                ->chatmessagereadable()
                ->whereHas('chatgroup', fn(Builder $q) => $q->where('uuid', request('chatgroup_uuid')))
                ->update(['read_at' => Carbon::now()]),
            'parentchatmessageupdateread'];
    }
}
