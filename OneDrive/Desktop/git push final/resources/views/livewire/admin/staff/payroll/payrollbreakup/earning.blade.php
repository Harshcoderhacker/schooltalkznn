<div class="col-span-12 sm:col-span-6 xl:col-span-4 intro-y">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <p class="font-bold text-white text-lg mr-auto mx-auto">Earnings</p>
                <a wire:click="addearning" class="btn btn-success text-white">Add</a>
            </div>
            <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                @foreach ($earning as $earningskey => $earningvalue)
                    <div class="col-span-12 sm:col-span-5">
                        <input autocomplete="off" wire:model.delay="earning.{{ $earningskey }}.name" type="text"
                            class="form-control" name="name[]" placeholder="Type">
                        @error('earning.' . $earningskey . '.name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-12 sm:col-span-5">
                        <input autocomplete="off" wire:model.delay="earning.{{ $earningskey }}.value"
                            wire:change="netsalary" wire:keyup="netsalary" type="number" class="form-control"
                            placeholder="Amount">
                        @error('earning.' . $earningskey . '.value')
                            <span class=" text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-12 sm:col-span-2 text-center">
                        <div class="flex gap-2 mt-3 item-center justify-center">
                            @if ($earningskey + 1 == sizeof($earning))
                                @include('helper.multientries.add', [
                                    'method' => 'addearning',
                                ])
                            @endif
                            @include('helper.multientries.delete', [
                                'method' => 'removeearning',
                                'id' => $earningskey,
                            ])
                        </div>
                    </div>
                @endforeach
            </div>
            @if (sizeof($earning) >= 1)
                <div class="modal-footer">
                    <a wire:click="saveearning" class="btn btn-primary text-white">Save</a>
                </div>
            @endif
        </div>
    </div>
</div>
