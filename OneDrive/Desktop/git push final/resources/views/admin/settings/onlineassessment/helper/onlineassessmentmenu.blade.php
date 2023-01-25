<div class="col-start-5 col-end-9 hidden md:block lg:block xl:block 2xl:block">
    <div class=" intro-y pr-1">
        <div class="box rounded-3xl">
            <div class="nav justify-center">
                <a href="{{ route('mapboard.index') }}"
                    class="flex-1 py-2 text-sm font-semibold rounded-3xl text-center  {{ $active == 'mapboard' ? 'bg-primary text-white' : '' }}">Map Board</a>
                <a href="{{ route('mapsubject.index') }}"
                    class="flex-1 py-2 text-sm font-semibold rounded-3xl text-center  {{ $active == 'mapsubject' ? 'bg-primary text-white' : '' }}">Map Subject</a>
                <a href="{{ route('mapclass.index') }}"
                    class="flex-1 py-2 text-sm font-semibold rounded-3xl text-center  {{ $active == 'mapclass' ? 'bg-primary text-white' : '' }}">Map Class</a>
            </div>
        </div>
    </div>
</div>