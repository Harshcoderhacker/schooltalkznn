<?php

namespace App\Http\Livewire\Admin\Settings\Feed\Feedhashtag;

use App\Models\Admin\Feeds\Feedtag;
use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class Feedhashtagindexlivewire extends Component
{
    use WithPagination;

    public $searchTerm = null;

    public $sortColumnName = 'created_at';

    public $sortDirection = 'desc';

    public $paginationlength = 10;

    public function active(Feedtag $feedtag)
    {
        try {
            DB::beginTransaction();

            $feedtag->active = $feedtag->active ? false : true;
            $feedtag->save();
            Helper::trackmessage(auth()->user(), 'Admin Feedtag Active Status Updated', 'admin_web_feedtag_active_status', session()->getId(), 'WEB');

            DB::commit();
            $this->resetPage();
            $this->dispatchBrowserEvent('successtoast', ['message' => 'Feed Tag Updated Successfully!']);

        } catch (Exception $e) {
            $this->exceptionerror('active_status', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('active_status', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('active_status', 'three', $e);
        }
    }

    public function deleteconfirm($feedtagid)
    {
        $this->dispatchBrowserEvent('deletetoast', ['feedtagid' => $feedtagid]);
    }

    public function delete(Feedtag $feedtag)
    {

        try {
            DB::beginTransaction();

            $feedtag->delete();
            Helper::trackmessage(auth()->user(), 'Admin Feedtag Delete', 'admin_web_feedtag_delete', session()->getId(), 'WEB');

            DB::commit();
            $this->resetPage();
            $this->dispatchBrowserEvent('deletemsg', ['message' => 'Feed Tag Deleted!']);

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
        $feedtag = Feedtag::query()
            ->where('name', 'like', '%' . $this->searchTerm . '%')
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)->onEachSide(1);

        return view('livewire.admin.settings.feed.feedhashtag.feedhashtagindexlivewire', compact('feedtag'));
    }

    protected function exceptionerror($msg, $type, $e)
    {
        DB::rollback();
        Log::error("SessionID: " . session()->getId() . ' Exception ' . $type . ': admin_web_feedtag_' . $msg . '  Error: ' . $e->getMessage());
        $this->dispatchBrowserEvent('errortoast', ['message' => $e->getMessage()]);
    }
}
