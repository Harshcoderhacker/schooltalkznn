<div>
    <div class="intro-y chat grid grid-cols-12 gap-5 mt-5 mb-12">
        @include('admin.settings.logs.helper.logsmenu', ['active' => 'loginlogs'])
    </div>
    <div class=" col-span-12 xl:col-span-8 ">
        <div class="p-2">
            <div class="grid grid-cols-12 gap-1">
                @include('helper.datatable.header',
                ['title' => 'Login Logs',
                'search' => 'searchTerm'])

                <!-- BEGIN: Data List -->
                @if ($loginlogs->isNotEmpty())
                    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">

                        <table class="table table-report sm:mt-2">
                            <thead>
                                <tr>
                                    <th class="whitespace-nowrap">
                                        S.NO
                                    </th>
                                    <th class="whitespace-nowrap">
                                        ID
                                    </th>
                                    <th class="whitespace-nowrap">
                                        NAME
                                    </th>
                                    <th class="whitespace-nowrap">TYPE</th>
                                    <th class="whitespace-nowrap">DEVICE/ BROWSER/ PLATFORM</th>
                                    {{-- <th class="whitespace-nowrap">SERVER IP/ CLIENT IP</th> --}}
                                    <th class="whitespace-nowrap">STATUS</th>
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
                                @foreach ($loginlogs as $index => $value)
                                    <tr class="intro-x">
                                        <td class="font-medium whitespace-nowrap">
                                            {{ $loginlogs->firstItem() + $index }}</td>
                                        <td class="font-medium whitespace-nowrap">
                                            @if ($value->logininformable_type == 'App\Models\Admin\Auth\User')
                                                {{ $value->user_uniqid }}(Admin)
                                            @elseif ($value->logininformable_type == 'App\Models\Staff\Auth\Staff')
                                                {{ $value->user_uniqid }}(Staff)
                                            @elseif ($value->logininformable_type == 'App\Models\Parent\Auth\Aparent')
                                                {{ $value->user_uniqid }}(Parent)
                                            @else
                                                {{ $value->user_uniqid }}(Student)
                                            @endif
                                        </td>
                                        <td class="font-medium whitespace-nowrap">
                                            {{ $value->user_name }}
                                        </td>
                                        <td class="font-medium whitespace-nowrap">
                                            {{ $value->type }}
                                        </td>
                                        <td class="font-medium whitespace-nowrap">
                                            {{ $value->device }}/ {{ $value->browser }}/ {{ $value->platform }}
                                        </td>
                                        {{-- <td class="font-medium whitespace-nowrap">
                                            {{ $value->serverIp }}/ {{ $value->clientIp }}
                                        </td> --}}
                                        <td class="font-medium whitespace-nowrap">
                                            {{ $value->login_status == 1 ? 'P' : 'F' }}
                                        </td>
                                        <td class="font-medium whitespace-nowrap">
                                            {{ $value->created_at->format('d-M-Y h:i:s') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    @include('helper.datatable.pagination', ['pagination' => $loginlogs])
                @else
                    @include('helper.datatable.norecordfound')
                @endif
            </div>
        </div>
    </div>
</div>
