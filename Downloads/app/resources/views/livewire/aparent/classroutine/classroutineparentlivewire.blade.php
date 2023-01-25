<div>
    <div class="col-span-12 mt-5 p-5">
        <div class="intro-y block sm:flex items-center h-10 mx-5">
            <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100 mr-5">Class Routine</h2>
            <button type="button" wire:click="downloadtimetabe"
                class="btn btn-primary ml-auto flex items-center text-theme-1 dark:text-theme-10">Print</button>
        </div>
    </div>
    @if ($timetable)
        <div class="flex flex-col mt-2 intro-y">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="overflow-hidden sm:rounded-lg">
                        <table class="table border-gray-700 dark:border-gray-800">
                            <thead class="bg-primary">
                                <tr class="intro-x border-2 border-gray-700 dark:border-gray-800">
                                    <th scope="col"
                                        class="text-base text-center border-2 border-gray-700 dark:border-gray-800 font-semibold text-white uppercase tracking-wider">
                                        Class Period
                                    </th>
                                    <th scope="col"
                                        class="text-base text-center border-2 border-gray-700 dark:border-gray-800 font-semibold text-white uppercase tracking-wider">
                                        MONDAY</th>
                                    <th scope="col"
                                        class="text-base text-center border-2 border-gray-700 dark:border-gray-800 font-semibold text-white uppercase tracking-wider">
                                        TUESDAY</th>
                                    <th scope="col"
                                        class="text-base text-center border-2 border-gray-700 dark:border-gray-800 font-semibold text-white uppercase tracking-wider">
                                        WEDNESDAY</th>
                                    <th scope="col"
                                        class="text-base text-center border-2 border-gray-700 dark:border-gray-800 font-semibold text-white uppercase tracking-wider">
                                        THURSDAY</th>
                                    <th scope="col"
                                        class="text-base text-center border-2 border-gray-700 dark:border-gray-800 font-semibold text-white uppercase tracking-wider">
                                        FRIDAY</th>
                                    <th scope="col"
                                        class="text-base text-center border-2 border-gray-700 dark:border-gray-800 font-semibold text-white uppercase tracking-wider">
                                        SATURDAY</th>
                                    <th scope="col"
                                        class="text-base text-center border-2 border-gray-700 dark:border-gray-800 font-semibold text-white uppercase tracking-wider">
                                        SUNDAY</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($timetable as $eachtimetable)
                                    <tr>
                                        <td class="whitespace-nowrap text-sm bg-primary text-white border-2 border-gray-700 dark:border-gray-800}}">
                                            @if($eachtimetable->classroutine->is_break)
                                            <span
                                                class="inline-flex leading-5 font-semibold rounded-full dark:text-gray-300">
                                                {{ $eachtimetable->classroutine->start_time->format('g:i A') }} -
                                                {{ $eachtimetable->classroutine->end_time->format('g:i A') }}
                                            </span>
                                            @else
                                            <span
                                                class="inline-flex leading-5 font-semibold rounded-full dark:text-gray-300">
                                            {{ $eachtimetable->classroutine->name }}<br>
                                            {{ $eachtimetable->classroutine->start_time->format('g:i A') }} -
                                                {{ $eachtimetable->classroutine->end_time->format('g:i A') }}
                                            </span>
                                            @endif
                                        </td>
                                        @if (!$eachtimetable->classroutine->is_break)
                                            <td
                                                class="whitespace-nowrap text-base text-center border-2 border-gray-700 dark:border-gray-800">
                                                @include(
                                                    'livewire.aparent.classroutine.classroutinehelper',
                                                    ['daystring' => 'monday']
                                                )
                                            </td>
                                            <td
                                                class="whitespace-nowrap text-base border-2 border-gray-700 dark:border-gray-800 text-center">
                                                @include(
                                                    'livewire.aparent.classroutine.classroutinehelper',
                                                    ['daystring' => 'tuesday']
                                                )
                                            </td>
                                            <td
                                                class="whitespace-nowrap text-base border-2 border-gray-700 dark:border-gray-800 text-center">
                                                @include(
                                                    'livewire.aparent.classroutine.classroutinehelper',
                                                    ['daystring' => 'wednesday']
                                                )
                                            </td>
                                            <td
                                                class="whitespace-nowrap text-base border-2 border-gray-700 dark:border-gray-800 text-center">
                                                @include(
                                                    'livewire.aparent.classroutine.classroutinehelper',
                                                    ['daystring' => 'thursaday']
                                                )
                                            </td>
                                            <td
                                                class="whitespace-nowrap text-base border-2 border-gray-700 dark:border-gray-800 text-center">
                                                @include(
                                                    'livewire.aparent.classroutine.classroutinehelper',
                                                    ['daystring' => 'friday']
                                                )
                                            </td>
                                            @else
                                            <td colspan = 5 class="whitespace-nowrap text-base border-2 border-gray-700 dark:border-gray-800 text-center">
                                                <span class="font-semibold">{{ $eachtimetable->classroutine->name }}</span>
                                            </td>
                                        @endif

                                        <td
                                            class="whitespace-nowrap text-base border-2 border-gray-700 dark:border-gray-800 text-center">
                                            @include(
                                                'livewire.aparent.classroutine.classroutinehelper',
                                                ['daystring' => 'saturday']
                                            )
                                        </td>
                                        <td
                                            class="whitespace-nowrap text-base border-2 border-gray-700 dark:border-gray-800 text-center">
                                            @include(
                                                'livewire.aparent.classroutine.classroutinehelper',
                                                ['daystring' => 'sunday']
                                            )
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @else
        @include('helper.datatable.norecordfound')
    @endif
</div>
