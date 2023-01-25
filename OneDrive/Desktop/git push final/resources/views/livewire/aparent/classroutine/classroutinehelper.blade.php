@if (is_null($eachtimetable->$daystring))
    -
@elseif ($eachtimetable->$daystring == 0)
    HOLIDAY
@else
    @php
        $assignsubject = App\Models\Admin\Settings\Academicsetting\Assignsubject::find($eachtimetable->$daystring);
    @endphp
    <div class="inline-flex text-sm leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
        {{ $assignsubject->subject?->name }}
    </div><br>
    <span class="inline-flex text-sm leading-5 font-semibold rounded-full text-theme-1">
        <span class="{{ $assignsubject->staff ? 'text-green-600' : 'text-red-600' }}">
            {{ $assignsubject->staff ? $assignsubject->staff?->name : 'Not Assigned' }}
        </span>
    </span>
@endif
