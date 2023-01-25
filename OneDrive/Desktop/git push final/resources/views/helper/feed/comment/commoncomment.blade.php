<div>
    <div class="flex items-center px-5 py-3 border-t border-slate-200/60 dark:border-darkmode-400">
        @include('helper.feed.feedpostlike', [
            'method' => 'feedpostlike',
            'id' => $feedpost->id,
            'platform' => $platform,
        ])
    </div>
    <div class="px-5 pt-3 pb-5 border-t border-slate-200/60 dark:border-darkmode-400">
        <div class="w-full flex items-center text-slate-500 text-xs sm:text-sm">
            <div class="mr-2">
                Likes: <span class="font-medium">{{ $feedpost->feedpostlike_count }}</span>
            </div>
            @include('helper.feed.feedpostlikelist')
            <div class="ml-auto">
                Comments: <span class="font-medium">{{ $feedpost->feedcomment_count }}</span>
            </div>
        </div>
        {{-- Comment --}}
        @if ($feedpost->feedcomment_count > 0)
            @include('helper.feed.comment.comment')
        @endif
        <div class="w-full flex items-center mt-3">
            <div class="w-8 h-8 flex-none image-fit mr-3">
                @if ($user->avatar)
                    <img alt="{{ $user->name }} image" class="rounded-full"
                        src="{{ url('storage/' . $user->avatar) }}">
                @else
                    <img alt="{{ $user->name }} image" class="rounded-full"
                        src="{{ asset('dist/images/placeholders/200x200.jpg') }}">
                @endif
            </div>
            <div class="flex-1 relative text-slate-600 dark:text-slate-200">
                <input wire:model="post_comment" type="text"
                    wire:keydown.enter="postfeedcomment({{ $feedpost->id }})"
                    class="form-control form-control-rounded border-transparent bg-slate-100 pr-10"
                    placeholder="Post a comment...">
                <div wire:loading wire:target="postfeedcomment">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"
                        class="feather feather-loader animate-spin  w-4 h-4 absolute inset-y-0 my-3 mr-3 right-0">
                        <line x1="12" y1="2" x2="12" y2="6"></line>
                        <line x1="12" y1="18" x2="12" y2="22"></line>
                        <line x1="4.93" y1="4.93" x2="7.76" y2="7.76"></line>
                        <line x1="16.24" y1="16.24" x2="19.07" y2="19.07"></line>
                        <line x1="2" y1="12" x2="6" y2="12"></line>
                        <line x1="18" y1="12" x2="22" y2="12"></line>
                        <line x1="4.93" y1="19.07" x2="7.76" y2="16.24"></line>
                        <line x1="16.24" y1="7.76" x2="19.07" y2="4.93"></line>
                    </svg>
                </div>
                <a wire:loading.remove wire:target="postfeedcomment" class="{{ $post_comment ? '' : 'disabled' }}"
                    wire:click="postfeedcomment({{ $feedpost->id }})"><svg xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round"
                        class="feather feather-send w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0">
                        <line x1="22" y1="2" x2="11" y2="13"></line>
                        <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                    </svg>
                </a>
            </div>
        </div>
    </div>
    @if ($openfeedlikelistmodal)
        <div class="fixed inset-0 z-50 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <div
            class="mt-10 right-0 left-0 z-50 justify-center items-start h-modal md:h-full inset-0 fixed pin overflow-auto bg-smoke-dark flex">
            <div class="bg-white rounded-lg dark:bg-gray-700 lg:w-96 shadow-2xl">
                <div class="flex justify-between items-center p-2 rounded-t border-b dark:border-gray-600 bg-primary">
                    <h3 class="text-md font-semibold text-white">
                        Liked People
                    </h3>
                    <button wire:click="closefeedpostlikemodal"
                        class="text-white bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="defaultModal">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <div class="p-6 space-y-6">
                    <div class="h-32 overflow-y-auto">
                        @foreach ($feedpost->feedpostlike as $key => $eachpostlikelist)
                            @if ($key <= 2)
                                <div class="flex intro-x gap-4 items-center">
                                    @if ($eachpostlikelist->feedpostlikeable->avatar)
                                        <img alt="Rubick Tailwind HTML Admin Template"
                                            class="rounded-full border border-white zoom-in tooltip w-8 h-8 image-fit"
                                            src="{{ url('storage/' . $eachpostlikelist->feedpostlikeable->avatar) }}"
                                            title="{{ $eachpostlikelist->feedpostlikeable->name }} - ({{ $eachpostlikelist->feedpostlikeable->usertype }})">
                                    @else
                                        <img alt="Rubick Tailwind HTML Admin Template"
                                            class="rounded-full border border-white zoom-in tooltip w-8 h-8 image-fit"
                                            src="{{ asset('dist/images/placeholders/200x200.jpg') }}"
                                            title="{{ $eachpostlikelist->feedpostlikeable->name }} - ({{ $eachpostlikelist->feedpostlikeable->usertype }})">
                                    @endif
                                    <p>{{ $eachpostlikelist->feedpostlikeable->name }} -
                                        ({{ $eachpostlikelist->feedpostlikeable->usertype }})
                                    </p>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
