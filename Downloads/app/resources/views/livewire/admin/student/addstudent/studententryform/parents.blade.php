<div class="intro-x box rounded-xl py-3 sm:py-3 mt-4 {{ $show == 2 ? '' : 'hidden' }}">
    @include('admin.student.helper.addstudentformwizard', [
    'active' => 'parents',
    ])
    <div class="px-5 sm:px-20 mt-3 pt-3 border-t border-gray-200 dark:border-dark-5 border-none">
        <form wire:submit.prevent="parents" autocomplete="off">
            <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                <!-- <div class="intro-x col-span-12 sm:col-span-4">
                    <label for="primary_number" class="form-label font-semibold">Primary Contact Phone No.</label>
                    <input wire:model.lazy="primary_number" id="primary_number" type="text" class="form-control"
                        readonly>
                </div>
                <div class="intro-x col-span-12 sm:col-span-4">
                    <label for="primary_email" class="form-label font-semibold">Primary Contact Mail</label>
                    <input wire:model.lazy="primary_email" id="primary_email" type="text" class="form-control" readonly>
                </div>
                <div class="intro-x col-span-12 sm:col-span-4">
                    <label for="primary_name" class="form-label font-semibold">Primary Contact Name</label>
                    <input wire:model.lazy="primary_name" id="primary_name" type="text" class="form-control">
                    @error('primary_name')
                    <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div> -->
                <div class="intro-x col-span-12 sm:col-span-4">
                    <label for="mother_name" class="form-label font-semibold">Mother Name</label>
                    <input wire:model.lazy="mother_name" id="mother_name" type="text" class="form-control">
                    @error('mother_name')
                    <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <!-- <div class="intro-x col-span-12 sm:col-span-4">
                    <label for="mother_occupation" class="form-label font-semibold">Mother Occupation</label>
                    <input id="mother_occupation" wire:model.lazy="mother_occupation" type="text" class="form-control">
                    @error('mother_occupation')
                    <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="intro-x col-span-12 sm:col-span-4">
                    <label for="mother_phoneno" class="form-label font-semibold">Mother Phone No</label>
                    <input id="mother_phoneno" wire:model.lazy="mother_phoneno" type="text" class="form-control">
                    @error('mother_phoneno')
                    <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div> -->
                <div class="intro-x col-span-12 sm:col-span-4">
                    <label for="father_name" class="form-label font-semibold">Father Name</label>
                    <input id="father_name" wire:model.lazy="father_name" type="text" class="form-control">
                    @error('father_name')
                    <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <!-- <div class="intro-x col-span-12 sm:col-span-4">
                    <label for="father_occupation" class="form-label font-semibold">Father Occupation</label>
                    <input id="father_occupation" wire:model.lazy="father_occupation" type="text" class="form-control">
                    @error('father_occupation')
                    <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="intro-x col-span-12 sm:col-span-4">
                    <label for="father_phoneno" class="form-label font-semibold">Father Phone No</label>
                    <input id="father_phoneno" wire:model.lazy="father_phoneno" type="text" class="form-control">
                    @error('father_phoneno')
                    <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="intro-x col-span-12 sm:col-span-8">
                    <label for="father_office_address" class="form-label font-semibold">Father Office
                        Address</label>
                    <textarea id="father_office_address" wire:model.lazy="father_office_address" type="text"
                        class="form-control"></textarea>
                    @error('father_office_address')
                    <span class="pristine-error text-red-600 mt-2">
                        {{ $message }}</span>
                    @enderror
                </div> -->
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