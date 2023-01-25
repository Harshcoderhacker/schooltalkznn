<div>
    <div class="flex justify-center items-center">
        <select class="form-select" wire:model="mapclass_uuid">
            <option value=0>Select a Class</option>
            @foreach($mapclasslist as $key => $value)
                <option value={{$key}}>
                    {{$value}}
                </option>
                @endforeach
        </select>
    </div>
</div>
