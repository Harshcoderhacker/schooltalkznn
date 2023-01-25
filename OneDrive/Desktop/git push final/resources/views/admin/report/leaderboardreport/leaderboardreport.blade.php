<div class="intro-y flex items-center h-10">
    <h2 class="text-lg font-medium truncate mr-5">Leaderboard Report</h2>
</div>
<div class="grid grid-cols-12 gap-y-5 sm:gap-6 mt-5 ">
    <a href="{{ route('classleaderboardreport') }}" class="col-span-12 sm:col-span-3 intro-y">
        <div class=" zoom-in">
            <div class="box px-3 py-4">
                <img class="object-contain h-16 w-full" alt="Time Table"
                    src="{{ asset('/image/report/class_leadeboard.png') }}">
                <div class="text-center text-sm font-medium leading-8 mt-2">Class Leaderboard
                </div>
            </div>
        </div>
    </a>
    <a href="{{ route('leaderboardclasscomparision') }}" class="col-span-12 sm:col-span-3 intro-y">
        <div class=" zoom-in">
            <div class="box px-3 py-4">
                <img class="object-contain h-16 w-full" alt="Time Table"
                    src="{{ asset('/image/report/class_comparison.png') }}">
                <div class="text-center text-sm font-medium leading-8 mt-2">Leaderboard Class Comparision
                </div>
            </div>
        </div>
    </a>
    <a href="{{ route('topstudentleaderboardreport') }}" class="col-span-12 sm:col-span-3 intro-y">
        <div class=" zoom-in">
            <div class="box px-3 py-4">
                <img class="object-contain h-16 w-full" alt="Time Table"
                    src="{{ asset('/image/report/top_students.png') }}">
                <div class="text-center text-sm font-medium leading-8 mt-2">Top Student Leaderboard 
                </div>
            </div>
        </div>
    </a>
    <a href="{{ route('staffleaderboardreport') }}" class="col-span-12 sm:col-span-3 intro-y">
        <div class=" zoom-in">
            <div class="box px-3 py-4">
                <img class="object-contain h-16 w-full" alt="Time Table"
                    src="{{ asset('/image/report/staff_leaderboard.png') }}">
                <div class="text-center text-sm font-medium leading-8 mt-2">Staff Leaderboard 
                </div>
            </div>
        </div>
    </a>
</div>