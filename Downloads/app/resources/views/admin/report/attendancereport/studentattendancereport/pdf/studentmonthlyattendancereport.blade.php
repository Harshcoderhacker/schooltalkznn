@if ($studentattendance->count() && $studentlist->count())
    {{-- <div class="flex flex-col mt-8 intro-y">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full"> --}}
    <div style="overflow-x:auto;">
        <table style="border-collapse: collapse;
                    border-spacing: 0;
                    width: 100%;
                    border: 1px solid black">
            <thead>
                <tr style="border:1px solid black">
                    <th style="text-align: center;
                            border:1px solid black">
                        Name
                    </th>
                    <th style="text-align: center;
                            border:1px solid black">
                        Role No
                    </th>
                    <th style="text-align: center;
                            border:1px solid black">
                        PR
                    </th>
                    <th style="text-align: center;
                            border:1px solid black">
                        L
                    </th>
                    <th style="text-align: center;
                            border:1px solid black">
                        P
                    </th>
                    <th style="text-align: center;
                            border:1px solid black">
                        %
                    </th>

                    @foreach ($studentattendance as $eachstudentattendance)
                        <th style="text-align: center;
                            border:1px solid black">
                            {{ \Carbon\Carbon::parse($eachstudentattendance->attendance_date)->format('d D') }}
                        </th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($studentlist as $eachstudentlist)
                    <tr>
                        <td style="text-align: center;
                            border:1px solid black">
                            {{ $eachstudentlist->name }}
                        </td>
                        <td style="text-align: center;
                            border:1px solid black">
                            {{ $eachstudentlist->roll_no }}
                        </td>
                        <td style="text-align: center;
                            border:1px solid black">
                            {{ $eachstudentlist->attendancecount('present') }}
                        </td>
                        <td style="text-align: center;
                            border:1px solid black">
                            {{ $eachstudentlist->attendancecount('absent') }}
                        </td>
                        <td style="text-align: center;
                            border:1px solid black">
                            {{ $eachstudentlist->attendancecount('late') }}
                        </td>
                        <td style="text-align: center;
                            border:1px solid black">
                            {{ $eachstudentlist->totalpresentdaysinthismonth($month_string, $academicyear_id) }} %
                        </td>
                        @foreach ($studentattendance as $eachstudentattendance)
                            <td style="text-align: center;
                            border:1px solid black">
                                @foreach ($eachstudentlist->studentattendancelist as $eachstudentattendancelist)
                                    @if ($eachstudentattendancelist->studentattendance_id == $eachstudentattendance->id)
                                        @if ($eachstudentattendancelist->present)
                                            <span>P </span>
                                        @elseif($eachstudentattendancelist->absent)
                                            <span>A </span>
                                        @elseif($eachstudentattendancelist->late)
                                            <span>L </span>
                                        @elseif($eachstudentattendancelist->halfday)
                                            <span>HD </span>
                                        @elseif($eachstudentattendancelist->is_holiday)
                                            <span>H </span>
                                        @else
                                            <span>- </span>
                                        @endif
                                    @endif
                                @endforeach
                            </td>
                        @endforeach
                    </tr>
                @endforeach

            </tbody>
        </table>
    </div>
    {{-- </div>
        </div>
    </div> --}}
@endif
