<div class="intro-x box rounded-xl py-3 sm:py-3 mt-4 {{ $show == 3 ? '' : 'hidden' }}">
    @include('admin.student.helper.addstudentformwizard', [
        'active' => 'transport',
    ])
    <div class="px-5 sm:px-20 mt-3 pt-3 border-t border-gray-200 dark:border-dark-5 border-none">
        <form wire:submit.prevent="transport" autocomplete="off">
            <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                <div class="intro-x col-span-12 sm:col-span-4">
                    <label for="route_no" class="form-label font-semibold">Route No</label>
                    <input id="route_no" wire:model.lazy="route_no" type="text" class="form-control">
                    @error('route_no')
                        <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="intro-x col-span-12 sm:col-span-4">
                    <label for="bus_no" class="form-label font-semibold">Bus No</label>
                    <input id="bus_no" wire:model.lazy="bus_no" type="text" class="form-control">
                    @error('bus_no')
                        <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="intro-x col-span-12 sm:col-span-4">
                    <label for="fee_amount" class="form-label font-semibold">Fee Amount</label>
                    <input id="fee_amount" wire:model.lazy="fee_amount" type="text" class="form-control">
                    @error('fee_amount')
                        <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                    @enderror
                </div>
                <div class="intro-x col-span-12 sm:col-span-8">
                    <label for="route_address" class="form-label font-semibold">Route Address</label>
                    <textarea id="route_address" wire:model.lazy="route_address" type="text" class="form-control"></textarea>
                    @error('route_address')
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
