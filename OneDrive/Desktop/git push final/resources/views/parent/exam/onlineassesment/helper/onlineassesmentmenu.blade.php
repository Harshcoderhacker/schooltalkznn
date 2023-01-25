<div class="col-start-4 col-end-10 hidden md:block lg:block xl:block 2xl:block">
    <div class=" intro-y pr-1">
        <div class="box rounded-3xl">
            <div class="nav justify-center">
                <a href="{{ route('parentonliveonlineassesment') }}"
                    class="flex-1 py-2 text-sm font-semibold rounded-3xl text-center  {{ $active == 'onlive' ? 'bg-primary text-white' : '' }}">Online
                </a>
                <a href="{{ route('parentoupcomingonlineassesment') }}"
                    class="flex-1 py-2 text-sm font-semibold rounded-3xl text-center  {{ $active == 'upcoming' ? 'bg-primary text-white' : '' }}">Upcoming</a>
                <a href="{{ route('parentcompletedonlineassesment') }}"
                    class="flex-1 py-2 text-sm font-semibold rounded-3xl text-center  {{ $active == 'completed' ? 'bg-primary text-white' : '' }}">Completed</a>
            </div>
        </div>
    </div>
</div>