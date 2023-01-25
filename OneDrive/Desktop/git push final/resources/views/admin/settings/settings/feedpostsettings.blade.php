<div class="col-span-12">
    <div class="grid grid-cols-12 ">
        <div class="col-span-12 mt-4">
            <div class="intro-y flex items-center h-10">
                <h2 class="text-lg font-medium truncate mr-5">Feed</h2>
            </div>
            <div class="grid grid-cols-12 gap-y-5 sm:gap-10 mt-5">
                <a href="{{ route('feedtagsettings') }}" class="col-span-12 sm:col-span-6 xl:col-span-2 intro-y">
                    <div class="zoom-in">
                        <div class="box px-3 py-4">
                            <img class="object-contain h-16 w-full" alt="Tags"
                                src="{{ asset('/image/settingsicon/feed/hastag.png') }}">
                            <div class="text-center text-sm font-medium leading-8 mt-2">Tags
                            </div>
                        </div>
                    </div>
                </a>

                <a href="{{ route('feedreportsettings') }}" class="col-span-12 sm:col-span-6 xl:col-span-2 intro-y">
                    <div class="zoom-in">
                        <div class="box px-3 py-4">
                            <img class="object-contain h-16 w-full" alt="Report Types"
                                src="{{ asset('/image/settingsicon/feed/stop-violence.png') }}">
                            <div class="text-center text-sm font-medium leading-8 mt-2">Report Types
                            </div>
                        </div>
                    </div>
                </a>

                <a href="{{ route('feedstickersettings') }}" class="col-span-12 sm:col-span-6 xl:col-span-2 intro-y">
                    <div class="zoom-in">
                        <div class="box px-3 py-4">
                            <img class="object-contain h-16 w-full" alt="Report Types"
                                src="{{ asset('/image/settingsicon/feed/sticker.png') }}">
                            <div class="text-center text-sm font-medium leading-8 mt-2">Feed Stickers
                            </div>
                        </div>
                    </div>
                </a>

                <a href="{{ route('feedstudentidealibrarysettings') }}"
                    class="col-span-12 sm:col-span-6 xl:col-span-2 intro-y">
                    <div class="zoom-in">
                        <div class="box px-3 py-4">
                            <img class="object-contain h-16 w-full" alt="Report Types"
                                src="{{ asset('/image/settingsicon/feed/idea.png') }}">
                            <div class="text-center text-sm font-medium leading-8 mt-2">Student Idea Library
                            </div>
                        </div>
                    </div>
                </a>

                <a href="{{ route('feedstaffidealibrarysettings') }}"
                    class="col-span-12 sm:col-span-6 xl:col-span-2 intro-y">
                    <div class="zoom-in">
                        <div class="box px-3 py-4">
                            <img class="object-contain h-16 w-full" alt="Report Types"
                                src="{{ asset('/image/settingsicon/feed/idea.png') }}">
                            <div class="text-center text-sm font-medium leading-8 mt-2">Staff Idea Library
                            </div>
                        </div>
                    </div>
                </a>

            </div>
        </div>
    </div>
</div>
