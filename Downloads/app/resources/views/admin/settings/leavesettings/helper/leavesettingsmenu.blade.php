<div class="col-start-5 col-end-9 hidden md:block lg:block xl:block 2xl:block">
    <div class=" intro-y pr-1">
        <div class="box rounded-3xl">
            <div class="nav justify-center">
                <a href="{{ route('leavetype.index') }}"
                    class="flex-1 py-2 text-sm font-semibold rounded-3xl text-center  {{ $active == 'leavetype' ? 'bg-primary text-white' : '' }}">Leave
                    Type</a>
                <a href="{{ route('leavedefine.index') }}"
                    class="flex-1 py-2 text-sm font-semibold rounded-3xl text-center  {{ $active == 'leavedefine' ? 'bg-primary text-white' : '' }}">Leave
                    Define</a>
            </div>
        </div>
    </div>
</div>