<div>
    <div class="intro-y chat grid grid-cols-12 gap-5 mt-5 mb-12">
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:float-right">
                <div class="relative text-gray-700 dark:text-gray-300">
                    <a href="{{ route('createonlineassessment') }}" class="btn btn-primary w-full ">Create Exam</a>
                </div>
            </div>
        </div>
    </div>
    <div class="flex flex-col mt-8 intro-y">
        <div class="-my-2 sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                @if ($assessment->isNotEmpty())
                    <div class="shadow border-2 border-gray-200 sm:rounded-lg">
                        <div class="intro-y chat grid mx-8 grid-cols-12 gap-5 mt-5 mb-12">
                            @foreach ($assessment as $eachassessment)
                                <div
                                    class="intro-y col-span-12 sm:col-span-6 bg-blue-100 border-2 rounded flex flex-wrap justify-between p-2 sm:flex-nowrap items-center mt-2">
                                    <div class="w-40">
                                        <img class="w-3/4 h-24 mx-auto"
                                            src="{{ url('storage/onlineassessment/' . $eachassessment->image) }}"
                                            alt="pronoun">
                                    </div>
                                    <div>
                                        <h3 class="text-lg font-medium">{{ $eachassessment->name }}</h3>
                                        <p class="text-sm text-gray-500 mt-2">{{ $eachassessment->classmaster->name }}
                                            -
                                            {{ $eachassessment->subject->name }}</p>
                                        <div class="flex flex-row gap-2 text-xs font-medium text-gray-500 mt-2">
                                            <svg class="w-3 h-3" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                            @if ($eachassessment->assigntype == 1)
                                                <span>Always Open
                                                @else
                                                    <span
                                                        class="font-semibold">{{ $eachassessment->start_date->format('d M Y') }}
                                                        - {{ $eachassessment->end_date->format('d M Y') }}
                                            @endif
                                            </span>
                                        </div>
                                    </div>
                                    <div>
                                        <a
                                            href="{{ route('assessmentsummary', ['assessmentid' => $eachassessment->id]) }}">
                                            <svg class="w-10 h-10 ml-auto" fill="none" stroke="gray" viewBox="0 0 24 24"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z">
                                                </path>
                                            </svg>
                                        </a>
                                        <div class="bg-white border rounded p-3 text-blue-700">
                                            <p class="text-xs font-semibold">completion Rate</p>
                                            <p class="text-base text-center mt-2">
                                                {{ $eachassessment->onlineassessmentstudentlist->where('assessment_status', 1)->count() }}
                                                /{{ $eachassessment->onlineassessmentstudentlist->count() }}</p>
                                        </div>
                                        @if ($eachassessment->assigntype == 1)
                                            <p class="text-xs font-semibold text-right mt-3 text-green-600">Always
                                                Active</p>
                                        @else
                                            <p class="text-xs font-semibold text-right mt-3 text-orange-500">Scheduled
                                                for {{ $eachassessment->start_date->format('d M Y') }}</p>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @include('helper.datatable.pagination', [
                        'pagination' => $assessment,
                    ])
                @else
                    @include('helper.datatable.norecordfound')
                @endif
            </div>
        </div>
    </div>
</div>
