<?php

namespace App\Http\Livewire\Admin\Settings\Onlineassessment\Mapclass;

use App\Models\Admin\Settings\Onlineassessment\Mapclass;
use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

class Mapeachclasslivewire extends Component
{
    public $mapclass, $mapclass_uuid, $mapclasslist;

    public function mount(Mapclass $mapclass)
    {
        $response = Http::post(config('archive.online_assessment.path') . '/getallclass', [
            'key' => config('archive.online_assessment.key'),
        ]);

        $response = json_decode($response->body());
        $this->mapclasslist = collect($response->data);
        $this->mapclass = $mapclass;
        $this->mapclass_uuid = $this->mapclass->mapclass_uuid;
    }

    public function updatedMapclassuuid()
    {
        $this->validate(
            [
                'mapclass_uuid' => 'required',
            ]
        );

        try {
            if ($this->mapclass_uuid == 0) {
                $this->mapclass->update(['mapclass_uuid' => null, 'status' => null]);
            } else {
                $this->mapclass->update(['mapclass_uuid' => $this->mapclass_uuid, 'status' => 1]);
            }

            Helper::trackmessage(auth()->user(), 'Admin Map Class', 'admin_web_map_class', session()->getId(), 'WEB');
            $this->emit('mapclasslistrefresh');
            DB::commit();
        } catch (Exception $e) {
            $this->exceptionerror('mapclass', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('mapclass', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('mapclass', 'three', $e);
        }
    }

    public function render()
    {
        return view('livewire.admin.settings.onlineassessment.mapclass.mapeachclasslivewire');
    }

    protected function exceptionerror($msg, $type, $e)
    {
        DB::rollback();
        Log::error("SessionID: " . session()->getId() . ' Exception ' . $type . ': admin_web_map_subject' . $msg . '  Error: ' . $e->getMessage());
        $this->dispatchBrowserEvent('errortoast', ['message' => $e->getMessage()]);
    }
}
