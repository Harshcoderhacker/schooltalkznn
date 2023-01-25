<div class="box grid grid-cols-12 intro-y mt-8 gap-4 w-full sm:w-11/12 mx-auto">
    <div class="col-span-12 mt-5 p-5">
        <div class="intro-y block sm:flex items-center h-10 mx-5">
            <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100 mr-5">Class Routine</h2>
            <button type="button" wire:click="printtimetable"
                class="btn btn-primary ml-auto flex items-center text-theme-1 dark:text-theme-10">Print</button>
        </div>
    </div>
    <div class="col-span-12 flex flex-col mt-2 intro-y">
        <div class="align-middle inline-block min-w-full sm:px-6 lg:px-8">
            <div class="sm:rounded-lg overflow-auto lg:overflow-visible ">
                <table class="w-full border border-gray-700 dark:border-gray-800 text-center">
                    <thead class="bg-primary">
                        <tr>
                            <th scope="col"
                                class="text-xs sm:text-md text-center border border-gray-700 dark:border-gray-800 font-semibold text-white uppercase p-4">
                                Class Period
                            </th>
                            @foreach ($weekend as $weekendkey => $eachweekend)
                            <th scope="col"
                                class="text-xs sm:text-md text-center border border-gray-700 dark:border-gray-800  font-semibold text-white uppercase p-4">
                                {{ $eachweekend->name }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($classroutine as $classroutinekey => $eachclassroutine)
                        <tr class="">
                            <td
                                class="whitespace-nowrap text-xs border border-gray-700 dark:border-gray-800 sm:text-md bg-primary text-white p-4">
                                @if ($eachclassroutine->is_break)
                                <span class="inline-flex leading-5 font-semibold rounded-full dark:text-gray-300">
                                    {{ $eachclassroutine->start_time->format('g:i A') }} -
                                    {{ $eachclassroutine->end_time->format('g:i A') }}
                                </span>
                                @else
                                <span class="inline-flex leading-5 font-semibold rounded-full dark:text-gray-300">
                                    {{ $eachclassroutine->name }}<br>
                                    {{ $eachclassroutine->start_time->format('g:i A') }} -
                                    {{ $eachclassroutine->end_time->format('g:i A') }}
                                </span>
                                @endif
                            </td>
                            @if (!$eachclassroutine->is_break)
                            @foreach ($weekend as $weekendkey => $eachweekend)
                            <td
                                class="whitespace-nowrap border border-gray-700 dark:border-gray-800 text-xs sm:text-md text-center p-4">
                                {!! $eachweekend->is_holiday ? 'Holiday' :
                                $eachclassroutine->findclassandsectionforstaff($eachclassroutine->id,
                                strtolower($eachweekend->name), $user_id) !!}
                            </td>
                            @endforeach
                            @else
                            <td colspan=5
                                class="whitespace-nowrap border border-gray-700 dark:border-gray-800 text-xs sm:text-md  text-center p-4">
                                <span class="font-semibold">{{ $eachclassroutine->name }}</span>
                            </td>
                            @foreach ($weekend as $weekendkey => $eachweekend)
                            @if ($eachclassroutine->is_break && $eachweekend->is_holiday == true)
                            <td
                                class="whitespace-nowrap border border-gray-700 dark:border-gray-800 text-xs sm:text-md text-center p-4">
                                Holiday
                            </td>
                            @endif
                            @endforeach
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>