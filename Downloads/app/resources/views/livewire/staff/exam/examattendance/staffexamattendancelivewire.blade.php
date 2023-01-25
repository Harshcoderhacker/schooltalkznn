<div>
    <div class="grid grid-cols-12 gap-6 mt-8">
        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
            <select wire:model="classmaster_id" class="form-select w-full mt-5">
                <option value="">Select Class </option>
                @foreach ($classteacher->unique('classmaster_id') as $eachclassmaster)
                    <option value="{{ $eachclassmaster->classmaster->id }}">
                        {{ $eachclassmaster->classmaster->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
            <select wire:model="section_id" class="form-select w-full mt-5">
                <option value="0">Select Section </option>
                @if ($classmaster_id)
                    @foreach ($classteacher->unique('section_id') as $eachsection)
                        <option value="{{ $eachsection->section->id }}">
                            {{ $eachsection->section->name }}
                        </option>
                    @endforeach
                @endif
            </select>
        </div>
        <div class="col-span-12 sm:col-span-6 xl:col-span-4 intro-y">
            <select wire:model="exam_id" class="form-select w-full mt-5">
                <option value="0">Select Exam </option>
                @foreach ($exam as $eachexam)
                    <option value="{{ $eachexam->id }}">
                        {{ $eachexam->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    @if (count($examlist) > 0)
        <div class="flex flex-col mt-8 intro-y">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="table table-report -mt-2">
                            <thead class="bg-primary">
                                <tr class="intro-x">
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                        Subject
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                        Date
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                        Attendance Percentage
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                        Marked By
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                        Attendance Status
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-semibold text-white uppercase tracking-wider text-center">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($examlist as $index => $eachexam)
                                    @foreach ($eachexam->examsubject as $eachsubject)
                                        <tr class="intro-x">
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                                    {{ $eachsubject->subject->name }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                                    {{ $eachsubject->examdate->format('d-M-Y') }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                                    {{ round($eachsubject->attendance_percentage) }}%
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                                    @if ($eachsubject->attendance_usertype)
                                                        @if ($eachsubject->attendance_usertype == 'ADMIN')
                                                            {{ App\Models\Admin\Auth\User::find($eachsubject->attendance_marked_id)->name }}
                                                        @else
                                                            {{ App\Models\Staff\Auth\Staff::find($eachsubject->attendance_marked_id)->name }}
                                                        @endif
                                                    @else
                                                        Not Taken Yet
                                                    @endif
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="inline-flex text-xs leading-5 font-semibold rounded-full {{ $eachsubject->attendance_status ? 'text-green-600' : 'text-red-600' }}">
                                                    {{ $eachsubject->attendance_status ? 'Marked' : 'Unmarked' }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                                <button
                                                    wire:click="showattendancemodel({{ $eachsubject->exam_id }},{{ $eachsubject->subject_id }})"
                                                    class="btn btn-outline-warning zoom-in inline-block mr-1 mb-2">View
                                                    Attendance</button>
                                                @if ($eachsubject->attendance_status)
                                                    <a href="{{ route('staffmarkexamattendance', ['examid' => $eachsubject->exam_id, 'subjectid' => $eachsubject->subject_id, 'classmasterid' => $classmaster_id, 'sectionid' => $section_id]) }}"
                                                        type="button"
                                                        class="btn btn-outline-danger zoom-in inline-block mr-1 mb-2">Retake
                                                        Attendance</a>
                                                @else
                                                    @if ($eachsubject->examdate == $today)
                                                        <a href="{{ route('staffmarkexamattendance', ['examid' => $eachsubject->exam_id, 'subjectid' => $eachsubject->subject_id, 'classmasterid' => $classmaster_id, 'sectionid' => $section_id]) }}"
                                                            type="button"
                                                            class="btn btn-outline-success zoom-in inline-block mr-1 mb-2">Take
                                                            Attendance</a>
                                                    @else
                                                        <button class="text-red-600 mr-1 mb-2 tooltip disabled"
                                                            title="Attendance not Available till Exam Date"><span
                                                                class="font-semibold">Take
                                                                Attendance</span></button>
                                                    @endif
                                                @endif

                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @elseif($classmaster_id && $section_id && $exam_id)
        @include('helper.datatable.norecordfound')
    @else
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center p-10 box mt-4 bg-blue-100 leading-6">
            <div class="mx-auto flex flex-row items-center">
                <div>
                    <p class="text-2xl font-bold text-gray-900 dark:text-gray-100 dark:text-white mr-5">Kindly Select</p>
                    <p class="text-2xl mt-2 font-bold"> <span class="text-green-500">Class, Section and Exam</span></p>
                    <p class="text-2xl mt-2 font-bold text-gray-900 dark:text-gray-100 dark:text-white mr-5">to view Exams Attendance</p>
                </div>
                <div>
                    <img class="w-40 h-64" src="{{ asset('/image/emptyfilter/edfish_character2.png') }}"
                            alt="ppl">
                </div>
            </div>
        </div>
    @endif
    {{-- Attendance Details --}}
    @if ($openattendance)
        <div class="fixed inset-0  z-50 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <div
            class="mt-10 right-0 left-0 z-50 justify-center items-start h-modal md:h-full inset-0 fixed pin overflow-auto bg-smoke-dark flex">
            <div class="bg-white rounded-lg dark:bg-gray-700 lg:w-4/5 shadow-2xl">
                <div class="flex justify-between items-center p-2 rounded-t border-b dark:border-gray-600 bg-primary">
                    <h3 class="text-lg font-semibold text-white">
                        Attendance Details
                    </h3>
                    <button wire:click="closeattendancemodal"
                        class="text-white bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="defaultModal">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <div class="p-6 space-y-6">
                    @if ($showstudentattendance->count() == $showstudentattendance->where('is_present', true)->count())
                        <div class="intro-y">
                            <div class="report-box zoom-in w-1/2 mx-auto">
                                <div class="box p-5 rounded-lg" style="background-color: #2ECC71">
                                    <div class="text-white font-bold">
                                        <div class="text-base">
                                            All Present
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="text-center">
                            <p class="text-theme-1 font-medium text-lg">Attendance of
                                <span
                                    class="font-semibold underline decoration-sky-500">{{ $exam_info->name }}</span>
                                Examination
                                -
                                {{ $examsubject->examdate->format('F, d Y') }}
                            </p>
                        </div>
                        <div class="grid grid-cols-12 gap-6 mt-5">
                            <div class="col-span-12 sm:col-span-4 intro-y">
                                <div class="report-box zoom-in">
                                    <div class="box p-5 rounded-lg bg-primary">
                                        <div class="flex flex-col text-white font-bold">
                                            <div class="text-base">
                                                Number of Students
                                            </div>
                                            <div class="ml-auto text-2xl">
                                                {{ $showstudentattendance->count() }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-12 sm:col-span-4 intro-y">
                                <div class="report-box zoom-in">
                                    <div class="box p-5 rounded-lg" style="background-color: #F39C12">
                                        <div class="flex flex-col text-white font-bold">
                                            <div class="text-base">
                                                Present
                                            </div>
                                            <div class="ml-auto text-2xl">
                                                {{ $examsubject->attendance_status ? $showstudentattendance->where('is_present', true)->count() : 0 }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-span-12 sm:col-span-4 intro-y">
                                <div class="report-box zoom-in">
                                    <div class="box p-5 rounded-lg" style="background-color: #8E44AD">
                                        <div class="flex flex-col text-white font-bold">
                                            <div class="text-base">
                                                Leave
                                            </div>
                                            <div class="ml-auto text-2xl">
                                                {{ $examsubject->attendance_status ? $showstudentattendance->where('is_present', false)->count() : 0 }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if ($examsubject->attendance_status)
                                <div class="col-span-12 sm:col-span-4 intro-y">
                                    <h1 class="text-2xl font-semibold">List of Absentees</h1>
                                    <ol class="list-decimal list-inside mt-3">
                                        @foreach ($showstudentattendance as $eachstudent)
                                            @if ($eachstudent->is_present == false)
                                                <li>{{ $eachstudent->examstudentlist->student->name }}</li>
                                            @endif
                                        @endforeach
                                    </ol>
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
                {{-- @if (!$showstudentattendance->studentattendancelist->count() == $showstudentattendance->presentstudent->count())
                    <div
                        class="flex justify-center items-center p-3 gap-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                        <button wire:click="sendnotification" class="btn btn-primary">Send Notification</button>
                    </div>
                @endif --}}
            </div>
        </div>
    @endif
</div>
