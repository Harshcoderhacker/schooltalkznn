<div wire:poll.60s>
    <div class="grid gap-5 grid-cols-12">
        <div class="col-span-12 mt-5">
            <div>
                @if ($type == 1)
                <textarea wire:model.lazy="post" class="form-control" rows="5" style="resize: none;" placeholder="What's on your mind. Share it with your peers....">
                </textarea>
                @elseif($type == 2)
                <textarea wire:model.lazy="post" class="form-control" rows="5" style="resize: none;" placeholder="Congrats on your achievement. Share it with your peers....">
            </textarea>
                @elseif($type == 3)
                <textarea wire:model.lazy="post" class="form-control" rows="5" style="resize: none;" placeholder="What's your poll about?">
            </textarea>
                @endif
                <div>
                    <span wire:ignore>
                        <select class="hastagdropdown" multiple="multiple" hidden>
                            @foreach ($feedtag as $eachtag)
                            <option>{{ $eachtag->name }}</option>
                            @endforeach
                        </select>
                    </span>
                </div>
                @error('post')
                <span class="font-semibold text-red-600 mt-2">{{ $message }}</span>
                @enderror
                @if ($videocreatemodel)
                <div>
                    @if ($video)
                    <video width="320" height="240" controls class="mx-auto">
                        <source src="{{ $video->temporaryUrl() }}" type="video/mp4">
                        Your browser does not support the video tag.
                    </video>
                    @endif
                    <div class="border relative mt-3 rounded intro-x shadow-md mb-3 dark:text-white intro-x">
                        <input wire:model="video" type="file" id="postvideo" accept="video/mp4,video/x-m4v,video/*" class="cursor-pointer relative block opacity-0 w-full h-full p-20 z-50">
                        <div class="text-center p-10 absolute top-0 right-0 left-0 m-auto">
                            <h4>
                                Drop files anywhere to upload
                                <br />or
                            </h4>
                            <p class="">Select Files</p>
                        </div>
                        @error('image')
                        <span class="font-semibold text-red-600 mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                @endif
                @if ($imagecreatemodel)
                <div>
                    @if ($image)
                    <div class="col-span-12 mt-4 mx-auto">
                        <div class="flex gap-4 justify-center">
                            @foreach ($image as $value)
                            <img class="rounded-md image-fit w-20 h-20" src="{{ $value->temporaryUrl() }}">
                            @endforeach
                        </div>
                    </div>
                    @endif
                    <div class="border relative mt-3 rounded intro-x shadow-md mb-3 dark:text-white intro-x">
                        <input wire:model="image" type="file" id="postimage" accept="image/*" class="cursor-pointer relative block opacity-0 w-full h-full p-20 z-50" multiple>
                        <div class="text-center p-10 absolute top-0 right-0 left-0 m-auto">
                            <h4>
                                Drop files anywhere to upload
                                <br />or
                            </h4>
                            <p class="">Select Files</p>
                        </div>
                        @error('image')
                        <span class="font-semibold text-red-600 mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                @endif
                @if ($pollcreatemodel)
                <div class="p-4">
                    @foreach ($poll as $pollkey => $eachpoll)
                    <div class="mt-3 flex gap-2">
                        <input autocomplete="off" wire:model.lazy="poll.{{ $pollkey }}.name" type="text" class="form-control" placeholder="Poll">
                        @if ($pollkey > 1)
                        @include('helper.multientries.delete', [
                        'method' => 'removepoll',
                        'id' => $pollkey,
                        ])
                        @endif
                    </div>
                    @error('poll.' . $pollkey . '.name')
                    <span class="font-semibold text-danger">{{ $message }}</span>
                    @enderror
                    @endforeach
                    @if (sizeof($poll) < 4) <div>
                        <button wire:click="addpoll" class="mt-3 btn btn-success text-white">
                            ADD POLL</button>
                </div>
                @endif
            </div>
            @endif
            <div class="col-span-12 mt-5 mb-5">
                <select name="to_show" wire:model.lazy="to_show" class="rounded form-control">
                    <option value="">Select option</option>
                    <option value="student">Students</option>
                    <option value="admin">Admin</option>
                    <option value="staff">Staff</option>
                </select>
            </div>
            <div class="intro-y flex flex-col sm:flex-row items-center mt-1 mb-8">

                @include('helper.feed.imagepost.imagecreatebutton')

                @include('helper.feed.poll.pollbutton')

                @include('helper.feed.video.videobutton')

                @include('helper.feed.achievement.createbutton')

                <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                    <button wire:click="createpost({{ $type }})" class="btn btn-primary py-2 px-4 w-full xl:w-32 xl:mr-3 align-top text-center" wire:loading.attr="disabled">
                        <div wire:loading>
                            @include('helper.loadingicon.loadingicon')
                        </div>
                        <span wire:loading.remove>Post Now</span>
                    </button>
                </div>
            </div>
            {{-- Feed Post List --}}
            @if ($feedpost->isNotEmpty())
            <div class="grid gap-5 grid-cols-12">
                <div class="col-span-12 lg:col-span-6 mt-5">
                    @foreach ($feedpost as $key => $eachfeedpost)
                    @if( $user['usertype'] == strtoupper( $eachfeedpost['to_show']) || $user['usertype'] == 0)
                    @if ($key % 2 == 0)
                    <div @if ($loop->last) id="last_record" @endif>
                        @livewire('admin.feed.adminfeedpostlistlivewire', ['feedpostid' => $eachfeedpost->id, 'platform' => $platform], key($eachfeedpost->uuid))
                    </div>
                    @endif
                    @endif
                    @endforeach
                </div>
                <div class="col-span-12 lg:col-span-6 mt-5">
                    @foreach ($feedpost as $key => $eachfeedpost)
                    @if( $user['usertype'] == strtoupper( $eachfeedpost['to_show']) || $user['usertype'] == 0)
                    @if ($key % 2 != 0)
                    <div @if ($loop->last) id="last_record" @endif>
                        @livewire('admin.feed.adminfeedpostlistlivewire', ['feedpostid' => $eachfeedpost->id, 'platform' => $platform], key($eachfeedpost->uuid))
                    </div>
                    @endif
                    @endif
                    @endforeach
                </div>
            </div>
            @else
            @include('helper.datatable.norecordfound')
            @endif
        </div>
    </div>
    {{-- <div class="col-span-12 lg:col-span-4 mt-5">
        <div class="intro-x flex items-center h-10">
            <h2 class="text-lg font-medium truncate">Popular Articles</h2>
        </div>
        <div class="box intro-x flex items-center mt-3 mb-3 zoom-in">
            <div class="w-16 h-16 image-fit">
                <img alt="Rubick Tailwind HTML Admin Template" class="mx-3"
                    src="{{ asset('dist/images/placeholders/200x200.jpg') }}">
</div>
<div class="px-5 py-3 flex-1">
    <div class="flex items-center">
        <div class="font-medium">Go for It</div>
        <div class="text-xs text-gray-500 dark:text-gray-100 ml-auto">16 Jan</div>
    </div>
    <div class="text-gray-600 dark:text-gray-400 mt-1">This kid mountain climber shares some secrets
        to success!</div>
</div>
</div>
<div class="box intro-x flex items-center mb-3 zoom-in">
    <div class="w-16 h-16 image-fit">
        <img alt="Rubick Tailwind HTML Admin Template" class="mx-3" src="{{ asset('dist/images/placeholders/200x200.jpg') }}">
    </div>
    <div class="px-5 py-3 flex-1">
        <div class="flex items-center">
            <div class="font-medium">Our Beautiful Town Is Gone</div>
            <div class="text-xs text-gray-500 dark:text-gray-100 ml-auto">16 Jan</div>
        </div>
        <div class="text-gray-600 dark:text-gray-400 mt-1">The story of Paradise, California, and the
            deadliest wildfire in</div>
    </div>
</div>
<div class="box intro-x flex items-center mb-3 zoom-in">
    <div class="w-16 h-16 image-fit">
        <img alt="Rubick Tailwind HTML Admin Template" class="mx-3" src="{{ asset('dist/images/placeholders/200x200.jpg') }}">
    </div>
    <div class="px-5 py-3 flex-1">
        <div class="flex items-center">
            <div class="font-medium">Dolphins on Duty</div>
            <div class="text-xs text-gray-500 dark:text-gray-100 ml-auto">16 Jan</div>
        </div>
        <div class="text-gray-600 dark:text-gray-400 mt-1">The U.S. Navy trains these supersmart animals
            to
            work on lifesaving missions.</div>
    </div>
</div>
</div> --}}
</div>
{{-- ignored because of select 2 --}}
{{-- Archivementmodel --}}
{{-- @if ($achievementmodal)
@include('helper.feed.achievement.createoreditmodal')
@endif --}}
{{-- Imagemodel --}}
{{-- @if ($imagecreatemodel)
@include('helper.feed.imagepost.createmodal')
@endif --}}
{{-- @if ($pollcreatemodel)
@include('helper.feed.poll.createmodal')
@endif --}}
{{-- @if ($feedpostcommenteditmodal)
@include('helper.feed.comment.edit')
@endif --}}
{{-- @if ($commandreplymodal)
@include('helper.feed.commentreply.createmodal')
@endif --}}
<script>
    const lastRecord = document.getElementById('last_record');
    const options = {
        root: null,
        threshold: 1,
        rootMargin: '0px'
    }
    const observer = new IntersectionObserver((entries, observer) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                @this.loadMore()
            }
        });
    });
    observer.observe(lastRecord);
</script>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $(".hastagdropdown").show();
        $(".hastagdropdown").select2({
            placeholder: "Create or Search for Labels",
            maximumSelectionLength: 4,
            tags: true,
            tokenSeparators: [',', ' ']
        });
        $('.hastagdropdown').on('change', function(e) {
            var hastagdropdown = $('.hastagdropdown').select2("val");
            @this.set('selecthastags', hastagdropdown);
        });
        window.addEventListener('clearselected', event => {
            $(".hastagdropdown").val([]).change();
        })
    });
</script>
@endpush