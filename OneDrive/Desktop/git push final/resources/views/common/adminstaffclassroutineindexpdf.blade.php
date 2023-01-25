<div style="text-align: center;">
    <h3>{{ $staff->name }} - {{ $staff->staffdepartment->name }} ({{ $staff->staffdesignation->name }})</h3>
</div>
<table style="width:100%;">
    <thead class="bg-primary">
        <tr>
            <th scope="col"
                class="text-base text-center border border-gray-700 dark:border-gray-800 font-semibold text-white uppercase tracking-wider">
                Class Period
            </th>
            @foreach ($weekend as $weekendkey => $eachweekend)
                <th scope="col"
                    class="text-base text-center border border-gray-700 dark:border-gray-800 font-semibold text-white uppercase tracking-wider">
                    {{ $eachweekend->name }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($classroutine as $classroutinekey => $eachclassroutine)
            <tr class="border border-gray-700 dark:border-gray-800">
                <td class="whitespace-nowrap text-sm {{ $eachclassroutine->is_break? 'text-center font-black border border-gray-700 dark:border-gray-800': 'bg-primary text-white border border-gray-700 dark:border-gray-800' }}"
                    {{ $eachclassroutine->is_break ? 'colspan=6' : '' }}>
                    <span class="inline-flex leading-5 font-semibold rounded-full dark:text-gray-300">
                        {{ $eachclassroutine->name }} <br>
                        {{ $eachclassroutine->start_time->format('g:i A') }} -
                        {{ $eachclassroutine->end_time->format('g:i A') }}
                    </span>
                </td>
                @foreach ($weekend as $weekendkey => $eachweekend)
                    @if (!$eachclassroutine->is_break)
                        <td class="whitespace-nowrap text-base text-center border border-gray-700 dark:border-gray-800">
                            {!! $eachweekend->is_holiday ? 'Holiday' : $eachclassroutine->findclassandsectionforstaff($eachclassroutine->id, strtolower($eachweekend->name), $staff->id) !!}
                        </td>
                    @endif
                    @if ($eachclassroutine->is_break && $eachweekend->is_holiday == true)
                        <td class="whitespace-nowrap text-base text-center border border-gray-700 dark:border-gray-800">
                            Holiday
                        </td>
                    @endif
                @endforeach
        @endforeach
        </tr>
    </tbody>
</table>
<style>
    table,
    th,
    td {
        border: 1px solid black;
        border-collapse: collapse;
    }

    td {
        text-align: center;
        vertical-align: middle;
    }

</style>
