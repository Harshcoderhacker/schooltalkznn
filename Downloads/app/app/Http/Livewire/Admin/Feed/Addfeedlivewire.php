<?php

namespace App\Http\Livewire\Admin\Feed;

use App\Models\Admin\Auth\User;
use App\Models\Admin\Feeds\Feedpoll;
use App\Models\Admin\Feeds\Feedpost;
use App\Models\Admin\Feeds\Feedtag;
use App\Models\Admin\Student\Student;
use App\Models\Commonhelper\Gamification\Gamificationfeedhelper;
use App\Models\Commontraits\Uploadtraits\Feedpost\FeedpostUploadTrait;
use App\Models\Miscellaneous\Helper;
use App\Models\Parent\Parenthelper\Parenthelper;
use App\Models\Staff\Auth\Staff;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Intervention\Image\Facades\Image;
use Livewire\Component;
use Livewire\WithFileUploads;
use Log;
use Storage;

class Addfeedlivewire extends Component
{
    use WithFileUploads, FeedpostUploadTrait;

    public $user, $platform;
    public $loadAmount = 15;

    public $post;
    public $type = 1;
    public $image, $existingimage;
    public $video;
    public $to_show;
    public $achievementmodal = false;
    public $imagecreatemodel = false;
    public $pollcreatemodel = false;
    public $videocreatemodel = false;

    public $postcategory;

    public $poll = [], $poll_post;
    public $feedtag, $selecthastags = [];
    public $totalRecords;

    protected $rules = [
        'post' => 'required|max:1300',
        'to_show' => 'required'
    ];

    public function loadMore()
    {
        $this->loadAmount += 15;
    }

