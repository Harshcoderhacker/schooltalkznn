<?php

namespace App\Http\Livewire\Admin\Settings\Feed\Feedsticker;

use App\Models\Admin\Feeds\Feedsticker;
use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Feedstickerindexlivewire extends Component
{
    use WithPagination, WithFileUploads;

    public $stickerid, $name, $sticker_path, $sticker_category, $existingpath;

    public $searchTerm = null;

    public $sortColumnName = 'created_at';

    public $sortDirection = 'desc';

    public $paginationlength = 10;

    public $stickerbtn = true;

    public $stickershowdata;

    public $isshowmodalopen = false;

    protected function rules()
    {
        return [
            'name' => 'required|min:1|max:35|unique:feedstickers,name,' . $this->stickerid,
            'sticker_path' => 'nullable|mimes:gif,jpg,jpeg,png|max:10240',
            'sticker_category' => 'required|numeric',
        ];
    }

    public function updated($propertyName)
    {
        $this->stickerbtn = true;
        $this->validateOnly($propertyName);
        $this->stickerbtn = false;
    }

    public function stickershowmodal()
    {
        $this->isshowmodalopen = true;
    }
    public function stickerclosemodal()
    {
        $this->isshowmodalopen = false;
        $this->stickershowdata = [];
    }
    public function show(Feedsticker $sticker)
    {
        $this->stickershowdata = $sticker;
        $this->stickershowmodal();
    }

    public function createorupdate()
    {
        $validatedData = $this->validate();
        try {
            DB::beginTransaction();
            $user = auth()->user();
            if ($this->stickerid) {
                if ($this->sticker_path) {
                    $validatedData['sticker_path'] = $this->sticker_path->store('feed/feedsticker/', 'public');
                    if ($this->existingpath) {
                        Storage::delete('public/' . $this->existingpath);
                    }
                    $this->sticker_path = null;
                    $this->existingpath = $validatedData['sticker_path'];
                } else {
                    unset($validatedData['sticker_path']);
                }

                $feedsticker = Feedsticker::find($this->stickerid);
                $feedsticker->update($validatedData);
                Helper::trackmessage($user, 'Admin Feed Sticker Create', 'admin_web_feed_sticker_create', session()->getId(), 'WEB');
                $this->dispatchBrowserEvent('successtoast', ['message' => 'Feed Sticker Updated Successfully!']);
            } else {
                $this->validate([
                    'sticker_path' => 'required|mimes:gif,jpg,jpeg,png|max:10240',
                ], [
                    'sticker_path.required' => 'Upload A Sticker',
                ]);
                $validatedData['sticker_path'] = $this->sticker_path->store('feed/feedsticker', 'public');
                $feedsticker = Feedsticker::create($validatedData);
                Helper::trackmessage($user, 'Admin Feed Sticker Create', 'admin_web_feed_sticker_create', session()->getId(), 'WEB');
                $this->dispatchBrowserEvent('successtoast', ['message' => 'Feed Sticker Added Successfully!']);
            }

            DB::commit();
            $this->formreset();
            $this->stickerbtn = true;
        } catch (Exception $e) {
            $this->exceptionerror(auth()->user(), 'admin_feedstickers_createoredit', 'error_one : ' . $e->getMessage());
        } catch (QueryException $e) {
            $this->exceptionerror(auth()->user(), 'admin_feedstickers_createoredit', 'error_two : ' . $e->getMessage());
        } catch (PDOException $e) {
            $this->exceptionerror(auth()->user(), 'admin_feedstickers_createoredit', 'error_three : ' . $e->getMessage());
        }
    }
    public function edit(Feedsticker $feedsticker)
    {
        $this->name = $feedsticker->name;
        $this->sticker_category = $feedsticker->sticker_category;
        $this->sticker_path = null;
        $this->existingpath = $feedsticker->sticker_path;
        $this->stickerid = $feedsticker->id;
    }

    public function deleteconfirm($feedstickerid)
    {
        $this->dispatchBrowserEvent('deletetoast', ['feedstickerid' => $feedstickerid]);
    }

    public function delete(Feedsticker $feedsticker)
    {

        try {
            DB::beginTransaction();

            $feedsticker->delete();
            Helper::trackmessage(auth()->user(), 'Admin Feed Sticker Delete', 'admin_web_feed_sticker_delete', session()->getId(), 'WEB');

            DB::commit();
            $this->formreset();
            $this->resetPage();
            $this->dispatchBrowserEvent('deletemsg', ['message' => 'Sticker Deleted!']);

        } catch (Exception $e) {
            $this->exceptionerror('delete', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('delete', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('delete', 'three', $e);
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

    protected function formreset()
    {
        $this->name = null;
        $this->sticker_category = null;
        $this->sticker_path = null;
        $this->stickerid = null;
        $this->existingpath = null;
        $this->stickerbtn = true;
        $this->resetValidation();
        $this->dispatchBrowserEvent('resetfileinput');
    }

    public function formcancel()
    {
        $this->formreset();
        $this->resetPage();
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
        $feedsticker = Feedsticker::query()
            ->where('name', 'like', '%' . $this->searchTerm . '%')
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)->onEachSide(1);
        return view('livewire.admin.settings.feed.feedsticker.feedstickerindexlivewire', compact('feedsticker'));
    }
    protected function exceptionerror($msg, $type, $e)
    {
        DB::rollback();
        Log::error("SessionID: " . session()->getId() . ' Exception ' . $type . ': admin_web_feediscount_' . $msg . '  Error: ' . $e->getMessage());
        $this->dispatchBrowserEvent('errortoast', ['message' => $e->getMessage()]);
    }
}
