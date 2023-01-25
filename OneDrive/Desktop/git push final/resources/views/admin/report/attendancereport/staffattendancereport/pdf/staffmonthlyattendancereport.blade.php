@if ($staffattendance->count() && $stafflist->count())
    <div style="overflow-x:auto;">
        <table style="border-collapse: collapse;
                    border-spacing: 0;
                    width: 100%;
                    border: 1px solid black">
            <thead>
                <tr style="border:1px solid black">
                    <th style="text-align: center; border:1px solid black">
                        Name
                    </th>
                    <th style="text-align: center; border:1px solid black">
                        Staff ID
                    </th>
                    <th style="text-align: center; border:1px solid black">
                        PR
                    </th>
                    <th style="text-align: center; border:1px solid black">
                        L
                    </th>
                    <th style="text-align: center; border:1px solid black">
                        P
                    </th>
                    <th style="text-align: center; border:1px solid black">
                        %
                    </th>

                    @foreach ($staffattendance as $eachstaffattendance)
                        <th style="text-align: center;
                             border:1px solid black">
                            {{ \Carbon\Carbon::parse($eachstaffattendance->attendance_date)->format('d D') }}
                        </th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach ($stafflist as $eachstafflist)
                    <tr>
                        <td style="text-align: center;
                             border:1px solid black">
                            {{ $eachstafflist->name }}
                        </td>
                        <td style="text-align: center;
                             border:1px solid black">
                            {{ $eachstafflist->staff_roll_id }}
                        </td>
                        <td style="text-align: center;
                             border:1px solid black">
                            {{ $eachstafflist->attendancecount('present') }}
                        </td>
                        <td style="text-align: center;
                             border:1px solid black">
                            {{ $eachstafflist->attendancecount('absent') }}
                        </td>
                        <td style="text-align: center;
                             border:1px solid black">
                            {{ $eachstafflist->attendancecount('late') }}
                        </td>
                        <td style="text-align: center;
                             border:1px solid black">
                            {{ $eachstafflist->totalpresentdaysinthismonth($month_string, $academicyear_id) }} %
                        </td>
                        @foreach ($staffattendance as $eachstaffattendance)
                            <td style="text-align: center;
                             border:1px solid black">
                                @foreach ($eachstafflist->staffattendancelist as $eachstaffattendancelist)
                                    @if ($eachstaffattendancelist->staffattendance_id == $eachstaffattendance->id)
                                        @if ($eachstaffattendancelist->present)
                                            <span>P </span>
                                        @elseif($eachstaffattendancelist->absent)
                                            <span>A </span>
                                        @elseif($eachstaffattendancelist->late)
                                            <span>L </span>
                                        @elseif($eachstaffattendancelist->halfday)
                                            <span>HD </span>
                                        @elseif($eachstaffattendancelist->is_holiday)
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
@endif
