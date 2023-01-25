<div class="intro-y box rounded-xl py-3 sm:py-3 mt-4 {{ $show == 2 ? '' : 'hidden' }}">
    @include('admin.accounts.fee.helper.createfeeformwizard', [
    'active' => 'addparticulars',
    ])
    <div
        class="px-5 sm:px-20 mt-3 pt-3 border-t border-gray-200 dark:border-dark-5 w-full  mx-0 sm:mx-auto border-none">
        <form wire:submit.prevent="validatefeeparticular" autocomplete="off">
            <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                @foreach ($particular as $particularkey => $eachparticular)
                <div class="intro-x col-span-6 sm:col-span-6">
                    <label for="feeparticular_id" class="form-label font-semibold">Particulars</label>
                    <select wire:model="particular.{{ $particularkey }}.feeparticular_id" wire:key="{{ $loop->index }}"
                        id="feeparticular_id" class="form-select w-full">
                        <option value="0">Select Fee Particular </option>
                        @foreach ($feeparticular as $eachfeeparticular)
                        <option value="{{ $eachfeeparticular->id }}">
                            {{ $eachfeeparticular->name }}
                        </option>
                        @endforeach
                    </select>
                    @error('particular.' . $particularkey . '.feeparticular_id')
                    <span class="font-semibold text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="intro-x col-span-4 sm:col-span-4">
                    <label for="amount" class="form-label font-semibold">Amount</label>
                    <input wire:model="particular.{{ $particularkey }}.amount" wire:keyup="calculateamount()"
                        type="number" class="form-control">
                    @error('particular.' . $particularkey . '.amount')
                    <span class="font-semibold text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-span-2 sm:col-span-2 flex gap-2 items-end mb-3">
                    @if ($particularkey + 1 == sizeof($particular))
                    @include('helper.multientries.add', [
                    'method' => 'addparticular',
                    ])
                    @endif
                    @if ($particularkey >= 1)
                    @include('helper.multientries.delete', [
                    'method' => 'removeparticular',
                    'id' => $particularkey,
                    ])
                    @endif
                </div>
                @endforeach
                <div class="intro-x col-span-10 sm:col-span-10">
                    <div class="flex flex-row gap-3 justify-end sm:justify-end">
                        <label for="total_amount" class="form-label font-semibold pt-12">Total</label>
                        <div class="mt-8 w-32 sm:w-full">
                            <input wire:model="total_amount" id="total_amount" type="number" class="form-control"
                                readonly>
                        </div>
                    </div>
                </div>
                <div class="intro-x col-span-10 flex items-center justify-center sm:justify-end mt-5 mb-5">
                    <button type="button" wire:click="back(1)" class="btn btn-secondary w-24">Previous</button>
                    <button type="submit" class="btn btn-primary w-24 ml-2">Next</button>
                </div>
            </div>
        </form>
    </div>
</div>