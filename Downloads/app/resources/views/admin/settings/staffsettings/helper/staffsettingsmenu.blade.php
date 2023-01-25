<div class="col-start-5 col-span-4 hidden md:block lg:block xl:block 2xl:block">
    <div class=" intro-y pr-1">
        <div class="box rounded-3xl">
            <div class="nav justify-center">
                <a href="{{ route('staffdesignation.index') }}"
                    class="flex-1 py-2 text-sm font-semibold rounded-3xl text-center  {{ $active == 'staffdesignation' ? 'bg-primary text-white' : '' }}">Designation</a>
                <a href="{{ route('staffdepartment.index') }}"
                    class="flex-1 py-2 text-sm font-semibold rounded-3xl text-center  {{ $active == 'staffdepartment' ? 'bg-primary text-white' : '' }}">Department</a>
            </div>
        </div>
    </div>
</div>