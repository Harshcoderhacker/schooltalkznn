<div class="col-span-12 lg:col-span-12 2xl:col-span-12 hidden md:block lg:block xl:block 2xl:block">
    <div class=" intro-y pr-1">
        <div class="box rounded-3xl">
            <div class="nav justify-center">
                <a href="{{ route('feedtagsettings') }}"
                    class="flex-1 py-2 text-sm font-semibold rounded-3xl text-center  {{ $active == 'feedtag' ? 'bg-primary text-white' : '' }}">Feed
                    Tag</a>
                <a href="{{ route('feedreportsettings') }}"
                    class="flex-1 py-2 text-sm font-semibold rounded-3xl text-center  {{ $active == 'feedreported' ? 'bg-primary text-white' : '' }}">Feed
                    Report</a>
                <a href="{{ route('feedstickersettings') }}"
                    class="flex-1 py-2 text-sm font-semibold rounded-3xl text-center  {{ $active == 'feedsticker' ? 'bg-primary text-white' : '' }}">Feed
                    Stickers</a>
                <a href="{{ route('feedstudentidealibrarysettings') }}"
                    class="flex-1 py-2 text-sm font-semibold rounded-3xl text-center  {{ $active == 'feedstudentidealibrary' ? 'bg-primary text-white' : '' }}">
                    Student Idea Library</a>
                <a href="{{ route('feedstaffidealibrarysettings') }}"
                    class="flex-1 py-2 text-sm font-semibold rounded-3xl text-center  {{ $active == 'feedstaffidealibrary' ? 'bg-primary text-white' : '' }}">
                    Staff Idea Library</a>
            </div>
        </div>
    </div>
</div>
