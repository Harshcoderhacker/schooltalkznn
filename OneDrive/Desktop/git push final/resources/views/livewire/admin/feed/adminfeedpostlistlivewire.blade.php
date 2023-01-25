<div>
    @if ($feedpost)
        @if ($feedpost->is_mediatype == 2)
            <div id={{ $feedpost->uuid }}>
                @include('helper.feed.videopost.videopost')
            </div>
        @endif
        @if ($feedpost->type == 2)
            @if ($feedpost->image == null)
                <div id={{ $feedpost->uuid }}>
                    @include('helper.feed.achievementfeed.post')
                </div>
            @else
                <div id={{ $feedpost->uuid }}>
                    @include('helper.feed.imagefeed.post')
                </div>
            @endif
        @elseif($feedpost->type == 1)
            @if ($feedpost->image == null)
                <div id={{ $feedpost->uuid }}>
                    @include('helper.feed.achievementfeed.post')
                </div>
            @else
                <div id={{ $feedpost->uuid }}>
                    @include('helper.feed.imagefeed.post')
                </div>
            @endif
        @elseif($feedpost->type == 3)
            <div id={{ $feedpost->uuid }}>
                @include('helper.feed.pollfeed.post')
            </div>
        @endif
    @endif
    @if ($reportpost)
        <div class="fixed inset-0 z-50 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <div
            class="right-0 left-0 z-50 justify-center items-center h-modal md:h-full inset-0 fixed pin overflow-auto bg-smoke-dark flex">
            <div class="bg-white rounded-lg dark:bg-gray-700 lg:w-96 shadow-2xl">
                <div class="flex justify-between items-center p-2 rounded-t border-b dark:border-gray-600 bg-primary">
                    <h3 class="text-lg font-semibold text-white">
                        Report Post
                    </h3>
                    <button wire:click="closereportmodal"
                        class="text-white bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="defaultModal">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                @if ($user->feedreportedpivot->where('feedpost_id', $feedpost->id)->count() == 0)
                    <div class="p-6 space-y-6">
                        @foreach ($feedreport as $eachfeedreport)
                            <div class="flex">
                                <div>
                                    <div class="form-check">
                                        <input wire:model="reportid"
                                            class="form-check-input appearance-none rounded-full h-4 w-4 border border-gray-300 bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer"
                                            type="radio" name="flexRadioDefault" id={{ $eachfeedreport->name }}
                                            value="{{ $eachfeedreport->id }}">
                                        <label class="form-check-label inline-block text-gray-800 dark:text-white"
                                            for={{ $eachfeedreport->name }}>
                                            {{ $eachfeedreport->name }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @error('reportid')
                            <span class="font-semibold text-red-600 mt-2">{{ $message }}</span>
                        @enderror
                    </div>
                    <div
                        class="flex flex-row-reverse items-center p-3 gap-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                        <button type="button" wire:click="closereportmodal"
                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600">Cancel</button>
                        <button type="submit" wire:click="reportthispost({{ $post_id }})"
                            class="btn btn-primary">Report</button>
                    </div>
                @else
                    <div class="p-6">
                        <p> You have already reported this Post we will look into this post and take it down as soosn as
                            possible if it is against our guidelines.</p>
                    </div>
                @endif
            </div>
        </div>
    @endif
    @if ($reportpoststatusupdatemodal)
        <div class="fixed inset-0 z-50 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <div
            class="mt-10 right-0 left-0 z-50 justify-center items-start h-modal md:h-full inset-0 fixed pin overflow-auto bg-smoke-dark flex">
            <div class="bg-white rounded-lg dark:bg-gray-700 lg:w-96 shadow-2xl">
                <div class="flex justify-between items-center p-2 rounded-t border-b dark:border-gray-600 bg-primary">
                    <h3 class="text-lg font-semibold text-white">
                        Report Post
                    </h3>
                    <button wire:click="closereportmodal"
                        class="text-white bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="defaultModal">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <div class="p-6 space-y-6">
                    @foreach ($reportlist as $eachreportlist)
                        <div class="flex">
                            <p>{{ $eachreportlist->feedreportedpivotable->name }}
                                ({{ $eachreportlist->feedreportedpivotable->usertype }})
                            </p>
                            <p class="ml-auto">
                                {{ App\Models\Admin\Feeds\Feedreported::find($eachreportlist->feedreported_id)->name }}
                            </p>
                        </div>
                    @endforeach
                </div>
                <div
                    class="flex justify-center items-center p-3 gap-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                    <button type="submit" wire:click="updatereportstatus({{ $post_id }}, 3)"
                        class="btn btn-success text-white">Approve</button>
                    <button type="submit" wire:click="updatereportstatus({{ $post_id }}, 4)"
                        class="btn btn-primary">Disapprove</button>
                </div>
            </div>
        </div>
    @endif
</div>
