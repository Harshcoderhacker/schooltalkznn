@if (is_null($eachtimetable->$daystring))
    <button
        wire:click="timetableopenmodal('{{ $daystring }}',{{ $eachtimetable->classroutine->id }},{{ $eachtimetable->id }})">
        @include('helper.datatable.addsymbol')
    </button>
@elseif($eachtimetable->$daystring == 0)
    HOLIDAY
@else
    @php
        $assignsubject = App\Models\Admin\Settings\Academicsetting\Assignsubject::find($eachtimetable->$daystring);
    @endphp
    <div class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
        {{ $assignsubject->subject?->name }}
    </div><br>
    <span class="inline-flex text-xs leading-5 font-semibold rounded-full text-theme-1">
        <span class="{{ $assignsubject->staff ? 'text-green-600' : 'text-red-600' }}">
            {{ $assignsubject->staff ? $assignsubject->staff?->name : 'Not Assigned' }}
        </span>
    </span>

    <div class="flex felx-row justify-center mt-1 gap-2">

        {{-- For edit --}}
        <a wire:click="edit('{{ $eachtimetable->id }}','{{ $eachtimetable->$daystring }}', '{{ $daystring }}')"
            class="flex items-center" href="#">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                class="feather feather-edit">
                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7">
                </path>
                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z">
                </path>
            </svg>
        </a>


        {{-- For delete --}}
        <a wire:click="deleteconfirm('{{ $eachtimetable->classroutine->uuid }}','{{ $daystring }}')"
            class="flex items-center text-theme-6" href="javascript:;">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="red"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2">
                <polyline points="3 6 5 6 21 6"></polyline>
                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                </path>
                <line x1="10" y1="11" x2="10" y2="17"></line>
                <line x1="14" y1="11" x2="14" y2="17"></line>
            </svg>
        </a>
        <div class="text-center">
            <a href="javascript:;" data-tw-toggle="modal"
                data-tw-target="#delete-modal-preview-{{ $eachtimetable->classroutine->uuid }}-{{ $daystring }}"
                id="{{ $eachtimetable->classroutine->uuid }}-{{ $daystring }}id"
                class="btn btn-primary hidden"></a>
        </div>
        {{-- For confirm and delete --}}
        <div id="delete-modal-preview-{{ $eachtimetable->classroutine->uuid }}-{{ $daystring }}"
            class="modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="p-5 text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24"
                                fill="none" stroke="red" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-x-circle mx-auto mt-3">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="15" y1="9" x2="9" y2="15"></line>
                                <line x1="9" y1="9" x2="15" y2="15"></line>
                            </svg>
                            <div class="text-3xl mt-5">Are you sure?</div>
                            <div class="text-gray-600 dark:text-white mt-2">Do you really
                                want to
                                delete this record? <br>This process
                                cannot
                                be undone.</div>
                        </div>
                        <div class="px-5 pb-8 text-center">
                            <button type="button" data-tw-dismiss="modal"
                                class="btn btn-outline-secondary w-24 dark:border-dark-5 dark:text-gray-300 mr-1">Cancel</button>
                            <button type="button" class="btn btn-danger w-24" data-tw-dismiss="modal"
                                wire:click="delete('{{ $eachtimetable->classroutine->uuid }}', '{{ $daystring }}')">Delete</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