    public function mount($postcategory, $platform)
    {
        $this->totalRecords = Feedpost::where('active', true)->count();
        $this->postcategory = $postcategory;
        if ($platform == null) {
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

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function pollvalidations()
    {
        $this->validate([
            'post' => 'required|max:1300',
            'poll.*.name' => 'required|string',
        ], [
            'poll.*.name.required' => 'Required',
        ]);
    }

    public function closemodal()
    {
        $this->achievementmodal = false;
        $this->imagecreatemodel = false;
        $this->pollcreatemodel = false;
        $this->videocreatemodel = false;
        $this->formreset();
    }

    public function formreset()
    {
        $this->post = "";
        $this->video = "";
        $this->image_post = "";
        $this->image = "";
        $this->type = 1;
        $this->poll = [];
    }

    public function createpost($type)
    {
        if ($type == 3) {
            $this->pollvalidations();
            $this->createafeedpost($type);
            $this->closemodal();
            $this->formreset();
        } else {
            $this->createafeedpost($type);
            $this->closemodal();
            $this->formreset();
        }
    }

    protected function postimage()
    {
        $imagevalidation = $this->validate([
            'image.*' => 'mimes:jpeg,png,jpg,svg,gif|max:10240',
        ], [
            'image.*.mimes' => 'Image format should be jpeg,jpg,png,gif.',
            'image.*.max' => 'Image should be less than 10 MB.',
        ]);

        foreach ($this->image as $key => $file) {
            $insert[$key]['images'] = $this->newimagefomrat($file);
        }
        return json_encode($insert);
    }

    public function createafeedpost($type)
    {
        try {
            DB::beginTransaction();

            $validate = $this->validate();
            $payload = [
                'post' => $validate['post'],
                'type' => $type,
                'to_show' => $validate['to_show']
            ];

            $payload = $this->image ? array_merge($payload, ['image' => $this->postimage()]) : $payload;

            $payload = $this->video ? array_merge($payload, ['video' => $this->postvideo(), 'is_mediatype' => 2]) : $payload;

            $feedpost = $this->user->feedpost()
                ->save(new Feedpost($payload));

            if ($type == 3) {
                foreach ($this->poll as $eachpoll) {
                    Feedpoll::create([
                        'feedpost_id' => $feedpost->id,
                        'name' => $eachpoll['name'],
                    ]);
                }
            }

            if ($this->selecthastags) {
                $feedtagid = [];
                foreach ($this->selecthastags as $eachtag) {
                    $feedtag = Feedtag::where('name', trim($eachtag))->first();
                    if ($feedtag) {
                        array_push($feedtagid, $feedtag->id);
                    } else {
                        array_push($feedtagid, $this->user->feedtag()->create(
                            ['name' => trim($eachtag)]
                        )->id);
                    }
                }
                $feedpost->feedtag()->sync($feedtagid);
            }

            if ($this->user->usertype == 'STUDENT' || $this->user->usertype == 'STAFF') {
                Gamificationfeedhelper::gamificationfeedpost($this->user, $feedpost, $type);
            }

            $this->dispatchBrowserEvent('successtoast', ['message' => 'Post Uploaded!']);
            Helper::trackmessage($this->user, 'Admin Feed Create - Type' . $type, 'admin_web_feed_create', session()->getId(), 'WEB');
            DB::commit();
            $this->dispatchBrowserEvent('clearselected');
            $this->formreset();
        } catch (Exception $e) {
            $this->exceptionerror('create_admin_feedpost', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('create_admin_feedpost', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('create_admin_feedpost', 'three', $e);
        }
    }

    public function addpoll()
    {
        if (sizeof($this->poll) < 4) {
            $this->poll[] = [
                'name' => '',
            ];
        }
    }

    public function removepoll($key)
    {
        unset($this->poll[$key]);
    }

    public function achievementmodaltoggle()
    {
        $this->closemodal();
        $this->type = 2;
        $this->image = "";
        $this->imagecreatemodel = true;
    }

    public function imagecreatemodal()
    {
        $this->closemodal();
        $this->type = 1;
        $this->image = "";
        $this->resetErrorBag();
        $this->imagecreatemodel = true;
        $this->dispatchBrowserEvent('image_post_trigger');
    }

    public function pollcreatemodal()
    {
        $this->image = "";
        $this->closemodal();
        $this->poll[] = [
            'name' => '',
        ];
        $this->poll[] = [
            'name' => '',
        ];
        $this->type = 3;
        $this->pollcreatemodel = true;
    }

    public function videocreatemodal()
    {
        $this->closemodal();
        $this->videocreatemodel = true;
        $this->dispatchBrowserEvent('video_selected');
    }

    protected function postvideo()
    {
        return Storage::disk('public')->put(
            'feed/post/video',
            $this->video,
            'public'
        );
    }

    public function render()
    {
        switch ($this->postcategory) {
            case 'LATEST':
                $feedpost = Feedpost::withCount([
                    'feedpostlike' => fn (Builder $query) => $query->where('active', true),
                    'feedcomment' => fn (Builder $query) => $query->where('active', true),
                    'feedpollcount',
                ])
                    ->with('feedpoll')
                    ->where('active', true)
                    ->where('reported_stage', '<>', 4)
                    ->where('is_notstike', true)
                    ->latest()
                    ->limit($this->loadAmount)
                    ->get();
                break;
            case 'TRENDING':
                $feedpost = Feedpost::withCount([
                    'feedpostlike' => fn (Builder $query) => $query->where('active', true),
                    'feedcomment' => fn (Builder $query) => $query->where('active', true),
                    'feedpollcount',
                ])
                    ->with('feedpoll')
                    ->where('active', true)
                    ->where('reported_stage', '<>', 4)
                    ->where('is_notstike', true)
                    ->orderBy('feedcomment_count', 'desc')
                    ->latest()
                    ->limit($this->loadAmount)
                    ->get();
                break;
            case 'MYPOST':
                $feedpost = $this->user
                    ->feedpost()
                    ->withCount([
                        'feedpostlike' => fn (Builder $query) => $query->where('active', true),
                        'feedcomment' => fn (Builder $query) => $query->where('active', true),
                        'feedpollcount',
                    ])
                    ->with('feedpoll')
                    ->where('active', true)
                    ->where('reported_stage', '<>', 4)
                    ->where('is_notstike', true)
                    ->latest()
                    ->limit($this->loadAmount)
                    ->get();
                break;
            case 'REPORTED POST':
                $feedpost = Feedpost::withCount([
                    'feedpostlike' => fn (Builder $query) => $query->where('active', true),
                    'feedcomment' => fn (Builder $query) => $query->where('active', true),
                    'feedpollcount',
                ])
                    ->with('feedpoll')
                    ->where('active', true)
                    ->where('reported_stage', 2)
                    ->where('is_notstike', true)
                    ->latest()
                    ->limit($this->loadAmount)
                    ->get();
                break;
            case 'MY CLASS':
                $feedpost = Feedpost::withCount([
                    'feedpostlike' => fn (Builder $q) => $q->where('active', true),
                    'feedcomment' => fn (Builder $q) => $q->where('active', true),
                ])->whereHasMorph(
                    'feedpostable',
                    [User::class, Staff::class, Student::class],
                    function (Builder $q, $type) {
                        $column = $type === Student::class ? 'classmaster_id' : 'uuid';
                        $q->where('usertype', '<>', 'ADMIN');
                        if ($column == 'classmaster_id') {
                            $q->where($column, Parenthelper::getstudentweb()->classmaster_id);
                        } else {
                            $q->whereIn($column, Staff::whereHas(
                                'assignsubject',
                                fn (Builder $q) => $q->where('classmaster_id', Parenthelper::getstudentweb()->classmaster_id)
                            )
                                ->pluck('uuid'));
                        }
                    }
                )
                    ->with('feedpoll')
                    ->where('active', true)
                    ->where('reported_stage', '<>', 4)
                    ->where('is_notstike', true)->latest()
                    ->get();
                break;
            default:
                $feedpost = Feedpost::withCount([
                    'feedpostlike' => fn (Builder $query) => $query->where('active', true),
                    'feedcomment' => fn (Builder $query) => $query->where('active', true),
                    'feedpollcount',
                ])
                    ->with('feedpoll')
                    ->where('active', true)
                    ->where('reported_stage', '<>', 4)
                    ->where('is_notstike', true)
                    ->latest()
                    ->limit($this->loadAmount)
                    ->get();
        }

        return view('livewire.admin.feed.addfeedlivewire', compact('feedpost'));
    }

    protected function exceptionerror($msg, $type, $e)
    {
        DB::rollback();
        Log::error("SessionID: " . session()->getId() . ' Exception ' . $type . ': admin_web_section_' . $msg . '  Error: ' . $e->getMessage());
        $this->dispatchBrowserEvent('errortoast', ['message' => $e->getMessage()]);
    }
}
