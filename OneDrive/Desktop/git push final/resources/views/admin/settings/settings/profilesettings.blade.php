<div class="col-span-12">
    <div class="grid grid-cols-12 ">
        <div class="col-span-12 mt-4">
            <div class="intro-y flex items-center h-10">
                <h2 class="text-lg font-medium truncate mr-5">Profile</h2>
            </div>
            <div class="grid grid-cols-12 gap-y-5 sm:gap-10 mt-5">
                <a href="{{ route('adminprofile') }}" class="col-span-12 sm:col-span-6 xl:col-span-2 intro-y">
                    <div class="zoom-in">
                        <div class="box px-3 py-4">
                            <img class="object-contain h-16 w-full" alt="Profile"
                                src="{{ asset('/image/settingsicon/profile/school.png') }}">
                            <div class="text-center text-sm font-medium leading-8 mt-2">Profile
                            </div>
                        </div>
                    </div>
                </a>
                <a href="{{ route('adminresetpassword') }}" class="col-span-12 sm:col-span-6 xl:col-span-2 intro-y">
                    <div class="zoom-in">
                        <div class="box px-3 py-4">
                            <img class="object-contain h-16 w-full" alt="Reset Password"
                                src="{{ asset('/image/settingsicon/profile/refresh.png') }}">
                            <div class="text-center text-sm font-medium leading-8 mt-2">Reset Password
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>