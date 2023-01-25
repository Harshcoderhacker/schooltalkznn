<?php

namespace App\Http\Livewire\Admin\Settings\Onlineassessment\Mapboard;

use App\Models\Admin\Settings\Onlineassessment\Mapboard;
use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Mapboardlivewire extends Component
{
    public $mapboardlist, $mapboard_uuid;
    public $mapboardsubmitbtn = true;

    public function mount()
    {
        $response = Http::post(config('archive.online_assessment.path') . '/getallboard', [
            'key' => config('archive.online_assessment.key'),
        ]);

        $response = json_decode($response->body());
        $this->mapboardlist = collect($response->data);
    }
    protected function rules()
    {
        return [
            'mapboard_uuid' => 'required',
        ];
    }

    protected $messages = [
        'mapboard_uuid.required' => 'Select Board',
    ];

    public function updated($propertyMapboardUuid)
    {
        $this->mapboardsubmitbtn = true;
        $this->validateOnly($propertyMapboardUuid);
        $this->mapboardsubmitbtn = false;
    }

    public function createorupdate()
    {
        try {
            DB::beginTransaction();

            $this->validate();
            $user = auth()->user();
            $mapboard = Mapboard::where('active', true)->get();
            if (sizeof($mapboard) > 0) {
                $mapboard->first()->update(['mapboard_uuid' => $this->mapboard_uuid]);
            } else {
                Mapboard::create(['mapboard_uuid' => $this->mapboard_uuid]);
            }
            Helper::trackmessage(auth()->user(), 'Admin Map Board', 'admin_web_map_board', session()->getId(), 'WEB');

            DB::commit();
            $this->formreset();
            $this->dispatchBrowserEvent('successtoast', ['message' => 'Mapped Board Successfully!']);

            $this->mapboardsubmitbtn = false;

        } catch (Exception $e) {
            $this->exceptionerror('createorupdate', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('createorupdate', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('createorupdate', 'three', $e);
        }

    }

    protected function formreset()
    {
        $this->mapboard_uuid = null;
    }

    public function formcancel()
    {
        $this->formreset();
    }

    public function render()
    {
        $mapboard = Mapboard::where("active", true)->latest()->first();
        $board = $this->mapboardlist->toArray();
        return view('livewire.admin.settings.onlineassessment.mapboard.mapboardlivewire', compact('mapboard', 'board'));
    }

    protected function exceptionerror($msg, $type, $e)
    {
        DB::rollback();
        Log::error("SessionID: " . session()->getId() . ' Exception ' . $type . ': admin_web_coa_' . $msg . '  Error: ' . $e->getMessage());
        $this->dispatchBrowserEvent('errortoast', ['message' => $e->getMessage()]);
    }
}
