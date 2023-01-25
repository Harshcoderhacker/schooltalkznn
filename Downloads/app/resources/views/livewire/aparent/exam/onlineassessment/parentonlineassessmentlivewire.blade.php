<div>
    <div class="intro-y chat grid grid-cols-12 gap-5 mt-5 mb-5">
        @include(
            'parent.exam.onlineassesment.helper.onlineassesmentmenu',
            ['active' => $panel]
        )
    </div>
    <div class="grid grid-cols-12 gap-1 mt-11 w-full sm:w-11/12 mx-auto">
        @if ($panel == 'onlive')
            @if (sizeof($onlineassessment) > 0)
                <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                    <table class="table table-report -mt-2">
                        <thead class="bg-primary">
                            <tr class="intro-x">
                                <th class="font-semibold text-white uppercase whitespace-nowrap">
                                    <div class="flex">
                                        Exam Date
                                </th>
                                <th class="font-semibold text-white uppercase whitespace-nowrap">
                                    <div class="flex">
                                        Time
                                </th>
                                <th class="font-semibold text-white uppercase whitespace-nowrap">
                                    <div class="flex">
                                        Exam Name
                                    </div>
                                </th>
                                <th class="font-semibold text-white uppercase whitespace-nowrap">
                                    <div class="flex">
                                        Subject
                                </th>
                                <th class="font-semibold text-white uppercase whitespace-nowrap">
                                    <div class="flex">
                                        Number of Question
                                </th>
                                <th class="font-semibold text-white uppercase whitespace-nowrap">
                                    <div class="flex">
                                        Marks
                                </th>
                                <th class="font-semibold text-white uppercase whitespace-nowrap">
                                    <div class="flex">
                                        Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($onlineassessment as $eachonlineassessment)
                                <tr class="intro-x">
                                    <td>
                                        <span class="text-sm font-medium whitespace-nowrap">
                                            {{ $eachonlineassessment->start_date ? $eachonlineassessment->start_date->format('Y-m-d') : 'Always Active' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-sm font-medium whitespace-nowrap">
                                            12.30
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-sm font-medium whitespace-nowrap">
                                            {{ $eachonlineassessment->name }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-sm font-medium whitespace-nowrap">
                                            {{ $eachonlineassessment->subject->name }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-sm font-medium text-center text-theme-11">
                                            {{ sizeof($eachonlineassessment->onlineassessmentquestion) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-sm font-medium text-center text-theme-11">
                                            {{ $eachonlineassessment->total_mark }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('parentattendonlineassessment', ['onlineassessment_id' => $eachonlineassessment->id]) }}"
                                            class="btn btn-primary w-auto">Take
                                            Exam</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @include('helper.datatable.pagination', [
                    'pagination' => $onlineassessment,
                ])
            @else
                @include('helper.datatable.norecordfound')
            @endif
        @elseif($panel == 'upcoming')
            @if (sizeof($onlineassessment) > 0)
                <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                    <table class="table table-report -mt-2">
                        <thead class="bg-primary">
                            <tr class="intro-x">
                                <th class="font-semibold text-white uppercase whitespace-nowrap">
                                    <div class="flex">
                                        Exam Date
                                </th>
                                <th class="font-semibold text-white uppercase whitespace-nowrap">
                                    <div class="flex">
                                        Time
                                </th>
                                <th class="font-semibold text-white uppercase whitespace-nowrap">
                                    <div class="flex">
                                        Exam Name
                                    </div>
                                </th>
                                <th class="font-semibold text-white uppercase whitespace-nowrap">
                                    <div class="flex">
                                        Subject
                                </th>
                                <th class="font-semibold text-white uppercase whitespace-nowrap">
                                    <div class="flex">
                                        Number of Question
                                </th>
                                <th class="font-semibold text-white uppercase whitespace-nowrap">
                                    <div class="flex">
                                        Marks
                                </th>
                                <th class="font-semibold text-white uppercase whitespace-nowrap">
                                    <div class="flex">
                                        Status
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($onlineassessment as $eachonlineassessment)
                                <tr class="intro-x">
                                    <td>
                                        <span class="text-sm font-medium whitespace-nowrap">
                                            {{ $eachonlineassessment->start_date ? $eachonlineassessment->start_date->format('Y-m-d') : 'Always Active' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-sm font-medium whitespace-nowrap">
                                            12.30
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-sm font-medium whitespace-nowrap">
                                            {{ $eachonlineassessment->name }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-sm font-medium whitespace-nowrap">
                                            {{ $eachonlineassessment->subject->name }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-sm font-medium text-center text-theme-11">
                                            {{ sizeof($eachonlineassessment->onlineassessmentquestion) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-sm font-medium text-center text-theme-11">
                                            {{ $eachonlineassessment->total_mark }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="p-2 border font-medium rounded bg-yellow-400 text-black">Yet
                                            To Start</span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @include('helper.datatable.pagination', [
                    'pagination' => $onlineassessment,
                ])
            @else
                @include('helper.datatable.norecordfound')
            @endif
        @else
            @if (sizeof($onlineassessment) > 0)
                <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                    <table class="table table-report w-full">
                        <thead class="bg-primary">
                            <tr class="intro-x">
                                <th class="font-semibold text-white uppercase whitespace-nowrap">
                                    Exam Date
                                </th>
                                <th class="font-semibold text-white uppercase whitespace-nowrap">
                                    Time
                                </th>
                                <th class="font-semibold text-white uppercase whitespace-nowrap">
                                    Exam Name
                                </th>
                                <th class="font-semibold text-white uppercase whitespace-nowrap">
                                    Subject
                                </th>
                                <th class="font-semibold text-white uppercase whitespace-nowrap">
                                    Number of Question
                                </th>
                                <th class="font-semibold text-white uppercase whitespace-nowrap">
                                    Marks
                                </th>
                                <th class="font-semibold text-white uppercase whitespace-nowrap">
                                    Your Mark
                                </th>
                                <th class="font-semibold text-white uppercase whitespace-nowrap">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($onlineassessment as $eachonlineassessment)
                                <tr class="intro-x">
                                    <td>
                                        <span class="text-sm font-medium whitespace-nowrap">
                                            {{ $eachonlineassessment->onlineassessmentstudentlist[0]->participated_date ? $eachonlineassessment->onlineassessmentstudentlist[0]->participated_date->format('d-m-Y') : 'Not Attended' }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-sm font-medium whitespace-nowrap">
                                            12.30
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-sm font-medium whitespace-nowrap">
                                            {{ $eachonlineassessment->name }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-sm font-medium whitespace-nowrap">
                                            {{ $eachonlineassessment->subject->name }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="text-sm font-medium whitespace-nowrap">
                                            {{ sizeof($eachonlineassessment->onlineassessmentquestion) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-sm font-medium whitespace-nowrap">
                                            {{ $eachonlineassessment->total_mark }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="text-sm font-medium whitespace-nowrap">
                                            {{ $eachonlineassessment->onlineassessmentstudentlist[0]->mark ? $eachonlineassessment->onlineassessmentstudentlist[0]->mark : 0 }}
                                        </span>
                                    </td>
                                    <td class=>
                                        <button class="btn btn-success w-32">View Result</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @include('helper.datatable.pagination', [
                    'pagination' => $onlineassessment,
                ])
            @else
                @include('helper.datatable.norecordfound')
            @endif
        @endif
    </div>
</div>
