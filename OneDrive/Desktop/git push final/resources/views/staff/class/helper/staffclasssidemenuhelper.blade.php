<div class="col-span-12 lg:col-span-2 grid grid-row-4 w-full lg:w-36 mx-auto intro-y h-auto lg:h-20">
    <a wire:click="changetab('attendance')"
        class="col-span-2 box rounded-none {{ $active == 'attendance' ? 'bg-primary dark:bg-primary' : '' }} p-5 cursor-pointer zoom-in shadow-none intro-y">
        @if ($active == 'attendance')
            <i data-feather="calendar" class="text-white mx-auto w-8 h-8"></i>
            <div class="font-medium text-base text-center text-white mt-2">Attendance</div>
        @else
            <i data-feather="calendar" class="mx-auto w-8 h-8"></i>
            <div class="font-medium text-base text-center mt-2">Attendance</div>
        @endif
    </a>
    <a wire:click="changetab('routine')"
        class="col-span-2 box rounded-none {{ $active == 'routine' ? 'bg-primary dark:bg-primary' : '' }} p-5 cursor-pointer zoom-in shadow-none intro-y">
        @if ($active == 'routine')
            <i data-feather="compass" class="text-white mx-auto w-8 h-8"></i>
            <div class="font-medium text-base text-center text-white mt-2">Routine</div>
        @else
            <i data-feather="compass" class="mx-auto w-8 h-8"></i>
            <div class="font-medium text-base text-center mt-2">Routine</div>
        @endif
    </a>
    <a wire:click="changetab('exams')"
        class="col-span-2 box rounded-none {{ $active == 'exams' ? 'bg-primary dark:bg-primary' : '' }} p-5 cursor-pointer zoom-in shadow-none intro-y">
        @if ($active == 'exams')
            <i data-feather="edit" class="text-white mx-auto w-8 h-8"></i>
            <div class="font-medium text-base text-center text-white mt-2">Exams</div>
        @else
            <i data-feather="edit" class="mx-auto w-8 h-8"></i>
            <div class="font-medium text-base text-center mt-2">Exams</div>
        @endif
    </a>
    <a wire:click="changetab('studentprogress')"
        class="col-span-2 box rounded-none {{ $active == 'studentprogress' ? 'bg-primary dark:bg-primary' : '' }} p-5 cursor-pointer zoom-in shadow-none intro-y">
        @if ($active == 'studentprogress')
            <i data-feather="trending-up" class="text-white mx-auto w-8 h-8"></i>
            <div class="font-medium text-base text-center text-white mt-2">Student Progress</div>
        @else
            <i data-feather="trending-up" class="mx-auto w-8 h-8"></i>
            <div class="font-medium text-base text-center mt-2">Student Progress</div>
        @endif
    </a>
</div>
