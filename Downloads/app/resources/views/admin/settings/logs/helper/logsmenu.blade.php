<div class="col-start-5 col-end-9 hidden md:block lg:block xl:block 2xl:block">
    <div class="intro-y pr-1">
        <div class="box rounded-3xl">
            <div class="nav justify-center">
                <a href="{{ route('adminloginlogs') }}"
                    class="flex-1 py-2 text-sm font-semibold rounded-3xl text-center  {{ $active == 'loginlogs' ? 'bg-primary text-white' : '' }}">Login
                    Logs</a>
                <a href="{{ route('adminuseractivitylogs') }}"
                    class="flex-1 py-2 text-sm font-semibold rounded-3xl text-center  {{ $active == 'useractivitylogs' ? 'bg-primary text-white' : '' }}">User
                    Activity Logs</a>
            </div>
        </div>
    </div>
</div>
