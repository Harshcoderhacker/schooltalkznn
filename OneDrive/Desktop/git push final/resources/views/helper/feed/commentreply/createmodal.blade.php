<div class="fixed inset-0 z-50 transition-opacity">
    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
</div>
<div class="right-0 left-0 justify-center items-center h-modal md:h-full inset-0 fixed pin overflow-auto bg-smoke-dark flex"
    style="z-index:10000;">
    <div class="bg-white rounded-lg dark:bg-gray-700 w-full max-w-lg shadow-2xl">
        <div class="flex justify-between items-center p-2 rounded-t border-b dark:border-gray-600 bg-primary">
            <h3 class="text-lg font-semibold text-white">
                Comment Reply
            </h3>
            <button wire:click="closemodal"
                class="text-white bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                data-modal-toggle="defaultModal">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd"
                        d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>
        </div>
        @if ($comment)
            <div class="p-6 space-y-6">
                <div
                    class="mt-5 relative before:block before:absolute before:w-px before:h-[85%] before:bg-slate-200 before:dark:bg-darkmode-400 before:ml-5 before:mt-5">
                    <div class="intro-x relative flex items-center mb-3">
                        <div
                            class="before:block before:absolute before:w-20 before:h-px before:bg-slate-200 before:dark:bg-darkmode-400 before:mt-5 before:ml-5">
                            <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
                                @if ($comment->feedcommentable->avatar)
                                    <img alt="{{ $comment->feedcommentable->name }} image" class="rounded-full"
                                        src="{{ url('storage/' . $comment->feedcommentable->avatar) }}">
                                @else
                                    <img alt=" {{ $comment->feedcommentable->name }} image" class="rounded-full"
                                        src="{{ asset('dist/images/placeholders/200x200.jpg') }}">
                                @endif
                            </div>
                        </div>
                        <div class="box px-5 py-3 ml-4 flex-1 zoom-in">
                            <div class="flex items-center">
                                <div class="font-medium">{{ $comment->feedcommentable->name }}</div>
                                <div class="text-xs text-slate-500 ml-auto">
                                    {{ $comment->created_at->diffForhumans() }}
                                </div>
                            </div>
                            <div class="text-slate-500 mt-1">{{ $comment->comment }}</div>
                        </div>
                    </div>
                    <div class="intro-x relative flex items-center mb-3">
                        <div
                            class="before:block before:absolute before:w-20 before:h-px before:bg-slate-200 before:dark:bg-darkmode-400 before:mt-5 before:ml-5">
                            <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
                                @if ($this->user->avatar)
                                    <img alt="{{ $this->user->name }} image" class="rounded-full"
                                        src="{{ url('storage/' . $this->user->avatar) }}">
                                @else
                                    <img alt=" {{ $this->user->name }} image" class="rounded-full"
                                        src="{{ asset('dist/images/placeholders/200x200.jpg') }}">
                                @endif
                            </div>
                        </div>
                        <div class="box px-5 py-3 ml-4 flex-1">
                            <div class="flex items-center">
                                <div class="font-medium">{{ $this->user->name }}</div>
                            </div>
                            <textarea wire:model="commentreply_post" class="form-control mt-2" rows="2"
                                style="resize: none;">
                        </textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="flex flex-row-reverse items-center p-3 gap-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                <button type="button" wire:click="closemodal"
                    class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-200 dark:hover:text-white dark:hover:bg-gray-600">Cancel</button>
                <button {{ strlen($commentreply_post) > 0 ? '' : 'disabled' }}
                    wire:click="createcommentreply({{ $comment->id }})" class="btn btn-primary">Reply</button>
            </div>
        @endif
    </div>
</div>
