<div>
    <div class="grid grid-cols-12 gap-6 mt-2 w-full sm:w-11/12 mx-auto">
        <div class="col-span-12 sm:col-span-3 intro-y">
            <select wire:model="classmasterid" class="form-select w-full mt-5">
                <option value="0">Select Class </option>
                @foreach ($classmasterlist as $eachclassmasterlist)
                    <option value="{{ $eachclassmasterlist->id }}">
                        {{ $eachclassmasterlist->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-span-12 sm:col-span-3 intro-y">
            <select wire:model="sectionid" class="form-select w-full mt-5">
                <option value="0">Select Section </option>
                @foreach ($sectionlist as $eachsectionlist)
                    <option value="{{ $eachsectionlist->id }}">
                        {{ $eachsectionlist->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-span-12 sm:col-span-3 intro-y">
            <select wire:model="assignsubjectid" class="form-select w-full mt-5">
                <option value="0">Select Subject </option>
                @foreach ($assignsubject as $eachassignsubject)
                    <option value="{{ $eachassignsubject->id }}">
                        {{ $eachassignsubject->subject->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    @if (!empty($assignsubjectid))
        <div class="flex flex-row w-full justify-end mt-5 gap-6">
            <button wire:click="newlessonopenformModal()" class="btn btn-primary w-32 ">New Lesson</button>
            <button wire:click="addlessontopicopenformModal()" class="btn btn-primary w-32">Add
                Topic</button>
        </div>
    @endif
    @if ($lesson->isNotEmpty())
        <div class="grid grid-cols-12 mt-2">
            @foreach ($lesson as $eachlesson)
                <div class="intro-y col-span-12 mt-2">
                    <div class="grid grid-cols-12 mt-2">
                        <div class="intro-y col-span-1 lg:col-span-1 mt-10 px-5 py-3">
                            <svg class="w-8 h-8" fill="none"
                                stroke="{{ $eachlesson->is_completed ? '#4CD137' : '#9B9B9B' }}" viewBox="0 0 24 24"
                                xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div class="intro-y col-span-11  lg:col-span-11 lg:px-2 mt-8">
                            <div class="flex flex-row w-full py-4 px-5 justify-between items-center"
                                style="background-color:{{ $eachlesson->is_completed ? '#E7FCE4' : '#FFF2E7' }}">
                                <div class="font-semibold">
                                    {{ $eachlesson->name }}
                                </div>
                                <div class="font-semibold">
                                    {{ $eachlesson->lessontopic->count() }} Topics
                                </div>
                                <div>
                                    <div class="font-semibold grid grid-cols-2 my-1">
                                        <div class="flex flex-row">
                                            <span class="mx-1"><svg xmlns="http://www.w3.org/2000/svg"
                                                    width="18" height="18" viewBox="0 0 18 18">
                                                    <g id="Layer_2" data-name="Layer 2" transform="translate(0 -0.253)">
                                                        <g id="invisible_box" data-name="invisible box">
                                                            <rect id="Rectangle_1064" data-name="Rectangle 1064"
                                                                width="18" height="18" transform="translate(0 0.253)"
                                                                fill="none" />
                                                        </g>
                                                        <g id="icons_Q2" data-name="icons Q2"
                                                            transform="translate(2.174 0.725)">
                                                            <g id="Group_190" data-name="Group 190">
                                                                <path id="Path_8" data-name="Path 8"
                                                                    d="M14.725,16a.725.725,0,0,0,0,1.449h5.8a.725.725,0,0,0,0-1.449Z"
                                                                    transform="translate(-11.102 -10.928)"
                                                                    fill="#4cd137" />
                                                                <path id="Path_9" data-name="Path 9"
                                                                    d="M20.521,24h-5.8a.725.725,0,1,0,0,1.449h5.8a.725.725,0,1,0,0-1.449Z"
                                                                    transform="translate(-11.102 -16.03)"
                                                                    fill="#4cd137" />
                                                                <path id="Path_10" data-name="Path 10"
                                                                    d="M17.623,32h-2.9a.725.725,0,0,0,0,1.449h2.9a.725.725,0,1,0,0-1.449Z"
                                                                    transform="translate(-11.102 -21.131)"
                                                                    fill="#4cd137" />
                                                                <path id="Path_11" data-name="Path 11"
                                                                    d="M18.318,3.449H16.869V2.725A.725.725,0,0,0,16.144,2H8.9a.725.725,0,0,0-.725.725v.725H6.725A.725.725,0,0,0,6,4.174V17.216a.725.725,0,0,0,.725.725H18.318a.725.725,0,0,0,.725-.725V4.174A.725.725,0,0,0,18.318,3.449Zm-.725,13.042H7.449V4.9H9.623V3.449h5.8V4.9h2.174Z"
                                                                    transform="translate(-6 -2)" fill="#4cd137" />
                                                            </g>
                                                        </g>
                                                    </g>
                                                </svg>
                                            </span>
                                            <span style="color: #4CD137">Started Date </span>
                                        </div>
                                        <div class="ml-auto">
                                            : {{ date('M d, Y', strtotime($eachlesson->start_date)) }}
                                        </div>
                                    </div>
                                    <div class="font-semibold grid grid-cols-2 my-1">
                                        <div class="flex flex-row">
                                            <span class="mx-1"><svg xmlns="http://www.w3.org/2000/svg"
                                                    width="18" height="18" viewBox="0 0 18 18">
                                                    <g id="Layer_2" data-name="Layer 2" transform="translate(0 -0.253)">
                                                        <g id="invisible_box" data-name="invisible box">
                                                            <rect id="Rectangle_1064" data-name="Rectangle 1064"
                                                                width="18" height="18" transform="translate(0 0.253)"
                                                                fill="none" />
                                                        </g>
                                                        <g id="icons_Q2" data-name="icons Q2"
                                                            transform="translate(2.174 0.725)">
                                                            <g id="Group_190" data-name="Group 190">
                                                                <path id="Path_8" data-name="Path 8"
                                                                    d="M14.725,16a.725.725,0,0,0,0,1.449h5.8a.725.725,0,0,0,0-1.449Z"
                                                                    transform="translate(-11.102 -10.928)"
                                                                    fill="#4cd137" />
                                                                <path id="Path_9" data-name="Path 9"
                                                                    d="M20.521,24h-5.8a.725.725,0,1,0,0,1.449h5.8a.725.725,0,1,0,0-1.449Z"
                                                                    transform="translate(-11.102 -16.03)"
                                                                    fill="#4cd137" />
                                                                <path id="Path_10" data-name="Path 10"
                                                                    d="M17.623,32h-2.9a.725.725,0,0,0,0,1.449h2.9a.725.725,0,1,0,0-1.449Z"
                                                                    transform="translate(-11.102 -21.131)"
                                                                    fill="#4cd137" />
                                                                <path id="Path_11" data-name="Path 11"
                                                                    d="M18.318,3.449H16.869V2.725A.725.725,0,0,0,16.144,2H8.9a.725.725,0,0,0-.725.725v.725H6.725A.725.725,0,0,0,6,4.174V17.216a.725.725,0,0,0,.725.725H18.318a.725.725,0,0,0,.725-.725V4.174A.725.725,0,0,0,18.318,3.449Zm-.725,13.042H7.449V4.9H9.623V3.449h5.8V4.9h2.174Z"
                                                                    transform="translate(-6 -2)" fill="#4cd137" />
                                                            </g>
                                                        </g>
                                                    </g>
                                                </svg>
                                            </span>
                                            <span style="color: #4CD137">End Date</span>
                                        </div>
                                        <div class="ml-auto">
                                            : {{ date('M d, Y', strtotime($eachlesson->due_date)) }}
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="font-semibold">
                                    Mr. Ashok
                                </div> --}}
                                <div class="dropdown">
                                    <button class="dropdown-toggle " aria-expanded="false" data-tw-toggle="dropdown">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z">
                                            </path>
                                        </svg>
                                    </button>
                                    <div class="dropdown-menu w-40">
                                        <ul class="dropdown-content">
                                            <li>
                                                <button data-tw-dismiss="dropdown"
                                                    wire:click="markcompleteopenformModal({{ $eachlesson->id }})"
                                                    class="dropdown-item">Mark
                                                    Completion</button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @if ($eachlesson->is_completed)
                                <div class="w-full bg-gray-200 h-1">
                                    <div style="background-color:#4CD137; width: 100%;" class="h-1"></div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        @include('helper.datatable.pagination', [
            'pagination' => $lesson,
        ])
    @elseif($classmasterid && $sectionid && $assignsubjectid && $lesson->isEmpty())
        @include('helper.datatable.norecordfound')
    @else
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center p-10 box mt-4 bg-blue-100 leading-6">
        <div class="mx-auto flex flex-row items-center">
            <div>
                <p class="text-2xl font-bold text-gray-900 dark:text-gray-100 dark:text-white mr-5">Kindly Select</p>
                <p class="text-2xl mt-2 font-bold"> <span class="text-green-500">Class, Section</span></p>
                <p class="text-2xl mt-2 font-bold text-gray-900 dark:text-gray-100 dark:text-white mr-5">to view lessons</p>
            </div>
            <div>
                <img class="w-40 h-64" src="{{ asset('/image/emptyfilter/edfish_character1.png') }}"
                        alt="ppl">
            </div>
        </div>
    </div>
    @endif

    {{-- Mark Completion Modal --}}

    @if ($isMarkcompleteModalFormOpen)
        <div class="fixed inset-0  z-50 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <div
            class="right-0 left-0 z-50 justify-center items-center h-modal md:h-full inset-0 fixed pin overflow-auto bg-smoke-dark flex">
            <div class="bg-white rounded-lg dark:bg-gray-700 lg:w-1/3 shadow-2xl">
                <div class="flex justify-between items-center p-2 rounded-t border-b dark:border-gray-600 bg-primary">
                    <h3 class="text-lg font-semibold text-white">
                        {{ $classmaster->name }} - {{ $section->name }} - {{ $markcompletion_lesson->name }} -
                        {{ $markcompletion_lesson->subject->name }}
                    </h3>
                    <button wire:click="markcompletecloseformModal()"
                        class="text-white bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <div class="p-0 sm:p-10">
                    <form wire:submit.prevent="markcompletionstore">
                        <div class="grid grid-cols-12 gap-4">
                            <div class="intro-x col-span-12 sm:col-span-6">
                                <label class="form-label font-semibold">START DATE</label>
                                <input wire:model="markcompletion.start_date" class="form-control"
                                    placeholder="Start Date" type="date">
                                @error('markcompletion.start_date')
                                    <span class="font-semibold text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="intro-x col-span-12 sm:col-span-6">
                                <label class="form-label font-semibold">DUE DATE</label>
                                <input wire:model="markcompletion.due_date" class="form-control"
                                    placeholder="Due Date" type="date">
                                @error('markcompletion.due_date')
                                    <span class="font-semibold text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="intro-x form-check form-switch col-span-12 sm:col-span-6">
                                <input id="post-form-5" class="form-check-input" value="1" type="checkbox"
                                    wire:model="markcompletion.is_completed">
                                <label class="form-label font-semibold mx-2 my-1">IS LESSON COMPLETED</label>
                                @error('markcompletion.is_completed')
                                    <span class="font-semibold text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="intro-x col-span-12 place-self-center">
                                <button type="submit" class="btn btn-primary w-32">SAVE</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endif

    {{-- New Lesson Modal --}}

    @if ($isNewlessonModalFormOpen)
        <div class="fixed inset-0  z-50 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <div
            class="right-0 left-0 z-50 justify-center items-center h-modal md:h-full inset-0 fixed pin overflow-auto bg-smoke-dark flex">
            <div class="bg-white rounded-lg dark:bg-gray-700 lg:w-2/5 shadow-2xl">
                <div class="flex justify-between items-center p-2 rounded-t border-b dark:border-gray-600 bg-primary">
                    <h3 class="text-lg font-semibold text-white">
                        {{ $classmaster->name }} - {{ $section->name }} - New Lesson
                    </h3>
                    <button wire:click="newlessoncloseformModal()"
                        class="text-white bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <div class="p-0 sm:p-10">
                    <form wire:submit.prevent="newlessonstore">
                        <div class="grid grid-cols-12 gap-4">
                            <div class="intro-x col-span-12 sm:col-span-4">
                                <label class="form-label font-semibold">LESSON NAME</label>
                                <input wire:model="lessonform.name" class="form-control" type="text">
                                @error('lessonform.name')
                                    <span class="font-semibold text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="intro-x col-span-12 sm:col-span-4">
                                <label class="form-label font-semibold">START DATE</label>
                                <input wire:model="lessonform.start_date" class="form-control"
                                    placeholder="Start Date" type="date">
                                @error('lessonform.start_date')
                                    <span class="font-semibold text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="intro-x col-span-12 sm:col-span-4">
                                <label class="form-label font-semibold">DUE DATE</label>
                                <input wire:model="lessonform.due_date" class="form-control" placeholder="Due Date"
                                    type="date">
                                @error('lessonform.due_date')
                                    <span class="font-semibold text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="intro-x col-span-12 place-self-center">
                                <button type="submit" class="btn btn-primary w-32">Add Lesson</button>
                            </div>
                        </div>
                    </form>
                    <h2 class="font-medium text-sm mt-3">Lesson List</h2>
                    @if ($lessonlist->isNotempty())
                        @foreach ($lessonlist as $eachlessonlist)
                            <div class="grid grid-cols-12 mt-3 p-2 border">
                                <div class="col-span-10 flex justify-between">
                                    <div> {{ $eachlessonlist->name }}</div>
                                    <div class="mx-6">
                                        {{ date('d/m/Y', strtotime($eachlessonlist->start_date)) }} -
                                        {{ date('d/m/Y', strtotime($eachlessonlist->due_date)) }}</div>

                                </div>
                                <div class="col-span-2 flex gap-2">
                                    @include('helper.datatable.edit', [
                                        'modalname' => 'New Lesson',
                                        'method' => 'editlesson',
                                        'id' => $eachlessonlist->id,
                                    ])
                                    @include('helper.datatable.delete', [
                                        'modalname' => 'New Lesson',
                                        'method' => 'deleteconfirm',
                                        'id' => $eachlessonlist->uuid,
                                    ])
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-gray-500 my-3">No Record found</div>
                    @endif
                </div>
            </div>
        </div>
    @endif

    <!-- Add Lesson Topic Modal -->
    @if ($isAddlessontopicModalFormOpen)
        <div class="right-0 left-0 justify-end h-screen inset-0 fixed overflow-auto bg-smoke-dark flex animate__animated animate__fadeInLeftBig"
            style="z-index:52;">
            <div type="button" wire:click="addlessontopiccloseformModal()"
                class="absolute inset-0 bg-gray-500 opacity-75">
            </div>
            <div class="relative md:w-1/3 w-full">
                <div class="relative bg-white rounded h-screen shadow dark:bg-gray-700">
                    <div
                        class="flex justify-between items-center bg-primary p-4 rounded-t border-b dark:border-gray-600">
                        <h3 class="text-lg font-medium text-white">
                            Add Lesson Topic
                        </h3>
                        <button type="button" wire:click="addlessontopiccloseformModal()"
                            class="text-white bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                    </div>
                    @livewire('admin.lessonplanner.addlessontopiclivewire', ['user' => $user, 'lessonlist' =>
                    $lessonlist, 'assignsubject' => $assignsubjectid])
                </div>
            </div>
        </div>
    @endif
    {{-- <div id="basic-slide-over-preview" class="modal modal-slide-over" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header p-5 bg-primary text-white">
                    <h2 class="font-medium text-base mx-auto">Add Lesson Topic</h2>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="lessontopicstore">
                        <div>
                            <input wire:model="lessontopicform.name" type="text" class="form-control"
                                placeholder="Enter the Topic Name">
                            @error('lessontopicform.name')
                                <span class="font-semibold text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <select wire:model="lessontopicform.lesson_id" class="form-select mt-2">
                                <option>Select Lesson</option>
                                <option value="1">Lesson 1</option>
                                <option value="2">Lesson 2</option>
                                <option value="3">Lesson 3</option>
                                <option value="4">Lesson 4</option>
                            </select>
                            @error('lessontopicform.lesson_id')
                                <span class="font-semibold text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary mt-3 w-32">Add Topic</button>
                    </form>
                    <h2 class="font-medium text-base text-primary mt-8">Lesson 1</h2>
                    <div class="flex flex-row mt-3 p-2 border">
                        <div class="w-96">
                            Topic 1
                        </div>
                        <div class="flex gap-2">
                            @include('helper.datatable.edit', [
                                'modalname' => 'New Topic',
                                'method' => 'edit',
                                'id' => 1,
                            ])
                            @include('helper.datatable.delete', [
                                'modalname' => 'New Topic',
                                'method' => 'delete',
                                'id' => 1,
                            ])
                        </div>
                    </div>
                    <div class="flex flex-row mt-3 p-2 border">
                        <div class="w-96">
                            Topic 2
                        </div>
                        <div class="flex gap-2">
                            @include('helper.datatable.edit', [
                                'modalname' => 'New Topic',
                                'method' => 'edit',
                                'id' => 2,
                            ])
                            @include('helper.datatable.delete', [
                                'modalname' => 'New Topic',
                                'method' => 'delete',
                                'id' => 2,
                            ])
                        </div>
                    </div>
                    <div class="flex flex-row mt-3 p-2 border">
                        <div class="w-96">
                            Topic 3
                        </div>
                        <div class="flex gap-2">
                            @include('helper.datatable.edit', [
                                'modalname' => 'New Topic',
                                'method' => 'edit',
                                'id' => 3,
                            ])
                            @include('helper.datatable.delete', [
                                'modalname' => 'New Topic',
                                'method' => 'delete',
                                'id' => 3,
                            ])
                        </div>
                    </div>
                    <h2 class="font-medium text-base text-primary mt-8">Lesson 2</h2>
                    <div class="flex flex-row mt-3 p-2 border">
                        <div class="w-96">
                            Topic 1
                        </div>
                        <div class="flex gap-2">
                            @include('helper.datatable.edit', [
                                'modalname' => 'New Topic',
                                'method' => 'edit',
                                'id' => 1,
                            ])
                            @include('helper.datatable.delete', [
                                'modalname' => 'New Topic',
                                'method' => 'delete',
                                'id' => 1,
                            ])
                        </div>
                    </div>
                    <div class="flex flex-row mt-3 p-2 border">
                        <div class="w-96">
                            Topic 2
                        </div>
                        <div class="flex gap-2">
                            @include('helper.datatable.edit', [
                                'modalname' => 'New Topic',
                                'method' => 'edit',
                                'id' => 2,
                            ])
                            @include('helper.datatable.delete', [
                                'modalname' => 'New Topic',
                                'method' => 'delete',
                                'id' => 2,
                            ])
                        </div>
                    </div>
                    <div class="flex flex-row mt-3 p-2 border">
                        <div class="w-96">
                            Topic 3
                        </div>
                        <div class="flex gap-2">
                            @include('helper.datatable.edit', [
                                'modalname' => 'New Topic',
                                'method' => 'edit',
                                'id' => 3,
                            ])
                            @include('helper.datatable.delete', [
                                'modalname' => 'New Topic',
                                'method' => 'delete',
                                'id' => 3,
                            ])
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}
</div>
