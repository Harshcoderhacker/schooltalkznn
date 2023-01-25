<div class="col-span-12">
    <div class="grid grid-cols-12 ">
        <div class="col-span-12 mt-4">
            <div class="intro-y flex items-center h-10">
                <h2 class="text-lg font-medium truncate mr-5">Front Desk</h2>
            </div>
            <div class="grid grid-cols-12 gap-y-5 sm:gap-10 mt-5">
                <a href="{{ route('source.index') }}" class="col-span-12 sm:col-span-6 xl:col-span-2 intro-y">
                    <div class="zoom-in">
                        <div class="box px-3 py-4">
                            <img class="object-contain h-16 w-full" alt="Source"
                                src="{{ asset('/image/settingsicon/frontdesk/source.png') }}">
                            <div class="text-center text-sm font-medium leading-8 mt-2">Source
                            </div>
                        </div>
                    </div>
                </a>
                <a href="{{ route('reference.index') }}" class="col-span-12 sm:col-span-6 xl:col-span-2 intro-y">
                    <div class="zoom-in">
                        <div class="box px-3 py-4">
                            <img class="object-contain h-16 w-full" alt="Reference"
                                src="{{ asset('/image/settingsicon/frontdesk/reference.png') }}">
                            <div class="text-center text-sm font-medium leading-8 mt-2">Reference
                            </div>
                        </div>
                    </div>
                </a>

                <a href="{{ route('complainttype.index') }}" class="col-span-12 sm:col-span-6 xl:col-span-2 intro-y">
                    <div class="zoom-in">
                        <div class="box px-3 py-4">
                            <img class="object-contain h-16 w-full" alt="Complaint Type"
                                src="{{ asset('/image/settingsicon/frontdesk/complaint_type.png') }}">
                            <div class="text-center text-sm font-medium leading-8 mt-2">Complaint Type
                            </div>
                        </div>
                    </div>
                </a>


                <a href="{{ route('purpose.index') }}" class="col-span-12 sm:col-span-6 xl:col-span-2 intro-y">
                    <div class="zoom-in">
                        <div class="box px-3 py-4">
                            <img class="object-contain h-16 w-full" alt="Purpose"
                                src="{{ asset('/image/settingsicon/frontdesk/purpose.png') }}">
                            <div class="text-center text-sm font-medium leading-8 mt-2">Purpose
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>