<div class="intro-y flex items-center h-10">
    <h2 class="text-lg font-medium truncate mr-5">Exam Report</h2>
</div>
<div class="grid grid-cols-12 gap-y-5 sm:gap-6 mt-5 ">
    <a href="{{ route('marksheetreport') }}" class="col-span-12 sm:col-span-3 intro-y">
        <div class=" zoom-in">
            <div class="box px-3 py-4">
                <img class="object-contain h-16 w-full" alt="Time Table"
                    src="{{ asset('/image/report/marksheet_report.png') }}">
                <div class="text-center text-sm font-medium leading-8 mt-2">Marksheet Report
                </div>
            </div>
        </div>
    </a>
    <a href="{{ route('classreport') }}" class="col-span-12 sm:col-span-3 intro-y">
        <div class=" zoom-in">
            <div class="box px-3 py-4">
                <img class="object-contain h-16 w-full" alt="Time Table"
                    src="{{ asset('/image/report/class_report.png') }}">
                <div class="text-center text-sm font-medium leading-8 mt-2">Class Report
                </div>
            </div>
        </div>
    </a>
    <a href="{{ route('classprogress') }}" class="col-span-12 sm:col-span-3 intro-y">
        <div class=" zoom-in">
            <div class="box px-3 py-4">
                <img class="object-contain h-16 w-full" alt="Time Table"
                    src="{{ asset('/image/report/class_progress.png') }}">
                <div class="text-center text-sm font-medium leading-8 mt-2">Class Progress
                </div>
            </div>
        </div>
    </a>
    <a href="{{ route('studentprogress') }}" class="col-span-12 sm:col-span-3 intro-y">
        <div class=" zoom-in">
            <div class="box px-3 py-4">
                <img class="object-contain h-16 w-full" alt="Time Table"
                    src="{{ asset('/image/report/student_progress.png') }}">
                <div class="text-center text-sm font-medium leading-8 mt-2">Student Progress
                </div>
            </div>
        </div>
    </a>
</div>