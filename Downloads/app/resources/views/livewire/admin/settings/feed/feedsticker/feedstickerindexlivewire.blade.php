<div>
    <div>
        <div class="intro-y chat grid grid-cols-12 gap-5 mt-5 mb-5">
            @include('admin.settings.feedsettings.helper.feedsettingsmenu', ['active' => 'feedsticker'])
        </div>
        <div class="intro-y chat grid grid-cols-12 gap-5 mt-5 mb-12">
            <div class="col-span-12 xl:col-span-4">
                <div class="intro-y block sm:flex items-center h-10 mx-5">
                    <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100 mr-5">Add Feed Sticker</h2>
                </div>
                <div class="intro-y box p-5 mt-12 sm:mt-5 mx-5 shadow">
                    <form wire:submit.prevent="createorupdate">
                        <div class="relative text-gray-700 dark:text-gray-300">
                            <div>
                                <label for="name_id" class="form-label font-medium">Sticker Name</label>
                                <input wire:model="name" type="text"
                                    class="form-control py-3 px-4 border-transparent bg-gray-200 pr-10 placeholder-theme-13"
                                    placeholder="Sticker Name *" id="name_id" autocomplete="off" autofocus>
                                @error('name')
                                    <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label for="sticker_category" class="form-label font-semibold mt-2">Sticker
                                    Category</label>
                                <select name="sticker_category" wire:model.lazy="sticker_category" id="sticker_category"
                                    class="form-select">
                                    <option>Select A Sticker Category</option>
                                    @foreach (config('archive.sticker_category') as $key => $value)
                                        <option value={{ $key }}>
                                            {{ $value }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('sticker_category')
                                    <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                                @enderror
                            </div>


                            <div>
                                <label for="sticker_path" class="form-label font-medium mt-2">Upload Sticker</label>
                                <input wire:model="sticker_path" type="file"
                                    class="form-control file py-3 px-4 border-transparent bg-gray-200 pr-10 placeholder-theme-13"
                                    id="sticker_path" autocomplete="off" autofocus>
                                @error('sticker_path')
                                    <span class="pristine-error text-red-600 mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div wire:loading wire:target="sticker_path" wire:loading.class="ml-10 my-3">
                                <div>
                                    @include('helper.loadingicon.loadingicon')
                                </div>
                            </div>
                            <div class="mt-2">
                                @if ($sticker_path)
                                    <img class="img-fluid mx-auto d-block rounded-md w-32 h-32"
                                        src="{{ $sticker_path->temporaryUrl() }}">
                                @elseif ($existingpath)
                                    <img class="img-fluid mx-auto d-block rounded-md w-32 h-32"
                                        src="{{ url('storage/' . $existingpath) }}">
                                @endif
                            </div>
                        </div>
                        @if ($stickerid)
                            <div class="flex mt-3 gap-2 justify-center">
                                <button type="submit" {{ $stickerbtn ? 'disabled' : '' }}
                                    class="btn btn-primary">Update
                                    Sticker</button>
                                <a wire:click="formcancel" class="btn btn-danger">Cancel</a>
                            </div>
                        @else
                            <div class="flex mt-3 gap-2 justify-center">
                                <button type="submit" {{ $stickerbtn ? 'disabled' : '' }} class="btn btn-primary">Add
                                    Sticker</button>
                                <a wire:click="formcancel" class="btn btn-danger">Cancel</a>
                            </div>
                        @endif
                    </form>
                </div>
            </div>
            <div class=" col-span-12 xl:col-span-8 ">
                <div class="p-2">
                    <div class="grid grid-cols-12 gap-1">
                        @include('helper.datatable.header', [
                            'title' => 'Sticker List',
                            'search' => 'searchTerm',
                        ])
                        <!-- BEGIN: Data List -->
                        @if ($feedsticker->isNotEmpty())
                            <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                                <table class="table table-report -mt-2">
                                    <thead>
                                        <tr>
                                            <th class="whitespace-nowrap">
                                                S.NO
                                            </th>
                                            <th class="text-center whitespace-nowrap">
                                                <div class="flex">
                                                    Sticker Name

                                                    @include('helper.datatable.sorting', [
                                                        'method' => 'sortBy',
                                                        'value' => 'name',
                                                    ])
                                                </div>
                                            </th>
                                            <th class="whitespace-nowrap">
                                                Sticker Category
                                            </th>
                                            <th class="text-center whitespace-nowrap">ACTIONS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($feedsticker as $index => $value)
                                            <tr class="intro-x">
                                                <td>{{ $feedsticker->firstItem() + $index }}</td>
                                                <td>
                                                    <span class="font-medium whitespace-nowrap">{{ $value->name }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <span
                                                        class="font-medium whitespace-nowrap">{{ config('archive.sticker_category')[$value->sticker_category] }}
                                                    </span>
                                                </td>
                                                <td class="table-report__action w-56">
                                                    <div class="flex justify-center gap-1 items-center">
                                                        @include('helper.datatable.show', [
                                                            'modalname' => 'sticker-show',
                                                            'method' => 'show',
                                                            'id' => $value->id,
                                                        ])
                                                        @include('helper.datatable.edit', [
                                                            'method' => 'edit',
                                                            'id' => $value->id,
                                                        ])

                                                        {{-- @include('helper.datatable.delete', [
                                                            'method' => 'deleteconfirm',
                                                            'id' => $value->id,
                                                        ]) --}}

                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @include('helper.datatable.pagination', [
                                'pagination' => $feedsticker,
                            ])
                        @elseif($searchTerm && $feedsticker->isEmpty())
                            @include('helper.datatable.norecordfound')
                        @else
                        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center p-10 box mt-4 bg-blue-100 leading-6">
                            <div class="mx-auto flex flex-row items-center">
                                <div>
                                    <p class="text-2xl font-bold text-gray-900 dark:text-gray-100 dark:text-white mr-5">Kindly Enter, Select and Upload</p>
                                    <p class="text-2xl mt-2 font-bold"> <span class="text-green-500">Sticker Name, Sticker Type and Sticker</span></p>
                                    <p class="text-2xl mt-2 font-bold text-gray-900 dark:text-gray-100 dark:text-white mr-5">to create feed sticker</p>
                                </div>
                                <div>
                                    <img class="w-40 h-64" src="{{ asset('/image/emptyfilter/edfish_character1.png') }}"
                                            alt="ppl">
                                </div>
                            </div>
                        </div>
                    @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('livewire.admin.settings.feed.feedsticker.show')
</div>
