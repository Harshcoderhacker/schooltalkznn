<?php

namespace App\Http\Livewire\Admin\Settings\Profile;

use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Changepasswordlivewire extends Component
{

    public $password, $password_confirmation, $currentpassword;

    protected $rules = [
        'currentpassword' => 'bail|required',
        'password' => 'bail|required|confirmed|min:8',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function changepassword()
    {

        try {
            DB::beginTransaction();

            $validatedData = $this->validate();

            $user = auth()->user();

            if (Hash::check($this->currentpassword, $user->password)) {

                $user->update(['password' => $this->password]);
                Helper::trackmessage($user, 'Admin Change Password', 'admin_web_changepassword', session()->getId(), 'WEB');
                DB::commit();

                $this->formreset();
                $this->dispatchBrowserEvent('successtoast', ['message' => 'Change Password Successfully!']);
            } else {
                DB::rollback();

                $this->formreset();
                $this->dispatchBrowserEvent('errortoast', ['message' => 'Wrong Password, Try Again']);
            }

        } catch (Exception $e) {
            $this->exceptionerror('changepassword', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('changepassword', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('changepassword', 'three', $e);
        }

    }

    public function onclickformreset()
    {
        //dd('working');
        // $this->formreset();
        $this->dispatchBrowserEvent('updatetoast', ['message' => 'Change Password Discard Done!']);
    }

    public function formreset()
    {
        $this->password = null;
        $this->password_confirmation = null;
        $this->currentpassword = null;
    }

    protected function exceptionerror($msg, $type, $e)
    {
        DB::rollback();
        Log::error("SessionID: " . session()->getId() . ' Exception ' . $type . ': admin_web_' . $msg . '  Error: ' . $e->getMessage());
        $this->dispatchBrowserEvent('errortoast', ['message' => $e->getMessage()]);
    }

    public function render()
    {
        return view('livewire.admin.settings.profile.changepasswordlivewire');
    }
}
