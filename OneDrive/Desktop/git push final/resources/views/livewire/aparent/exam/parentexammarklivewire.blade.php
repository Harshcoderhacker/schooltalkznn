<div>
    <div class="col-span-12 mt-5 w-full sm:w-11/12 mx-auto">
        <div class="intro-y flex items-center h-10">
            <h2 class="text-lg font-medium truncate mr-5">Exam Marks</h2>
        </div>
        <div class="grid grid-cols-12 gap-6 mt-2">
            <div class="col-span-12 sm:col-span-6 xl:col-span-4 intro-y">
                <select wire:model="exam_id" class="form-select w-full mt-5">
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
    @if ($exam->isNotEmpty())
        <div class="intro-y box mt-5 w-full sm:w-11/12 mx-auto">
            <div class="flex items-center p-2 text-lg justify-center bg-primary">
                <h1 class="font-semibold text-white">Exam Details</h1>
            </div>
            <div class="p-3 border-t grid grid-cols-12 border-gray-200 dark:border-dark-5 w-10/12 mx-auto">
                <div class="col-span-12 sm:col-span-6 mt-5 sm:mt-0">
                    <span class="text-base font-semibold">Exam Name</span>
                    <span class="text-base mx-5">{{ $exam[0]->name }}
                    </span>
                </div>
                <div class="col-span-12 sm:col-span-6 mt-5 sm:mt-0">
                    <span class="text-base font-semibold">Dates</span>
                    <span class="text-base mx-5">{{ $exam[0]->examsubject->min('examdate')->format('d-M-Y') }} -
                        {{ $exam[0]->examsubject->max('examdate')->format('d-M-Y') }}
                    </span>
                </div>
                <div class="col-span-12 mt-5">
                    <span class="text-base font-semibold">Subject</span>
                    <span class="text-base mx-5">
                        @foreach ($exam[0]->examsubject as $key => $eachexamsubject)
                            @if ($key == 0)
                                {{ $eachexamsubject->subject->name }}
                            @else
                                , {{ $eachexamsubject->subject->name }}
                            @endif
                        @endforeach
                    </span>
                </div>
                <div class="col-span-6 sm:col-span-6 mt-5">
                    <span class="text-base font-semibold">Average</span>
                    <span class="text-base mx-5">
                        {{ ($totalavg->where('exam_id', $exam[0]->id)->sum('mark') / $exam[0]->examsubject->sum('mark')) * 100 }}
                        %
                    </span>
                </div>
                <div class="col-span-6 sm:col-span-6 mt-5">
                    <span class="text-base font-semibold">Rank</span>
                    <span class="text-base mx-5">
                        @if (sizeof($totalavg->where('exam_id', $exam[0]->id)) ==
    $totalavg->where('exam_id', $exam[0]->id)->where('is_pass')->count())
                            @foreach ($grade as $eachgrade)
                                @if ($eachgrade->percentage_from <= ($totalavg->where('exam_id', $exam[0]->id)->sum('mark') / $exam[0]->examsubject->sum('mark')) * 100 && $eachgrade->percentage_to > ($totalavg->where('exam_id', $exam[0]->id)->sum('mark') / $exam[0]->examsubject->sum('mark')) * 100)
                                    {{ $eachgrade->name }}
                                @elseif(($totalavg->where('exam_id', $exam[0]->id)->sum('mark') / $exam[0]->examsubject->sum('mark')) * 100 == 100 && $eachgrade->percentage_to == 100)
                                    {{ $eachgrade->name }}
                                @endif
                            @endforeach
                        @else
                            F
                        @endif
                    </span>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-12 gap-1 mt-11 w-full sm:w-11/12 mx-auto">
            <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                <table class="table table-report -mt-2">
                    <thead class="bg-primary">
                        <tr class="intro-x">
                            <th class="font-semibold text-white uppercase whitespace-nowrap">
                                <div class="flex">
                                    Date
                            </th>
                            <th class="font-semibold text-white uppercase whitespace-nowrap">
                                <div class="flex">
                                    Subject
                            </th>
                            <th class="font-semibold text-white uppercase whitespace-nowrap">
                                <div class="flex">
                                    Total Mark
                                </div>
                            </th>
                            <th class="font-semibold text-white uppercase whitespace-nowrap">
                                <div class="flex">
                                    Your Mark
                            </th>
                            <th class="font-semibold text-white uppercase whitespace-nowrap">
                                <div class="flex">
                                    Rank
                            </th>
                            <th class="font-semibold text-white uppercase whitespace-nowrap">
                                <div class="flex">
                                    Status
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($exam[0]->examsubject as $key => $eachexamsubject)
                            <tr class="intro-x">
                                <td>
                                    <span class="text-sm font-medium whitespace-nowrap">
                                        {{ $eachexamsubject->examdate->format('d-M-Y') }}
                                    </span>
                                </td>
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
                                        {{ $totalavg[$key]->mark }}
                                    </span>
                                </td>
                                <td>
                                    <span class="text-sm font-medium text-center text-theme-11">
                                        @foreach ($grade as $eachgrade)
                                            @if ($eachgrade->percentage_from <= $totalavg[$key]->subjectmark_percentage && $eachgrade->percentage_to > $totalavg[$key]->subjectmark_percentage)
                                                {{ $eachgrade->name }}
                                            @elseif($totalavg[$key]->subjectmark_percentage == 100 && $eachgrade->percentage_to == 100)
                                                {{ $eachgrade->name }}
                                            @endif
                                        @endforeach
                                    </span>
                                </td>
                                <td>
                                    <span class="text-sm font-medium text-center text-theme-9">
                                        @if ($totalavg[$key]->subjectmark_percentage >= $passpercentage[0]->pass_percentage)
                                            Pass
                                        @else
                                            Fail
                                        @endif
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @else
        @include('helper.datatable.norecordfound')
    @endif
</div>
