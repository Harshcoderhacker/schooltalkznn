<div class="mt-5 pt-2 border-t border-slate-200/60 dark:border-darkmode-400">
    @foreach ($feedcomment->feedcommentreply()->where('active', true)->take($commentreplypagination)->latest()->get()
    as $eachcommentreply)
        <div class="flex mt-3">
            <div class="w-5 h-5 sm:w-10 sm:h-10 flex-none image-fit">
                @if ($eachcommentreply->feedcommentreplyable->avatar)
                    <img alt="{{ $eachcommentreply->feedcommentreplyable->name }} image" class="rounded-full"
                        src="{{ url('storage/' . $eachcommentreply->feedcommentreplyable->avatar) }}">
                @else
                    <img alt="{{ $eachcommentreply->feedcommentreplyable->name }} image" class="rounded-full"
                        src="{{ asset('dist/images/placeholders/200x200.jpg') }}">
                @endif
            </div>
            <div class="w-full">
                <div class="ml-3">
                    <div class="flex items-center">
                        <p class="font-medium">{{ $eachcommentreply->feedcommentreplyable->name }}
                            <span
                                class="font-sm">({{ $eachcommentreply->feedcommentreplyable->usertype }})</span>
                            </a>
                            @if ($eachcommentreply->feedcommentreplyable->uuid == $user->uuid || $platform == 'admin')
                                <div class="flex ml-auto text-xs text-slate-500">
                                    @include('helper.feed.feedpostcommentreplymenu',
                                    [
                                    'uuid' => $eachcommentreply->uuid,
                                    'id' => $eachcommentreply->id
                                    ])
                                </div>
                            @endif
                    </div>
                    <div class="text-slate-500 text-xs sm:text-sm">
                        {{ $eachcommentreply->created_at->diffForhumans() }}
                    </div>
                    <div class="mt-2">{{ $eachcommentreply->reply }}</div>
                </div>
            </div>
        </div>
    @endforeach
    @if ($commentreplycount > 3 && $commentreplypagination < $commentreplycount)
        <div class="text-center">
            <button wire:click="paginatecommentreply(3)">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-plus-circle">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="16"></line>
                    <line x1="8" y1="12" x2="16" y2="12"></line>
                </svg>
            </button>
        </div>
        <a wire:click="paginatecommentreply(1000)"
            class="mt-5 text-slate-600 dark:text-slate-500 p-3 underline hover:underline-offset-4">View All
            <span class="font-bold">{{ $feedcomment->feedcommentreply()->count() }}</span> Replies
        </a>
    @endif
    @if ($commentreplyeditmodal)
        @include('helper.feed.commentreply.editmodal')
    @endif
</div>
