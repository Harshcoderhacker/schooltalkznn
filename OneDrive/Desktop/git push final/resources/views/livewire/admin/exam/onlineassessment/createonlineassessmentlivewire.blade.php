<div>
    <div class="intro-y chat grid grid-cols-12 gap-2 mt-5 mb-12">
        <div class="col-span-12 xl:col-span-4">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="intro-y box p-5 mt-12 sm:mt-5 mx-5 shadow py-4">
                    <select class="form-select w-full mt-2" wire:model="class_id">
                        <option value=null>Select Class </option>
                        @foreach ($classmaster as $eachclassmaster)
                            <option value={{ $eachclassmaster->id }}>
                                {{ $eachclassmaster->name }}
                            </option>
                        @endforeach
                    </select>
                    <select class="form-select w-full mt-4" wire:model="subject_id">
                        <option value=null>Select Subject </option>
                        @foreach ($subjectlist as $eachsubject)
                            <option value={{ $eachsubject->id }}>
                                {{ $eachsubject->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-span-12 xl:col-span-8">
            <input type="text" class="form-control w-3/4 box pr-10 mt-8 placeholder-theme-13"
                placeholder="Enter Topic Name" wire:model="searchterm">
            <div class="grid grid-cols-12 gap-6 mt-6 border-2 rounded p-4">
                @if ($template != null)
                    @foreach ($template as $eachtemplate)
                        <div wire:click="openmodelquestions('{{ $eachtemplate->uuid }}')"
                            class="intro-y col-span-12 sm:col-span-4 w-full bg-white border-2 rounded-md p-4 mt-4">
                            <img class="w-3/4 h-32 mx-auto" src="{{ $eachtemplate->image }}" alt="bargain">
                            <div class="flex flex-row justify-between gap-2">
                                <div>
                                    <h3 class="font-semibold mt-3 text-base">{{ $eachtemplate->name }}</h3>
                                    <p class="text-xs text-gray-500 font-semibold mt-2">
                                        {{ $this->getassessmentquestion($eachtemplate->uuid) }} questions
                                    </p>
                                </div>
                                <div class="flex flex-row gap-3 mt-8">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                            viewBox="0 0 24 24" fill="none" stroke="purple" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                            <circle cx="12" cy="12" r="3"></circle>
                                        </svg>
                                    </div>
                                    <div>
                                        <svg class="w-5 h-5" fill="none" stroke="red" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div>
                                        <svg class="w-5 h-5" fill="none" stroke="green" viewBox="0 0 24 24"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z">
                                            </path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    @include('helper.datatable.norecordfound')
                @endif
            </div>
            <div class="flex mt-5 justify-between">
                @if ($page != 1)
                    <button class="btn btn-primary w-24" wire:click="perv">Previous</button>
                @endif
                @if ($current_page != $total_pages)
                    <button class="btn btn-primary w-24 ml-auto" wire:click="nextpage">Next</button>
                @endif
            </div>
        </div>
    </div>
    @if ($questionmodel)
        <div class="fixed inset-0  z-50 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <div
            class="mt-10 mb-10 right-0 left-0 z-50 justify-center items-start h-modal md:h-full inset-0 fixed pin overflow-auto bg-smoke-dark flex">
            <div class="bg-white rounded-lg dark:bg-gray-700 lg:w-1/2 shadow-2xl">
                <div class="p-6 space-y-6 mb-10">
                    <div class="flex flex-row justify-between">
                        <div class="flex flex-row gap-4">
                            <img class="w-1/2 h-32 border-2" src="{{ $assessmenttemplate['image'] }}" alt="verb">
                            <div>
                                <p class="text-lg font-semibold">{{ $assessmenttemplate['name'] }}</p>
                                <p class="text-sm text-gray-500 font-semibold mt-3">
                                    {{ $this->getassessmentquestion($assessmenttemplate['uuid']) }}
                                    questions</p>
                                <p class="text-sm text-gray-500 font-semibold mt-3">5 minutes</p>
                            </div>
                        </div>
                        <div>
                            <div>
                                <button class="btn btn-outline-danger w-40 zoom-in inline-block mr-1 mb-2"
                                    wire:click="closequestions">Cancel and Go
                                    back</button>
                            </div>
                            <div>
                                <button wire:click="openconfiguremodel"
                                    class="btn btn-outline-primary w-40 zoom-in inline-block mr-1 mb-2">Configure
                                    Exam</button>
                            </div>
                        </div>
                    </div>
                    <div>
                        @foreach ($assessmentquestion as $key => $eachassessmentquestion)
                            <div class="flex flex-row gap-2 w-full mt-2">
                                <div class="text-xl mt-3">
                                    {{ $key + 1 }}
                                </div>
                                <div class="border-2 w-full">
                                    <div class="flex flex-row  w-full p-4 justify-between">
                                        <div>
                                            {{ $eachassessmentquestion->question }}
                                        </div>
                                        <div>
                                            <span class="border-2 px-4">Multiple Choice</span> <span
                                                class="border-2 px-4">30
                                                seconds</span>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-12 mx-4 mb-4">
                                        <div class="intro-y col-span-12 mt-4 flex flex-row gap-2 sm:col-span-6">
                                            <div>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 24 24" fill="" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-circle {{ $eachassessmentquestion->answer == 1 ? 'fill-green-400' : 'fill-gray-400' }}">
                                                    <circle cx="12" cy="12" r="10"></circle>
                                                </svg>
                                            </div>
                                            <div>
                                                {{ $eachassessmentquestion->option_one }}
                                            </div>
                                        </div>
                                        <div class="intro-y col-span-12 mt-4 flex flex-row gap-2 sm:col-span-6">
                                            <div>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 24 24" fill="" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-circle {{ $eachassessmentquestion->answer == 2 ? 'fill-green-400' : 'fill-gray-400' }}">
                                                    <circle cx="12" cy="12" r="10"></circle>
                                                </svg>
                                            </div>
                                            <div>
                                                {{ $eachassessmentquestion->option_two }}
                                            </div>
                                        </div>
                                        <div class="intro-y col-span-12 mt-4 flex flex-row gap-2 sm:col-span-6">
                                            <div>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 24 24" fill="" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-circle {{ $eachassessmentquestion->answer == 3 ? 'fill-green-400' : 'fill-gray-400' }}">
                                                    <circle cx="12" cy="12" r="10"></circle>
                                                </svg>
                                            </div>
                                            <div>
                                                {{ $eachassessmentquestion->option_three }}
                                            </div>
                                        </div>
                                        <div class="intro-y col-span-12 mt-4 flex flex-row gap-2 sm:col-span-6">
                                            <div>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 24 24" fill="" stroke="currentColor" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="feather feather-circle {{ $eachassessmentquestion->answer == 4 ? 'fill-green-400' : 'fill-gray-400' }}">
                                                    <circle cx="12" cy="12" r="10"></circle>
                                                </svg>
                                            </div>
                                            <div>
                                                {{ $eachassessmentquestion->option_four }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if ($configuremodal)
        @livewire('admin.exam.onlineassessment.configureonlineassessmentlivewire',['assessmenttemplate'=>$assessmenttemplate,
        'assessmentquestion'=>$assessmentquestion])
    @endif
</div>
