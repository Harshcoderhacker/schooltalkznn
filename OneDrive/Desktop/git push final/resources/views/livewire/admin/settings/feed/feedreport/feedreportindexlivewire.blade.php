<div>
    <div class="intro-y chat grid grid-cols-12 gap-5 mt-5 mb-12">
        @include('admin.settings.feedsettings.helper.feedsettingsmenu', ['active' => 'feedreported'])
        <div class=" col-span-12 xl:col-span-12">
            <div class="p-2">
                <div class="grid grid-cols-12 gap-1">
                    @include('helper.datatable.header',
                    ['title' => 'Feed Reported List',
                    'search' => 'searchTerm'])
                    <!-- BEGIN: Data List -->
                    @if ($feedreported->isNotEmpty())
                    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">

                        <table class="table table-report sm:mt-2">
                            <thead>
                                <tr>
                                    <th class="whitespace-nowrap">
                                        S.NO
                                    </th>
                                    <th class="text-center whitespace-nowrap">
                                        <div class="flex">
                                            NAME

                                            @include('helper.datatable.sorting',
                                            ['method' => 'sortBy',
                                            'value' => 'name'])

                                        </div>
                                    </th>
                                    <th class="text-center whitespace-nowrap">ACTIVE STATUS</th>
                                    <th class="text-center whitespace-nowrap">DELETE</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($feedreported as $index => $value)
                                <tr class="intro-x">
                                    <td class="font-medium whitespace-nowrap">
                                        {{ $feedreported->firstItem() + $index }}</td>
                                    <td class="font-medium whitespace-nowrap">{{ $value->name }}</td>
                                    <td class="table-report__action w-12 text-center">
                                        <div class="flex justify-center items-center">
                                            <div class="form-check form-switch flex flex-col items-start">
                                                <input id="post-form-5" class="form-check-input" type="checkbox"
                                                    wire:click="active({{$value->id}})" {{ $value->active ? 'checked'
                                                :'' }}>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="table-report__action w-56">
                                        <div class="flex justify-center gap-1 items-center">

                                            @include('helper.datatable.delete',
                                            ['method' => 'deleteconfirm',
                                            'id' => $value->id])

                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @include('helper.datatable.pagination', ['pagination' => $feedreported])
                    @else
                    @include('helper.datatable.norecordfound')
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>