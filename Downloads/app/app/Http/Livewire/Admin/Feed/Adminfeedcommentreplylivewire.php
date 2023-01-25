<?php

namespace App\Http\Livewire\Admin\Feed;

use App\Models\Admin\Feeds\Feedcomment;
use App\Models\Admin\Feeds\Feedcommentreply;
use App\Models\Miscellaneous\Helper;
use App\Models\Parent\Parenthelper\Parenthelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Adminfeedcommentreplylivewire extends Component
{
    public $comment_id;
    public $commentreplypagination = 3;
    public $user, $platform;
    public $commentreplyid, $commentreply, $commentreplyeditmodal = false;

    protected $listeners = ['feedpostcommentreply' => 'render'];

    public function mount($comment_id, $platform)
    {
        $this->comment_id = $comment_id;
        if ($platform == "admin") {
            $this->user = auth()->user();
            $this->platform = "admin";
        } elseif ($platform == "staff") {
            $this->user = auth()->guard('staff')->user();
            $this->platform = $platform;
        } elseif ($platform == "student") {
            $this->user = Parenthelper::getstudentweb();
            $this->platform = $platform;
        }
    }

    public function closemodal()
    {
        $this->commentreplyeditmodal = false;
    }

    public function paginatecommentreply($totalpaginations)
    {
        $this->commentreplypagination += $totalpaginations;
    }

    public function editpostcommentreply(Feedcommentreply $commentreply)
    {
        $this->commentreplyid = $commentreply->id;
        $this->commentreply = $commentreply->reply;
        $this->commentreplyeditmodal = true;
    }

    public function updatepostcommentreply(Feedcommentreply $commentreply)
    {
        try {
            $this->validate([
                'commentreply' => 'required',
            ]);
            DB::beginTransaction();

            $commentreply->reply = $this->commentreply;
            $commentreply->save();

            Helper::trackmessage($this->user,
                'Admin Feed Post Comment Reply Update ',
                'admin_web_adminupdatefeedpostcommentreply',
                session()->getId(),
                'WEB');

            DB::commit();
            $this->commentreplyid = null;
            $this->commentreply = null;
            $this->closemodal();
            $this->dispatchBrowserEvent('successtoast', ['message' => 'Comment Reply Updated!']);
        } catch (Exception $e) {
            $this->exceptionerror('createorupdate_admin_feedpost', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('createorupdate_admin_feedpost', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('createorupdate_admin_feedpost', 'three', $e);
        }
    }

    public function deletecommmentreply(Feedcommentreply $commentreply)
    {
        try {
            DB::beginTransaction();
            $commentreply->delete();
            Helper::trackmessage($this->user, 'Admin Feed Post Comment Reply Delete ',
                'admin_web_admincommentreplydelete',
                session()->getId(),
                'WEB');
            DB::commit();
            $this->emit('feedpostcommentreplydelete');
            $this->dispatchBrowserEvent('successtoast', ['message' => 'Comment Reply Deleted!']);
        } catch (Exception $e) {
            $this->exceptionerror('deletecommentreply_admin_feedpostcommentreply', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('deletecommentreply_admin_feedpostcommentreply', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('deletecommentreply_admin_feedpostcommentreply', 'three', $e);
        }
    }

    public function render()
    {
        $feedcomment = Feedcomment::find($this->comment_id);

        $commentreplycount = $feedcomment->feedcommentreply()->where('active', true)->count();

        return view('livewire.admin.feed.adminfeedcommentreplylivewire', compact('feedcomment', 'commentreplycount'));
    }

    protected function exceptionerror($msg, $type, $e)
    {
        DB::rollback();
        Log::error("SessionID: " . session()->getId() . ' Exception ' . $type . ': admin_web_section_' . $msg . '  Error: ' . $e->getMessage());
        $this->dispatchBrowserEvent('errortoast', ['message' => $e->getMessage()]);
    }
}
