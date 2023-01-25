<div class="col-start-5 col-end-9 hidden md:block lg:block xl:block 2xl:block">
    <div class=" intro-y pr-1">
        <div class="box rounded-3xl">
            <div class="nav justify-center">
                <a href="{{ route('adminprofile') }}"
                    class="flex-1 py-2 text-sm font-semibold rounded-3xl text-center  {{ $active == 'profile' ? 'bg-primary text-white' : '' }}">Profile
                </a>
                <a href="{{ route('adminresetpassword') }}"
                    class="flex-1 py-2 text-sm font-semibold rounded-3xl text-center  {{ $active == 'resetpassword' ? 'bg-primary text-white' : '' }}">Reset
                    Password
                </a>
            </div>
        </div>
    </div>
</div>