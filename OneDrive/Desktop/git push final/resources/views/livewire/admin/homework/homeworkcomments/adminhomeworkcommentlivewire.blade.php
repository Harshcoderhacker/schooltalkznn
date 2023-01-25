<div class="intro-y box mt-2">
    <div class="h-full flex flex-col">
        <div class="flex flex-col sm:flex-row border-b border-gray-200 dark:border-dark-5 px-5 py-4 bg-primary">
            <div class="flex items-center">
                <h1 class="font-semibold text-white text-lg">Comment</h1>
            </div>
        </div>
        <div class="chat_container overflow-y-auto px-5 pt-2" id="msg" style="height: 24rem;">
            <div class="clear-both"></div>
            @foreach ($homeworklist->homeworkcomment as $message)
                @if ($user->uuid == $message->homeworkcommentable->uuid)
                    <div class="chat__box__text-box flex gap-3 items-end float-right mb-4" id="{{ $message->id }}">
                        <div class="bg-primary px-4 py-3 text-white rounded-l-md rounded-t-md">
                            {{ $message->body }}
                            <div class="mt-1 text-xs text-theme-21">
                                {{ $message->created_at->format('d M h:i a') }}
                            </div>
                        </div>
                        @if ($user->avatar)
                            <div class="w-10 h-10 hidden sm:block flex-none image-fit relative">
                                <img alt="Edfish School ERP Software" class="rounded-full"
                                    src="{{ url('storage/' . $user->avatar) }}">
                            </div>
                        @else
                            <div class="w-10 h-10 hidden sm:block flex-none image-fit relative">
                                <img alt="Edfish School ERP Software" class="rounded-full"
                                    src="{{ asset('dist/images/placeholders/200x200.jpg') }}">
                            </div>
                        @endif
                    </div>
                    <div class="clear-both"></div>
                @else
                    <div class="chat__box__text-box flex gap-3 items-start float-left mb-4">
                        <div class="w-10 h-10 hidden sm:block flex-none image-fit relative">
                            <img alt="Edfish School ERP Software" class="rounded-full"
                                src="{{ asset('dist/images/placeholders/200x200.jpg') }}">
                        </div>
                        <div>
                            {{ $message->homeworkcommentable->usertype }}
                            <div class="bg-slate-100 dark:bg-white px-4 py-3 text-gray-900 rounded-r-md rounded-t-md">
                                {{ $message->body }}
                                <div class="mt-1 text-xs ">
                                    {{ $message->created_at->format('d M h:i a') }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clear-both"></div>
                @endif
            @endforeach
        </div>
        <div class="py-2 px-2 sm:py-2 flex items-center border-t border-gray-200 dark:border-dark-5">
            <form wire:submit.prevent="sendMessage" class="flex w-full" action="#">
                <textarea wire:model="body"
                    class="chat__box__input form-control dark:bg-dark-3 h-16 resize-none border-transparent px-5 py-3 shadow-none focus:ring-0"
                    rows="1" placeholder="Type your message...">
                    </textarea>
                <button type="submit"
                    class="w-8 h-8 sm:w-10 sm:h-10 block text-black flex-none flex self-center text-center justify-center mt-5">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="feather feather-send">
                        <line x1="22" y1="2" x2="11" y2="13"></line>
                        <polygon points="22 2 15 22 11 13 2 9 22 2"></polygon>
                    </svg>
                </button>
            </form>
        </div>
        <div class="px-3">
            @error('body')
                <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
            @enderror
        </div>
    </div>
    <script>
        $(document).ready(function() {
            var objDiv = document.getElementById("msg");
            objDiv.scrollTop = objDiv.scrollHeight;
        });
        window.livewire.on('scroll', event => {
            var objDiv = document.getElementById("msg");
            objDiv.scrollTop = objDiv.scrollHeight;
        })
    </script>
</div>
