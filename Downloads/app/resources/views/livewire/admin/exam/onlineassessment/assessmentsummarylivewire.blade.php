<div>
    <div class="intro-y grid grid-cols-12 gap-5 mt-5">
        <div class="col-span-12 lg:col-span-4 flex lg:block flex-col-reverse">
            <div class="intro-y box mt-5 lg:mt-0">
                <div class="flex items-center p-2 text-lg justify-center bg-primary">
                    <h1 class="font-semibold text-white">Exam Details</h1>
                </div>
                <div class="p-3 border-t grid grid-cols-12 border-gray-200 dark:border-dark-5">
                    <div class="col-span-12 flex flex-row mt-5">
                        <button class="rounded-full w-10 h-10 text-center" style="background-color: #E4FCD8">
                            <svg xmlns="http://www.w3.org/2000/svg" style="color: #44BD32;" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-home w-5 h-5 mx-auto">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                <polyline points="9 22 9 12 15 12 15 22"></polyline>
                            </svg>
                        </button>
                        <span class="mt-auto mb-auto mx-3">Class and Section <br>
                            <span class="font-semibold text-base">
                                {{ $onlineassessment->classmaster->name }} - {{ $section_name }}
                            </span>
                        </span>
                    </div>
                    <div class="col-span-12 sm:col-span-6 flex flex-row mt-5">
                        <button class="rounded-full w-10 h-10" style="background-color: #E4FCD8">
                            <svg xmlns="http://www.w3.org/2000/svg" style="color: #44BD32" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-align-center w-5 h-5 mx-auto">
                                <line x1="18" y1="10" x2="6" y2="10"></line>
                                <line x1="21" y1="6" x2="3" y2="6"></line>
                                <line x1="21" y1="14" x2="3" y2="14"></line>
                                <line x1="18" y1="18" x2="6" y2="18"></line>
                            </svg>
                        </button>
                        <span class="mt-auto mb-auto mx-3">Subject <br>
                            <span class="font-semibold text-base">
                                {{ $onlineassessment->subject->name }}
                            </span>
                        </span>
                    </div>
                    <div class="col-span-12 sm:col-span-6 flex flex-row mt-5">
                        <button class="rounded-full w-10 h-10" style="background-color: #E4FCD8">
                            <svg xmlns="http://www.w3.org/2000/svg" style="color: #44BD32" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-user w-5 h-5 mx-auto">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                        </button>
                        <span class="mt-auto mb-auto mx-3">Created by<br>
                            <span class="font-semibold text-base">
                                {{ $onlineassessment->created_by }}
                            </span>
                        </span>
                    </div>
                    @if ($onlineassessment->assigntype == 2)
                    <div class="col-span-12 flex flex-row mt-5">
                        <button class="rounded-full w-10 h-10" style="background-color: #E2EEFF">
                            <svg xmlns="http://www.w3.org/2000/svg" style="color: #0663DF" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-calendar w-5 h-5 mx-auto">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                            </svg>
                        </button>
                        <span class="mt-auto mb-auto mx-3">Scheduled on<br>
                            <span class="font-semibold text-base">
                                {{ $onlineassessment->start_date->format('d-M-Y') }}
                            </span>
                        </span>
                    </div>
                    <div class="col-span-12 flex flex-row mt-5">
                        <button class="rounded-full w-10 h-10" style="background-color: #FFE8E8">
                            <svg xmlns="http://www.w3.org/2000/svg" style="color: #D22525" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-calendar w-5 h-5 mx-auto">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                            </svg>
                        </button>
                        <span class="mt-auto mb-auto mx-3">Due On <br>
                            <span class="font-semibold text-base">
                                {{ $onlineassessment->end_date->format('d-M-Y') }}
                            </span>
                        </span>
                    </div>
                    @else
                    <div class="col-span-12 flex flex-row mt-5">
                        <button class="rounded-full w-10 h-10" style="background-color: #E4FCD8">
                            <svg xmlns="http://www.w3.org/2000/svg" style="color: #44BD32" width="24" height="24"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round"
                                class="feather feather-calendar w-5 h-5 mx-auto">
                                <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="16" y1="2" x2="16" y2="6"></line>
                                <line x1="8" y1="2" x2="8" y2="6"></line>
                                <line x1="3" y1="10" x2="21" y2="10"></line>
                            </svg>
                        </button>
                        <span class="mt-auto mb-auto mx-3 font-semibold text-base">
                            Always Active
                        </span>
                    </div>
                    @endif
                </div>
                <div class="col-span-12 mt-5 w-11/12 mx-auto rounded-lg" style="background-color: #E8F1FF">
                    <div class="grid grid-cols-12 gap-5 p-3 mx-auto">
                        <div class="col-span-12 sm:col-span-6" style="color: #0663DF">Marks <br>
                            <span class="font-semibold text-base">
                                {{ $onlineassessment->total_mark }}
                            </span>
                        </div>
                        <div class="col-span-12 sm:col-span-6 text-blue-600">Completion %<br>
                            <span class="font-semibold text-base">
                                {{ round(($onlineassessment->onlineassessmentstudentlist->where('assessment_status',
                                1)->count() / $onlineassessment->onlineassessmentstudentlist->count()) * 100) }}
                                %
                            </span>
                        </div>
                    </div>
                </div>
                <div class="mb-4 border w-11/12 mx-auto rounded-lg border-gray-200 dark:border-dark-5 mt-5">
                    <div class="grid grid-cols-12 gap-5 p-3">
                        <div class="col-span-12">Exam Name<br>
                            <span class="font-semibold text-base">
                                {{ $onlineassessment->name }}
                            </span>
                        </div>
                        <div class="col-span-12">Number of Questions<br>
                            <span class="text-base">{{ sizeof($onlineassessment->onlineassessmentquestion) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-12 lg:col-span-8 lg:block">
            <div>
                <span class="flex flex-row-reverse">
                    <button class="btn btn-primary" wire:click="shownonparticipantmodel">Non-Participants List</button>
                </span>

                <div class="grid grid-cols-12 gap-1 mt-5">
                    <div class="intro-y col-span-12 overflow-auto">
                        <table class="table table-report -mt-2 table-auto">
                            <thead>
                                <tr class="intro-x">
                                    <th class="font-semibold uppercase whitespace-nowrap">
                                        <div class="flex">
                                            Name
                                    </th>
                                    <th class="font-semibold uppercase whitespace-nowrap">
                                        <div class="flex">
                                            Participation Date
                                    </th>
                                    <th class="font-semibold uppercase whitespace-nowrap">
                                        <div class="flex">
                                            Time Taken
                                        </div>
                                    </th>
                                    <th class="font-semibold uppercase whitespace-nowrap">
                                        <div class="flex">
                                            Percentage
                                    </th>
                                    <th class="font-semibold uppercase whitespace-nowrap">
                                        <div class="flex">
                                            Score
                                    </th>
                                    <th class="font-semibold uppercase whitespace-nowrap">
                                        <div class="flex">
                                            Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($onlineassessment->onlineassessmentstudentlist as $eachstudent)
                                <tr class="intro-x">
                                    <td>
                                        <span class="text-sm whitespace-nowrap">
                                            {{ $eachstudent->student->name }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-sm whitespace-nowrap">
                                            {{ $eachstudent->participated_date ?
                                            $eachstudent->participated_date->format('d-m-Y') : '-' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-sm whitespace-nowrap">
                                            {{ $eachstudent->time_taken ? $eachstudent->time_taken : '-' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-sm text-green-600 whitespace-nowrap">
                                            {{ $eachstudent->mark ? round(($eachstudent->mark /
                                            $onlineassessment->total_mark) * 100) : 0 }}
                                            %
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-sm whitespace-nowrap">
                                            {{ $eachstudent->mark ? $eachstudent->mark : 0 }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-sm text-green-600 whitespace-nowrap">
                                            <button type="button" wire:click="showanswermodel({{ $eachstudent }})" {{
                                                $eachstudent->assessment_status == 1 ? '' : 'disabled' }}>View
                                                Answer</a>
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include(
    'livewire.admin.exam.onlineassessment.onlineassessmentsummarymodels.onlineassessmentanswermodel'
    )
    @include(
    'livewire.admin.exam.onlineassessment.onlineassessmentsummarymodels.onlineassessmentnonparticipantmodel'
    )
</div>