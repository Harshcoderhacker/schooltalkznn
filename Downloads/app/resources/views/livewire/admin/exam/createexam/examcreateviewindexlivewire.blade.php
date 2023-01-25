<div>
    <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:float-right">
        <div class="relative text-gray-700 dark:text-gray-300">
            <a href="{{ route('createexam') }}" class="btn btn-primary w-40 ml-2">New Examination +</a>
        </div>
    </div>
    <div class="col-span-12 mt-10">
        <div class="intro-y flex items-center h-10 mt-8">
            <h2 class="text-lg font-medium truncate mr-5">Recently Created Examination</h2>
        </div>
        <div class="grid grid-cols-12 gap-6 mt-2">
            <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                <select wire:model="classmaster_id" class="form-select w-full mt-5">
                    <option value="0">Select Class </option>
                    @foreach ($classmaster as $eachclassmaster)
                        <option value="{{ $eachclassmaster->id }}">
                            {{ $eachclassmaster->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                <select wire:model="section_id" class="form-select w-full mt-5">
                    <option value="0">Select Section </option>
                    @foreach ($section as $eachsection)
                        <option value="{{ $eachsection->id }}">
                            {{ $eachsection->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    @if ($examlist->isNotEmpty())
        <div class="flex flex-col mt-8 intro-y">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="table table-report -mt-2">
                            <thead class="bg-primary">
                                <tr class="intro-x">
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                        Examination
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                        Class
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                        Sections
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                        Subjects
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                        Start Date
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                        End Date
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                        Created By
                                    </th>
                                    <th scope="col"
                                        class="text-center text-xs font-semibold text-white uppercase tracking-wider">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($examlist as $index => $eachexam)
                                    <tr class="intro-x">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 {{ $eachexam->is_main_exam == true ? 'text-green-600' : 'text-gray-600' }}">
                                                {{ $eachexam->name }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                                {{ $eachexam->classmaster->name }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                                {{ $eachexam->classmaster->section->whereIn('id', $eachexam->section)->pluck('name')->implode(', ') }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                                @foreach ($eachexam->examsubject as $examsubjectkey => $eachexamsubject)
                                                    @if ($examsubjectkey == 0)
                                                        {{ $eachexamsubject->subject->name }}
                                                    @else
                                                        , {{ $eachexamsubject->subject->name }}
                                                    @endif
                                                @endforeach
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                                {{ $eachexam->examsubject->min('examdate')->format('d-M-Y') }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                                {{ $eachexam->examsubject->max('examdate')->format('d-M-Y') }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                                {{ $eachexam->created_by }}
                                            </span>
                                        </td>
                                        <td class="whitespace-nowrap text-center">
                                            <div class="dropdown">
                                                <button class="dropdown-toggle" aria-expanded="false"
                                                    data-tw-toggle="dropdown">
                                                    <svg class="w-10 h-10" fill="none" stroke="gray"
                                                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z">
                                                        </path>
                                                    </svg>
                                                </button>
                                                <div class="dropdown-menu w-52">
                                                    <ul class="dropdown-content">
                                                        <li class="px-3">
                                                            <div class="flex justify-center gap-2 items-center">
                                                                <a href="{{ route('editexam', ['exam' => $eachexam->id, 'show' => 1]) }}"
                                                                    class="
                                                                    dropdown-item {{ $eachexam->is_lock == true ? 'disabled' : '' }}"><span
                                                                        class="mr-4">Edit</span>
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18"
                                                                        height="18" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="feather feather-edit ml-6">
                                                                        <path
                                                                            d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7">
                                                                        </path>
                                                                        <path
                                                                            d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z">
                                                                        </path>
                                                                    </svg>
                                                                </a>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            @if ($eachexam->is_lock == true)
                                                                <div
                                                                    class="flex dropdown-item justify-center gap-2 items-center ">
                                                                @else
                                                                    <div wire:click="delete({{ $eachexam->id }})"
                                                                        class="flex dropdown-item justify-center gap-2 items-center {{ $eachexam->is_lock == true ? 'disabled' : '' }}">
                                                            @endif
                                                            Delete
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18"
                                                                height="18" viewBox="0 0 24 24" fill="none" stroke="red"
                                                                stroke-width="2" stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                class="feather feather-trash-2 ml-4">
                                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                                <path
                                                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                                </path>
                                                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                                                <line x1="14" y1="11" x2="14" y2="17"></line>
                                                            </svg>
                                                        </li>
                                                        <li>
                                                            <div data-tw-dismiss="dropdown"
                                                                class="dropdown-item justify-center"
                                                                wire:click="openexamstatusmodal({{ $eachexam->id }})">
                                                                View Exam Status
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="18"
                                                                    height="18" viewBox="0 0 24 24" fill="none"
                                                                    stroke="cyan" stroke-width="4"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="feather feather-circle ml-2">
                                                                    <circle cx="12" cy="12" r="10"></circle>
                                                                </svg>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div data-tw-dismiss="dropdown"
                                                                class="dropdown-item justify-center"
                                                                wire:click="openexamdetailsmodal({{ $eachexam->id }})">
                                                                Exam Details
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="18"
                                                                    height="18" viewBox="0 0 24 24" fill="none"
                                                                    stroke="green" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="feather feather-edit ml-2">
                                                                    <path
                                                                        d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7">
                                                                    </path>
                                                                    <path
                                                                        d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z">
                                                                    </path>
                                                                </svg>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @include('helper.datatable.pagination', ['pagination' => $examlist])
    @else
        @include('helper.datatable.norecordfound')
    @endif
    @if ($showexamdetailsmodal)
        <div class="right-0 left-0 justify-end h-screen inset-0 fixed overflow-auto bg-smoke-dark flex animate__animated animate__fadeInLeftBig"
            style="z-index:52;">
            <div type="button" wire:click="closeexamdetailsmodal" class="absolute inset-0 bg-gray-500 opacity-75"></div>
            <div class="relative md:w-2/5 w-full">
                <div class="relative bg-white rounded h-screen shadow dark:bg-gray-700">
                    <div
                        class="flex justify-between items-center bg-primary p-4 rounded-t border-b dark:border-gray-600">
                        <h3 class="text-lg font-medium text-white">
                            Exam Details
                        </h3>
                        <button type="button" wire:click="closeexamdetailsmodal"
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
                        <div class="intro-y flex bg-amber-400 rounded justify-between items-center h-18 mt-2">
                            <div>
                                <h2 class="text-lg font-medium truncate mr-5 p-5">{{ $examdetails->name }}
                                    {{ $examdetails->is_main_exam == true ? '(Main Exam)' : '' }}</h2>
                            </div>
                            <div>
                                <h2 class="text-base font-medium truncate mr-auto p-5">
                                    {{ $examdetails->classmaster->name }} -
                                    {{ $examdetails->classmaster->section->whereIn('id', $eachexam->section)->pluck('name')->implode(', ') }}
                                </h2>
                            </div>
                        </div>
                        <div class="text-cyan-500 mt-6 font-semibold">
                            Created By : {{ $examdetails->created_by }}
                        </div>
                        <div class="intro-y flex justify-between items-center h-18 mt-2">
                            <div>
                                <h2 class="font-semibold text-gray-500 truncate p-5">Exam Schedule</h2>
                            </div>
                            <div>
                                <h2 class="font-semibold text-blue-500 truncate mr-auto p-5">
                                    Total Marks - {{ $examdetails->examsubject->sum('mark') }}
                                </h2>
                            </div>
                        </div>
                        @foreach ($examdetails->examsubject as $eachexamsubject)
                            <div class="flex flex-row w-full rounded py-4 px-5 bg-green-300 justify-between mt-4">
                                <div class="font-semibold text-green-700">
                                    {{ $eachexamsubject->subject->name }}
                                </div>
                                <div class="font-semibold text-green-700">
                                    {{ $eachexamsubject->examdate->format('d-M-Y') }}
                                </div>
                                <div class="font-semibold text-green-700">
                                    {{ $eachexamsubject->start->format('g:ia') }} -
                                    {{ $eachexamsubject->end->format('g:ia') }}
                                </div>
                                <div class="font-semibold text-green-700">
                                    {{ $eachexamsubject->mark }} M
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if ($showexamstatusmodal)
        <div class="right-0 left-0 justify-end h-screen inset-0 fixed overflow-auto bg-smoke-dark flex animate__animated animate__fadeInLeftBig"
            style="z-index:52;">
            <div type="button" wire:click="closeexamstatusmodal" class="absolute inset-0 bg-gray-500 opacity-75"></div>
            <div class="relative md:w-2/5 w-full">
                <div class="relative bg-white rounded h-screen shadow dark:bg-gray-700">
                    <div
                        class="flex justify-between items-center bg-primary p-4 rounded-t border-b dark:border-gray-600">
                        <h3 class="text-lg font-medium text-white">
                            Exam Status
                        </h3>
                        <button type="button" wire:click="closeexamstatusmodal"
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
                        <div class="intro-y flex bg-amber-500 rounded justify-between items-center h-16 mt-2 mx-3">
                            <div>
                                <h2 class="text-lg font-medium truncate mr-5 p-3">{{ $examstatus->name }}</h2>
                            </div>
                            <div>
                                <h2 class="text-base font-medium truncate mr-auto p-3">
                                    {{ $examstatus->classmaster->name }} -
                                    {{ $examstatus->classmaster->section->whereIn('id', $eachexam->section)->pluck('name')->implode(', ') }}
                                </h2>
                            </div>
                        </div>
                        @foreach ($examstatus->examsubject as $key => $eachexamsubject)
                            <div class="intro-y flex justify-between items-center h-18 mt-2 mx-3">
                                <div>
                                    <h2 class="font-semibold text-gray-500 truncate p-5">Exam {{ $key + 1 }} :
                                        {{ $eachexamsubject->subject->name }}</h2>
                                </div>
                                <div>
                                    <h2 class="font-semibold text-gray-500 truncate mr-auto p-5">
                                        {{ $eachexamsubject->examdate->format('d-M-Y') }}
                                    </h2>
                                </div>
                            </div>
                            <div class="flex flex-row justify-center">
                                <div class="py-4">

                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-user-check">
                                        <path d="M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="8.5" cy="7" r="4"></circle>
                                        <polyline points="17 11 19 13 23 9"></polyline>
                                    </svg>
                                </div>
                                <div
                                    class="flex flex-row w-10/12 mx-auto rounded py-3 mx-2 px-3 {{ $eachexamsubject->attendance_status ? 'bg-green-300' : 'bg-red-300' }} justify-between">
                                    @if ($eachexamsubject->attendance_status)
                                        <div class="font-semibold text-gray-700">
                                            Attendance Marked on
                                            {{ $eachexamsubject->attendance_updated_at->format('d-M-Y') }}
                                        </div>
                                        <div
                                            class="font-semibold {{ $absentstatus->where('subject_id', $eachexamsubject->subject_id)->where('is_present', false)->count() > 0? 'text-red-600': 'text-green-600' }}">
                                            {{ $absentstatus->where('subject_id', $eachexamsubject->subject_id)->where('is_present', false)->count() > 0? $absentstatus->where('subject_id', $eachexamsubject->subject_id)->where('is_present', false)->count(): 'All Present' }}
                                        </div>
                                    @else
                                        <div class="font-semibold text-gray-700">
                                            Attendance Not Marked
                                        </div>
                                        <div class="font-semibold">
                                            @if ($eachexamsubject->examdate == $today)
                                                <a href="{{ route('markexamattendance', ['examid' => $eachexamsubject->exam_id, 'subjectid' => $eachexamsubject->subject_id]) }}"
                                                    class="text-red-600 mr-1 mb-2">Take
                                                    Attendance</a>
                                            @else
                                                <button class="text-red-600 mr-1 mb-2 tooltip disabled"
                                                    title="Attendance not Available till Exam Date"><span
                                                        class="font-semibold">Take
                                                        Attendance</span></button>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="flex flex-row justify-center">
                                <div class="py-4">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4">
                                        </path>
                                    </svg>
                                </div>
                                <div
                                    class="flex flex-row w-10/12 rounded py-3 mx-2 px-3 {{ $eachexamsubject->mark_status ? 'bg-green-300' : 'bg-red-300' }} justify-between mt-2">

                                    @if ($eachexamsubject->mark_status)
                                        <div class="font-semibold text-gray-700">
                                            Mark Entry Done on
                                            {{ $eachexamsubject->mark_updated_at->format('d-M-Y') }}
                                        </div>
                                        <div class="font-semibold text-gray-700">
                                            View Marks
                                        </div>
                                    @else
                                        <div class="font-semibold text-gray-700">
                                            Mark Entry not Done
                                        </div>
                                        <div class="font-semibold">
                                            @if ($eachexamsubject->attendance_status)
                                                <a href="{{ route('admindomarkentry', ['examid' => $eachexamsubject->exam_id, 'subjectid' => $eachexamsubject->subject_id]) }}"
                                                    class="text-red-600 mr-1 mb-2">Entry
                                                    Mark</a>
                                            @else
                                                <button class="text-red-600 mr-1 mb-2 tooltip disabled"
                                                    title="Take Attendance first"><span class="font-semibold">Entry
                                                        Mark</span></button>
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
</div>
