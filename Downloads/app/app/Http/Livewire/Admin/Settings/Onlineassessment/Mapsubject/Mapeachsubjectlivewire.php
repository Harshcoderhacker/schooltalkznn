<?php

namespace App\Http\Livewire\Admin\Settings\Onlineassessment\Mapsubject;

use App\Models\Admin\Settings\Onlineassessment\Mapsubject;
use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Mapeachsubjectlivewire extends Component
{
    public $mapsubject, $mapsubject_uuid, $mapsubjectlist;

    public function mount(Mapsubject $mapsubject)
    {
        $response = Http::post(config('archive.online_assessment.path') . '/getallsubject', [
            'key' => config('archive.online_assessment.key'),
        ]);

        $response = json_decode($response->body());
        $this->mapsubjectlist = collect($response->data);
        $this->mapsubject = $mapsubject;
        $this->mapsubject_uuid = $this->mapsubject->mapsubject_uuid;
    }

    public function updatedMapsubjectuuid()
    {
        $this->validate(
            [
                'mapsubject_uuid' => 'required',
            ]
        );

        try {
            if ($this->mapsubject_uuid == 0) {
                $this->mapsubject->update(['mapsubject_uuid' => null, 'status' => null]);
            } else {
                $this->mapsubject->update(['mapsubject_uuid' => $this->mapsubject_uuid, 'status' => 1]);
            }

            Helper::trackmessage(auth()->user(), 'Admin Map Subject', 'admin_web_map_subject', session()->getId(), 'WEB');
            $this->emit('mapsubjectlistrefresh');
            DB::commit();
        } catch (Exception $e) {
            $this->exceptionerror('mapsubject', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('mapsubject', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('mapsubject', 'three', $e);
        }
    }

    public function render()
    {
        return view('livewire.admin.settings.onlineassessment.mapeachsubjectlivewire');
    }

    protected function exceptionerror($msg, $type, $e)
    {
        DB::rollback();
        Log::error("SessionID: " . session()->getId() . ' Exception ' . $type . ': admin_web_map_subject' . $msg . '  Error: ' . $e->getMessage());
        $this->dispatchBrowserEvent('errortoast', ['message' => $e->getMessage()]);
    }
}
