<div class="zoom-in intro-y grid grid-cols-12 gap-6 mt-5 shadow-md rounded-lg" id="{{ $feedpost->uuid }}">
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
                    @if ($feedpost->type == 2)
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none"
                            stroke="orange" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="feather feather-award">
                            <circle cx="12" cy="8" r="7"></circle>
                            <polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline>
                        </svg>
                    @endif
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
                <textarea wire:model.lazy="archivement_post" name="archivement_post" id="archivement_post{{ $post_id }}"
                    type="text" class="form-control" rows="5" style="resize:none;"
                    placeholder="Share your thoughts over here. Get to know your peers opinions"></textarea>
                <select class="section-dropdown" multiple="multiple">
                    @foreach ($feedtag as $eachtag)
                        <option>{{ $eachtag->name }}</option>
                    @endforeach
                </select>
                <div class="flex flex-row-reverse items-center p-1 gap-2 rounded-b">
                    <button type="button" wire:click="closemodal"
                        class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600">Cancel</button>
                    <button wire:click="updatepost({{ $post_id }})" class="btn btn-primary">Update Post</button>
                </div>
            </div>
        @else
            <p class="p-5 text-slate-600 dark:text-slate-500">
                <span class="whitespace-normal break-words">
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
        @livewire('admin.feed.adminfeedcommentlivewire', ["feedpost" => $feedpost->id, "platform" =>$platform],
        key($feedpost->id))
    </div>
</div>

{{-- @push('scripts')
    <script>
        window.loadSelect2 = () => {
            $('.section-dropdown').select2().on('change', function() {
                let data = $(this).val();
                @this.set('hashtags', data);
            });
            $(".section-dropdown").select2({
                placeholder: "Create or Search for Tags",
                maximumSelectionLength: 4,
                tags: true,
                tokenSeparators: [',', ' ']
            });
        }
        loadSelect2();
        window.livewire.on('loadSelect2Hydrate', () => {
            loadSelect2();
        });
    </script>
@endpush --}}