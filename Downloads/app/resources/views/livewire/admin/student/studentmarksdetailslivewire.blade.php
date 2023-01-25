<div>
    <div id="marks" class="tab-pane" role="tabpanel" aria-labelledby="marks-tab" >
        <div class="box p-2 mt-2">
            <div class="grid grid-cols-12 gap-6">
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
            <div class="grid grid-cols-12 mt-8 ml-10 justify-around gap-8">
                @if ($selectedexam)
                    <div class="col-span-12 sm:col-span-12 border">
                        <div class="grid grid-cols-12 p-4">
                            <div class="col-span-12 sm:col-span-12 p-4 flex flex-row justify-between">
                                <div>
                                    <span class="font-semibold">Exam Name :
                                        {{ $selectedexam[0]->name }}</span>
                                </div>
                                <div>
                                    <span class="font-semibold">Academic Year :
                                        {{ $selectedexam[0]->academicyear->year }}</span>
                                </div>
                            </div>
                            <div class="intro-y col-span-12 sm:col-span-12 overflow-auto lg:overflow-visible">
                                <table class="table table-report -mt-2">
                                    <thead>
                                        <tr class="intro-x">
                                            <th class="font-semibold uppercase whitespace-nowrap">
                                                Subject
                                            </th>
                                            <th class="font-semibold uppercase whitespace-nowrap">
                                                Total Marks
                                            </th>
                                            <th class="font-semibold uppercase whitespace-nowrap">
                                                Mark Obtained
                                            </th>
                                            <th class="font-semibold uppercase whitespace-nowrap">
                                                Subject Grade
                                            </th>
                                            <th class="font-semibold uppercase whitespace-nowrap">
                                                Remarks
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($selectedexam[0]->examsubject as $key => $eachexamsubject)
                                            <tr class="intro-x">
                                                <td>
                                                    <span class="text-sm font-medium whitespace-nowrap">
                                                        {{ $eachexamsubject->subject->name }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="text-sm font-medium whitespace-nowrap">
                                                        {{ $eachexamsubject->mark }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="text-sm font-medium whitespace-nowrap">
                                                        {{ $examsubjectmark[$key]->mark }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="text-sm font-medium text-center text-theme-11">
                                                        @if(sizeof($examsubjectmark->where('exam_id', $selectedexam[0]->id)->where('is_present',1))>0)
                                                            @foreach ($grade as $eachgrade)
                                                                @if ($eachgrade->percentage_from <= $examsubjectmark[$key]->subjectmark_percentage && $eachgrade->percentage_to > $examsubjectmark[$key]->subjectmark_percentage)
                                                                {{ $eachgrade->name }}
                                                                @elseif($examsubjectmark[$key]->subjectmark_percentage == 100 && $eachgrade->percentage_to == 100)
                                                                    {{ $eachgrade->name }}
                                                                @endif
                                                            @endforeach
                                                        @else
                                                        A
                                                        @endif
                                                    </span>
                                                </td>
                                                <td>
                                                    <span class="text-sm font-medium text-center text-theme-9">
                                                        {{ $examsubjectmark[$key]?->remarks }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr class="intro-x">
                                            <td>
                                                <span class="text-sm font-medium whitespace-nowrap">
                                                    All Subjects
                                                </span>
                                            </td>
                                            <td>
                                                <span class="text-sm font-medium whitespace-nowrap">
                                                    {{ $selectedexam[0]->examsubject->sum('mark') }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="text-sm font-medium whitespace-nowrap">
                                                    {{ $examsubjectmark->sum('mark') }}
                                                </span>
                                            </td>
                                            <td>
                                                <span class="text-sm font-medium text-center text-theme-11">
                                                    @if (sizeof($examsubjectmark->where('exam_id', $selectedexam[0]->id)) ==
                                                        $examsubjectmark->where('exam_id', $selectedexam[0]->id)->where('is_pass')->count())
                                                        @foreach ($grade as $eachgrade)
                                                            @if ($eachgrade->percentage_from <= ($examsubjectmark->where('exam_id', $selectedexam[0]->id)->sum('mark') / $selectedexam[0]->examsubject->sum('mark')) * 100 && $eachgrade->percentage_to > ($examsubjectmark->where('exam_id', $selectedexam[0]->id)->sum('mark') / $selectedexam[0]->examsubject->sum('mark')) * 100)
                                                                {{ $eachgrade->name }}
                                                            @elseif(($examsubjectmark->where('exam_id', $selectedexam[0]->id)->sum('mark') / $selectedexam[0]->examsubject->sum('mark')) * 100 == 100 && $eachgrade->percentage_to == 100)
                                                                {{ $eachgrade->name }}
                                                            @endif
                                                        @endforeach
                                                    @else
                                                        F
                                                    @endif
                                                </span>
                                            </td>
                                            <td>
                                                <span class="text-sm font-medium whitespace-nowrap">
                                                    @if (sizeof($examsubjectmark->where('exam_id', $selectedexam[0]->id)) ==
                                                        $examsubjectmark->where('exam_id', $selectedexam[0]->id)->where('is_pass')->count())
                                                        Pass
                                                    @else
                                                        Fail
                                                    @endif
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div
                                class="col-span-12 sm:col-span-12 mt-5 p-4 flex flex-row border justify-around bg-gray-200">
                                <div>
                                    <span class="text-green-500">Overall Percentage</span><br>
                                    <span class="text-xl">
                                        {{ round(($examsubjectmark->where('exam_id', $selectedexam[0]->id)->sum('mark') / $selectedexam[0]->examsubject->sum('mark')) * 100) }}
                                        %
                                    </span>
                                </div>
                                <div>
                                    <span class="text-green-500">Rank</span><br>
                                    @if (sizeof($examsubjectmark->where('exam_id', $selectedexam[0]->id)) ==
                                        $examsubjectmark->where('exam_id', $selectedexam[0]->id)->where('is_pass')->count())
                                        {{ array_search($studentid, array_keys($total_mark)) + 1 }} /
                                        {{ sizeof($total_mark) }}
                                    @else
                                        <span class="text-xl">-</span>
                                    @endif
                                </div>
                                <div>
                                    <span class="text-green-500">Grade</span><br>
                                    @if (sizeof($examsubjectmark->where('exam_id', $selectedexam[0]->id)) ==
                                        $examsubjectmark->where('exam_id', $selectedexam[0]->id)->where('is_pass')->count())
                                        @foreach ($grade as $eachgrade)
                                            @if ($eachgrade->percentage_from <= ($examsubjectmark->where('exam_id', $selectedexam[0]->id)->sum('mark') / $selectedexam[0]->examsubject->sum('mark')) * 100 && $eachgrade->percentage_to > ($examsubjectmark->where('exam_id', $selectedexam[0]->id)->sum('mark') / $selectedexam[0]->examsubject->sum('mark')) * 100)
                                                <span class="text-xl">{{ $eachgrade->name }}</span>
                                            @elseif(($examsubjectmark->where('exam_id', $selectedexam[0]->id)->sum('mark') / $selectedexam[0]->examsubject->sum('mark')) * 100 == 100 && $eachgrade->percentage_to == 100)
                                                <span class="text-xl">{{ $eachgrade->name }}</span>
                                            @endif
                                        @endforeach
                                    @else
                                        <span class="text-xl">F</span>
                                    @endif
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
                @else
                    @include('helper.datatable.norecordfound')
                @endif
            </div>
        </div>
    </div>
</div>
