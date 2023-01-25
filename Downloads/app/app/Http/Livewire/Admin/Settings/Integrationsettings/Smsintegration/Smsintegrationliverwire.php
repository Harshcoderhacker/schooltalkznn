<?php

namespace App\Http\Livewire\Admin\Settings\Integrationsettings\Smsintegration;

use App\Models\Admin\Settings\Integration\Smsintegration;
use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Smsintegrationliverwire extends Component
{

    public $smsintegrationid, $provider_name, $sid, $sender_id, $token, $url, $country_code, $phone_no;

    public $isModalFormOpen = false;

    public $smsintegrationshowdata;

    public $isshowmodalopen = false;

    public function smsintegrationshowmodal()
    {
        $this->isshowmodalopen = true;
    }
    public function smsintegrationclosemodal()
    {
        $this->isshowmodalopen = false;
        $this->smsintegrationshowdata = [];
    }

    protected $rules = [
        'provider_name' => 'required',
        'sid' => 'required',
        'sender_id' => 'required',
        'token' => 'required',
        'url' => 'required',
        'country_code' => 'required',
        'phone_no' => 'required|numeric|digits:10',
    ];

    public function smsintegrationopenformModal()
    {
        $this->isModalFormOpen = true;
    }
    public function smsintegrationcloseFormModal()
    {
        $this->resetErrorBag();
        $this->isModalFormOpen = false;
    }

    public function updatesmsintegration()
    {
        try {
            $validated = $this->validate();
            DB::beginTransaction();

            $smsintegration = Smsintegration::find($this->smsintegrationid);

            $smsintegration->provider_name = $this->provider_name;
            $smsintegration->sid = $this->sid;
            $smsintegration->sender_id = $this->sender_id;
            $smsintegration->token = $this->token;
            $smsintegration->url = $this->url;
            $smsintegration->country_code = $this->country_code;
            $smsintegration->phone_no = $this->phone_no;

            if ($smsintegration->isDirty()) {
                $smsintegration->save();

                Helper::trackmessage(auth()->user(),
                    'Admin Smsintegration ' . ($this->smsintegrationid) ? 'Update' : 'Create',
                    'admin_web_smsintegration_' . ($this->smsintegrationid) ? 'update' : 'create',
                    session()->getId(),
                    'WEB');

                DB::commit();
                $this->dispatchBrowserEvent('updatetoast', ['message' => 'Smsintegration Updated Successfully!']);
                $this->smsintegrationcloseFormModal();
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

    public function show(Smsintegration $smsintegration)
    {
        $this->smsintegrationshowdata = $smsintegration;
        $this->smsintegrationshowmodal();
    }

    public function edit(Smsintegration $smsintegration)
    {
        $this->smsintegrationid = $smsintegration->id;
        $this->provider_name = $smsintegration->provider_name;
        $this->sid = $smsintegration->sid;
        $this->sender_id = $smsintegration->sender_id;
        $this->token = $smsintegration->token;
        $this->url = $smsintegration->url;
        $this->country_code = $smsintegration->country_code;
        $this->phone_no = $smsintegration->phone_no;
        $this->smsintegrationopenformModal();
    }

    public function changedefault(Smsintegration $smsintegration)
    {
        try {
            DB::beginTransaction();

            Smsintegration::where('is_default', true)
                ->update([
                    'is_default' => false,
                ]);

            $smsintegration->is_default = true;
            $smsintegration->save();
            Helper::trackmessage(auth()->user(), 'Admin Smsintegration Default', 'admin_web_smsintegration_default', session()->getId(), 'WEB');

            DB::commit();
            $this->resetPage();
            $this->dispatchBrowserEvent('successtoast', ['message' => 'Default Smsintegration Changed!']);

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
        $smsintegration = Smsintegration::select('provider_name', 'sender_id', 'country_code', 'phone_no', 'id', 'is_default')->get();
        return view('livewire.admin.settings.integrationsettings.smsintegration.smsintegrationliverwire', compact('smsintegration'));
    }

    protected function exceptionerror($msg, $type, $e)
    {
        DB::rollback();
        Log::error("SessionID: " . session()->getId() . ' Exception ' . $type . ': admin_web_smstemplate_' . $msg . '  Error: ' . $e->getMessage());
        $this->dispatchBrowserEvent('errortoast', ['message' => $e->getMessage()]);
    }
}
