<div class="col-span-12">
    <div class="grid grid-cols-12 ">
        <div class="col-span-12 mt-4">
            <div class="intro-y flex items-center h-10">
                <h2 class="text-lg font-medium truncate mr-5">Leave</h2>
            </div>
            <div class="grid grid-cols-12 gap-y-5 sm:gap-10 mt-5">
                <a href="{{ route('leavetype.index') }}" class="col-span-12 sm:col-span-6 xl:col-span-2 intro-y">
                    <div class="zoom-in">
                        <div class="box px-3 py-4">
                            <img class="object-contain h-16 w-full" alt="Leave Type"
                                src="{{ asset('/image/settingsicon/leave/leave_type.png') }}">
                            <div class="text-center text-sm font-medium leading-8 mt-2">Leave Type
                            </div>
                        </div>
                    </div>
                </a>

                <a href="{{ route('leavedefine.index') }}" class="col-span-12 sm:col-span-6 xl:col-span-2 intro-y">
                    <div class="zoom-in">
                        <div class="box px-3 py-4">
                            <img class="object-contain h-16 w-full" alt="Leave Define"
                                src="{{ asset('/image/settingsicon/leave/leavedefine.png') }}">
                            <div class="text-center text-sm font-medium leading-8 mt-2">Leave Define
                            </div>
                        </div>
                    </div>
                </a>

            </div>
        </div>
    </div>
</div>