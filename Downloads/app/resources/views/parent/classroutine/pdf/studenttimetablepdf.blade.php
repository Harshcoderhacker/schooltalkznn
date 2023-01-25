<!DOCTYPE html>
<html>

<head>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        td,
        th {
            border: 1px solid black;
            text-align: center;
            padding: 4px;
        }

    </style>
</head>

<body>
    <h2 style="text-align:center;">Class {{ $classmaster }} - Section {{ $section }}
        <table>
            <tr class="intro-x border-2 border-black">
                <th>Class Period</th>
                <th>MONDAY</th>
                <th>TUESDAY</th>
                <th>WEDNESDAY</th>
                <th>THURSDAY</th>
                <th>FRIDAY</th>
                <th>SATURDAY</th>
                <th>SUNDAY</th>
            </tr>
            @foreach ($timetable as $eachtimetable)
                <tr>
                    <td {{ str_contains($eachtimetable->classroutine->name, 'Break') ? 'colspan=6' : '' }}>
                        <span class="inline-flex leading-5 font-semibold rounded-full dark:text-gray-300">
                            {{ $eachtimetable->classroutine->name }} <br>
                            {{ $eachtimetable->classroutine->start_time->format('g:i A') }} -
                            {{ $eachtimetable->classroutine->end_time->format('g:i A') }}
                        </span>
                    </td>
                    @if (!str_contains($eachtimetable->classroutine->name, 'Break'))
                        <td class="whitespace-nowrap text-base text-center border-2 border-black">
                            @include('livewire.aparent.classroutine.classroutinehelper',
                            ['daystring' => 'monday'])
                        </td>
                        <td>
                            @include('livewire.aparent.classroutine.classroutinehelper',
                            ['daystring' => 'tuesday'])
                        </td>
                        <td>
                            @include('livewire.aparent.classroutine.classroutinehelper',
                            ['daystring' => 'wednesday'])
                        </td>
                        <td>
                            @include('livewire.aparent.classroutine.classroutinehelper',
                            ['daystring' => 'thursaday'])
                        </td>
                        <td>
                            @include('livewire.aparent.classroutine.classroutinehelper',
                            ['daystring' => 'friday'])
                        </td>
                    @endif
                    <td>
                        @include('livewire.aparent.classroutine.classroutinehelper',
                        ['daystring' => 'saturday'])
                    </td>
                    <td>
                        @include('livewire.aparent.classroutine.classroutinehelper',
                        ['daystring' => 'sunday'])
                    </td>
                </tr>
            @endforeach
        </table>
</body>

</html>
