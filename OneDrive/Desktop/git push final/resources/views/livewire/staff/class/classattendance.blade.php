@include('staff.class.helper.staffclasssidemenuhelper', [
    'active' => 'attendance',
])
<div class="col-span-12 lg:col-span-10 box w-full lg:w-10/12 p-10 intro-y">
    <div class="intro-y col-span-12 overflow-auto">
        <div class="col-span-12 lg:col-span-8 grid grid-flow-row gap-4">
            <div class="col-span-12 border-2 dark:border-theme-3 p-5 rounded-lg">
                <div class="flex intro-y">
                    <div class="relative text-gray-700 dark:text-gray-300 font-semibold text-lg">
                        Student Attendance 
                    </div>
                    <button class="btn btn-primary lg:w-auto mt-3 lg:mt-0 ml-auto"
                        wire:click="viewabsentees('student')">View
                        Absentees 
                        @if($viewabsentees == '' || $viewabsentees == 'staff')
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevrons-down"><polyline points="7 13 12 18 17 13"></polyline><polyline points="7 6 12 11 17 6"></polyline></svg>
                        @elseif($viewabsentees == 'student')
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevrons-up"><polyline points="17 11 12 6 7 11"></polyline><polyline points="17 18 12 13 7 18"></polyline></svg>
                        @endif
                    </button>
                </div>
                <div class="grid grid-cols-12 mt-5">
                    <div class="col-span-12 lg:col-span-4 text-center font-semibold text-base text-primary-2">
                        Total Students: {{ $totalstudents->count() }}
                    </div>
                    <div class="col-span-12 lg:col-span-4 text-center font-semibold text-base text-primary-3">
                        On Leave: {{ $studentattendace?->absentstudent->count() !=null ?$studentattendace?->absentstudent->count() : 0 }}
                    </div>
                    <div class="col-span-12 lg:col-span-4 text-center font-semibold text-base text-theme-9">
                        Present: {{ round($studentattendace?->attendance_percentage) }} %
                    </div>
                </div>
                @if ($viewabsentees == 'student')
                    <div class="grid grid-cols-12 mt-5">
                        <div class="col-span-12 lg:col-span-6 font-semibold text-base">
                            @if($studentattendace?->absentstudent->count() !=null)
                            @foreach ($studentattendace->absentstudent as $index => $eachabsentstudent)
                                <div class="font-semibold">
                                    {{ $index + 1 }} . {{ $eachabsentstudent?->student->name }}
                                </div>
                            @endforeach
                            @endif
                        </div>
                    </div>
                @endif
            </div>
            <div class="col-span-12 border-2 dark:border-theme-3 p-5 rounded-lg">
                <div class="flex intro-y">
                    <div class="relative text-gray-700 dark:text-gray-300 font-semibold text-lg">
                        Staff Attendance
                    </div>
                    <button class="btn btn-primary lg:w-auto mt-3 lg:mt-0 ml-auto"
                        wire:click="viewabsentees('staff')">View Absentees
                        @if($viewabsentees == '' || $viewabsentees=='student')
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevrons-down"><polyline points="7 13 12 18 17 13"></polyline><polyline points="7 6 12 11 17 6"></polyline></svg>
                        @elseif($viewabsentees == 'staff')
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevrons-up"><polyline points="17 11 12 6 7 11"></polyline><polyline points="17 18 12 13 7 18"></polyline></svg>
                        @endif
                    </button>
                </div>
                <div class="grid grid-cols-12 mt-5">
                    <div class="col-span-12 lg:col-span-4 text-center font-semibold text-base text-primary-2">
                        Total Staff: {{ $staffattendance->count() }}
                    </div>
                    <div class="col-span-12 lg:col-span-4 text-center font-semibold text-base text-primary-3">
                        On Leave: {{ $staffattendance->sum('absent') }}
                    </div>
                    <div class="col-span-12 lg:col-span-4 text-center font-semibold text-base text-theme-9">
                        Present:
                        {{ $staffattendance->sum('present') != 0? round(($staffattendance->sum('present') / $staffattendance->count()) * 100): 0 }}
                        %
                    </div>
                </div>
                @if ($viewabsentees == 'staff')
                    <div class="grid grid-cols-12 mt-5">
                        <div class="col-span-12 lg:col-span-6 font-semibold text-base">
                            @foreach ($stafflist as $index => $eachabsentstaff)
                                <div class="font-semibold">
                                    {{ $index + 1 }} . {{ $eachabsentstaff->name }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
