<div class="grid grid-cols-12 gap-6 mt-2">
    <div class="intro-y col-span-12 lg:col-span-5 sm:mt-8">
        <div class="mt-8">
            <h2 class="text-lg font-medium mr-auto">Classes Behind Due Date</h2>
        </div>
        @foreach ($dueclasses as $eachdueclasses)
            <div class="flex flex-row col-span-3 w-full mt-3 justify-between p-4 items-center text-sm border">
                <div>
                    <span class="text-cyan-500">{{ $eachdueclasses->classmaster->name }} -
                        {{ $eachdueclasses->section->name }}</span><br><span
                        class="font-light">{{ $eachdueclasses->subject->name }}</span>
                </div>
                <div class="text-red-600 text-sm px-3">
                    Due by {{ \Carbon\Carbon::parse($eachdueclasses->due_date)->diffForHumans() }}
                </div>
                <a href="{{ route('adminplanlesson', $eachdueclasses->id) }}" class="font-bold">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z">
                        </path>
                    </svg>
                </a>
            </div>
        @endforeach
    </div>
    <div class="intro-y col-span-12 lg:col-span-5 mt-8">
        {{-- <div class="mt-8">
            <h2 class="text-lg font-medium mr-auto">Classes with less Participation</h2>
        </div>
        <div class="flex flex-row col-span-3 w-full mt-3 justify-between p-4 items-center text-sm border">
            <div>
                <span class="text-cyan-500">Class V-A</span><br><span class="font-light">Physics</span>
            </div>
            <div class="text-green-600 text-sm px-3">
                No Homework created in last two days
            </div>
            <div class="font-bold">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z">
                    </path>
                </svg>
            </div>
        </div>
        <div class="flex flex-row col-span-3 w-full mt-3 justify-between p-4 items-center text-sm border">
            <div>
                <span class="text-cyan-500">Class VI-A</span><br><span class="font-light">Chemistry</span>
            </div>
            <div class="text-yellow-600 text-sm px-3">
                No Assesment created after class completion
            </div>
            <div class="font-bold">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z">
                    </path>
                </svg>
            </div>
        </div>
        <div class="flex flex-row col-span-3 w-full mt-3 justify-between p-4 items-center text-sm border">
            <div>
                <span class="text-cyan-500">Class VIII-A</span><br><span class="font-light">Chemistry</span>
            </div>
            <div class="text-yellow-600 text-sm px-3">
                No Assesment created after class completion
            </div>
            <div class="font-bold">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M5 12h.01M12 12h.01M19 12h.01M6 12a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0zm7 0a1 1 0 11-2 0 1 1 0 012 0z">
                    </path>
                </svg>
            </div>
        </div> --}}
    </div>
    <div class="intro-y col-span-12 lg:col-span-2 mt-8 order-first sm:order-none">
        {{-- <div class="mt-8">
        </div> --}}
        <div class="mt-3">
            <a type="button" href="{{ route('adminplanlesson') }}" class="btn btn-primary sm:mt-10 w-full">Plan
                Lesson</a>
            <a type="button" href="{{ route('adminprogresstrack') }}" class="btn btn-primary mt-2 w-full">Progress
                Track</a>
        </div>
    </div>
</div>
