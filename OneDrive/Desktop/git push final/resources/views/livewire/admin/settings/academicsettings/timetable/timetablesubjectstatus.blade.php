<div>
    <span class="inline-flex text-xs leading-5 font-semibold rounded-full text-theme-9">
        @if (is_null($eachtimetable->$day))
            <select wire:click.prevent="changeEvent($event.target.value)" class="form-select w-full">
                <option value=''>Select Subject </option>
                @foreach ($assignsubject as $eachassignsubject)
                    <option value="{{ $eachassignsubject->id }}">
                        {{ $eachassignsubject->subject?->name }}
                    </option>
                @endforeach
            </select>
        @elseif($eachtimetable->$day == 0)
            HOLIDAY
        @else
            {{ App\Models\Admin\Settings\Academicsetting\Assignsubject::find($eachtimetable->$day)->subject->name }}
        @endif
    </span>
</div>
