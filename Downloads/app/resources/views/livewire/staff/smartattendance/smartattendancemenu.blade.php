<div class="w-96 ml-auto mt-5 mb-5">
    <div class="intro-y pr-1">
        <div class="box rounded-3xl">
            <div class="nav justify-end">
                <a href="{{ route('smartattendanceindex') }}"
                    class="flex-1 py-2 text-sm font-semibold rounded-3xl text-center {{ $active == 'today' ? 'bg-primary text-white' : '' }}">Today

                </a>
                <a href="{{ route('upcomingsmartattendanceindex') }}"
                    class="flex-1 py-2 text-sm font-semibold rounded-3xl text-center {{ $active == 'upcoming' ? 'bg-primary text-white' : '' }}">Upcoming
                </a>
            </div>
        </div>
    </div>
</div>
