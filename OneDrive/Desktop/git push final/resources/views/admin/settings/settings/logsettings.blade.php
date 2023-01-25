<div class="col-span-12">
    <div class="grid grid-cols-12 ">
        <div class="col-span-12 mt-4">
            <div class="intro-y flex items-center h-10">
                <h2 class="text-lg font-medium truncate mr-5">Log</h2>
            </div>
            <div class="grid grid-cols-12 gap-y-5 sm:gap-10 mt-5">
                <a href="{{ route('adminloginlogs') }}" class="col-span-12 sm:col-span-6 xl:col-span-2 intro-y">
                    <div class="zoom-in">
                        <div class="box px-3 py-4">
                            <img class="object-contain h-16 w-full" alt="Profile"
                                src="{{ asset('/image/settingsicon/logs/logs.png') }}">
                            <div class="text-center text-sm font-medium leading-8 mt-2">Login Logs
                            </div>
                        </div>
                    </div>
                </a>
                <a href="{{ route('adminuseractivitylogs') }}"
                    class="col-span-12 sm:col-span-6 xl:col-span-2 intro-y">
                    <div class="zoom-in">
                        <div class="box px-3 py-4">
                            <img class="object-contain h-16 w-full" alt="Reset Password"
                                src="{{ asset('/image/settingsicon/logs/user.png') }}">
                            <div class="text-center text-sm font-medium leading-8 mt-2">User Logs
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
