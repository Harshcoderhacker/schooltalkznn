<?php

namespace App\Http\Livewire\Admin\Settings\Feed\Feedidealibrary;

use App\Models\Admin\Feeds\Stafffeedidealibrary;
use App\Models\Admin\Settings\Onlineassessment\Mapboard;
use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Stafffeedidealibraryindexlivewire extends Component
{
    use WithPagination, WithFileUploads;

    public $board_uuid, $idealibraryshowdata;

    public $isshowmodalopen = false;

    public $searchTerm = null;

    public $sortColumnName = 'created_at';

    public $sortDirection = 'desc';

    public $paginationlength = 10;

    public function mount()
    {
        $board = Mapboard::where('active', true)->first();
        if ($board) {
            $this->board_uuid = $board->mapboard_uuid;
        }
    }
    public function idealibraryshowmodal()
    {
        $this->isshowmodalopen = true;
    }
    public function idealibraryclosemodal()
    {
        $this->isshowmodalopen = false;
        $this->idealibraryshowdata = [];
    }
    public function show(Stafffeedidealibrary $idealibrary)
    {
        $this->idealibraryshowdata = $idealibrary;
        $this->idealibraryshowmodal();
    }

    public function syncidealibrary()
    {
        $idealibrary = Stafffeedidealibrary::where('active', true)->get();
        if ($idealibrary) {
            $exsisting_uuid = $idealibrary->pluck('template_uuid')->implode(',');
        }
        $response = Http::post(config('archive.online_assessment.path') . '/getstaffidealibrary', [
            'key' => config('archive.online_assessment.key'),
            'board_uuid' => $this->board_uuid,
            'exsisting_template_uuid' => $exsisting_uuid ? $exsisting_uuid : '',
        ]);
        if ($response->successful()) {
            $response = json_decode($response->body());
            $idealibrary = collect($response->idealibrary);
            if ($idealibrary->isNotEmpty()) {
                try {
                    DB::beginTransaction();

                    foreach ($idealibrary as $eachidealibrary) {
                        $imagepath = "";
                        if ($eachidealibrary->image) {
                            $img = $eachidealibrary->image;
                            $idealibrary_image = basename($eachidealibrary->image);
                            Storage::disk('public')->put('staffidealibrary/' . $idealibrary_image, file_get_contents($img), 'public');
                            $imagepath = '/' . 'staffidealibrary/' . $idealibrary_image;
                        }
                        Stafffeedidealibrary::create([
                            'name' => $eachidealibrary->name,
                            'tag' => $eachidealibrary->tag,
                            'description' => $eachidealibrary->description,
                            'image' => $imagepath,
                            'starvalue' => $eachidealibrary->star_value,
                            'template_uuid' => $eachidealibrary->idealibrary_uuid,
                            'template_uniqid' => $eachidealibrary->idealibrary_uniqid,
                        ]);
                    }
                    Helper::trackmessage(auth()->user(), 'Admin Staff Feed Idea Library Updated', 'admin_web_staff_feed_idea_library_update', session()->getId(), 'WEB');

                    DB::commit();
                    $this->dispatchBrowserEvent('successtoast', ['message' => 'Staff Idea Library Updated Successfully!']);

                } catch (Exception $e) {
                    $this->exceptionerror('active_status', 'one', $e);
                } catch (QueryException $e) {
                    $this->exceptionerror('active_status', 'two', $e);
                } catch (PDOException $e) {
                    $this->exceptionerror('active_status', 'three', $e);
                }
            } else {
                $this->dispatchBrowserEvent('warningtoast', ['message' => 'Staff Idea Library already Updated!']);
            }

        }
    }
    public function sortBy($columnName)
    {
        if ($this->sortColumnName === $columnName) {
            $this->sortDirection = $this->swapSortDirection();
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortColumnName = $columnName;
    }

    public function swapSortDirection()
    {
        return $this->sortDirection === 'asc' ? 'desc' : 'asc';
    }
    public function updatedSearchTerm()
    {
        $this->resetPage();
    }

    public function updatepagination()
    {
        $this->resetPage();
    }
    public function render()
    {
        $staffidealibrary = Stafffeedidealibrary::query()
            ->where('name', 'like', '%' . $this->searchTerm . '%')
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)->onEachSide(1);

        return view('livewire.admin.settings.feed.feedidealibrary.stafffeedidealibraryindexlivewire', compact('staffidealibrary'));
    }
}
