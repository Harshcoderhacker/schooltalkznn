<?php

namespace App\Http\Livewire\Admin\Feed;

use App\Models\Admin\Feeds\Feedpoll;
use App\Models\Admin\Feeds\Feedpollcount;
use App\Models\Admin\Feeds\Feedpost;
use App\Models\Admin\Feeds\Feedreported;
use App\Models\Admin\Feeds\Feedreportedpivot;
use App\Models\Admin\Feeds\Feedtag;
use App\Models\Commonhelper\Gamification\Gamificationfeedhelper;
use App\Models\Miscellaneous\Helper;
use App\Models\Parent\Parenthelper\Parenthelper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Adminfeedpostlistlivewire extends Component
{
    public $commentpagination = 3;
    public $post_id;
    public $archivement_post;
    public $user, $platform;
    public $reportid;
    public $hashtags = [], $feedtag;

    public $postcategory;
    public $feedpostid;
    public $reportpost = false;
    public $reportpoststatusupdatemodal = false, $reportlist = [];
    public $showkey = 0;

    public function hydrate()
    {
        $this->emit('loadSelect2Hydrate');
    }

    protected function rules()
    {
        return [
            'hashtags' => 'nullable',
        ];
    }

    public function mount($feedpostid, $platform)
    {
        $this->editmodel = false;
        $this->feedpostid = $feedpostid;
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
        $this->feedtag = Feedtag::where('active', true)->get();
    }

    public function closereportmodal()
    {
        $this->reportpost = false;
        $this->reportpoststatusupdatemodal = false;
    }

    public function votethispoll(Feedpoll $feedpoll)
    {
        try {
            if ($this->user->feedpollcount->where('feedpost_id', $feedpoll->feedpost_id)->count() == 0) {
                $this->user->feedpollcount()
                    ->save(new Feedpollcount([
                        'feedpost_id' => $feedpoll->feedpost_id,
                        'feedpoll_id' => $feedpoll->id,
                    ]));

                $feedpoll->pollcount += 1;
                $feedpoll->save();

                $allpoll = Feedpoll::where('feedpost_id', $feedpoll->feedpost_id)
                    ->get();

                $totalcount = $allpoll->sum('pollcount');

                foreach ($allpoll as $eachpoll) {
                    $currentpoll = Feedpoll::find($eachpoll->id);
                    $currentpoll->percentage = round(($currentpoll->pollcount / $totalcount) * 100);
                    $currentpoll->save();
                }

            } else {
                DB::rollback();
                $this->dispatchBrowserEvent('errortoast', ['message' => 'already voted']);
            }
            Helper::trackmessage($this->user,
                'Admin Feed Poll Vote ',
                'admin_web_adminfeedpolltoggle',
                session()->getId(),
                'WEB');
            DB::commit();

        } catch (Exception $e) {
            $this->exceptionerror('admin_web_adminfeedpolltoggle', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('admin_web_adminfeedpolltoggle', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('admin_web_adminfeedpolltoggle', 'three', $e);
        }
    }

    public function formreset()
    {
        $this->post_id = null;
        $this->archivement_post = null;
        $this->reportid = null;
    }

    public function closemodal()
    {
        $this->editmodel = false;
    }

    public function editpost(Feedpost $feedpost)
    {
        $this->post_id = $feedpost->id;
        $this->hashtags = $feedpost->feedtag;
        $this->archivement_post = $feedpost->post;
        $this->editmodel = true;
    }

    public function updatepost(Feedpost $feedpost)
    {

        try {
            $this->validate([
                'archivement_post' => 'required',
            ]);
            DB::beginTransaction();

            $feedpost->post = $this->archivement_post;
            $feedpost->save();
            $this->dispatchBrowserEvent('successtoast', ['message' => 'Post Updated!']);
            Helper::trackmessage($this->user, 'Admin Feed Update', 'admin_web_feed_update', session()->getId(), 'WEB');
            DB::commit();
            $this->formreset();
            $this->closemodal();
        } catch (Exception $e) {
            $this->exceptionerror('createorupdate_admin_feedpost', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('createorupdate_admin_feedpost', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('createorupdate_admin_feedpost', 'three', $e);
        }
    }

    public function feedpoststatus(Feedpost $feedpost)
    {
        try {
            DB::beginTransaction();
            $feedpost->active ? $feedpost->active = false : $feedpost->active = true;
            $feedpost->save();

            Helper::trackmessage($this->user, 'Admin FeedPost Statusupdate', 'admin_web_feedpost_delete', session()->getId(), 'WEB');

            DB::commit();
            $this->dispatchBrowserEvent('successtoast', ['message' => 'Post Statusupdated!']);
        } catch (Exception $e) {
            $this->exceptionerror('feedpoststatus_admin_feedpost', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('feedpoststatus_admin_feedpost', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('feedpoststatus_admin_feedpost', 'three', $e);
        }
    }

    public function delete(Feedpost $feedpost)
    {
        try {
            DB::beginTransaction();

            foreach ($feedpost->feedcomment as $eachfeedcomment) {
                Gamificationfeedhelper::gamificationfeedengagepeercomment($eachfeedcomment->feedcommentable);
            }
            foreach ($feedpost->feedpostlike as $eachfeedpostlike) {
                Gamificationfeedhelper::gamificationfeedengagepeerlike($eachfeedpostlike->feedpostlikeable);
            }

            $feedpost->gamefunctionable()->delete();
            $feedpost->delete();

            Helper::trackmessage($this->user, 'Admin FeedPost Delete', 'admin_web_feedpost_delete', session()->getId(), 'WEB');

            DB::commit();
            $this->dispatchBrowserEvent('successtoast', ['message' => 'Post Deleted!']);
        } catch (Exception $e) {
            $this->exceptionerror('createorupdate_admin_feedpost', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('createorupdate_admin_feedpost', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('createorupdate_admin_feedpost', 'three', $e);
        }
    }

    public function report($feedpostid)
    {
        $this->post_id = $feedpostid;
        $this->feedreport = Feedreported::where('active', true)->get();

        $this->reportpost = true;
    }

    public function reportstatus(Feedpost $feedpost)
    {
        $this->reportlist = $feedpost->feedreportedpivot()
            ->with('feedreportedpivotable')->get();
        $this->post_id = $feedpost->id;
        $this->reportpoststatusupdatemodal = true;
    }

    public function updatereportstatus(Feedpost $feedpost, $type)
    {
        try {
            DB::beginTransaction();
            $feedpost->reported_stage = $type;

            if ($type == 4) {
                foreach ($feedpost->feedcomment as $eachfeedcomment) {
                    Gamificationfeedhelper::gamificationfeedengagepeercomment($eachfeedcomment->feedcommentable);
                }
                foreach ($feedpost->feedpostlike as $eachfeedpostlike) {
                    Gamificationfeedhelper::gamificationfeedengagepeerlike($eachfeedpostlike->feedpostlikeable);
                }
                $feedpost->gamefunctionable()->delete();
            }

            $feedpost->save();
            DB::commit();
            $this->closereportmodal();
            $this->render();
            $this->dispatchBrowserEvent('successtoast', ['message' => 'Status Updated']);
        } catch (Exception $e) {
            $this->exceptionerror('update_admin_feedpost_status', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('update_admin_feedpost_status', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('update_admin_feedpost_status', 'three', $e);
        }
    }

    public function reportthispost(Feedpost $feedpost)
    {
        try {
            if ($this->user->feedreportedpivot->where('feedpost_id', $feedpost->id)->count() == 0) {
                $this->validate([
                    'reportid' => 'required',
                ]);
                DB::beginTransaction();
                $this->user->feedreportedpivot()
                    ->save(new Feedreportedpivot([
                        'feedpost_id' => $feedpost->id,
                        'feedreported_id' => Feedreported::find($this->reportid)->id,
                    ]));

                $feedpost->reported_stage = 2;
                $feedpost->save();

                Helper::trackmessage($this->user,
                    'Staff Feed Post Reported ',
                    'staff_web_stafffeedreportedpivottoggle_updated',
                    session()->getId(),
                    'WEB');
                DB::commit();
                $this->closereportmodal();
                $this->formreset();
                $this->dispatchBrowserEvent('successtoast', ['message' => 'Reported']);
            }
        } catch (Exception $e) {
            $this->exceptionerror('report_admin_feedpost', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('report_admin_feedpost', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('report_admin_feedpost', 'three', $e);
        }
    }

    public function plusSlides($n, $lastkey)
    {
        if ($this->showkey == 0) {
            $this->showkey = $lastkey - 1;
        } else if ($this->showkey + $n > $lastkey - 1) {
            $this->showkey = 0;
        } else {
            $this->showkey += $n;
        }
    }

    public function currentSlide($n)
    {
        $this->showkey = $n;
    }

    public function render()
    {
        $feedpost = FeedPost::find($this->feedpostid);
        return view('livewire.admin.feed.adminfeedpostlistlivewire', compact('feedpost'));
    }

    protected function exceptionerror($msg, $type, $e)
    {
        DB::rollback();
        Log::error("SessionID: " . session()->getId() . ' Exception ' . $type . ': admin_web_section_' . $msg . '  Error: ' . $e->getMessage());
        $this->dispatchBrowserEvent('errortoast', ['message' => $e->getMessage()]);
    }
}
