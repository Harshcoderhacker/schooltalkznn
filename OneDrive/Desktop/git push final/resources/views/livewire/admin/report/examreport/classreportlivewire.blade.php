<div>
    <div class="w-full mx-auto ">
        <div class="col-span-12 mt-5">
            <div class="intro-y flex items-center h-10">
                <h2 class="text-lg truncate mr-5">Class Report</h2>
            </div>
            <div class="grid grid-cols-12 col-span-12 gap-6 mt-2">
                <div class="col-span-12 sm:col-span-2 intro-y">
                    <select wire:model="classmasterid" class="form-select w-full mt-5">
                        <option value="0">Select Class </option>
                        @foreach ($classmaster as $eachclassmaster)
                            <option value="{{ $eachclassmaster->id }}">
                                {{ $eachclassmaster->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-span-12 sm:col-span-2 intro-y">
                    <select wire:model="sectionid" class="form-select w-full mt-5">
                        <option value="0">Select Section </option>
                        @foreach ($section as $eachsection)
                            <option value="{{ $eachsection->id }}">
                                {{ $eachsection->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-span-12 sm:col-span-3 intro-y">
                    <select wire:model="examid" class="form-select w-full mt-5">
                        <option value="0">Select Exam </option>
                        @foreach ($examlist as $eachexam)
                            <option value="{{ $eachexam->id }}">
                                {{ $eachexam->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-12 mt-8 ml-10 justify-around gap-8">
            @if ($exam->isNotEmpty())
                <div class="col-span-12 sm:col-span-10 border">
                    <div class="grid grid-cols-12 p-4">
                        <div class="col-span-12 sm:col-span-12 p-4 flex flex-row ">
                            <div class="border">
                                <img class="w-3/4 h-24 mx-auto"
                                    src="{{ url('storage/' . App::make('generalsetting')->logo) }}" alt="logo">
                            </div>
                            <div class="w-full bg-blue-100 border">
                                <h1 class="text-xl text-center">{{ App::make('generalsetting')->schoolname }}</h1>
                                <p class="text-base text-center">{{ App::make('generalsetting')->address }}</p>
                                <div class="flex flex-row justify-around">
                                    <div>
                                        {{ App::make('generalsetting')->phone }}
                                    </div>
                                    <div>
                                        {{ App::make('generalsetting')->email }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-12 p-4 flex flex-row justify-between">
                            <div>
                                <span class="font-semibold">Exam Name :
                                    {{ $exam[0]->name }}</span>
                            </div>
                            <div>
                                <span class="font-semibold">Academic Year :
                                    {{ $exam[0]->academicyear->year }}</span>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-12 p-4 flex flex-row border justify-center bg-green-100">
                            <span class="font-semibold text-base">Class {{ $exam[0]->classmaster->name }} -
                                {{ $section_name }}</span>
                        </div>
                        <div class="intro-y col-span-12 mt-4 overflow-auto lg:overflow-visible">
                            <table class="table table-report -mt-2">
                                <thead>
                                    <tr class="intro-x">
                                        <th class="font-semibold uppercase whitespace-nowrap">
                                            Subject
                                        </th>
                                        @foreach ($exam[0]->examsubject as $key => $eachexamsubject)
                                            <th class="font-semibold uppercase whitespace-nowrap">
                                                {{ $eachexamsubject->subject->name }}
                                            </th>
                                        @endforeach
                                        <th class="font-semibold uppercase whitespace-nowrap">
                                            Total
                                        </th>
                                        <th class="font-semibold uppercase whitespace-nowrap">
                                            Average
                                        </th>
                                        <th class="font-semibold uppercase whitespace-nowrap">
                                            Grade
                                        </th>
                                        <th class="font-semibold uppercase whitespace-nowrap">
                                            Rank
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($examsubjectmark as $key => $eachexamsubjectmark)
                                        <tr class="intro-x">
                                            <td>
                                                <span class="text-sm font-medium whitespace-nowrap">
                                                    {{ $eachexamsubjectmark->student->name }}
                                                </span>
                                            </td>
                                            @foreach ($eachexamsubjectmark->examstudentsubjectlist as $key => $eachsubjectmark)
                                                <td>
                                                    <span class="text-sm font-medium whitespace-nowrap">
                                                        {{ round(($eachsubjectmark->mark / $exam[0]->examsubject[$key]->mark) * 100) }}
                                                    </span>
                                                </td>
                                            @endforeach
                                            <td>
                                                <span class="text-sm font-medium whitespace-nowrap">
                                                    {{ round(($eachexamsubjectmark->examstudentsubjectlist->sum('mark') / $exam[0]->examsubject->sum('mark')) *$exam[0]->examsubject->sum('mark')) * sizeof($exam[0]->examsubject) }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="text-sm font-medium whitespace-nowrap">
                                                    {{ round(($eachexamsubjectmark->examstudentsubjectlist->sum('mark') / $exam[0]->examsubject->sum('mark')) * 100) }}
                                                </span>
                                            </td>
                                            <td>
                                                @if (sizeof($eachexamsubjectmark->examstudentsubjectlist->where('exam_id', $exam[0]->id)) ==
                                                    $eachexamsubjectmark->examstudentsubjectlist->where('exam_id', $exam[0]->id)->where('is_pass')->count())
                                                    @foreach ($grade as $eachgrade)
                                                        @if ($eachgrade->percentage_from <= ($eachexamsubjectmark->examstudentsubjectlist->where('exam_id', $exam[0]->id)->sum('mark') / $exam[0]->examsubject->sum('mark')) * 100 && $eachgrade->percentage_to > ($eachexamsubjectmark->examstudentsubjectlist->where('exam_id', $exam[0]->id)->sum('mark') / $exam[0]->examsubject->sum('mark')) * 100)
                                                            <span
                                                                class="text-sm font-medium whitespace-nowrap text-orange-500">{{ $eachgrade->name }}</span>
                                                        @elseif(($eachexamsubjectmark->examstudentsubjectlist->where('exam_id', $exam[0]->id)->sum('mark') / $exam[0]->examsubject->sum('mark')) * 100 == 100 && $eachgrade->percentage_to == 100)
                                                            <span
                                                                class="text-sm font-medium whitespace-nowrap text-orange-500">{{ $eachgrade->name }}</span>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    <span
                                                        class="text-sm font-medium whitespace-nowrap text-orange-500">F</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if (sizeof($eachexamsubjectmark->examstudentsubjectlist->where('exam_id', $exam[0]->id)) ==
                                                    $eachexamsubjectmark->examstudentsubjectlist->where('exam_id', $exam[0]->id)->where('is_pass')->count())
                                                    <span
                                                        class="text-green-600">{{ array_search($eachexamsubjectmark->student_id, array_keys($total_mark)) + 1 }}</span>
                                                @else
                                                    <span class="text-xl text-red-600">-</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div
                            class="col-span-12 sm:col-span-12 mt-5 p-4 flex flex-row border justify-around bg-gray-200">
                            <div>
                                <span class="text-green-500">Exam Attendance</span><br>
                                <span class="text-xl">{{ $examattendance }} %
                                </span>
                            </div>
                            <div>
                                <span class="text-green-500">Class Average</span><br>
                                <span class="text-xl">
                                    {{ $avg }}
                                </span>
                            </div>
                            <div>
                                <span class="text-green-500">Pass Percentage</span><br>
                                <span class="text-xl">
                                    {{ round((sizeof($total_mark) / sizeof($examsubjectmark)) * 100) }} %
                                </span>
                            </div>
                        </div>
                        <div
                            class="col-span-12 sm:col-span-12 mt-5 p-4 flex flex-row border justify-around bg-gray-200">
                            @foreach ($grade as $eachgrade)
                                <div>
                                    <span class="text-sm text-blue-600">
                                        {{ $eachgrade->percentage_from }} % - {{ $eachgrade->percentage_to }} %
                                        {{ $eachgrade->name }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-2">
                    <button class="btn btn-primary" wire:click="downloadclassreport">print</button>
                </div>
            @elseif($classmasterid && $sectionid && $examid && $exam->isEmpty())
                @include('helper.datatable.norecordfound')
                @else
                <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center p-10 box mt-4 bg-blue-100 leading-6">
                    <div class="mx-auto flex flex-row items-center">
                        <div>
                            <p class="text-2xl font-bold text-gray-900 dark:text-gray-100 dark:text-white mr-5">Kindly Select</p>
                            <p class="text-2xl mt-2 font-bold"> <span class="text-green-500">Class, Section and Exam</span></p>
                            <p class="text-2xl mt-2 font-bold text-gray-900 dark:text-gray-100 dark:text-white mr-5">to view class report</p>
                        </div>
                        <div>
                            <img class="w-40 h-64" src="{{ asset('/image/emptyfilter/edfish_character2.png') }}"
                                    alt="ppl">
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
