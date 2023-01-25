<div class="mt-5 pt-2 pb-5 border-t border-slate-200/60 dark:border-darkmode-400">
    @foreach ($feedpost->feedcomment()->where('active', true)->take($commentpagination)->latest()->get()
    as $eachcomment)
        <div class="flex">
            <div class="w-5 h-5 sm:w-10 sm:h-10 flex-none image-fit">
                @if ($eachcomment->feedcommentable->avatar)
                    <img alt="{{ $eachcomment->feedcommentable->name }} image" class="rounded-full"
                        src="{{ url('storage/' . $eachcomment->feedcommentable->avatar) }}">
                @else
                    <img alt="{{ $eachcomment->feedcommentable->name }} image" class="rounded-full"
                        src="{{ asset('dist/images/placeholders/200x200.jpg') }}">
                @endif
            </div>
            <div class="w-full">
                <div class="ml-3">
                    <div class="flex items-center">
                        <p class="font-medium">{{ $eachcomment->feedcommentable->name }}
                            ({{ $eachcomment->feedcommentable->usertype }})
                        </p>
                        @if ($eachcomment->feedcommentable->uuid == $user->uuid || $platform == 'admin')
                            <div class="flex ml-auto text-xs text-slate-500">
                                @include('helper.feed.feedpostcommentmenu', [
                                    'uuid' => $eachcomment->uuid,
                                    'id' => $eachcomment->id,
                                ])
                            </div>
                        @endif
                    </div>
                    <div class="text-slate-500 text-xs sm:text-sm">{{ $eachcomment->created_at->diffForhumans() }}
                    </div>
                    <div class="mt-2">{{ $eachcomment->comment }}</div>
                    <div class="flex">
                        <button wire:click="opencreatereplymodal({{ $eachcomment->id }})"
                            class="mt-1 mx-5 text-slate-600 dark:text-slate-500 hover:underline">Reply</button>
                        @if ($eachcomment->feedcommentreply()->count() > 0)
                            <p class="mt-1 mx-5 text-slate-600 dark:text-slate-500">Replies -
                                {{ $eachcomment->feedcommentreply()->count() }}</p>
                        @endif
                    </div>
                    @if ($eachcomment->feedcommentreply()->count() > 0)
                        @livewire('admin.feed.adminfeedcommentreplylivewire',['comment_id' => $eachcomment->id,
                        'platform' => $platform], key($eachcomment->id))
                    @endif
                </div>
            </div>
        </div>
    @endforeach
    @if ($feedpost->feedcomment_count > 3 && $commentpagination < $feedpost->feedcomment_count)
        <div class="text-center">
            <button wire:click="paginatecomment">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-plus-circle">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="16"></line>
                    <line x1="8" y1="12" x2="16" y2="12"></line>
                </svg>
            </button>
        </div>
    @endif
</div>
