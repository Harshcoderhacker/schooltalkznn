<?php

namespace App\Http\Livewire\Admin\Settings\Integrationsettings\Emailintegration;

use App\Models\Admin\Settings\Integration\Emailintegration;
use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Emailintegrationliverwire extends Component
{
    public $emailintegrationid;

    public $provider_name, $email_from_name, $email_from_mail, $email_mail_driver, $email_mail_host, $email_mail_port;
    public $email_mail_username, $email_mail_password, $email_mail_encryption;

    public $isModalFormOpen = false;

    public $emailintegrationshowdata;

    public $isshowmodalopen = false;

    public function emailintegrationshowmodal()
    {
        $this->isshowmodalopen = true;
    }
    public function emailintegrationclosemodal()
    {
        $this->isshowmodalopen = false;
        $this->emailintegrationshowdata = [];
    }

    protected $rules = [
        'provider_name' => 'required',
        'email_from_name' => 'required',
        'email_from_mail' => 'required|email',
        'email_mail_driver' => 'required',
        'email_mail_host' => 'required',
        'email_mail_port' => 'required',
        'email_mail_username' => 'required',
        'email_mail_password' => 'required',
        'email_mail_encryption' => 'required',
    ];

    public function emailintegrationopenFormModal()
    {
        $this->isModalFormOpen = true;
    }

    public function emailintegrationcloseFormModal()
    {
        $this->resetErrorBag();
        $this->isModalFormOpen = false;
    }

    public function updateemailintegration()
    {
        try {
            $validated = $this->validate();
            DB::beginTransaction();

            $emailintegration = Emailintegration::find($this->emailintegrationid);

            $emailintegration->provider_name = $this->provider_name;
            $emailintegration->email_from_name = $this->email_from_name;
            $emailintegration->email_from_mail = $this->email_from_mail;
            $emailintegration->email_mail_driver = $this->email_mail_driver;
            $emailintegration->email_mail_host = $this->email_mail_host;
            $emailintegration->email_mail_port = $this->email_mail_port;
            $emailintegration->email_mail_username = $this->email_mail_username;
            $emailintegration->email_mail_password = $this->email_mail_password;
            $emailintegration->email_mail_encryption = $this->email_mail_encryption;

            if ($emailintegration->isDirty()) {
                $emailintegration->save();

                Helper::trackmessage(auth()->user(),
                    'Admin emailintegration ' . ($this->emailintegrationid) ? 'Update' : 'Create',
                    'admin_web_emailintegration_' . ($this->emailintegrationid) ? 'update' : 'create',
                    session()->getId(),
                    'WEB');

                DB::commit();
                $this->dispatchBrowserEvent('updatetoast', ['message' => 'Email Integration Updated Successfully!']);
                $this->emailintegrationcloseFormModal();
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

    public function show(Emailintegration $emailintegration)
    {
        $this->emailintegrationshowdata = $emailintegration;
        $this->emailintegrationshowmodal();
    }

    public function edit(Emailintegration $emailintegration)
    {
        $this->emailintegrationid = $emailintegration->id;
        $this->provider_name = $emailintegration->provider_name;
        $this->email_from_name = $emailintegration->email_from_name;
        $this->email_from_mail = $emailintegration->email_from_mail;
        $this->email_mail_driver = $emailintegration->email_mail_driver;
        $this->email_mail_host = $emailintegration->email_mail_host;
        $this->email_mail_port = $emailintegration->email_mail_port;
        $this->email_mail_username = $emailintegration->email_mail_username;
        $this->email_mail_password = $emailintegration->email_mail_password;
        $this->email_mail_encryption = $emailintegration->email_mail_encryption;
        $this->emailintegrationopenFormModal();
    }

    public function changedefault(Emailintegration $emailintegration)
    {

        try {
            DB::beginTransaction();

            Emailintegration::where('is_default', true)
                ->update([
                    'is_default' => false,
                ]);

            $emailintegration->is_default = true;
            $emailintegration->save();

            Helper::trackmessage(auth()->user(), 'Admin Emailintegration Default', 'admin_web_emailintegration_default', session()->getId(), 'WEB');

            DB::commit();
            $this->resetPage();
            $this->dispatchBrowserEvent('successtoast', ['message' => 'Default Emailintegration Changed!']);

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
        $emailintegration = Emailintegration::select('id', 'provider_name', 'email_from_name', 'email_from_mail', 'email_mail_username', 'is_default')->get();
        return view('livewire.admin.settings.integrationsettings.emailintegration.emailintegrationliverwire',
            compact('emailintegration'));
    }

    protected function exceptionerror($msg, $type, $e)
    {
        DB::rollback();
        Log::error("SessionID: " . session()->getId() . ' Exception ' . $type . ': admin_web_emailintegration_' . $msg . '  Error: ' . $e->getMessage());
        $this->dispatchBrowserEvent('errortoast', ['message' => $e->getMessage()]);
    }
}
