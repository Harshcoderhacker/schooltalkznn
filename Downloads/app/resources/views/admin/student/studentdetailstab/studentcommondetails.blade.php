<div class="flex flex-col lg:flex-row border-b border-slate-200/60 dark:border-darkmode-400 pb-5 -mx-5">
    <div class="flex flex-1 px-5 items-center justify-center lg:justify-start">
        <div class="w-20 h-20 sm:w-24 sm:h-24 flex-none lg:w-32 lg:h-32 image-fit relative">
            <img alt="Rubick Tailwind HTML Admin Template" class="rounded-full"
                src="{{ $student->photo ? asset('storage/' . $student->photo) : asset('image/avatar/avatar.jpeg') }}">
        </div>
        <div class="ml-5">
            <div class="w-24 sm:w-40 truncate sm:whitespace-normal font-medium text-lg">
                {{ $student->name }}</div>
            <div class="text-slate-500">
                Class {{ $student->classmaster?->name }} -
                {{ $student->section?->name }}
            </div>
            <div class="text-slate-500">
                {{ config('archive.gender')[$student->gender] }}
            </div>
        </div>
    </div>
    <div
        class="mt-6 lg:mt-0 flex-1 px-5 border-l border-r border-slate-200/60 dark:border-darkmode-400 border-t lg:border-t-0 pt-5 lg:pt-0">
        <div class="font-medium text-center lg:text-left lg:mt-3">Contact Details</div>
        <div class="flex flex-col justify-center items-center lg:items-start mt-4">
            <div class="truncate sm:whitespace-normal flex items-center mt-3">
                <i data-feather="phone" class="w-4 h-4 mr-2"></i>
                {{ $student->phone_no }}
            </div>
            <div class="truncate sm:whitespace-normal flex items-center mt-3">
                <i data-feather="mail" class="w-4 h-4 mr-2"></i>{{ $student->email }}
            </div>
            <div class="truncate sm:whitespace-normal mt-3">
                {{ $student->address }}
            </div>
        </div>
    </div>
    <div
        class="mt-6 lg:mt-0 flex-1 flex items-center justify-center  border-t lg:border-0 border-slate-200/60 dark:border-darkmode-400 pt-5 lg:pt-0">
        <div class="text-center rounded-md w-48 py-3">
            <div class="text-slate-500">ACADEMIC YEAR</div>
            <div class="font-medium text-primary text-xl">{{ $student->academicyear?->year }}</div>
        </div>
    </div>
</div>