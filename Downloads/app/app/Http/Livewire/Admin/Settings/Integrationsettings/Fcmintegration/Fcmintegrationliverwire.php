<?php

namespace App\Http\Livewire\Admin\Settings\Integrationsettings\Fcmintegration;

use App\Models\Admin\Settings\Integration\Fcmintegration;
use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Fcmintegrationliverwire extends Component
{
    public $fcmintegrationid;

    public $isModalFormOpen = false;

    public $fcmintegrationshowdata;

    public $isshowmodalopen = false;

    public function fcmintegrationshowmodal()
    {
        $this->isshowmodalopen = true;
    }
    public function fcmintegrationclosemodal()
    {
        $this->isshowmodalopen = false;
        $this->fcmintegrationshowdata = [];
    }

    public $serverkey, $apiKey, $authDomain, $projectId, $storageBucket, $messagingSenderId, $appId, $measurementId, $sender_id;

    protected $rules = [
        'serverkey' => 'required',
        'email' => 'required',
    ];

    public function fcmintegrationopenFormModal()
    {
        $this->isModalFormOpen = true;
    }

    public function fcmintegrationcloseFormModal()
    {
        $this->resetErrorBag();
        $this->isModalFormOpen = false;
    }

    public function updatefcmintegration()
    {
        try {
            $validated = $this->validate();
            DB::beginTransaction();

            $fcmintegration = Fcmintegration::find($this->fcmintegrationid);

            $fcmintegration->serverkey = $this->serverkey;
            $fcmintegration->email = $this->email;

            if ($fcmintegration->isDirty()) {
                $fcmintegration->save();

                Helper::trackmessage(auth()->user(),
                    'Admin fcmintegration ' . ($this->fcmintegrationid) ? 'Update' : 'Create',
                    'admin_web_fcmintegration_' . ($this->fcmintegrationid) ? 'update' : 'create',
                    session()->getId(),
                    'WEB');

                DB::commit();
                $this->dispatchBrowserEvent('updatetoast', ['message' => 'FCM Integration Updated Successfully!']);
                $this->fcmintegrationcloseFormModal();
            } else {
                DB::rollback();
                $this->dispatchBrowserEvent('warningtoast', ['message' => 'No Changes has been made!']);
            }

        } catch (Exception $e) {
            $this->exceptionerror('createorupdate', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('createorupdate', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('createorupdate', 'three', $e);
        }
    }

    public function show(Fcmintegration $fcmintegration)
    {
        $this->fcmintegrationshowdata = $fcmintegration;
        $this->fcmintegrationshowmodal();
    }

    public function edit(Fcmintegration $fcmintegration)
    {
        $this->fcmintegrationid = $fcmintegration->id;
        $this->serverkey = $fcmintegration->serverkey;
        $this->email = $fcmintegration->email;
        $this->fcmintegrationopenFormModal();
    }

    public function changedefault(Fcmintegration $fcmintegration)
    {
        try {
            DB::beginTransaction();

            Fcmintegration::where('is_default', true)
                ->update([
                    'is_default' => false,
                ]);

            $fcmintegration->is_default = true;
            $fcmintegration->save();
            Helper::trackmessage(auth()->user(), 'Admin Fcmintegration Default', 'admin_web_fcmintegration_default', session()->getId(), 'WEB');

            DB::commit();
            $this->resetPage();
            $this->dispatchBrowserEvent('successtoast', ['message' => 'Default Fcmintegration Changed!']);

        } catch (Exception $e) {
            $this->exceptionerror('delete', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('delete', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('delete', 'three', $e);
        }
    }

    public function render()
    {
        $fcmintegration = Fcmintegration::select('id', 'email', 'is_default')->get();
        return view('livewire.admin.settings.integrationsettings.fcmintegration.fcmintegrationliverwire', compact('fcmintegration'));
    }

    protected function exceptionerror($msg, $type, $e)
    {
        DB::rollback();
        Log::error("SessionID: " . session()->getId() . ' Exception ' . $type . ': admin_web_fcmtemplate_' . $msg . '  Error: ' . $e->getMessage());
        $this->dispatchBrowserEvent('errortoast', ['message' => $e->getMessage()]);
    }
}
