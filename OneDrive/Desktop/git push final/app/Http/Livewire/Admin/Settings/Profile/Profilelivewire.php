<?php

namespace App\Http\Livewire\Admin\Settings\Profile;

use App\Models\Admin\Auth\User;
use App\Models\Miscellaneous\Helper;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Profilelivewire extends Component
{
    use WithFileUploads;

    public $avatar;
    public $existingavatar;

    public $name;
    public $email;
    public $dob;
    public $address_lineone;
    public $address_linetwo;
    public $pincode;

    public function mount()
    {
        $user = auth()->user();
        $this->name = $user->name;
        $this->email = $user->email;
        $this->dob = Carbon::parse($user->dob)->format('Y-m-d');
        $this->address = $user->address;
        $this->existingavatar = $user->avatar;
    }

    protected $rules = [
        'name' => 'bail|required',
        'email' => 'bail|required',
        'dob' => 'bail|required',
        'address' => 'bail|required',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updateprofile()
    {

        try {
            DB::beginTransaction();
            $validatedData = $this->validate();
            $user = auth()->user();
            $user->update($validatedData);
            Helper::trackmessage($user, 'Admin Profile Update', 'admin_web_updateprofile', session()->getId(), 'WEB');
            DB::commit();
            $this->dispatchBrowserEvent('successtoast', ['message' => 'Profile Update Successfully!']);

        } catch (Exception $e) {
            $this->exceptionerror('profileupdate', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('profileupdate', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('profileupdate', 'three', $e);
        }

    }

    protected function exceptionerror($msg, $type, $e)
    {
        DB::rollback();
        Log::error("SessionID: " . session()->getId() . ' Exception ' . $type . ': admin_web_' . $msg . '  Error: ' . $e->getMessage());
        $this->dispatchBrowserEvent('errortoast', ['message' => $e->getMessage()]);
    }

    public function render()
    {
        return view('livewire.admin.settings.profile.profilelivewire');
    }

    // UPLOAD PHOTO

    public function uploadphoto()
    {

        $this->validate([
            'avatar' => 'image|max:1024', // 1MB Max
        ]);

        $user = auth()->user();
        $path = 'image/profile';
        $newavatar = $this->avatar->store($path, 'public');
        $user->update(['avatar' => $newavatar]);
        if ($this->existingavatar) {
            Storage::delete('public/' . $this->existingavatar);
        }
        $this->avatar = null;
        $this->existingavatar = $newavatar;

        $this->dispatchBrowserEvent('successtoast', ['message' => 'Profile Image Uploaded Successfully!']);
    }
}
