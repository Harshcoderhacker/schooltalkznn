<div>
    <div>
        <input type="number" placeholder="Enter Mark" wire:model.debounce.500ms="mark"
            class="form-control border-0 border-b-2 w-full" {{$examstudentsubjectlist->is_present ? '':'disabled'}}>
        <div>
            @error('mark')
                <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>
