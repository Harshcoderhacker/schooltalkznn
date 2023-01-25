<div>
    <div class="intro-y chat grid grid-cols-12 gap-5 mt-5 mb-12">
        @include('admin.settings.feedsettings.helper.feedsettingsmenu', [
            'active' => 'feedstudentidealibrary',
        ])
        <div class=" col-span-12 xl:col-span-12">
            <div class="p-2">
                <div class="grid grid-cols-12 gap-1">
                    @include('helper.datatable.header', [
                        'title' => 'Student Idea Library',
                        'search' => 'searchTerm',
                    ])
                    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                        <button class="h-8 w-16 rounded-lg btn-primary float-right mt-4"
                            wire:click="syncidealibrary">Sync</button>
                    </div>
                    <!-- BEGIN: Data List -->
                    @if ($studentidealibrary->isNotEmpty())
                        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                            <table class="table table-report -mt-2">
                                <thead>
                                    <tr>
                                        <th class="whitespace-nowrap text-center">
                                            S.NO
                                        </th>
                                        <th class="text-center whitespace-nowrap">
                                            <div class="flex justify-center">
                                                TITLE

                                                @include('helper.datatable.sorting', [
                                                    'method' => 'sortBy',
                                                    'value' => 'name',
                                                ])
                                            </div>
                                        </th>
                                        <th class="text-center whitespace-nowrap">
                                            LABEL
                                        </th>
                                        <th class="text-center whitespace-nowrap">
                                            STAR VALUE
                                        </th>
                                        <th class="text-center whitespace-nowrap">
                                            TEMPLATE USED
                                        </th>
                                        <th class="text-center whitespace-nowrap">VIEW</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($studentidealibrary as $index => $value)
                                        <tr class="intro-x">
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td class="text-center">
                                                <span class="font-medium whitespace-nowrap">{{ $value->name }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <span class="font-medium whitespace-nowrap">{{ $value->tag }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <span class="font-medium whitespace-nowrap">{{ $value->starvalue }}
                                                </span>
                                            </td>
                                            <td class="text-center">
                                                <span
                                                    class="font-medium whitespace-nowrap">{{ $value->idealibable->count() }}
                                                </span>
                                            </td>
                                            <td>
                                                <div class="flex justify-center gap-1 items-center">
                                                    <a wire:click="show('{{ $value->id }}')" href="javascript:;"
                                                        class="flex items-center text-theme-1">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="18"
                                                            height="18" viewBox="0 0 24 24" fill="none"
                                                            stroke="green" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" class="feather feather-eye">
                                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z">
                                                            </path>
                                                            <circle cx="12" cy="12" r="3">
                                                            </circle>
                                                        </svg>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @include('helper.datatable.pagination', [
                            'pagination' => $studentidealibrary,
                        ])
                    @else
                        @include('helper.datatable.norecordfound')
                    @endif
                </div>
            </div>
        </div>
    </div>
    @include('livewire.admin.settings.feed.feedidealibrary.feedstudentidealibraryshow')
</div>
