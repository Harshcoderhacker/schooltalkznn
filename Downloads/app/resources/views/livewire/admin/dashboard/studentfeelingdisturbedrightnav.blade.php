@if ($studentfellingdisturbedrightnav)
    <div class="right-0 left-0 justify-end h-screen inset-0 fixed overflow-auto bg-smoke-dark flex animate__animated animate__fadeInLeftBig"
        style="z-index:52;">
        <div type="button" wire:click="closestudentfeelingdisturbedmodal" class="absolute inset-0 bg-gray-500 opacity-75">
        </div>
        <div class="relative md:w-2/5 w-full">
            <div class="relative bg-white rounded h-screen shadow dark:bg-gray-700">
                <div class="flex justify-between items-center bg-primary p-4 rounded-t border-b dark:border-gray-600">
                    <h3 class="text-lg font-medium text-white">
                        Students feeling disturbed <span>
                            @if ($select_day == 1)
                                today
                            @elseif ($select_day == 2)
                                From {{ \Carbon\Carbon::now()->startOfWeek()->format('d-m-y') }} to
                                {{ \Carbon\Carbon::now()->endOfWeek()->format('d-m-y') }}
                            @elseif ($select_day == 3)
                                {{ \Carbon\Carbon::now()->format('F') }}
                            @elseif($select_day == 4)
                                {{ \Carbon\Carbon::now()->year }}
                            @endif
                        </span>
                    </h3>
                    <button type="button" wire:click="closestudentfeelingdisturbedmodal"
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
                            <h2 class="text-lg font-medium truncate mr-5 p-5">Class:
                                {{ $selected_classmaster_name }}</h2>
                        </div>
                        <div>
                            @php
                                $count = 0;
                                foreach ($selectedclassstudents as $key => $value) {
                                    if ($value->distrubed || $value->scared) {
                                        $count += 1;
                                    }
                                }
                            @endphp
                            <h2 class="text-base font-medium truncate mr-auto p-5">
                                Students :
                                {{ $count }}/{{ $totalstudent }}
                            </h2>
                        </div>
                        <div>
                            <h2 class="text-base font-medium truncate mr-auto p-5">
                                Percentage: {{ ($count / $totalstudent) * 100 }} %
                            </h2>
                        </div>
                    </div>
                    @foreach ($selectedclassstudents as $key => $value)
                        @if ($value->distrubed || $value->scared)
                            <div
                                class="flex flex-row w-full rounded py-4 px-5 bg-white dark:bg-darkmode-600 justify-between mt-4">
                                <div class="font-semibold">
                                    {{ $value->roll_no }}
                                </div>
                                <div class="font-semibold">
                                    {{ $value->name }}
                                </div>
                                <div class="font-semibold">
                                    Class {{ $selected_classmaster_name }}
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endif
