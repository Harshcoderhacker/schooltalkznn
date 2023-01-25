<div>
    <div class="col-span-12">
        <div class="intro-y flex items-center h-10">
            <a href="" class="ml-auto flex items-center text-theme-1 dark:text-theme-10">
                <i data-feather="refresh-ccw" class="w-4 h-4 mr-3"></i> Reload Data
            </a>
        </div>
        <div class="grid grid-cols-12 gap-6 mt-2">
            <a href="{{ route('staffcreateexamindex') }}" class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
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
            <a href="{{ route('staffexamattendance') }}" class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
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
            <a href="{{ route('staffmarkentry') }}" class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
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
            <a href="{{ route('staffonlineassessment') }}" class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
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
                                                    View Data
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
</div>
