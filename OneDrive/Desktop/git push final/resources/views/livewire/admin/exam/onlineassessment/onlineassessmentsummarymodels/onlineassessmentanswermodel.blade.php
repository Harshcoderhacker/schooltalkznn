@if ($openanswermodel)
    <div class="right-0 left-0 justify-end h-screen inset-0 fixed overflow-auto bg-smoke-dark flex animate__animated animate__fadeInLeftBig"
        style="z-index:52;">
        <div type="button" wire:click="closeanswermodel" class="absolute inset-0 bg-gray-500 opacity-75"></div>
        <div class="relative md:w-1/3 w-full">
            <div class="relative bg-white rounded h-screen shadow dark:bg-gray-700">
                <div class="flex justify-between items-center bg-primary p-4 rounded-t border-b dark:border-gray-600">
                    <h3 class="text-lg font-medium text-white">
                        {{ $studentanswer->student->name }} Assessment
                    </h3>
                    <button type="button" wire:click="closeanswermodel"
                        class="text-white bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <div class="p-4">
                    <div class="flex flex-row gap-6 justify-center">
                        <div class="bg-amber-200 p-5 flex flex-row gap-3 w-44 justify-start">
                            <div>
                                <button class="rounded-full w-10 h-10 bg-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" style="color: #D22525" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-calendar w-5 h-5 mx-auto">
                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                        <line x1="16" y1="2" x2="16" y2="6"></line>
                                        <line x1="8" y1="2" x2="8" y2="6"></line>
                                        <line x1="3" y1="10" x2="21" y2="10"></line>
                                    </svg>
                                </button>
                            </div>
                            <div>
                                <span class="text-xs text-gray-600">Score</span> <br> <span
                                    class="text-sm font-semibold">{{ $studentanswer->mark }}/{{ $onlineassessment->total_mark }}</span>
                            </div>
                        </div>
                        <div class="bg-green-200 p-5 flex flex-row gap-3 w-44 justify-start">
                            <div>
                                <button class="rounded-full w-10 h-10 bg-white">
                                    <svg xmlns="http://www.w3.org/2000/svg" style="color: #D22525" width="24"
                                        height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                        class="feather feather-calendar w-5 h-5 mx-auto">
                                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                        <line x1="16" y1="2" x2="16" y2="6"></line>
                                        <line x1="8" y1="2" x2="8" y2="6"></line>
                                        <line x1="3" y1="10" x2="21" y2="10"></line>
                                    </svg>
                                </button>
                            </div>
                            <div>
                                <span class="text-xs text-gray-600">Time Taken</span> <br> <span
                                    class="text-sm font-semibold">{{ $studentanswer->time_taken }}</span>
                                Minutes</span>
                            </div>
                        </div>
                    </div>
                    <div class="font-semibold text-sm mt-6">
                        {{ $studentanswer->student->name }}'s Answer
                    </div>
                    @foreach ($onlineassessment->onlineassessmentquestion as $key => $eachquestion)
                        <div>
                            <p class="mt-2">{{ $key + 1 }}) {{ $eachquestion->question }}</p>
                            <div class="flex flex-row gap-6 mt-2">
                                @if ($eachquestion->answer == $studentanswer->onlineassessmentstudentanswer->where('onlineassessmentquestion_id', $eachquestion->id)->first()->answer)
                                    <div class="tex-sm font-semibold text-green-600">
                                        {{ $studentanswer->student->name }}'s Answer :
                                        @if ($eachquestion->answer == 1)
                                            <span>a)
                                                {{ $eachquestion->option_one }}
                                            </span>
                                        @elseif($eachquestion->answer == 2)
                                            <span>b)
                                                {{ $eachquestion->option_two }}
                                            </span>
                                        @elseif($eachquestion->answer == 2)
                                            <span>c)
                                                {{ $eachquestion->option_three }}
                                            </span>
                                        @else
                                            <span>d)
                                                {{ $eachquestion->option_four }}
                                            </span>
                                        @endif
                                    </div>
                                @else
                                    <div class="tex-sm font-semibold text-red-600">
                                        {{ $studentanswer->student->name }}'s Answer :
                                        @if ($studentanswer->onlineassessmentstudentanswer->where('onlineassessmentquestion_id', $eachquestion->id)->first()->answer == 1)
                                            <span>a)
                                                {{ $eachquestion->option_one }}
                                            </span>
                                        @elseif($studentanswer->onlineassessmentstudentanswer->where('onlineassessmentquestion_id', $eachquestion->id)->first()->answer == 2)
                                            <span>b)
                                                {{ $eachquestion->option_two }}
                                            </span>
                                        @elseif($studentanswer->onlineassessmentstudentanswer->where('onlineassessmentquestion_id', $eachquestion->id)->first()->answer == 2)
                                            <span>c)
                                                {{ $eachquestion->option_three }}
                                            </span>
                                        @else
                                            <span>d)
                                                {{ $eachquestion->option_four }}
                                            </span>
                                        @endif
                                    </div>
                                    <div class="tex-sm font-semibold text-green-600">
                                        Correct Answer : @if ($eachquestion->answer == 1)
                                            <span>a)
                                                {{ $eachquestion->option_one }}
                                            </span>
                                        @elseif($eachquestion->answer == 2)
                                            <span>b)
                                                {{ $eachquestion->option_two }}
                                            </span>
                                        @elseif($eachquestion->answer == 3)
                                            <span>c)
                                                {{ $eachquestion->option_three }}
                                            </span>
                                        @else
                                            <span>d)
                                                {{ $eachquestion->option_four }}
                                            </span>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endif
