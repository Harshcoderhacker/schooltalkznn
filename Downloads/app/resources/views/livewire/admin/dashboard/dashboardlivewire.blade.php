<div>
    <div class="grid grid-cols-12 gap-6 mt-2 font-Montserrat">
        <div
            class="col-span-12 flex justify-between gap-4 text-white bg-[#22509F] rounded-md sm:col-span-9 xl:col-span-9 intro-y">
            <div class="mt-4 ml-4">
                <p class="text-md">Hi {{ auth()->user()->name }}! {{ $greetings }}.</p>
                <p class="text-md mt-3">{{ $staffabsentcount ? $staffabsentcount : 'No' }} Staffs are absent today and
                    {{ $dueclasses
                        ? $dueclasses .
                            ' class
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                subjects have crossed the
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                plan date'
                        : 'No class
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                subjects have crossed the
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                plan date' }}
                </p>
                <div class="flex flex-row justify-center gap-4 text-[#22509F] text-sm self-baseline mt-4">
                    <a type="button" href={{ route('smartattendanceindex') }}
                        class="p-2 self-center border bg-white rounded-md">Regulate classes</a>
                    <a type="button" href={{ route('adminlessonplanner') }}
                        class="p-2 self-center border bg-white rounded-md">View Completions</a>
                </div>
            </div>
            <div>
                @include('helper.staffstudentdashboard.hellocharacter')
            </div>
        </div>
        <div class="col-span-12 sm:col-span-3 xl:col-span-3 intro-y bg-[#DEDCEE] p-3 border items-end rounded-md">
            {{-- <button class="w-24 bg-primary mb-4 rounded-lg text-white" wire:click="convert">Convert</button> --}}
            <p class="text-sm text-[#707070]">
                You have one unread messages from Mrs.Saranya (Physics Staff)
            </p>
        </div>
        <div class="col-span-12 sm:col-span-4 xl:col-span-4 intro-y">
            <div class="zoom-in">
                <div class="box p-2 rounded-lg bg-gradient-to-r from-[#02AF98] to-[#92C740]">
                    <div class="flex text-white justify-around">
                        <div class="mt-5">
                            <div class="text-white text-base">Students Attendance</div>
                            <div class="text-white text-2xl font-bold mt-2">
                                {{ $todaystudentsattendancepercentage ? $todaystudentsattendancepercentage : 0 }} %
                                <span
                                    class="text-sm">({{ $studentpresentcount ? $studentpresentcount : 0 }}/{{ $totalstudents }})
                                </span>
                            </div>
                        </div>
                        <img class="h-28" src="{{ asset('/image/dashboard/dashboard/student.png') }}" alt="ppl">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-12 sm:col-span-4 xl:col-span-4 intro-y">
            <div class="zoom-in">
                <div class="box rounded-lg bg-gradient-to-r from-[#02AF98] to-[#92C740]">
                    <div class="flex text-white justify-around">
                        <div class="mt-5">
                            <div class="text-white text-base">Staff Attendance</div>
                            <div class="text-white text-2xl font-bold mt-2">
                                {{ $todaystaffsattendancepercentage ? $todaystaffsattendancepercentage : 0 }} %
                                <span
                                    class="text-sm">({{ $staffpresentcount ? $staffpresentcount : 0 }}/{{ $staffcount }})
                                </span>
                            </div>
                        </div>
                        <div>
                            <img class="h-32" src="{{ asset('/image/dashboard/dashboard/staffcard.png') }}"
                                alt="ppl">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-12 sm:col-span-4 xl:col-span-4 intro-y">
            <div class="zoom-in">
                <div class="box p-2 rounded-lg bg-gradient-to-r from-[#02AF98] to-[#92C740]">
                    <div class="flex text-white justify-around">
                        <div class="mt-5">
                            <div class="text-white text-base">Fee Due</div>
                            <div class="text-white text-2xl font-bold mt-2">
                                Rs.{{ $feedue }}
                            </div>
                        </div>
                        <img class="h-28" src="{{ asset('/image/dashboard/dashboard/fee.png') }}" alt="ppl">
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-12 md:col-span-6 mt-3 p-3 bg-[#C6D8ED]">
            <div class="intro-x flex items-center h-10">
                <div class="font-bold truncate text-[#707070] {{ $exam->isNotEmpty() ? '' : 'mx-auto' }}">
                    @if ($exam->isNotEmpty())
                        There are totally {{ $exam->count() }} exams happening today
                    @else
                        No exams today
                    @endif
                </div>
            </div>
            @foreach ($exam as $eachexam)
                <div class="intro-x relative flex items-center mb-3 mt-2">
                    <div class="box px-5 py-3 flex-1 zoom-in">
                        <div class="flex items-center justify-around">
                            <div class="col-span-12 sm:col-span-4 text-gray-600  font-semibold">
                                {{ $eachexam->exam->name }}
                            </div>
                            <div class="font-semibold text-[#02AF98] text-theme-1">
                                {{ $eachexam->exam->classmaster->name }}</div>
                            <div class="col-span-12 sm:col-span-4 font-semibold ">Subject: <span
                                    class="text-text-[#E7980E]">{{ $eachexam->subject->name }}</span></div>
                            <div class="col-span-12 sm:col-span-4 font-semibold ">Marks: <span
                                    class="text-text-[#E7980E]">{{ $eachexam->mark }}</span></div>
                        </div>
                    </div>
                </div>
            @endforeach
            @if ($exam->isNotEmpty())
                <div>
                    <a href={{ route('admincreateexamindex') }}
                        class="float-right font-bold text-[#22509F] p-3 m-5 mb-0 mt-0">View
                        More</a>
                </div>
            @endif
        </div>
        <div class="col-span-12 md:col-span-6 mt-3 p-3 bg-[#C6D8ED]">
            <div class="intro-x flex items-center h-10">
                <div class="font-bold truncate text-[#707070] {{ $staffleaverequest->isNotEmpty() ? '' : 'mx-auto' }}">
                    @if ($staffleaverequest->isNotEmpty())
                        Leave Applications (staff)
                    @else
                        No Leave Applications
                    @endif
                </div>
            </div>
            @foreach ($staffleaverequest as $key => $value)
                <div class="intro-x relative flex items-center mb-3 mt-2">
                    <div class="box px-5 py-2 flex-1 zoom-in">
                        <div class="flex items-center justify-between">
                            <div
                                class="w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit  text-gray-600  font-semibold">
                                @if ($value->staff->avatar)
                                    <img alt="{{ $value->staff->name }} image" class="rounded-full"
                                        src="{{ url('storage/' . $value->staff->avatar) }}">
                                @else
                                    <img alt="image" class="rounded-full"
                                        src="{{ asset('dist/images/placeholders/200x200.jpg') }}">
                                @endif
                            </div>
                            <div class="font-semibold text-black text-theme-1">
                                {{ $value->staff->name }}</div>
                            <div class="font-semibold text-[#45A83E]">
                                @if ($value->from_date == $value->to_date)
                                    {{ Carbon\Carbon::parse($value->from_date)->format('M d,Y') }}
                                @else
                                    {{ Carbon\Carbon::parse($value->from_date)->format('M d,Y') }} to
                                    {{ Carbon\Carbon::parse($value->to_date)->format('M d,Y') }}
                                @endif
                            </div>
                            <div class="text-[#E7980E] font-semibold">
                                {{ Carbon\Carbon::parse($value->to_date)->diffInDays(Carbon\Carbon::parse($value->from_date)) + 1 }}
                                days
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            @if ($staffleaverequest->isNotEmpty())
                <div>
                    <a href={{ route('staffleaverequest') }}
                        class="float-right font-bold text-[#22509F] p-3 m-5 mb-0 mt-0">View
                        More</a>
                </div>
            @endif
        </div>
    </div>
</div>
