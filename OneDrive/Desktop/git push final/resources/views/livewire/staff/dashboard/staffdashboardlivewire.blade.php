<div>
    <div class="grid grid-cols-12 gap-6 mt-2 font-Montserrat">
        <div
            class="col-span-12 flex justify-between gap-4 text-white bg-[#22509F] rounded-md sm:col-span-9 xl:col-span-9 intro-y">
            <div class="mt-4 ml-4">
                <p class="text-md">Hi {{ $user->name }}! {{ $greetings }}.</p>
                <p class="text-md mt-3">
                    {{ $dueclasses ? $dueclasses . ' Classes are behind Due Date. Kindly check and update' : '' }}</p>
                @if ($dueclasses)
                    <div class="flex flex-row justify-center gap-4 text-[#22509F] text-sm self-baseline mt-4">
                        <a type="button" href={{ route('adminlessonplanner') }}
                            class="p-2 self-center border bg-white rounded-md">Class Progress</a>
                    </div>
                @endif
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
                    <div class="flex flex-row sm:flex-col lg:flex-row items-center text-white justify-around">
                        <div class="mt-5">
                            <div class="text-white text-sm">
                                {{ $homeworklist->whereNotNull('submissionfile')->where('staff_homework_status', 3)->count() }}
                                Submissions</div>
                            <div class="text-white text-lg font-bold mt-2">
                                {{ $homeworklist->unique('homework_id')->count() }} Homeworks
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
                    <div class="flex flex-row sm:flex-col lg:flex-row items-center text-white justify-around">
                        <div class="mt-5">
                            <div class="text-white text-sm">{{ $assessment->where('assessment_status', 1)->count() }}
                                Completed</div>
                            <div class="text-white text-lg font-bold mt-2">
                                {{ $assessment->unique('onlineassessment_id')->count() }} Assessments
                            </div>
                        </div>
                        <img class="h-20 mx-0 sm:mx-auto lg:mx-0 w-20"
                            src="{{ asset('/image/dashboard/staffstudentdashboard/exam.png') }}" alt="exam">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-12 sm:col-span-4 xl:col-span-4 intro-y">
            <div class="zoom-in">
                <div class="box p-2 rounded-lg bg-gradient-to-r from-[#02AF98] to-[#92C740]">
                    <div class="flex flex-row sm:flex-col items-center lg:flex-row text-white justify-around">
                        <div class="mt-5">
                            <div class="text-white text-sm">
                                {{ $gamificationstar->gamificationable_sum_star ? $gamificationstar->gamificationable_sum_star : 0 }}
                                Stars
                                <div class="text-xs">
                                    ({{ $gamificationstar->getrankingoverall() }} Position)
                                </div>
                            </div>
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
                            class="text-2xl lg:text-2xl xl:text-3xl">{{ $user->overallattendancepercentage($academicyear_id) }}
                            %</span>

                    </div>
                </div>
                <div class="mt-5 font-semibold">
                    <div class="text-green-500">
                        {{ $user->overallpresentdays($academicyear_id) }} days present
                    </div>
                    <div class="text-red-500">
                        {{ $user->overallabsentdays($academicyear_id) }} days absent
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
                            Pay Slip
                        </div>
                        <div class="text-2xl md:text-xl lg:text-2xl xl:text-3xl text-[#22509F]">
                            {{ $payroll?->month_date->format('F Y') }}
                        </div>
                    </div>
                </div>
                <div class="mr-8">
                    <a class="btn bg-[#22509F] text-white text-xs p-1 w-24 rounded-lg" href="#">View Pay Slip</a>
                </div>
            </div>
        </div>
        <div class="col-span-12 md:col-span-6 mt-3 p-3 bg-[#C6D8ED]">
            <div class="intro-x flex items-center h-10">
                <div class="font-bold dark:text-gray-600 truncate">
                    Today's Routine
                </div>
            </div>
            @foreach ($stafftodaytimetable as $key => $value)
                <div class="intro-x relative flex items-center mb-3 mt-2">
                    <div class="box px-5 py-2 flex-1 zoom-in">
                        <div class="flex items-center justify-between">
                            <div class=" text-gray-600  font-semibold">
                                {{ $value->classroutine->name }}
                                ({{ $value->classroutine->start_time->format('H a') }} -
                                {{ $value->classroutine->end_time->format('H a') }})
                            </div>
                            <div class=" text-green-600  font-semibold">
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
                                {{ $subject[$key]->classmaster->name }} - {{ $subject[$key]->section->name }}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
