<div class="fixed inset-0 z-50 transition-opacity">
    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
</div>
<div class="right-0 left-0 justify-center items-center h-modal md:h-full inset-0 fixed pin overflow-auto bg-smoke-dark flex"
    style="z-index:10000;">
    <div class="bg-white rounded-lg dark:bg-gray-700 w-full max-w-lg shadow-2xl">
        <div class="flex justify-between items-center p-2 rounded-t border-b dark:border-gray-600 bg-primary">
            <h3 class="text-lg font-semibold text-white">
                Post Poll
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
        <div class="p-6">
            <div>
                <label for="poll_post" class="form-label font-medium text-lg">Post</label>
                <textarea autocomplete="off" wire:model.lazy="poll_post" name="poll_post" id="poll_post" type="text"
                    class="form-control" rows="5" style="resize:none;"
                    placeholder="Share your thoughts over here. Get to know your peers opinions">
                        </textarea>
                @error('poll_post') <span class="font-semibold text-red-600 mt-2">{{ $message
                    }}</span>
                @enderror
            </div>
            @foreach ($poll as $pollkey => $eachpoll)
            <div class="mt-3 flex gap-2">
                <input autocomplete="off" wire:model.lazy="poll.{{ $pollkey }}.name" type="text" class="form-control"
                    placeholder="Poll">
                @if($pollkey > 1)
                @include('helper.multientries.delete',[
                'method' => "removepoll",
                'id' =>$pollkey,
                ])
                @endif
            </div>
            @error('poll.' . $pollkey . '.name') <span class="font-semibold text-danger">{{ $message
                }}</span>
            @enderror
            @endforeach
            @if (sizeof($poll) < 4) <div>
                <button wire:click="addpoll" class="mt-3 btn btn-success text-white">
                    ADD POLL</button>
        </div>
        @endif
    </div>
    <div class="flex flex-row-reverse items-center p-3 gap-2 rounded-b border-t border-gray-200 dark:border-gray-600">
        <button type="button" wire:click="closemodal"
            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600">Cancel</button>
        <button wire:click="createpost(3, true)" class="btn btn-primary">Post</button>
    </div>
</div>