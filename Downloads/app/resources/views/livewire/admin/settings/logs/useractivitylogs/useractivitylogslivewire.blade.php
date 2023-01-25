<div>
    <div class="intro-y chat grid grid-cols-12 gap-5 mt-5 mb-12">
        @include('admin.settings.logs.helper.logsmenu', ['active' => 'useractivitylogs'])
    </div>
    <div class=" col-span-12 xl:col-span-8 ">
        <div class="p-2">
            <div class="grid grid-cols-12 gap-1">
                @include('helper.datatable.header',
                ['title' => 'User Activity Logs',
                'search' => 'searchTerm'])

                <!-- BEGIN: Data List -->
                @if ($useractivitylogs->isNotEmpty())
                    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">

                        <table class="table table-report sm:mt-2">
                            <thead>
                                <tr>
                                    <th class="whitespace-nowrap">
                                        S.NO
                                    </th>
                                    <th class="whitespace-nowrap">ID</th>
                                    <th class="whitespace-nowrap">
                                        NAME
                                    </th>
                                    {{-- <th class="whitespace-nowrap">E-MAIL</th> --}}
                                    <th class="whitespace-nowrap">DETAILS</th>
                                    <th class="text-center whitespace-nowrap">
                                        <div class="flex">
                                            CREATED AT
                                            @include('helper.datatable.sorting',
                                            ['method' => 'sortBy',
                                            'value' => 'created_at'])
                                        </div>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($useractivitylogs as $index => $value)
                                    <tr class="intro-x">
                                        <td class="font-medium whitespace-nowrap">
                                            {{ $useractivitylogs->firstItem() + $index }}</td>
                                        <td class="font-medium whitespace-nowrap">
                                            @if ($value->trackable_type == 'App\Models\Admin\Auth\User')
                                                {{ $value->uniqid }}(Admin)
                                            @elseif ($value->trackable_type == 'App\Models\Staff\Auth\Staff')
                                                {{ $value->uniqid }}(Staff)
                                            @elseif ($value->trackable_type == 'App\Models\Parent\Auth\Aparent')
                                                {{ $value->uniqid }}(Parent)
                                            @else
                                                {{ $value->uniqid }}(Student)
                                            @endif
                                        </td>
                                        <td class="font-medium whitespace-nowrap">
                                            {{ $value->name }}
                                        </td>
                                        <td class="font-medium whitespace-nowrap">
                                            {{ $value->trackmsg }}
                                        </td>
                                        <td class="font-medium whitespace-nowrap">
                                            {{ $value->created_at->format('d-M-Y h:i:s') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @include('helper.datatable.pagination', ['pagination' => $useractivitylogs])
                @else
                    @include('helper.datatable.norecordfound')
                @endif
            </div>
        </div>
    </div>
</div>
