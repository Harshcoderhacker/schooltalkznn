@if ($studentfellinghappyrightnav)
    <div class="right-0 left-0 justify-end h-screen inset-0 fixed overflow-auto bg-smoke-dark flex animate__animated animate__fadeInLeftBig"
        style="z-index:52;">
        <div type="button" wire:click="closestudentfeelinghappymodal" class="absolute inset-0 bg-gray-500 opacity-75">
        </div>
        <div class="relative md:w-2/5 w-full">
            <div class="relative bg-white rounded h-screen shadow dark:bg-gray-700">
                <div class="flex justify-between items-center bg-primary p-4 rounded-t border-b dark:border-gray-600">
                    <h3 class="text-lg font-medium text-white">
                        Students feeling
                        @if ($emotion_status == 1)
                            happy
                        @elseif($emotion_status == 2)
                            excited
                        @elseif($emotion_status == 3)
                            neutral
                        @elseif($emotion_status == 4)
                            scared
                        @elseif($emotion_status == 5)
                            distrubed
                        @endif
                        <span>
                            @if ($emotionselectedday == 1)
                                today
                            @elseif ($emotionselectedday == 2)
                                From {{ \Carbon\Carbon::now()->startOfWeek()->format('d-m-y') }} to
                                {{ \Carbon\Carbon::now()->endOfWeek()->format('d-m-y') }}
                            @elseif ($emotionselectedday == 3)
                                {{ \Carbon\Carbon::now()->format('F') }}
                            @elseif($emotionselectedday == 4)
                                {{ \Carbon\Carbon::now()->year }}
                            @endif
                        </span>
                    </h3>
                    <button type="button" wire:click="closestudentfeelinghappymodal"
                        class="text-white bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <div class="p-4">
                    <div class="intro-y flex bg-orange-400 rounded justify-between items-center h-18 mt-2">
                        <div>
                            <h2 class="text-lg font-medium truncate mr-5 p-5">
                                {{ $classemotionfilter == 0 ? 'Overall' : 'Class ' . $emotionselectedclass }}</h2>
                        </div>
                        <div>
                            <h2 class="text-base font-medium truncate mr-auto p-5">
                                @if ($emotion_status == 1)
                                    Smiles:
                                @elseif($emotion_status == 2)
                                    Excited:
                                @elseif($emotion_status == 3)
                                    Neutral:
                                @elseif($emotion_status == 4)
                                    Scared:
                                @elseif($emotion_status == 5)
                                    Distrubed:
                                @endif
                                {{ $emotions->where('emotionstatus', $emotion_status)->count() }}/{{ $noofstudents->count() }}
                            </h2>
                        </div>
                        <div>
                            <h2 class="text-base font-medium truncate mr-auto p-5">
                                Percentage:
                                {{ $emotions->where('emotionstatus', $emotion_status)->count() != 0 ? number_format(($emotions->where('emotionstatus', $emotion_status)->count() / $noofstudents->count()) * 100, 2) : 0 }}
                                %
                            </h2>
                        </div>
                    </div>
                    @foreach ($noofstudents as $eachstudent)
                        @if ($eachstudent->happy != null)
                            <div class="flex flex-row w-full rounded py-4 px-5 bg-gray-100 justify-between mt-4">
                                <div class="font-semibold">
                                    {{ $eachstudent->roll_no }}
                                </div>
                                <div class="font-semibold">
                                    {{ $eachstudent->name }}
                                </div>
                                <div class="font-semibold">
                                    Class {{ $eachstudent->classmaster->name }}
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endif
