<div class="col-span-12">
    <div class="grid grid-cols-12 ">
        <div class="col-span-12 mt-4">
            <div class="intro-y flex items-center h-10">
                <h2 class="text-lg font-medium truncate mr-5">Common Sync</h2>
            </div>
            <div class="grid grid-cols-12 gap-y-5 sm:gap-10 mt-5">
                <a href="{{ route('mapboard.index') }}" class="col-span-12 sm:col-span-6 xl:col-span-2 intro-y">
                    <div class="zoom-in">
                        <div class="box px-3 py-4">
                            <img class="object-contain h-16 w-full" alt="Tags"
                                src="{{ asset('/image/settingsicon/onlineassessment/director.png') }}">
                            <div class="text-center text-sm font-medium leading-8 mt-2">Map Board
                            </div>
                        </div>
                    </div>
                </a>

                <a href="{{ route('mapsubject.index') }}" class="col-span-12 sm:col-span-6 xl:col-span-2 intro-y">
                    <div class="zoom-in">
                        <div class="box px-3 py-4">
                            <img class="object-contain h-16 w-full" alt="Report Types"
                                src="{{ asset('/image/settingsicon/onlineassessment/text-books.png') }}">
                            <div class="text-center text-sm font-medium leading-8 mt-2">Map Subject
                            </div>
                        </div>
                    </div>
                </a>
                <a href="{{ route('mapclass.index') }}" class="col-span-12 sm:col-span-6 xl:col-span-2 intro-y">
                    <div class="zoom-in">
                        <div class="box px-3 py-4">
                            <img class="object-contain h-16 w-full" alt="Report Types"
                                src="{{ asset('/image/settingsicon/onlineassessment/class.png') }}">
                            <div class="text-center text-sm font-medium leading-8 mt-2">Map Class
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
