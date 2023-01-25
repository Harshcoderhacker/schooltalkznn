<div class="intro-y flex items-center h-10">
    <h2 class="text-lg font-medium truncate mr-5">Staff Attendance</h2>
</div>
<div class="grid grid-cols-12 gap-y-5 sm:gap-6 mt-5">
    <a href="{{ route('adminstaffmonthlyattendance') }}" class="col-span-12 sm:col-span-6 intro-y">
        <div class="zoom-in">
            <div class="box px-3 py-4">
                <img class="object-contain h-16 w-full" alt="Time Table"
                    src="{{ asset('/image/report/monthly_attendance.png') }}">
                <div class="text-center text-sm font-medium leading-8 mt-2">Staff Monthly Attendance
                </div>
            </div>
        </div>
    </a>
    <a href="{{ route('adminstaffoverallattendance') }}" class="col-span-12 sm:col-span-6 intro-y">
        <div class="zoom-in">
            <div class="box px-3 py-4">
                <img class="object-contain h-16 w-full" alt="Time Table"
                    src="{{ asset('/image/report/overall_attendance.png') }}">
                <div class="text-center text-sm font-medium leading-8 mt-2">Over All Attendance
                </div>
            </div>
        </div>
    </a>
</div>
