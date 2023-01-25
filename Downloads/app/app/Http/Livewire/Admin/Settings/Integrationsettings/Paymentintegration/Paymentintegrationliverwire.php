<?php

namespace App\Http\Livewire\Admin\Settings\Integrationsettings\Paymentintegration;

use App\Models\Admin\Settings\Integration\Paymentintegration;
use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class Paymentintegrationliverwire extends Component
{
    use WithPagination;

    public $paymentintegrationid, $gateway_name;
    public $gateway_username, $gateway_secret_key, $gateway_publisher_key;

    public $searchTerm = null;

    public $sortColumnName = 'created_at';

    public $sortDirection = 'desc';

    public $paginationlength = 5;

    public $paymentintegrationshowdata;

    public $isshowmodalopen = false;

    public function paymentintegrationshowmodal()
    {
        $this->isshowmodalopen = true;
    }
    public function paymentintegrationclosemodal()
    {
        $this->isshowmodalopen = false;
        $this->paymentintegrationshowdata = [];
    }

    protected function rules()
    {
        return [
            'gateway_username' => 'required',
            'gateway_secret_key' => 'required',
            'gateway_publisher_key' => 'required',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function createorupdate()
    {
        try {
            DB::beginTransaction();

            $validated = $this->validate();
            $user = auth()->user();

            if ($this->paymentintegrationid) {
                $paymentintegrationmodel = Paymentintegration::find($this->paymentintegrationid);

                $paymentintegrationmodel->gateway_username = $this->gateway_username;
                $paymentintegrationmodel->gateway_secret_key = $this->gateway_secret_key;
                $paymentintegrationmodel->gateway_publisher_key = $this->gateway_publisher_key;

                if ($paymentintegrationmodel->isDirty()) {
                    $paymentintegrationmodel->save();

                    Helper::trackmessage(auth()->user(), 'Admin Paymentintegration Update', 'admin_web_paymentintegration_create', session()->getId(), 'WEB');
                    DB::commit();
                    $this->formreset();
                    $this->resetPage();
                    $this->dispatchBrowserEvent('updatetoast', ['message' => 'Paymentintegration Updated Successfully!']);

                } else {
                    DB::rollback();
                    $this->dispatchBrowserEvent('warningtoast', ['message' => 'No Changes has been made!']);
                    $this->emit('payment_field_focus_trigger');
                }
            } else {
                Paymentintegration::create($validated);
                Helper::trackmessage(auth()->user(), 'Admin Paymentintegration Create', 'admin_web_paymentintegration_create', session()->getId(), 'WEB');

                DB::commit();
                $this->formreset();
                $this->resetPage();
                $this->dispatchBrowserEvent('successtoast', ['message' => 'Paymentintegration Added Successfully!']);
            }

        } catch (Exception $e) {
            $this->exceptionerror('createorupdate', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('createorupdate', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('createorupdate', 'three', $e);
        }

    }

    public function changedefault(Paymentintegration $paymentintegration)
    {
        try {
            DB::beginTransaction();

            Paymentintegration::where('is_default', true)
                ->update([
                    'is_default' => false,
                ]);

            $paymentintegration->is_default = true;
            $paymentintegration->save();
            Helper::trackmessage(auth()->user(), 'Admin Paymentintegration Default', 'admin_web_paymentintegration_default', session()->getId(), 'WEB');

            DB::commit();
            $this->resetPage();
            $this->dispatchBrowserEvent('successtoast', ['message' => 'Default Paymentintegration Changed!']);

        } catch (Exception $e) {
            $this->exceptionerror('delete', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('delete', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('delete', 'three', $e);
        }
    }

    public function show(Paymentintegration $paymentintegration)
    {
        $this->paymentintegrationshowdata = $paymentintegration;
        $this->paymentintegrationshowmodal();
    }

    public function edit(Paymentintegration $paymentintegration)
    {
        $this->paymentintegrationid = $paymentintegration->id;
        $this->gateway_name = $paymentintegration->gateway_name;
        $this->gateway_username = $paymentintegration->gateway_username;
        $this->gateway_secret_key = $paymentintegration->gateway_secret_key;
        $this->gateway_publisher_key = $paymentintegration->gateway_publisher_key;

        $this->emit('payment_field_focus_trigger');
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

    protected function formreset()
    {
        $this->gateway_name = null;
        $this->paymentintegrationid = null;
    }

    public function formcancel()
    {
        $this->formreset();
        $this->resetPage();
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
        $paymentintegration = Paymentintegration::query()
            ->where('gateway_name', 'like', '%' . $this->searchTerm . '%')
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)->onEachSide(1);

        return view('livewire.admin.settings.integrationsettings.paymentintegration.paymentintegrationliverwire', [
            'paymentintegration' => $paymentintegration,
        ]);
    }

    protected function exceptionerror($msg, $type, $e)
    {
        DB::rollback();
        Log::error("SessionID: " . session()->getId() . ' Exception ' . $type . ': admin_web_paymentintegration_' . $msg . '  Error: ' . $e->getMessage());
        $this->dispatchBrowserEvent('errortoast', ['message' => $e->getMessage()]);
    }
}
