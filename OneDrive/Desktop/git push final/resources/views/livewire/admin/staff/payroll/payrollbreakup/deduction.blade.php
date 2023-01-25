<div class="col-span-12 sm:col-span-6 xl:col-span-4 intro-y">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <p class="font-bold text-white text-lg mr-auto mx-auto">Deduction</p>
                <a wire:click="adddeduction" class="btn btn-success text-white">Add</a>
            </div>
            <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                @foreach ($deduction as $deductionskey => $deductionvalue)
                <div class="col-span-12 sm:col-span-5">
                    <input autocomplete="off" wire:model.delay="deduction.{{ $deductionskey }}.name" type="text"
                        class="form-control" name="name[]"  placeholder="Type">
                    @error('deduction.' . $deductionskey . '.name') <span class="text-danger">{{ $message
                        }}</span>
                    @enderror
                </div>
                <div class="col-span-12 sm:col-span-5">
                    <input autocomplete="off" wire:model.delay="deduction.{{ $deductionskey }}.value"
                        wire:change="netsalary" wire:keyup="netsalary" type="number" class="form-control"  placeholder="Amount">
                    @error('deduction.' . $deductionskey . '.value') <span class=" text-danger">{{ $message
                        }}</span>
                    @enderror
                </div>
                <div class="col-span-12 sm:col-span-2 text-center">
                    <div class="flex gap-2 mt-3 item-center justify-center">
                        @if($deductionskey + 1 == sizeof($deduction))
                        @include('helper.multientries.add',[
                        'method' => "adddeduction",
                        ])
                        @endif
                        @include('helper.multientries.delete',[
                        'method' => "removededuction",
                        'id'=> $deductionskey,
                        ])
                    </div>
                </div>
                @endforeach
            </div>
            @if(sizeof($deduction) >=1)
            <div class="modal-footer">
                <a wire:click="savededuction" class="btn btn-primary text-white">Save</a>
            </div>
            @endif
        </div>
    </div>
</div>