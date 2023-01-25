<div class="grid grid-cols-12 gap-6">
    <div class="col-span-12">
        <div class="grid grid-cols-12 gap-6">
            <!-- BEGIN: General Report -->
            <div class="col-span-12 mt-5">
                <div class="intro-y flex h-10">
                    <div class="ml-auto flex items-center">
                        <select wire:model="currentstudent" wire:change="sutdentswap" class="form-control">
                            @foreach ($students as $student)
                                <option value="{{ $student->uuid }}">{{ $student->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div
        class="col-span-12 flex justify-between gap-4 text-white bg-[#22509F] rounded-md sm:col-span-9 xl:col-span-9 intro-y">
        <div class="mt-4 ml-4">
            <p class="text-md">Hi {{ $currentuser->name }}! {{ $greetings }}.</p>
            <p class="text-md mt-3">
                You got
                {{ $homeworklist->where('homework_status', 0)->count() > 0 ? $homeworklist->where('homework_status', 0)->count() : 'no' }}
                pending homeworks and
                {{ $assessment->where('assessment_status', 0)->count() > 0 ? $assessment->where('assessment_status', 0)->count() : 'no' }}
                assessment to take</p>
            <div class="flex flex-row justify-center gap-4 text-[#22509F] text-sm self-baseline mt-10">
                <div class="text-yellow-300 font-semibold text-base mt-2">
                    Your {{ $currentuser->classmaster->name }} - {{ $currentuser->section->name }}
                </div>
                @if ($homeworklist->where('homework_status', 0)->count() > 0)
                    <a type="button" href={{ route('parenthomework') }}
                        class="p-2 self-center border bg-white rounded-md">Check Homework</a>
                @endif
                @if ($assessment->where('assessment_status', 0)->count() > 0)
                    <a type="button" href={{ route('parentonliveonlineassesment') }}
                        class="p-2 self-center border bg-white rounded-md">Take Assessment</a>
                @endif
            </div>
        </div>
        <div>
            @include('helper.staffstudentdashboard.hellocharacter')
        </div>
    </div>
    <div class="col-span-12 sm:col-span-3 xl:col-span-3 intro-y bg-[#DEDCEE] p-3 border items-end rounded-md">
        <img class="h-24 mx-auto w-24 mt-2" src="{{ asset('/image/dashboard/staffstudentdashboard/mail.png') }}"
            alt="mail">
        <div class="text-sm text-center text-[#707070]">
            You got no notice
        </div>
    </div>
    <div class="col-span-12 sm:col-span-4 xl:col-span-4 intro-y">
        <div class="zoom-in">
            <div class="box p-2 rounded-lg bg-gradient-to-r from-[#F05F6D] to-[#FCC372]">
                <div class="flex flex-row sm:flex-col lg:flex-row text-white justify-around">
                    <div class="mt-5 text-left sm:text-center lg:text-left">
                        <div class="text-white text-sm">{{ $material->count() }} Material</div>
                        <div class="text-white text-lg font-bold mt-2">
                            Recently Uploaded
                        </div>
                    </div>
                    <img class="h-20 mx-0 sm:mx-auto lg:mx-0 w-20"
                        src="{{ asset('/image/dashboard/staffstudentdashboard/files.png') }}" alt="folder">
                </div>
            </div>
        </div>
    </div>
    <div class="col-span-12 sm:col-span-4 xl:col-span-4 intro-y">
        <div class="zoom-in">
            <div class="box p-2 rounded-lg bg-gradient-to-r from-[#4EC3D2] to-[#6381C0]">
                <div class="flex flex-row sm:flex-col lg:flex-row text-white justify-around">
                    <div class="mt-5 text-left sm:text-center lg:text-left">
                        <div class="text-white text-sm mx-0 sm:mx-auto lg:mx-0">Class Rank</div>
                        <div class="text-white flex items-center gap-4 font-bold mt-2">
                            <div class="text-2xl">
                                {{ $rank > 0 ? $rank : '-' }}
                            </div>
                            @if ($exam)
                                <div class="text-xs">
                                    <button class="underline decoration-2" wire:click="openviewmark">(View
                                        Mark)</button>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div>
                        <img class="h-20 mx-0 sm:mx-auto lg:mx-0 w-20"
                            src="{{ asset('/image/dashboard/staffstudentdashboard/exam.png') }}" alt="exam">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-span-12 sm:col-span-4 xl:col-span-4 intro-y">
        <div class="zoom-in">
            <div class="box p-2 rounded-lg bg-gradient-to-r from-[#02AF98] to-[#92C740]">
                <div class="flex flex-row sm:flex-col lg:flex-row text-white justify-around">
                    <div class="mt-5 text-left sm:text-center lg:text-left">
                        <div class="text-white text-sm">
                            {{ $gamificationstar->gamificationable_sum_star ? $gamificationstar->gamificationable_sum_star : 0 }}
                            Stars</div>
                        @if ($gamificationstar->gamificationable_sum_star)
                            <div class="text-xs">
                                ({{ $gamificationstar->getrankingoverall() }} Position)
                            </div>
                        @endif
                        <div class="text-white text-lg font-bold mt-2">
                            School Talkz
                        </div>
                    </div>
                    <img class="h-20 mx-0 sm:mx-auto lg:mx-0 w-20"
                        src="{{ asset('/image/dashboard/staffstudentdashboard/schooltalkzbadge.png') }}"
                        alt="schooltalkz">
                </div>
            </div>
        </div>
    </div>
    <div class="col-span-12 md:col-span-6 p-3">
        <div class="intro-x flex gap-2 justify-between items-center bg-blue-100 h-32">
            <div class="font-bold ml-2  text-[#707070] ">
                <div class="text-center break-words">
                    <span class="text-md lg:text-lg">Your Attendance</span> <br>
                    <span
                        class="text-2xl lg:text-2xl xl:text-3xl">{{ $currentuser->overallattendancepercentage($academicyear_id) }}
                        %</span>

                </div>
            </div>
            <div class="mt-5 font-semibold">
                <div class="text-green-500">
                    {{ $currentuser->overallpresentdays($academicyear_id) }} days present
                </div>
                <div class="text-red-500">
                    {{ $currentuser->overallabsentdays($academicyear_id) }} days absent
                </div>
            </div>
            <div class="mt-2">
                <img class="h-28 w-28" src="{{ asset('/image/dashboard/staffstudentdashboard/calendar.png') }}"
                    alt="calendar">
            </div>
        </div>
        <div class="intro-x flex gap-2 mt-4 overflow-hidden justify-between items-center bg-blue-100 h-32">
            <div class="font-bold flex  justify-center items-center truncate text-[#707070] ">
                <div class="font-bold ml-2 truncate ">
                    <div class="text-md lg:text-lg">
                        Your Pending Due
                    </div>
                    <div class="text-2xl md:text-xl lg:text-2xl xl:text-3xl text-[#22509F]">
                        Rs. {{ $feedue }}
                    </div>
                </div>
            </div>
            @if ($feedue > 0)
                <div class="mr-8">
                    <a class="btn bg-[#22509F] text-white p-1 w-24 rounded-lg" href="{{ route('parentfee') }}">Pay
                        Fee</a>
                </div>
            @endif
        </div>
    </div>
    <div class="col-span-12 md:col-span-6 mt-3 p-3 bg-[#C6D8ED]">
        <div class="intro-x flex items-center h-10">
            <div class="font-bold dark:text-gray-500 truncate">
                Today's Routine
            </div>
        </div>
        @foreach ($studenttodaytimetable as $key => $value)
            <div class="intro-x relative flex items-center mb-3 mt-2">
                <div class="box px-5 py-2 flex-1 zoom-in">
                    <div class="flex items-center justify-between">
                        <div>
                            {{ $value->classroutine->name }} ({{ $value->classroutine->start_time->format('H a') }} -
                            {{ $value->classroutine->end_time->format('H a') }})
                        </div>
                        <div class=" text-green-600 ">
                            @if ($day == 'Monday')
                                @php
                                    $subject = $assignsubject->where('id', $value->monday);
                                @endphp
                                {{ $subject[$key]->subject->name }}
                            @elseif($day == 'Tuesday')
                                @php
                                    $subject = $assignsubject->where('id', $value->tuesday);
                                @endphp
                                {{ $subject[$key]->subject->name }}
                            @elseif($day == 'Wednesday')
                                @php
                                    $subject = $assignsubject->where('id', $value->wednesday);
                                    
                                @endphp
                                {{ $value->subject_id }}
                                {{ $subject[$key]->subject->name }}
                            @elseif($day == 'Thursday')
                                @php
                                    $subject = $assignsubject->where('id', $value->thursday);
                                @endphp
                                {{ $subject[$key]->subject->name }}
                            @elseif($day == 'Friday')
                                @php
                                    $subject = $assignsubject->where('id', $value->friday);
                                @endphp
                                {{ $subject[$key]->subject->name }}
                            @elseif($day == 'Saturday')
                                @php
                                    $subject = $assignsubject->where('id', $value->saturday);
                                @endphp
                                {{ $subject[$key]->subject->name }}
                            @elseif($day == 'Sunday')
                                @php
                                    $subject = $assignsubject->where('id', $value->sunday);
                                @endphp
                                {{ $subject[$key]->subject->name }}
                            @endif
                        </div>
                        <div class="text-orange-600">
                            {{ $subject[$key]->staff->name }}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @if ($viewmarkmodel == true)
        <div class="fixed inset-0  z-50 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <div
            class="mt-10 right-0 left-0 z-50 justify-center items-start h-modal md:h-full inset-0 fixed pin overflow-auto bg-smoke-dark flex">
            <div class="bg-white rounded-lg dark:bg-gray-700 lg:w-6/12 shadow-2xl">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h2 class="font-bold text-lg text-white mr-auto">{{ $exam->name }} Mark</h2>
                            <button wire:click="closeviewmark"
                                class="text-white bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>
                        <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                            @if ($examsubjectmark)
                                <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                                    <table class="table table-report -mt-2">
                                        <thead>
                                            <tr>
                                                <th class="text-center whitespace-nowrap">
                                                    S.NO
                                                </th>
                                                <th class="text-center whitespace-nowrap">
                                                    Subject Name
                                                </th>
                                                <th class="text-center whitespace-nowrap">
                                                    Mark
                                                </th>
                                                <th class="text-center whitespace-nowrap">Remarks</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($examsubjectmark as $index => $value)
                                                <tr class="intro-x">
                                                    <td class="font-medium text-center whitespace-nowrap">
                                                        {{ $index + 1 }}</td>
                                                    <td class="font-medium text-center whitespace-nowrap">
                                                        {{ $value->subject->name }}</td>
                                                    <td class="font-medium text-center whitespace-nowrap">
                                                        {{ $value->subjectmark_percentage ? $value->subjectmark_percentage : '' }}
                                                    </td>
                                                    <td class="font-medium text-center whitespace-nowrap">
                                                        {{ $value->remarks }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <div class="text-red-600">Marks Not Updated Yet</div>
                            @endif
                        </div>
                        <div class="modal-footer text-right">
                            <button type="button" wire:click="closeviewmark"
                                class="btn btn-outline-secondary w-20 mr-1">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
