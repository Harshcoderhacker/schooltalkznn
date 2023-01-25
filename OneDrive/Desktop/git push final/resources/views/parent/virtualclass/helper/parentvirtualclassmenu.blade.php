<div class="col-start-5 col-span-4 hidden md:block lg:block xl:block 2xl:block">
    <div class="intro-y pr-1">
        <div class="box rounded-3xl">
            <div class="nav justify-center">
                <a href="{{ route('parentvirtualclasstoday') }}"
                    class="flex-1 py-2 text-base rounded-3xl text-center  {{ $active == 'today' ? 'bg-primary text-white' : '' }}">Today</a>
                <a href="{{ route('parentvirtualclassupcoming') }}"
                    class="flex-1 py-2 text-base rounded-3xl text-center {{ $active == 'upcoming' ? 'bg-primary text-white' : '' }}">Upcoming</a>
            </div>
        </div>
    </div>
</div>