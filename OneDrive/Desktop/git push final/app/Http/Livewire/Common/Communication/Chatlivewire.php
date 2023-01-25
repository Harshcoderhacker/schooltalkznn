<?php

namespace App\Http\Livewire\Common\Communication;

use App\Events\Chatgroupevent\ChatbroadcastEvent;
use App\Models\Admin\Chat\Chatgroup;
use App\Models\Admin\Chat\Chatmessage;
use App\Models\Parent\Parenthelper\Parenthelper;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class Chatlivewire extends Component
{

    public $platform;
    public $user;

    public $chatrecentlist, $chatgrouplist, $chatcontactlist;
    public $chatgroup;

    public $chatmessagelist = [];
    public $chatgroup_uuid;

    public $body;

    protected $rules = [
        'body' => 'required|max:1300',
    ];

    public function mount($platform)
    {
        $this->platform = $platform;
        $this->chatgroup = Chatgroup::first();
    }

    public function getListeners()
    {
        $chatgroup = 1;
        return [
            //   "echo-private:chatgroup.{$chatgroup},Chatgroupevent\ChatmessagesentEvent" => 'notifyNewOrder',
            'echo:chatbroadcast,Chatgroupevent\ChatbroadcastEvent' => '$refresh',
        ];
    }

    public function chatmessagefunction($chatgroupuuid)
    {
        $this->chatgroup = Chatgroup::where('active', true)
            ->where('uuid', $chatgroupuuid)
            ->first();
        // dd($this->chatgroup->id);

        $this->chatmessagelist = $this->chatgroup
            ->chatmessage()
            ->orderBy('created_at')
            ->get();

    }

    public function sendmessage()
    {
        $this->validate();

        $chatmessage = $this->user
            ->chatmessageable()
            ->save(
                new Chatmessage([
                    'body' => $this->body,
                    'messagetype' => 1,
                    'chatgroup_id' => $this->chatgroup->id,
                ]),
            );

        $this->reset('body');
        $this->emit('scroll');

        broadcast(new ChatbroadcastEvent())->toOthers();
        // broadcast(new ChatmessagesentEvent($this->user, $chatmessage, $this->chatgroup));
    }

    public function render()
    {
        switch ($this->platform) {
            case "admin":
                $this->chatrecentlist = $this->adminchattype([1, 2, 4, 5]);
                $this->chatgrouplist = $this->adminchattype([1, 2]);
                $this->chatcontactlist = $this->adminchattype([4, 5]);
                $this->user = auth()->user();
                break;
            case "staff":

                $this->user = auth()->guard('staff')->user();
                $this->chatrecentlist = $this->staffchattype([1, 2, 3, 4]);
                $this->chatgrouplist = $this->staffchattype([1, 2]);
                $this->chatcontactlist = $this->staffchattype([3, 4]);

                break;
            case "student":
                $this->user = Parenthelper::getstudentweb();
                $this->chatrecentlist = $this->studentchattype([1, 2, 3, 5]);
                $this->chatgrouplist = $this->studentchattype([1, 2]);
                $this->chatcontactlist = $this->studentchattype([3, 5]);

                break;
            default:
        }
        if ($this->chatgroup) {
            $this->chatmessagelist = $this->chatgroup
                ->chatmessage()
                ->orderBy('created_at')
                ->get();
        }

        $this->emit('scroll');

        return view('livewire.common.communication.chatlivewire');
    }

    protected function adminchattype($chattype)
    {
        return Chatgroup::where('active', true)
            ->whereIn('chattype', $chattype)
            ->with(['chatmessage' => function ($q) {
                $q->latest();
            }])
            ->withCount(['chatmessageread' => function ($q) {
                $q->whereNull('read_at')
                    ->whereHas('chatmessagereadable',
                        fn($q) => $q->where('uuid', auth()->user()->uuid));
            }])
            ->orderByDesc('lastupdated_at')
            ->get();
    }

    protected function staffchattype($chattype)
    {
        return Chatgroup::where('active', true)
        // ->whereRelation('chatparticipant.chatparticipantable', 'uuid', $this->user->uuid)
            ->whereIn('chattype', $chattype)
            ->where(function (Builder $q) {
                $q->whereJsonContains('staff_pluck', $this->user->id)
                    ->orWhereHas('assignsubject', fn($q) => $q->where('staff_id', $this->user->id));
            })
            ->with(['chatmessage' => function ($q) {
                $q->latest();
            }])
            ->withCount(['chatmessageread' => function ($q) {
                $q->whereNull('read_at')
                    ->whereHas('chatmessagereadable',
                        fn($q) => $q->where('uuid', $this->user->uuid));
            }])
            ->orderByDesc('lastupdated_at')
            ->get();

        // return Chatgroup::where('active', true)
        //     ->whereRelation('chatparticipant.chatparticipantable', 'uuid', $this->user->uuid)
        //     ->whereIn('chattype', $chattype)
        //     ->where(function (Builder $q) {
        //         $q->whereJsonContains('staff_pluck', $this->user->id)
        //             ->orWhereHas('assignsubject', fn($q) => $q->where('staff_id', $this->user->id));
        //     })
        //     ->with(['chatmessage' => function ($q) {
        //         $q->latest();
        //     }])
        //     ->withCount(['chatmessageread' => function ($q) {
        //         $q->whereNull('read_at')
        //             ->whereHas('chatmessagereadable',
        //                 fn($q) => $q->where('uuid', $this->user->uuid));
        //     }])
        //     ->orderByDesc('lastupdated_at')
        //     ->get();
    }

    protected function studentchattype($chattype)
    {
        return Chatgroup::where('active', true)
            ->isclasssection($this->user->classmaster_id, $this->user->section_id)
            ->whereIn('chattype', $chattype)
            ->with(['chatmessage' => function ($q) {
                $q->latest();
            }])
            ->withCount(['chatmessageread' => function ($q) {
                $q->whereNull('read_at')
                    ->whereHas('chatmessagereadable',
                        fn($q) => $q->where('uuid', $this->user->uuid));
            }])
            ->orderByDesc('lastupdated_at')
            ->get();
    }
}
