@if ($staffattendance->isNotEmpty())
    <div class="flex flex-col mt-2 intro-y">
        <div class="-my-2 overflow-x-auto sm:-mx-6 ">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-0">
                <div class="overflow-hidden">
                    <table class="table table-report">
                        <thead>
                            <tr class="intro-x">
                                <th scope="col" class="whitespace-wrap text-xs text-center font-semibold uppercase ">
                                    Name
                                </th>
                                <th scope="col" class="whitespace-wrap text-xs text-center font-semibold uppercase ">
                                    Role No
                                </th>
                                @foreach ($academicyearmonthlist as $value)
                                    <th scope="col" class="whitespace-wrap text-xs text-center font-semibold uppercase ">
                                        {{ $value->month_string }}
                                    </th>
                                @endforeach
                                <th scope="col" class="whitespace-wrap text-xs text-center font-semibold uppercase ">
                                    Overall %
                                </th>
                                <th scope="col" class="whitespace-wrap text-xs text-center font-semibold uppercase ">
                                    No. of Days Present
                                </th>
                                <th scope="col" class="whitespace-wrap text-xs text-center font-semibold uppercase ">
                                    No. of Days Absent
                                </th>
                                <th scope="col" class="whitespace-wrap text-xs text-center font-semibold uppercase ">
                                    No. of Days Half Day
                                </th>
                                <th scope="col" class="whitespace-wrap text-center text-xs font-semibold uppercase ">
                                    No. of Days Late
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($stafflist as $eachstafflist)
                                <tr class="intro-x">
                                    <td class="text-xs text-center whitespace-wrap">
                                        {{ $eachstafflist->name }}
                                    </td>
                                    <td class="text-xs text-center whitespace-wrap">
                                        {{ $eachstafflist->staff_roll_id }}
                                    </td>
                                    @foreach ($academicyearmonthlist as $value)
                                        <td class="text-xs text-center whitespace-wrap">
                                            {{ $eachstafflist->totalpresentdaysinthismonth($value->month_string, $academicyear_id) }}
                                            %
                                        </td>
                                    @endforeach
                                    <td class="text-xs text-center text-blue-600 whitespace-wrap">
                                        {{ $eachstafflist->overallattendancepercentage($academicyear_id) }}
                                    </td>
                                    <td class="text-xs text-center text-green-600 whitespace-wrap">
                                        {{ $eachstafflist->attendancecount('present') }}
                                    </td>
                                    <td class="text-xs text-center text-red-600 whitespace-wrap">
                                        {{ $eachstafflist->attendancecount('absent') }}
                                    </td>
                                    <td class="text-xs text-center whitespace-wrap">
                                        {{ $eachstafflist->attendancecount('halfday') }}
                                    </td>
                                    <td class="text-xs text-center whitespace-wrap">
                                        {{ $eachstafflist->attendancecount('late') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endif
