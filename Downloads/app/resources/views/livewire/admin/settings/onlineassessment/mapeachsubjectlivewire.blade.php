<div>
    <div class="flex justify-center items-center">
        <select class="form-select" wire:model="mapsubject_uuid">
            <option value=0>Select a Subject</option>
            @foreach($mapsubjectlist as $key => $value)
                <option value={{$key}}>
                    {{$value}}
                </option>
                @endforeach
        </select>
    </div>
</div>