<div>
    <div class="intro-y chat grid grid-cols-12 gap-5 mt-5">
        <!-- BEGIN: Chat Side Menu -->
        <div class="col-span-12 lg:col-span-4">
            <div class="intro-y pr-1">
                <div class="box p-2">
                    <ul class="nav nav-pills" role="tablist">
                        <li id="chats-tab" class="nav-item flex-1" role="presentation">
                            <button class="nav-link w-full py-2 active" data-tw-toggle="pill" data-tw-target="#chats"
                                type="button" role="tab" aria-controls="chats" aria-selected="true">
                                Recent
                            </button>
                        </li>
                        <li id="groupchat-tab" class="nav-item flex-1" role="presentation">
                            <button class="nav-link w-full py-2" data-tw-toggle="pill" data-tw-target="#groupchat"
                                type="button" role="tab" aria-controls="groupchat" aria-selected="false">
                                Groups
                            </button>
                        </li>
                        <li id="contact-tab" class="nav-item flex-1" role="presentation">
                            <button class="nav-link w-full py-2" data-tw-toggle="pill" data-tw-target="#contact"
                                type="button" role="tab" aria-controls="contact" aria-selected="false">
                                Contact
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="tab-content">
                <div id="chats" class="tab-pane active" role="tabpanel" aria-labelledby="chats-tab">
                    <div class="pr-1 mt-4">
                        <div class="relative text-slate-500">
                            <input type="text" class="form-control py-3 px-4 border-transparent bg-slate-100 pr-10"
                                placeholder="Search for messages or users...">
                            <i class="w-4 h-4 hidden sm:absolute my-auto inset-y-0 mr-3 right-0"
                                data-feather="search"></i>
                        </div>
                    </div>
                    <div class="chat__chat-list overflow-y-auto scrollbar-hidden pr-1 pt-1 mt-4">
                        @if ($chatrecentlist->count() > 0)
                            @foreach ($chatrecentlist as $key => $eachchatrecent)
                                <div wire:click="chatmessagefunction('{{ $eachchatrecent->uuid }}')"
                                    class="intro-x cursor-pointer box relative w-full flex items-center p-5 {{ $key ? 'mt-5' : '' }}">
                                    <div class="w-12 h-12 flex-none image-fit mr-1">
                                        <img alt="Edfish" class="rounded-full"
                                            src="{{ asset('dist/images/placeholders/200x200.jpg') }}">
                                        {{-- Online icon --}}
                                        <div
                                            class="w-3 h-3 bg-success absolute right-0 bottom-0 rounded-full border-2 border-white dark:border-darkmode-600">
                                        </div>
                                    </div>
                                    <div class="ml-2 overflow-hidden w-full">
                                        <div class="flex items-center">
                                            <a href="javascript:;"
                                                class="font-medium">{{ $eachchatrecent->groupname }}</a>
                                            <div class="text-xs text-slate-400 ml-auto inline-block">
                                                {{ $eachchatrecent->created_at->diffForhumans() }}</div>
                                        </div>
                                        <div class="w-full truncate text-slate-500 mt-0.5">
                                            Meassage</div>
                                    </div>
                                    @if ($eachchatrecent->unread_count > 0)
                                        <div
                                            class="w-5 h-5 flex items-center justify-center absolute top-0 right-0 text-xs text-white rounded-full bg-primary font-medium -mt-1 -mr-1">
                                            {{ $eachchatrecent->unread_count }}</div>
                                    @endif
                                </div>
                            @endforeach
                        @else
                            @include('helper.datatable.norecordfound')
                        @endif
                    </div>
                </div>
                <div id="groupchat" class="tab-pane active" role="tabpanel" aria-labelledby="chats-tab">
                    <div class="pr-1 mt-4">
                        <div class="relative text-slate-500">
                            <input type="text" class="form-control py-3 px-4 border-transparent bg-slate-100 pr-10"
                                placeholder="Search for messages or users...">
                            <i class="w-4 h-4 hidden sm:absolute my-auto inset-y-0 mr-3 right-0"
                                data-feather="search"></i>
                        </div>
                    </div>
                    <div class="chat__chat-list overflow-y-auto scrollbar-hidden pr-1 pt-1 mt-4">
                        @if ($chatgrouplist->count() > 0)
                            @foreach ($chatgrouplist as $key => $eachchatgroup)
                                <div
                                    class="intro-x cursor-pointer box relative w-full flex items-center p-5 {{ $key ? 'mt-5' : '' }}">
                                    <div class="w-12 h-12 flex-none image-fit mr-1">
                                        <img alt="Edfish" class="rounded-full"
                                            src="{{ asset('dist/images/placeholders/200x200.jpg') }}">
                                        {{-- Online icon --}}
                                        <div
                                            class="w-3 h-3 bg-success absolute right-0 bottom-0 rounded-full border-2 border-white dark:border-darkmode-600">
                                        </div>
                                    </div>
                                    <div class="ml-2 overflow-hidden w-full">
                                        <div class="flex items-center">
                                            <a href="javascript:;"
                                                class="font-medium">{{ $eachchatgroup->groupname }}</a>
                                            <div class="text-xs text-slate-400 ml-auto inline-block">
                                                {{ $eachchatgroup->created_at->diffForhumans() }}</div>
                                        </div>
                                        <div class="w-full truncate text-slate-500 mt-0.5">
                                            Meassage</div>
                                    </div>
                                    @if ($eachchatgroup->unread_count > 0)
                                        <div
                                            class="w-5 h-5 flex items-center justify-center absolute top-0 right-0 text-xs text-white rounded-full bg-primary font-medium -mt-1 -mr-1">
                                            {{ $eachchatgroup->unread_count }}</div>
                                    @endif
                                </div>
                            @endforeach
                        @else
                            @include('helper.datatable.norecordfound')
                        @endif
                    </div>
                </div>
                <div id="contact" class="tab-pane active" role="tabpanel" aria-labelledby="chats-tab">
                    <div class="pr-1 mt-4">
                        <div class="relative text-slate-500">
                            <input type="text" class="form-control py-3 px-4 border-transparent bg-slate-100 pr-10"
                                placeholder="Search for messages or users...">
                            <i class="w-4 h-4 hidden sm:absolute my-auto inset-y-0 mr-3 right-0"
                                data-feather="search"></i>
                        </div>
                    </div>
                    <div class="chat__chat-list overflow-y-auto scrollbar-hidden pr-1 pt-1 mt-4">
                        @if ($chatcontactlist->count() > 0)
                            @foreach ($chatcontactlist as $key => $eachchatcontact)
                                <div
                                    class="intro-x cursor-pointer box relative w-full flex items-center p-5 {{ $key ? 'mt-5' : '' }}">
                                    <div class="w-12 h-12 flex-none image-fit mr-1">
                                        <img alt="Edfish" class="rounded-full"
                                            src="{{ asset('dist/images/placeholders/200x200.jpg') }}">
                                        {{-- Online icon --}}
                                        <div
                                            class="w-3 h-3 bg-success absolute right-0 bottom-0 rounded-full border-2 border-white dark:border-darkmode-600">
                                        </div>
                                    </div>
                                    <div class="ml-2 overflow-hidden w-full">
                                        <div class="flex items-center">
                                            <a href="javascript:;"
                                                class="font-medium">{{ $eachchatcontact->groupname }}</a>
                                            <div class="text-xs text-slate-400 ml-auto inline-block">
                                                {{ $eachchatcontact->created_at->diffForhumans() }}</div>
                                        </div>
                                        <div class="w-full truncate text-slate-500 mt-0.5">
                                            Meassage</div>
                                    </div>
                                    @if ($eachchatcontact->unread_count > 0)
                                        <div
                                            class="w-5 h-5 flex items-center justify-center absolute top-0 right-0 text-xs text-white rounded-full bg-primary font-medium -mt-1 -mr-1">
                                            {{ $eachchatcontact->unread_count }}</div>
                                    @endif
                                </div>
                            @endforeach
                        @else
                            @include('helper.datatable.norecordfound')
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <!-- END: Chat Side Menu -->
        <!-- BEGIN: Chat Content -->
        <div class="intro-y col-span-12 lg:col-span-8">
            <div class="chat__box box">
                <!-- BEGIN: Chat Active -->

                <div class="h-full flex flex-col">
                    <div
                        class="flex flex-col sm:flex-row border-b border-slate-200/60 dark:border-darkmode-400 px-5 py-4">
                        <div class="flex items-center">
                            <div class="w-10 h-10 sm:w-12 sm:h-12 flex-none image-fit relative">

                                @if ($user->avatar)
                                    <img alt="{{ $user->name }} image" class="rounded-full"
                                        src="{{ url('storage/' . $user->avatar) }}">
                                @else
                                    <img alt="{{ $user->name }} image" class="rounded-full"
                                        src="{{ asset('dist/images/placeholders/200x200.jpg') }}">
                                @endif

                            </div>
                            <div class="ml-3 mr-auto">
                                <div class="font-medium text-base">{{ $user->name }}</div>
                                <div class="text-slate-500 text-xs sm:text-sm">Hey, I am using chat <span
                                        class="mx-1">•</span> Online</div>
                            </div>
                        </div>
                    </div>


                    <div class="overflow-y-scroll scrollbar-hidden px-5 pt-5 flex-1" id="msg" style="height: 24rem;">


                        @foreach ($chatmessagelist as $eachchatmessagelist)
                            @if ($eachchatmessagelist->chatmessageable->uuid != $user->uuid)
                                <div class="clear-both"></div>
                                <div class="chat__box__text-box flex items-end float-left mb-4">
                                    <div class="w-10 h-10 hidden sm:block flex-none image-fit relative mr-5">
                                        @if ($eachchatmessagelist->chatmessageable->avatar)
                                            <img alt="{{ $eachchatmessagelist->chatmessageable->name }} image"
                                                class="rounded-full"
                                                src="{{ url('storage/' . $eachchatmessagelist->chatmessageable->avatar) }}">
                                        @else
                                            <img alt="{{ $eachchatmessagelist->chatmessageable->name }} image"
                                                class="rounded-full"
                                                src="{{ asset('dist/images/placeholders/200x200.jpg') }}">
                                        @endif
                                    </div>
                                    <div
                                        class="bg-slate-100 dark:bg-darkmode-400 px-4 py-3 text-slate-500 rounded-r-md rounded-t-md">
                                        {{ $eachchatmessagelist->body }}
                                        <div class="mt-1 text-xs text-slate-500">
                                            {{ $eachchatmessagelist->created_at->diffForhumans() }}</div>
                                    </div>
                                </div>
                            @else
                                <div class="clear-both"></div>
                                <div class="chat__box__text-box flex items-end float-right mb-4">
                                    <div class="bg-primary px-4 py-3 text-white rounded-l-md rounded-t-md">
                                        {{ $eachchatmessagelist->body }}
                                        <div class="mt-1 text-xs text-white text-opacity-80">
                                            {{ $eachchatmessagelist->created_at->diffForhumans() }}</div>
                                    </div>
                                    <div class="w-10 h-10 hidden sm:block flex-none image-fit relative ml-5">
                                        @if ($eachchatmessagelist->chatmessageable->avatar)
                                            <img alt="{{ $eachchatmessagelist->chatmessageable->name }} image"
                                                class="rounded-full"
                                                src="{{ url('storage/' . $eachchatmessagelist->chatmessageable->avatar) }}">
                                        @else
                                            <img alt="{{ $eachchatmessagelist->chatmessageable->name }} image"
                                                class="rounded-full"
                                                src="{{ asset('dist/images/placeholders/200x200.jpg') }}">
                                        @endif
                                    </div>
                                </div>
                            @endif
                        @endforeach

                        {{-- <div class="clear-both"></div>
                        <div class="chat__box__text-box flex items-end float-left mb-4">
                            <div class="w-10 h-10 hidden sm:block flex-none image-fit relative mr-5">
                                <img alt="Edfish" class="rounded-full"
                                    src="{{ asset('dist/images/' . $fakers[0]['photos'][0]) }}">
                            </div>
                            <div
                                class="bg-slate-100 dark:bg-darkmode-400 px-4 py-3 text-slate-500 rounded-r-md rounded-t-md">
                                {{ $fakers[0]['users'][0]['name'] }} is typing
                                <span class="typing-dots ml-1">
                                    <span>.</span>
                                    <span>.</span>
                                    <span>.</span>
                                </span>
                            </div>
                        </div> --}}
                    </div>
                    {{-- <div
                        class="pt-4 pb-10 sm:py-4 flex items-center border-t border-slate-200/60 dark:border-darkmode-400">
                        <textarea class="chat__box__input form-control dark:bg-darkmode-600 h-16 resize-none border-transparent px-5 py-3 shadow-none focus:border-transparent focus:ring-0"
                            rows="1" placeholder="Type your message..."></textarea>

                        <a href="javascript:;"
                            class="w-8 h-8 sm:w-10 sm:h-10 block bg-primary text-white rounded-full flex-none flex items-center justify-center mr-5">
                            <i data-feather="send" class="w-4 h-4"></i>
                        </a>
                    </div> --}}

                    <div class="py-2 px-2 sm:py-2 flex items-center border-t border-gray-200 dark:border-dark-5">
                        <form wire:submit.prevent="sendmessage" class="flex w-full" action="#">
                            <textarea wire:model="body" class="chat__box__input form-control dark:bg-dark-3 h-16 resize-none border-transparent px-5 py-3 shadow-none focus:ring-0"
                                rows="1" placeholder="Type your message...">
                                </textarea>
                            <button type="submit"
                                class="w-8 h-8 sm:w-10 sm:h-10 text-black flex-none flex self-center text-center justify-center mt-5">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-send">
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
                <!-- END: Chat Active -->
                <!-- BEGIN: Chat Default -->
                {{-- <div class="h-full flex items-center">
                    <div class="mx-auto text-center">
                        <div class="w-16 h-16 flex-none image-fit rounded-full overflow-hidden mx-auto">
                            <img alt="Edfish" src="{{ asset('dist/images/' . $fakers[0]['photos'][0]) }}">
                        </div>
                        <div class="mt-3">
                            <div class="font-medium">Hey, {{ $fakers[0]['users'][0]['name'] }}!</div>
                            <div class="text-slate-500 mt-1">Please select a chat to start messaging.</div>
                        </div>
                    </div>
                </div> --}}
                <!-- END: Chat Default -->
            </div>
        </div>
        <!-- END: Chat Content -->
    </div>
</div>
@push('scripts')
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
@endpush
