<div class="zoom-in intro-y grid grid-cols-12 gap-6 mt-5 shadow-md rounded-lg">
    <div class="intro-y col-span-12 box">
        <div class=" w-full flex items-center px-5 pt-6 z-10">
            <div class="w-10 h-10 flex-none image-fit">
                @if ($feedpost->feedpostable->avatar)
                    <img alt="{{ $feedpost->feedpostable->name }} image" class="rounded-full"
                        src="{{ url('storage/' . $feedpost->feedpostable->avatar) }}">
                @else
                    <img alt=" {{ $feedpost->feedpostable->name }} image" class="rounded-full"
                        src="{{ asset('dist/images/placeholders/200x200.jpg') }}">
                @endif
            </div>
            <div class="ml-3 text-gray-800 dark:text-white mr-auto">
                <div class="flex gap-2">
                    <p class="font-medium">{{ $feedpost->feedpostable->name }}</p>
                    <p class="font-medium">({{ $feedpost->feedpostable->usertype }})</p>
                </div>
                <div class="text-xs mt-0.5">{{ $feedpost->created_at->diffForhumans() }}</div>
            </div>
            @include('helper.feed.feedpostmenu', [
                'id' => $feedpost->id,
                'platform' => $platform,
                'feedpostableuuid' => $feedpost->feedpostable->uuid,
                'feedpost' => $feedpost,
            ])
        </div>
        @if ($editmodel)
            <div class="p-3">
                <textarea autocomplete="off" wire:model.lazy="archivement_post" name="archivement_post"
                    id="archivement_post{{ $post_id }}" type="text" class="form-control" rows="5"
                    style="resize:none;"
                    placeholder="Share your thoughts over here. Get to know your peers opinions"></textarea>
                <div class="flex flex-row-reverse items-center p-1 gap-2 rounded-b">
                    <button type="button" wire:click="closemodal"
                        class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600">Cancel</button>
                    <button wire:click="updatepost({{ $post_id }})" class="btn btn-primary">Update Post</button>
                </div>
            </div>
        @else
            <p class="p-5 text-slate-600 dark:text-slate-500">
                <span>
                    {!! nl2br($feedpost->post) !!}
                </span>
                <br>
                <span class="text-primary font-semibold">
                    @foreach ($feedpost->feedtag->pluck('name') as $eachtagname)
                        <span class="px-1 hover:underline">{{ $eachtagname }}</span>
                    @endforeach
                </span>
            </p>
        @endif
        @if ($platform == 'admin')
            @if (auth()->user()->feedpollcount->where('feedpost_id', $feedpost->id)->count() > 0)
                <div class="w-11/12 mx-auto mb-3">
                    @foreach ($feedpost->feedpoll as $eachfeedpoll)
                        <div class="grid grid-cols-12 gap-2 mt-2 text-lg">
                            <div class="col-span-10 text-white">
                                <progress class="h-8 rounded" max="100"
                                    value={{ $eachfeedpoll->percentage ? $eachfeedpoll->percentage : '1' }}
                                    data-label="{{ $eachfeedpoll->name }}"></progress>
                            </div>
                            @if (auth()->user()->feedpollcount->where('feedpost_id', $feedpost->id)->where('feedpoll_id', $eachfeedpoll->id)->count() == 0)
                                <div class="col-span-2 ml-auto">
                                    {{ $eachfeedpoll->percentage }}%
                                </div>
                            @else
                                <div class="col-span-2 ml-auto flex items-center gap-2 font-semibold">
                                    @include('helper.feed.styling.check') {{ $eachfeedpoll->percentage }}%
                                </div>
                            @endif
                        </div>
                    @endforeach
                    <div class="mt-2 text-slate-600 dark:text-slate-500">Vote Count -
                        <span class="font-semibold">{{ $feedpost->feedpollcount->count() }}</span>
                    </div>
                </div>
            @else
                <div class="p-2 w-11/12 mx-auto">
                    @foreach ($feedpost->feedpoll as $eachfeedpoll)
                        <div class="flex items-center mt-2">
                            <div class="progress h-8">
                                <a wire:click="votethispoll({{ $eachfeedpoll->id }})" class="progress-bar text-lg"
                                    role="progressbar" aria-valuenow="0" aria-valuemin="0"
                                    aria-valuemax="100">{{ $eachfeedpoll->name }}</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        @elseif($platform == 'staff')
            @if (auth()->guard('staff')->user()->feedpollcount->where('feedpost_id', $feedpost->id)->count() > 0)
                <div class="w-11/12 mx-auto mb-3">
                    @foreach ($feedpost->feedpoll as $eachfeedpoll)
                        <div class="grid grid-cols-12 gap-2 mt-2 text-lg">
                            <div class="col-span-10 text-white">
                                <progress class="h-8 rounded" max="100"
                                    value={{ $eachfeedpoll->percentage ? $eachfeedpoll->percentage : '1' }}
                                    data-label="{{ $eachfeedpoll->name }}"></progress>
                            </div>
                            @if (auth()->guard('staff')->user()->feedpollcount->where('feedpost_id', $feedpost->id)->where('feedpoll_id', $eachfeedpoll->id)->count() == 0)
                                <div class="col-span-2 ml-auto">
                                    {{ $eachfeedpoll->percentage }}%
                                </div>
                            @else
                                <div class="col-span-2 ml-auto flex items-center gap-2 font-semibold">
                                    @include('helper.feed.styling.check') {{ $eachfeedpoll->percentage }}%
                                </div>
                            @endif
                        </div>
                    @endforeach
                    <div class="mt-2 text-slate-600 dark:text-slate-500">Vote Count -
                        <span class="font-semibold">{{ $feedpost->feedpollcount->count() }}</span>
                    </div>
                </div>
            @else
                <div class="p-2 w-11/12 mx-auto">
                    @foreach ($feedpost->feedpoll as $eachfeedpoll)
                        <div class="flex items-center mt-2">
                            <div class="progress h-8">
                                <a wire:click="votethispoll({{ $eachfeedpoll->id }})" class="progress-bar text-lg"
                                    role="progressbar" aria-valuenow="0" aria-valuemin="0"
                                    aria-valuemax="100">{{ $eachfeedpoll->name }}</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        @elseif($platform == 'student')
            @if (\App\Models\Admin\Student\Student::find($user->id)->feedpollcount->where('feedpost_id', $feedpost->id)->count() > 0)
                <div class="w-11/12 mx-auto mb-3">
                    @foreach ($feedpost->feedpoll as $eachfeedpoll)
                        <div class="grid grid-cols-12 gap-2 mt-2 text-lg">
                            <div class="col-span-10 text-white">
                                <progress class="h-8 rounded" max="100"
                                    value={{ $eachfeedpoll->percentage ? $eachfeedpoll->percentage : '1' }}
                                    data-label="{{ $eachfeedpoll->name }}"></progress>
                            </div>
                            @if (\App\Models\Admin\Student\Student::find($user->id)->feedpollcount->where('feedpost_id', $feedpost->id)->where('feedpoll_id', $eachfeedpoll->id)->count() == 0)
                                <div class="col-span-2 ml-auto">
                                    {{ $eachfeedpoll->percentage }}%
                                </div>
                            @else
                                <div class="col-span-2 ml-auto flex items-center gap-2 font-semibold">
                                    @include('helper.feed.styling.check') {{ $eachfeedpoll->percentage }}%
                                </div>
                            @endif
                        </div>
                    @endforeach
                    <div class="mt-2 text-slate-600 dark:text-slate-500">Vote Count -
                        <span class="font-semibold">{{ $feedpost->feedpollcount->count() }}</span>
                    </div>
                </div>
            @else
                <div class="p-2 w-11/12 mx-auto">
                    @foreach ($feedpost->feedpoll as $eachfeedpoll)
                        <div class="flex items-center mt-2">
                            <div class="progress h-8">
                                <a wire:click="votethispoll({{ $eachfeedpoll->id }})" class="progress-bar text-lg"
                                    role="progressbar" aria-valuenow="0" aria-valuemin="0"
                                    aria-valuemax="100">{{ $eachfeedpoll->name }}</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        @endif
        @livewire('admin.feed.adminfeedcommentlivewire', ["feedpost" => $feedpost->id, "platform" =>$platform],
        key($feedpost->id))
    </div>
</div>
