<div class="col-start-5 col-span-4 hidden md:block lg:block xl:block 2xl:block">
    <div class="intro-y pr-1">
        <div class="box rounded-3xl">
            <div class="nav justify-center">
                <a href="{{ route('staffleaverequest') }}"
                    class="flex-1 py-2 text-base rounded-3xl text-center  {{ $active == 'pending' ? 'bg-primary text-white' : '' }}">Pending</a>
                <a href="{{ route('staffapprovedleave') }}"
                    class="flex-1 py-2 text-base rounded-3xl text-center {{ $active == 'approved' ? 'bg-primary text-white' : '' }}">Approved</a>
                <a href="{{ route('staffdeclineleave') }}"
                    class="flex-1 py-2 text-base rounded-3xl text-center {{ $active == 'decline' ? 'bg-primary text-white' : '' }}">Decline</a>
            </div>
        </div>
    </div>
</div>
