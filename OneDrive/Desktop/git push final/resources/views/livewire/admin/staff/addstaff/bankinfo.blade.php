<div class="intro-y box rounded-xl py-3 sm:py-3 mt-4 {{ $show == 3 ? '' : 'hidden' }}">
    @include('admin.staff.helper.addstaffformwizard', ['active' => 'bankinfo'])
    <div class="px-5 sm:px-20 mt-3 pt-3 border-t border-gray-200 dark:border-dark-5 border-none">
        <form wire:submit.prevent="bankinfo" autocomplete="off">
            <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                <div class="intro-x col-span-12 sm:col-span-4">
                    <label for="input-wizard-1" class="form-label font-semibold">Account name</label>
                    <input id="account_name" wire:model.lazy="account_name" type="text" class="form-control"
                        placeholder="Ajay Antony">
                    @error('account_name')
                        <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="intro-x col-span-12 sm:col-span-4">
                    <label for="input-wizard-1" class="form-label font-semibold">Bank name</label>
                    <input id="bank_name" wire:model.lazy="bank_name" type="text" class="form-control"
                        placeholder="Fedral Bank">
                    @error('bank_name')
                        <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="intro-x col-span-12 sm:col-span-4">
                    <label for="input-wizard-2" class="form-label font-semibold">Account Number</label>
                    <input id="account_no" wire:model.lazy="account_no" type="number" class="form-control"
                        placeholder="12345">
                    @error('account_no')
                        <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="intro-x col-span-12 sm:col-span-4">
                    <label for="input-wizard-3" class="form-label font-semibold">IFSC Code</label>
                    <input id="ifsc_code" wire:model.lazy="ifsc_code" type="text" class="form-control"
                        placeholder="12345">
                    @error('ifsc_code')
                        <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="intro-x col-span-12 sm:col-span-4">
                    <label for="input-wizard-4" class="form-label font-semibold">Bank Branch</label>
                    <input id="bank_branch" wire:model.lazy="bank_branch" type="text" class="form-control"
                        placeholder="Chennai">
                    @error('bank_branch')
                        <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div>

                <div class="intro-x col-span-12 flex items-center justify-center sm:justify-end mt-5 mb-5">
                    <button wire:click="back(2)" type="button" class="btn btn-secondary w-24">Previous</button>
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
