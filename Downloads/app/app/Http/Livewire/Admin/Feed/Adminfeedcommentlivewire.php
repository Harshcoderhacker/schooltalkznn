<?php

namespace App\Http\Livewire\Admin\Feed;

use App\Models\Admin\Feeds\Feedcomment;
use App\Models\Admin\Feeds\Feedcommentreply;
use App\Models\Admin\Feeds\Feedpost;
use App\Models\Admin\Feeds\Feedpostlike;
use App\Models\Commonhelper\Gamification\Gamificationfeedhelper;
use App\Models\Miscellaneous\Helper;
use App\Models\Parent\Parenthelper\Parenthelper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Adminfeedcommentlivewire extends Component
{
    public $feedpostid, $user, $platform;
    public $post_comment = [];
    public $commentpagination = 3;
    public $commandreplymodal = false;
    public $comment, $commentreply_post;
    public $feedcommenteditid, $feedcommentedit;
    public $feedpostcommenteditmodal = false;
    public $feedpostlikelist;
    public $openfeedlikelistmodal = false;

    protected $listeners = ['feedpostcommentreplydelete' => 'render'];

    public function mount($feedpost, $platform)
    {
        $this->feedpostid = $feedpost;
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
        $this->feedpostlikelist = Feedpost::find($feedpost)
            ->feedpostlike;
    }

    public function postfeedcomment(Feedpost $feedpostidforcomment)
    {
        if ($this->post_comment) {
            try {
                DB::beginTransaction();
                $this->user->feedcomment()
                    ->save(new Feedcomment([
                        'feedpost_id' => $feedpostidforcomment->id,
                        'comment' => $this->post_comment,
                        'commenttype' => 0,
                    ]));

                Gamificationfeedhelper::gamificationfeedcomment($feedpostidforcomment, 'create');

                if ($this->user->usertype == 'STUDENT' || $this->user->usertype == 'STAFF') {
                    Gamificationfeedhelper::gamificationfeedengagepeercomment($this->user);
                }

                Helper::trackmessage($this->user,
                    'Admin Feed Post Comment Create ',
                    'admin_web_admincreatefeedpostcomment',
                    session()->getId(),
                    'WEB');

                DB::commit();
                $this->post_comment = null;

            } catch (Exception $e) {
                $this->exceptionerror('admin_web_admincreatefeedpostcomment', 'one', $e);
            } catch (QueryException $e) {
                $this->exceptionerror('admin_web_admincreatefeedpostcomment', 'two', $e);
            } catch (PDOException $e) {
                $this->exceptionerror('admin_web_admincreatefeedpostcomment', 'three', $e);
            }
        }
    }

    public function openfeedpostlikemodal(Feedpost $feedpost)
    {
        $this->openfeedlikelistmodal = true;
    }

    public function closefeedpostlikemodal()
    {
        $this->openfeedlikelistmodal = false;
    }

    public function feedpostlike(Feedpost $feedpost)
    {
        try {
            DB::beginTransaction();
            if ($this->user->feedpostlike->where('feedpost_id', $feedpost->id)->count() == 0) {
                $this->user->feedpostlike()->save(new Feedpostlike([
                    'feedpost_id' => $feedpost->id,
                ]));

                $toggle = 'attach';
            } else {
                $this->user->feedpostlike()->where('feedpost_id', $feedpost->id)->first()->delete();
                $toggle = 'detach';
            }

            Gamificationfeedhelper::gamificationfeedlike($feedpost);
            if ($this->user->usertype == 'STUDENT' || $this->user->usertype == 'STAFF') {
                Gamificationfeedhelper::gamificationfeedengagepeerlike($this->user);
            }

            Helper::trackmessage($this->user, 'Admin FeedPost Create', 'admin_web_feedpost_create', session()->getId(), 'WEB');
            DB::commit();
            $this->emit('feedpostcommentrefresh');

        } catch (Exception $e) {
            $this->exceptionerror('createorupdate_admin_feedpost', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('createorupdate_admin_feedpost', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('createorupdate_admin_feedpost', 'three', $e);
        }
    }

    public function closemodal()
    {
        $this->commandreplymodal = false;
        $this->feedpostcommenteditmodal = false;
    }

    public function paginatecomment()
    {
        $this->commentpagination += 3;
    }

    public function opencreatereplymodal(Feedcomment $comment)
    {
        $this->comment = $comment;
        $this->commandreplymodal = true;
    }

    public function createcommentreply(Feedcomment $feedcomment)
    {
        if (strlen($this->commentreply_post) > 0) {
            try {
                DB::beginTransaction();
                $this->user->feedcommentreply()
                    ->save(new Feedcommentreply([
                        'feedpost_id' => $feedcomment->feedpost_id,
                        'feedcomment_id' => $feedcomment->id,
                        'reply' => $this->commentreply_post,
                    ]));

                Helper::trackmessage($this->user, 'Admin Feed Comment Reply',
                    'admin_web_feed_comment_create',
                    session()->getId(), 'WEB');
                DB::commit();
                $this->closemodal();
                $this->commentreply_post = null;
                $this->comment = null;
                $this->emit('feedpostcommentreply');
            } catch (Exception $e) {
                $this->exceptionerror('createorupdate_admin_feedpost', 'one', $e);
            } catch (QueryException $e) {
                $this->exceptionerror('createorupdate_admin_feedpost', 'two', $e);
            } catch (PDOException $e) {
                $this->exceptionerror('createorupdate_admin_feedpost', 'three', $e);
            }
        }
    }

    public function editpostcomment(Feedcomment $feedcomment)
    {
        $this->feedcommenteditid = $feedcomment->id;
        $this->feedcommentedit = $feedcomment->comment;
        $this->feedpostcommenteditmodal = true;
    }

    public function updatepostcomment()
    {
        try {
            DB::beginTransaction();
            Feedcomment::find($this->feedcommenteditid)
                ->update([
                    'comment' => $this->feedcommentedit,
                ]);

            Helper::trackmessage($this->user,
                'Admin Feed Post Comment Update ',
                'admin_web_adminupdatefeedpostcomment',
                session()->getId(),
                'WEB');

            DB::commit();
            $this->feedcommenteditid = null;
            $this->feedcommentedit = null;
            $this->closemodal();
            $this->dispatchBrowserEvent('successtoast', ['message' => 'Comment Updated!']);
        } catch (Exception $e) {
            $this->exceptionerror('createorupdate_admin_feedpost', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('createorupdate_admin_feedpost', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('createorupdate_admin_feedpost', 'three', $e);
        }
    }

    public function deletecommment(Feedcomment $feedcomment)
    {
        try {
            DB::beginTransaction();

            Gamificationfeedhelper::gamificationfeedcomment(
                Feedpost::whereHas('feedcomment',
                    fn(Builder $q) => $q->where('uuid', $feedcomment->uuid))
                    ->first(), 'delete'
            );

            if ($this->user->usertype == 'STUDENT' || $this->user->usertype == 'STAFF') {
                Gamificationfeedhelper::gamificationfeedengagepeercomment($this->user);
            }

            $feedcomment->delete();
            Helper::trackmessage($this->user, 'Admin Feed Post Comment Delete ',
                'admin_web_admincommentdelete',
                session()->getId(),
                'WEB');
            DB::commit();
            $this->dispatchBrowserEvent('successtoast', ['message' => 'Comment Deleted!']);
        } catch (Exception $e) {
            $this->exceptionerror('createorupdate_admin_feedpost', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('createorupdate_admin_feedpost', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('createorupdate_admin_feedpost', 'three', $e);
        }
    }

    public function render()
    {
        $feedpost = Feedpost::where('id', $this->feedpostid)->withCount([
            'feedpostlike' => fn(Builder $query) => $query->where('active', true),
            'feedcomment' => fn(Builder $query) => $query->where('active', true),
            'feedpollcount',
        ])->first();

        return view('livewire.admin.feed.adminfeedcommentlivewire', compact('feedpost'));
    }

    protected function exceptionerror($msg, $type, $e)
    {
        DB::rollback();
        Log::error("SessionID: " . session()->getId() . ' Exception ' . $type . ': admin_web_section_' . $msg . '  Error: ' . $e->getMessage());
        $this->dispatchBrowserEvent('errortoast', ['message' => $e->getMessage()]);
    }
}
