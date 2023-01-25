<div class="intro-y box rounded-xl py-3 sm:py-3 mt-4 {{ $show == 2 ? '' : 'hidden' }}">
    @include('admin.staff.helper.addstaffformwizard', ['active' => 'payroll'])
    <div class="px-5 sm:px-20 mt-3 pt-3 border-t border-gray-200 dark:border-dark-5 border-none">
        <form wire:submit.prevent="payroll" autocomplete="off">
            <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                <div class="intro-x col-span-12 sm:col-span-4">
                    <label for="input-wizard-1" class="form-label font-semibold">EDF Number</label>
                    <input id="edf_number" wire:model.lazy="edf_number" type="text" class="form-control"
                        placeholder="1234567890">
                    @error('edf_number')
                        <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="intro-x col-span-12 sm:col-span-4">
                    <label for="input-wizard-2" class="form-label font-semibold">Basic Salary (For Month)</label>
                    <input id="basic_salary" wire:model.lazy="basic_salary" type="text" class="form-control"
                        placeholder="20,000">
                    @error('basic_salary')
                        <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="intro-x col-span-12 sm:col-span-4">
                    <label for="input-wizard-3" class="form-label font-semibold">Contact Type</label>
                    <select wire:model.lazy="contract_type_id" id="contract_type_id" class="form-select">
                        <option>Select A Contract</option>
                        @foreach (config('archive.contract_type') as $key => $value)
                            <option value={{ $key }}>
                                {{ $value }}
                            </option>
                        @endforeach
                    </select>
                    @error('contract_type_id')
                        <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="intro-x col-span-12 sm:col-span-4">
                    <label for="input-wizard-4" class="form-label font-semibold">Location</label>
                    <input id="location" wire:model.lazy="location" type="text" class="form-control"
                        placeholder="Chennai">
                    @error('location')
                        <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div>

                <div class="intro-x col-span-12 flex items-center justify-center sm:justify-end mt-5 mb-5">
                    <button wire:click="back(1)" type="button" class="btn btn-secondary w-24">Previous</button>
                    <button type="submit" class="btn btn-primary w-24 mx-2 text-center">
                        <div wire:loading>
                            @include('helper.loadingicon.loadingicon')
                        </div>
                        <span wire:loading.remove>Next</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
