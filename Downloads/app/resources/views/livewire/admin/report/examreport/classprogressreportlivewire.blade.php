<div>
    <div class="w-full mx-auto ">
        <div class="col-span-12 mt-5">
            <div class="intro-y flex items-center h-10">
                <h2 class="text-lg truncate mr-5">Class Progress Report</h2>
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
                {{-- <div class="col-span-12 sm:col-span-3 intro-y">
                    <select wire:model="examid" class="form-select w-full mt-5">
                        <option value="0">Select Exam </option>
                        @foreach ($examlist as $eachexam)
                            <option value="{{ $eachexam->id }}">
                                {{ $eachexam->name }}
                            </option>
                        @endforeach
                    </select>
                </div> --}}
            </div>
        </div>
        <div class="grid grid-cols-12 mt-8 ml-10 justify-around gap-8">
            @if ($sectionid && $exam->isNotEmpty())
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
                        <div class="col-span-12 sm:col-span-12 mt-5 lg:overflow-visible">
                            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="py-2 align-middle inline-block min-w-full">
                                    <div class="overflow-hidden">
                                        <table class="table table-report -mt-2">
                                            <thead>
                                                <tr class="intro-x">
                                                    <th class="font-semibold uppercase whitespace-nowrap">

                                                    </th>
                                                    @foreach ($exam->unique('subject_id') as $eachexam)
                                                        @foreach ($eachexam->examsubject as $eachsubject)
                                                            <th colspan={{ sizeof($exam) }}
                                                                class="font-semibold uppercase text-center whitespace-nowrap">
                                                                {{ $eachsubject->subject->name }}
                                                            </th>
                                                        @endforeach
                                                    @endforeach
                                                    <th colspan="3">

                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="intro-x">
                                                    <td>
                                                        Student Name
                                                    </td>
                                                    @php
                                                        $count = 0;
                                                        $marklist = [];
                                                        $total_mark = [];
                                                        foreach ($exam->unique('subject_id') as $eachexam) {
                                                            foreach ($eachexam->examsubject as $eachsubject) {
                                                                $count += 1;
                                                            }
                                                        }
                                                        foreach ($examsubjectmark->unique('student_id') as $key => $eachstudent) {
                                                            $mark1 = 0;
                                                            for ($i = 0; $i < $count; $i++) {
                                                                foreach ($exam as $eachexam) {
                                                                    $mark1 += $eachexam->findmark($eachstudent->student->id, $eachstudent->examstudentsubjectlist[$i]);
                                                                }
                                                            }
                                                            if (sizeof($eachstudent->examstudentsubjectlist) == $eachstudent->examstudentsubjectlist->where('is_pass', true)->count()) {
                                                                for ($i = 0; $i < $count; $i++) {
                                                                    $mark = 0;
                                                                    foreach ($exam as $eachexam) {
                                                                        $mark += $eachexam->findmark($eachstudent->student->id, $eachstudent->examstudentsubjectlist[$i]);
                                                                    }
                                                                }
                                                                $total_mark[$eachstudent->student_id] = round($mark / ($count * sizeof($exam)));
                                                            }
                                                            $marklist[$key] = $mark1;
                                                        }
                                                        $totalstudentmark = round(array_sum($marklist) / ($count * sizeof($exam)));
                                                        arsort($total_mark);
                                                    @endphp
                                                    @for ($i = 0; $i < $count; $i++)
                                                        @foreach ($exam as $eachexam)
                                                            <td>
                                                                {{ $eachexam->name }}
                                                            </td>
                                                        @endforeach
                                                    @endfor
                                                    <td>
                                                        Overall %
                                                    </td>
                                                    <td>
                                                        Grade
                                                    </td>
                                                    <td>
                                                        Rank
                                                    </td>
                                                </tr>

                                                @foreach ($examsubjectmark->unique('student_id') as $eachexammark)
                                                    @php
                                                        $marks = 0;
                                                        $examattendance = 0;
                                                        foreach ($exam as $eachexam) {
                                                            $examattendance += $eachexam->examsubject->avg('attendance_percentage');
                                                        }
                                                    @endphp
                                                    <tr>
                                                        <td>
                                                            {{ $eachexammark->student->name }}
                                                        </td>
                                                        @for ($i = 0; $i < $count; $i++)
                                                            @foreach ($exam as $eachexam)
                                                                @php
                                                                    $marks += $eachexam->findmark($eachexammark->student->id, $eachexammark->examstudentsubjectlist[$i]);
                                                                @endphp
                                                                <td>
                                                                    {{ $eachexam->findmark($eachexammark->student->id, $eachexammark->examstudentsubjectlist[$i]) }}
                                                                </td>
                                                            @endforeach
                                                        @endfor
                                                        <td>
                                                            {{ round($marks / ($count * sizeof($exam))) }}
                                                        </td>
                                                        <td>
                                                            @if ($eachexammark->examstudentsubjectlist->count() == $eachexammark->examstudentsubjectlist->where('is_pass')->count())
                                                                @foreach ($grade as $eachgrade)
                                                                    @if ($eachgrade->percentage_from <= round($marks / ($count * sizeof($exam))) && $eachgrade->percentage_to > round($marks / ($count * sizeof($exam))))
                                                                        {{ $eachgrade->name }}
                                                                    @elseif(round($marks / ($count * sizeof($exam))) == 100 && $eachgrade->percentage_to == 100)
                                                                        {{ $eachgrade->name }}
                                                                    @endif
                                                                @endforeach
                                                            @else
                                                                F
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if ($eachexammark->examstudentsubjectlist->count() == $eachexammark->examstudentsubjectlist->where('is_pass')->count())
                                                                <span
                                                                    class="text-green-600">{{ array_search($eachexammark->student_id, array_keys($total_mark)) + 1 }}</span>
                                                            @else
                                                                <span class="text-xl text-red-600">-</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div
                            class="col-span-12 sm:col-span-12 mt-5 p-4 flex flex-row border justify-around bg-gray-200">
                            <div>
                                <span class="text-green-500">Exam Attendance</span><br>
                                <span class="text-xl">{{ round($examattendance / ($count * sizeof($exam))) }}
                                    %
                                </span>
                            </div>
                            <div>
                                <span class="text-green-500">Class Average</span><br>
                                <span
                                    class="text-xl">{{ round($totalstudentmark / sizeof($marklist)) }}</span>
                                </span>
                            </div>
                            <div>
                                <span class="text-green-500">Pass Percentage</span><br>
                                <span
                                    class="text-xl">{{ round((sizeof($total_mark) / sizeof($marklist)) * 100) }}
                                    %
                                </span>
                            </div>
                        </div>
                        <div
                            class="col-span-12 sm:col-span-12 mt-5 p-4 flex flex-row border justify-around bg-gray-200">
                            @foreach ($grade as $eachgrade)
                                <div>
                                    <span class="text-sm text-blue-600">
                                        {{ $eachgrade->percentage_from }} % -
                                        {{ $eachgrade->percentage_to }} %
                                        {{ $eachgrade->name }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-2">
                    <button class="btn btn-primary" wire:click="downloadclassprogressreport">print</button>
                </div>
            @elseif($sectionid && $exam->isEmpty())
                @include('helper.datatable.norecordfound')
            @else
            <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center p-10 box mt-4 bg-blue-100 leading-6">
                <div class="mx-auto flex flex-row items-center">
                    <div>
                        <p class="text-2xl font-bold text-gray-900 dark:text-gray-100 dark:text-white mr-5">Kindly Select</p>
                        <p class="text-2xl mt-2 font-bold"> <span class="text-green-500">Class and Section</span></p>
                        <p class="text-2xl mt-2 font-bold text-gray-900 dark:text-gray-100 dark:text-white mr-5">to view class progress report</p>
                    </div>
                    <div>
                        <img class="w-40 h-64" src="{{ asset('/image/emptyfilter/edfish_character1.png') }}"
                                alt="ppl">
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
