<?php

namespace App\Http\Livewire\Admin\Settings\Feed\Feedidealibrary;

use App\Models\Admin\Feeds\Studentidealibrary;
use App\Models\Admin\Settings\Onlineassessment\Mapboard;
use App\Models\Admin\Settings\Onlineassessment\Mapclass;
use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Studentidealibraryindexlivewire extends Component
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
    public function show(Studentidealibrary $idealibrary)
    {
        $this->idealibraryshowdata = $idealibrary;
        $this->idealibraryshowmodal();
    }

    public function syncidealibrary()
    {
        $exsisting_template = "";
        $allidealibrary = Studentidealibrary::where('active', true)->get();
        if ($allidealibrary) {
            foreach ($allidealibrary as $key => $eachidealibrary) {
                if ($key == 0) {
                    $exsisting_template = $eachidealibrary->template_uuid . ':' . $eachidealibrary->classmaster->count();
                } else {
                    $exsisting_template = $exsisting_template . ',' . $eachidealibrary->template_uuid . ':' . $eachidealibrary->classmaster->count();
                }
            }
        }
        $response = Http::post(config('archive.online_assessment.path') . '/getstudentidealibrary', [
            'key' => config('archive.online_assessment.key'),
            'board_uuid' => $this->board_uuid,
            'exsisting_template' => $exsisting_template ? $exsisting_template : '',
        ]);
        if ($response->successful()) {
            $response = json_decode($response->body());
            $idealibrary = collect($response->idealibrary);
            if ($idealibrary->isNotEmpty()) {
                try {
                    DB::beginTransaction();
                    foreach ($idealibrary as $eachidealibrary) {
                        $imagepath = "";
                        if (sizeof($allidealibrary->where('template_uuid', $eachidealibrary->idealibrary_uuid)) > 0) {
                            $studentidealibrary = Studentidealibrary::where('template_uuid', $eachidealibrary->idealibrary_uuid)->first();
                        } else {
                            if ($eachidealibrary->image) {
                                $img = $eachidealibrary->image;
                                $idealibrary_image = basename($eachidealibrary->image);
                                Storage::disk('public')->put('studentidealibrary/' . $idealibrary_image, file_get_contents($img), 'public');
                                $imagepath = '/' . 'studentidealibrary/' . $idealibrary_image;
                            }
                            $studentidealibrary = Studentidealibrary::create([
                                'name' => $eachidealibrary->name,
                                'idea_category' => $eachidealibrary->idealibrary_category,
                                'tag' => $eachidealibrary->tag,
                                'description' => $eachidealibrary->description,
                                'image' => $imagepath,
                                'starvalue' => $eachidealibrary->star_value,
                                'template_uuid' => $eachidealibrary->idealibrary_uuid,
                                'template_uniqid' => $eachidealibrary->idealibrary_uniqid,
                            ]);
                        }
                        $classmaster = [];
                        foreach ($eachidealibrary->classmaster as $key => $eachclassmaster) {
                            $classmaster_id = Mapclass::where('mapclass_uuid', $eachclassmaster->classmaster_uuid)->first();
                            if ($classmaster_id) {
                                $classmaster[$key] = $classmaster_id->classmaster_id;
                            }
                        }
                        $studentidealibrary->classmaster()->sync($classmaster);
                    }

                    Helper::trackmessage(auth()->user(), 'Admin Student Feed Idea Library Updated', 'admin_web_student_feed_idea_library_update', session()->getId(), 'WEB');

                    DB::commit();
                    $this->dispatchBrowserEvent('successtoast', ['message' => 'Student Idea Library Updated Successfully!']);

                } catch (Exception $e) {
                    $this->exceptionerror('active_status', 'one', $e);
                } catch (QueryException $e) {
                    $this->exceptionerror('active_status', 'two', $e);
                } catch (PDOException $e) {
                    $this->exceptionerror('active_status', 'three', $e);
                }
            } else {
                $this->dispatchBrowserEvent('warningtoast', ['message' => 'Student Idea Library already Updated!']);
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
        $studentidealibrary = Studentidealibrary::query()
            ->where('name', 'like', '%' . $this->searchTerm . '%')
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)->onEachSide(1);
        return view('livewire.admin.settings.feed.feedidealibrary.studentidealibraryindexlivewire', compact('studentidealibrary'));
    }
}
