<div>
    <div class="w-full mx-auto ">
        <div class="col-span-12 mt-5">
            <div class="intro-y flex items-center h-10">
                <h2 class="text-lg truncate mr-5">Student Progress Report</h2>
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
                <div class="col-span-12 sm:col-span-4 intro-y">
                    <select wire:model="studentid" class="form-select w-full mt-5">
                        <option value="0">Select Student </option>
                        @foreach ($studentlist as $eachstudent)
                            <option value="{{ $eachstudent->id }}">
                                {{ $eachstudent->name }} (Roll No : {{ $eachstudent->roll_no }})
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-12 mt-8 ml-10 justify-around gap-8">
            @if ($exam->isNotEmpty() && $studentid)
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
                        <div class="col-span-12 sm:col-span-12 p-4 flex flex-row border justify-between bg-green-100">
                            <div>
                                Name : {{ $student->name }}
                            </div>
                            <div>
                                Class {{ $exam[0]->classmaster->name }} - {{ $section_name }}
                            </div>
                            <div>
                                Roll Number : {{ $student->roll_no }}
                            </div>
                        </div>
                        <div class="intro-y col-span-12 mt-8 overflow-auto lg:overflow-visible">
                            <table class="table -mt-2">
                                <th>
                                    Subject
                                </th>
                                <th>
                                    Exam Name
                                </th>
                                <th>
                                    Marks Obtained
                                </th>
                                <th>
                                    Subject Grade
                                </th>
                                <th>
                                    Remarks
                                </th>
                                @foreach ($exam->unique('subject_id') as $eachexam)
                                    @foreach ($eachexam->examsubject as $eachsubject)
                                        <tr>
                                            <td>
                                                {{ $eachsubject->subject->name }}
                                            </td>
                                            <td>
                                                <table>
                                                    @foreach ($exam as $eachexam)
                                                        <tr>
                                                            <td>{{ $eachexam->name }}</td>
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table>
                                                    @foreach ($exam as $eachexam)
                                                        <tr>
                                                            <td>
                                                                {{ $eachexam->overallmark($studentid, $eachsubject->subject_id) }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table>
                                                    @foreach ($exam as $eachexam)
                                                        <tr>
                                                            <td>
                                                                @foreach ($grade as $eachgrade)
                                                                    @if ($eachgrade->percentage_from <= $eachexam->overallmark($studentid, $eachsubject->subject_id) && $eachgrade->percentage_to > $eachexam->overallmark($studentid, $eachsubject->subject_id))
                                                                        {{ $eachgrade->name }}
                                                                    @elseif($eachexam->overallmark($studentid, $eachsubject->subject_id) == 100 && $eachgrade->percentage_to == 100)
                                                                        {{ $eachgrade->name }}
                                                                    @elseif($eachexam->overallmark($studentid, $eachsubject->subject_id) == '-')
                                                                        -
                                                                    @endif
                                                                @endforeach
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                            <td>
                                                <table>
                                                    @foreach ($exam as $eachexam)
                                                        <tr>
                                                            <td>
                                                                {{ $eachexam->remark($studentid, $eachsubject->subject_id) }}
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </table>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </table>
                        </div>
                        <div
                            class="col-span-12 sm:col-span-12 mt-5 p-4 flex flex-row border justify-around bg-gray-200">
                            <div>
                                <span class="text-green-500">Overall Percentage</span><br>
                                <span class="text-xl">100 %
                                </span>
                            </div>
                            <div>
                                <span class="text-green-500">Rank</span><br>
                                <span class="text-xl">6/20
                                </span>
                            </div>
                            <div>
                                <span class="text-green-500">Grade</span><br>
                                <span class="text-xl">A
                                </span>
                            </div>
                        </div>
                        <div
                            class="col-span-12 sm:col-span-12 mt-5 p-4 flex flex-row border justify-around bg-gray-200">
                            @foreach ($grade as $eachgrade)
                                <div>
                                    <span class="text-sm text-blue-600">
                                        {{ $eachgrade->percentage_from }} % - {{ $eachgrade->percentage_to }}
                                        %
                                        {{ $eachgrade->name }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-span-12 sm:col-span-2">
                    <button class="btn btn-primary" wire:click="downloadstudentprogressreport">print</button>
                </div>
            @elseif($sectionid && $exam->isEmpty() && $studentid)
                @include('helper.datatable.norecordfound')
            @else
            <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center p-10 box mt-4 bg-blue-100 leading-6">
                <div class="mx-auto flex flex-row items-center">
                    <div>
                        <p class="text-2xl font-bold text-gray-900 dark:text-gray-100 dark:text-white mr-5">Kindly Select</p>
                        <p class="text-2xl mt-2 font-bold"> <span class="text-green-500">Class, Section and Student</span></p>
                        <p class="text-2xl mt-2 font-bold text-gray-900 dark:text-gray-100 dark:text-white mr-5">to view progress report</p>
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
