<div>
    <div class="col-span-12">
        <div class="intro-y flex items-center h-10">
            <a href="" class="ml-auto flex items-center text-theme-1 dark:text-theme-10">
                <i data-feather="refresh-ccw" class="w-4 h-4 mr-3"></i> Reload Data
            </a>
        </div>
        <div class="grid grid-cols-12 gap-6 mt-2">
            <a href="{{ route('admincreateexamindex') }}" class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                <div class="report-box zoom-in">
                    <div class="box p-5 rounded-lg bg-primary h-auto sm:h-28">
                        <div class="flex flex-col text-white">
                            <div class="font-normal">
                                Examination creation
                            </div>
                            <div class="text-xl font-bold">
                                Create/Edit an Exam
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <a href="{{ route('examattendance') }}" class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                <div class="report-box zoom-in">
                    <div class="box p-5 rounded-lg bg-primary h-auto sm:h-28">
                        <div class="flex flex-col text-white">
                            <div class="font-normal">
                                Examination Attendance
                            </div>
                            <div class="text-xl font-bold">
                                Record Attendance for Completed Exams
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <a href="{{ route('exammarkentry') }}" class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                <div class="report-box zoom-in">
                    <div class="box p-5 rounded-lg bg-primary h-auto sm:h-28">
                        <div class="flex flex-col text-white">
                            <div class="font-normal">
                                Mark Register
                            </div>
                            <div class="text-xl font-bold">
                                View/Entry Marks for Completed Exams
                            </div>
                        </div>
                    </div>
                </div>
            </a>
            <a href="{{ route('onlineassessment') }}" class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                <div class="report-box zoom-in">
                    <div class="box p-5 rounded-lg bg-primary h-auto sm:h-28">
                        <div class="flex flex-col text-white">
                            <div class="text-base">
                                Online Assessments
                            </div>
                            <div class="text-xl font-bold">
                                View/Create Online Assessments
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <div class="col-span-12 mt-8">
        <div class="intro-y flex items-center h-10">
            <h2 class="text-lg font-medium truncate mr-5">View Exam Schedule</h2>
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
                                        Date
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                        Start Time
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                        End Time
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
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
                                                    {{ $eachsubject->start->format('g:ia') }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                                    {{ $eachsubject->end->format('g:ia') }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span
                                                    class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300"
                                                    style="color:rgb(0, 221, 0)">
                                                    <div class="flex flex-row gap-2">
                                                        <a type="button"
                                                            wire:click="showattendancemodel({{ $eachsubject->exam_id }},{{ $eachsubject->subject_id }})">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="36"
                                                                height="39" viewBox="0 0 36 39">
                                                                <defs>
                                                                    <clipPath id="clip-path">
                                                                        <rect width="36" height="39" fill="none" />
                                                                    </clipPath>
                                                                </defs>
                                                                <g id="Group_24" data-name="Group 24"
                                                                    transform="translate(-1595 -633)">
                                                                    <g id="Repeat_Grid_28" data-name="Repeat Grid 28"
                                                                        transform="translate(1595 633)"
                                                                        clip-path="url(#clip-path)">
                                                                        <g id="Group_23" data-name="Group 23"
                                                                            transform="translate(-1595 -633)">
                                                                            <rect id="Rectangle_283"
                                                                                data-name="Rectangle 283" width="36"
                                                                                height="39" rx="5"
                                                                                transform="translate(1595 633)"
                                                                                fill="#b6cffa" />
                                                                        </g>
                                                                    </g>
                                                                    <image id="calendar_1_" data-name="calendar (1)"
                                                                        width="18" height="18"
                                                                        transform="translate(1604 644)"
                                                                        xlink:href="data:image/png;base64,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" />
                                                                </g>
                                                            </svg>
                                                        </a>
                                                        <a type="button"
                                                            wire:click="showmarkmodel({{ $eachsubject->exam_id }},{{ $eachsubject->subject_id }})">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="36"
                                                                height="39" viewBox="0 0 36 39">
                                                                <defs>
                                                                    <clipPath id="clip-path">
                                                                        <rect width="36" height="39" fill="none" />
                                                                    </clipPath>
                                                                </defs>
                                                                <g id="Group_78" data-name="Group 78"
                                                                    transform="translate(-1679 -633)">
                                                                    <g id="Repeat_Grid_30" data-name="Repeat Grid 30"
                                                                        transform="translate(1679 633)"
                                                                        clip-path="url(#clip-path)">
                                                                        <g id="Group_23" data-name="Group 23"
                                                                            transform="translate(-1595 -633)">
                                                                            <rect id="Rectangle_283"
                                                                                data-name="Rectangle 283" width="36"
                                                                                height="39" rx="5"
                                                                                transform="translate(1595 633)"
                                                                                fill="#b9ffe6" />
                                                                        </g>
                                                                    </g>
                                                                    <image id="marking" width="19" height="19"
                                                                        transform="translate(1684 643)"
                                                                        xlink:href="data:image/png;base64,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" />
                                                                </g>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                </span>
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
    @elseif($classmaster_id && $section_id && $exam->isEmpty())
    @include('helper.datatable.norecordfound')
    @else
    <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center p-10 box mt-4 bg-blue-100 leading-6">
        <div class="mx-auto flex flex-row items-center">
            <div>
                <p class="text-2xl font-bold text-gray-900 dark:text-gray-100 dark:text-white mr-5">Kindly Select</p>
                <p class="text-2xl mt-2 font-bold"> <span class="text-green-500">Class, Section and Exam</span></p>
                <p class="text-2xl mt-2 font-bold text-gray-900 dark:text-gray-100 dark:text-white mr-5">to view Exams</p>
            </div>
            <div>
                <img class="w-40 h-64" src="{{ asset('/image/emptyfilter/edfish_character1.png') }}"
                        alt="ppl">
            </div>
        </div>
    </div>
    @endif
    @if ($openattendance)
        <div class="right-0 left-0 justify-end h-screen inset-0 fixed overflow-auto bg-smoke-dark flex animate__animated animate__fadeInLeftBig"
            style="z-index:52;">
            <div type="button" wire:click="closeattendancemodal" class="absolute inset-0 bg-gray-500 opacity-75"></div>
            <div class="relative md:w-2/5 w-full">
                <div class="relative bg-white rounded h-screen shadow dark:bg-gray-700">
                    <div
                        class="flex justify-between items-center bg-primary p-4 rounded-t border-b dark:border-gray-600">
                        <h3 class="text-lg mx-auto font-medium text-white">
                            Exam Attendance
                        </h3>
                        <button type="button" wire:click="closeattendancemodal"
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
                            <div class="mx-4">
                                <h2 class="text-base truncate mr-5 p-3">Number of Students Present</h2>
                            </div>
                            <div class="mr-4">
                                <h2 class="text-base truncate mr-auto p-3">
                                    {{ $examsubject->attendance_status ? $showstudentattendance->where('is_present', true)->count() : 0 }}
                                </h2>
                            </div>
                        </div>
                        <div class="intro-y flex bg-amber-500 rounded justify-between items-center h-16 mt-2 mx-3">
                            <div class="mx-4">
                                <h2 class="text-base truncate mr-5 p-3">Number of Students Absent</h2>
                            </div>
                            <div class="mr-4">
                                <h2 class="text-base truncate mr-auto p-3">
                                    {{ $examsubject->attendance_status ? $showstudentattendance->where('is_present', false)->count() : 0 }}
                                </h2>
                            </div>
                        </div>
                        @if ($examsubject->attendance_status)
                            <div class="col-span-12 sm:col-span-4 intro-y mt-4">
                                <h1 class="text-base font-semibold">List of Absentees</h1>
                                <ol class="list-decimal font-semibold list-inside mt-3">
                                    @foreach ($showstudentattendance as $eachstudent)
                                        @if ($eachstudent->is_present == false)
                                            <li><span
                                                    class="font-semibold">{{ $eachstudent->examstudentlist->student->name }}</span>
                                                <span class="text-base font-light">(Roll No :
                                                    {{ $eachstudent->examstudentlist->student->roll_no }})</span>
                                            </li>
                                        @endif
                                    @endforeach
                                </ol>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
    @if ($openmarkmodel)
        <div class="right-0 left-0 justify-end h-screen inset-0 fixed overflow-auto bg-smoke-dark flex animate__animated animate__fadeInLeftBig"
            style="z-index:52;">
            <div type="button" wire:click="closemarkmodal" class="absolute inset-0 bg-gray-500 opacity-75"></div>
            <div class="relative md:w-2/5 w-full">
                <div class="relative bg-white rounded h-screen shadow dark:bg-gray-700">
                    <div
                        class="flex justify-between items-center bg-primary p-4 rounded-t border-b dark:border-gray-600">
                        <h3 class="text-lg mx-auto font-medium text-white">
                            Mark Information
                        </h3>
                        <button type="button" wire:click="closemarkmodal"
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
                        <div class="intro-y flex bg-amber-400 rounded justify-between items-center h-16 mt-2 mx-3">
                            <div class="mx-4">
                                <h2 class="text-base font-semibold truncate mr-5 p-3">Pass Percentage</h2>
                            </div>
                            <div class="mr-4">
                                <h2 class="text-base font-semibold truncate mr-auto p-3">
                                    {{ round(($showstudentmark->where('is_pass', true)->count() / $showstudentmark->count()) * 100) }}
                                    %
                                </h2>
                            </div>
                        </div>
                        <h1 class="text-base font-semibold mt-10">Mark Information</h1>
                        @if ($examsubjectmark->mark_status)
                            <table class="border w-11/12 mt-4 mx-2">
                                <tr class="border">
                                    <th class="p-3">
                                        Roll Number
                                    </th>
                                    <th class="p-3">
                                        Name
                                    </th>
                                    <th class="p-3">
                                        Mark
                                    </th>
                                    <th class="p-3">
                                        Status
                                    </th>
                                </tr>
                                @foreach ($showstudentmark as $eachstudent)
                                    <tr>
                                        <td class="p-3 text-center">
                                            {{ $eachstudent->examstudentlist->student->name }}
                                        </td>
                                        <td class="p-3 text-center">
                                            {{ $eachstudent->examstudentlist->student->roll_no }}
                                        </td>
                                        <td class="p-3 text-center">
                                            {{ $eachstudent->mark ? $eachstudent->mark : '-' }}
                                        </td>
                                        <td class="p-3 text-center">
                                            @if (isset($eachstudent->is_pass))
                                                {{ $eachstudent->is_pass == 0 ? 'Fail' : 'Pass' }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
