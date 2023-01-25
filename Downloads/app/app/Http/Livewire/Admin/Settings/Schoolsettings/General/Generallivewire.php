<?php

namespace App\Http\Livewire\Admin\Settings\Schoolsettings\General;

use App\Models\Admin\Settings\Schoolsetting\Generalsetting;
use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Generallivewire extends Component
{

    use WithFileUploads;

    public $isModalFormOpen = false;

    public $schoolname, $apptitle, $address, $phone, $email, $code, $academicyear, $language;

    public $logo, $existinglogo;

    public $favicon, $existingfavicon;

    protected $rules = [
        'schoolname' => 'bail|required',
        'apptitle' => 'bail|required',
        'address' => 'bail|required',
        'phone' => 'bail|required|numeric|digits:10',
        'email' => 'bail|required|email',
        'code' => 'bail|required',
        'academicyear' => 'bail|required',
        'language' => 'bail|required',
    ];

    public function generalsettingsmodal()
    {
        $this->isModalFormOpen = true;
    }

    public function generalsettingscloseFormModalPopover()
    {
        $this->resetErrorBag();
        $this->isModalFormOpen = false;
    }

    public function updategeneralsetting()
    {
        try {
            $validated = $this->validate();
            DB::beginTransaction();

            $generalsettings = Generalsetting::first();

            $generalsettings->schoolname = $this->schoolname;
            $generalsettings->apptitle = $this->apptitle;
            $generalsettings->address = $this->address;
            $generalsettings->phone = $this->phone;
            $generalsettings->code = $this->code;
            $generalsettings->email = $this->email;
            $generalsettings->academicyear = $this->academicyear;
            $generalsettings->language = $this->language;

            if ($generalsettings->isDirty()) {
                $generalsettings->save();

                Helper::trackmessage(auth()->user(),
                    'Admin General Settings' . ($generalsettings->id) ? 'Update' : 'Create',
                    'admin_web_general_settings_' . ($generalsettings->id) ? 'update' : 'create',
                    session()->getId(),
                    'WEB');

                DB::commit();
                $this->dispatchBrowserEvent('updatetoast', ['message' => 'General Settings Updated Successfully!']);
                $this->generalsettingscloseFormModalPopover();
            } else {
                DB::rollback();
                $this->dispatchBrowserEvent('warningtoast', ['message' => 'No Changes has been made!']);
            }
        } catch (ValidationException $e) { //Error Validation
            $this->dispatchBrowserEvent('errortoast', ['message' => array_values(array_values($e->errors())[0])[0]]);
        } catch (Exception $e) {
            $this->exceptionerror('createorupdate', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('createorupdate', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('createorupdate', 'three', $e);
        }
    }

    public function edit()
    {
        $generalsettings = Generalsetting::first();

        $this->schoolname = $generalsettings->schoolname;
        $this->apptitle = $generalsettings->apptitle;
        $this->address = $generalsettings->address;
        $this->phone = $generalsettings->phone;
        $this->email = $generalsettings->email;
        $this->code = $generalsettings->code;
        $this->academicyear = $generalsettings->academicyear;
        $this->language = $generalsettings->language;
        $this->existinglogo = $generalsettings->logo;
        $this->existingfavicon = $generalsettings->favicon;
        $this->generalsettingsmodal();
    }

    protected function exceptionerror($msg, $type, $e)
    {
        DB::rollback();
        Log::error("SessionID: " . session()->getId() . ' Exception ' . $type . ': admin_web_' . $msg . '  Error: ' . $e->getMessage());
        $this->dispatchBrowserEvent('errortoast', ['message' => $e->getMessage()]);
    }

    public function render()
    {
        $generalsettings = Generalsetting::first();
        return view('livewire.admin.settings.schoolsettings.general.generallivewire', compact('generalsettings'));
    }

    public function uploadlogo()
    {
        $this->validate([
            'logo' => 'image|max:1024', // 1MB Max
        ]);

        $path = 'image/logo';
        $newlogo = $this->logo->store($path, 'public');
        Generalsetting::first()->update(['logo' => $newlogo]);
        if ($this->existinglogo) {
            Storage::delete('public/' . $this->existinglogo);
        }
        $this->logo = null;
        $this->existinglogo = $newlogo;

        $this->dispatchBrowserEvent('successtoast', ['message' => 'Logo Uploaded Successfully!']);
    }

    public function uploadfavicon()
    {
        $this->validate([
            'favicon' => 'image|max:1024', // 1MB Max
        ]);

        $path = 'image/favicon';
        $newfavicon = $this->favicon->store($path, 'public');
        Generalsetting::first()->update(['favicon' => $newfavicon]);
        if ($this->existingfavicon) {
            Storage::delete('public/' . $this->existingfavicon);
        }
        $this->favicon = null;
        $this->existingfavicon = $newfavicon;

        $this->dispatchBrowserEvent('successtoast', ['message' => 'Favicon Uploaded Successfully!']);
    }
}
