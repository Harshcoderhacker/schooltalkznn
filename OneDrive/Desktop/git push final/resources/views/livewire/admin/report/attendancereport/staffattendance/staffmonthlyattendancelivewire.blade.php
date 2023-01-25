<div>
    <div class="w-full mx-auto sm:w-11/12">
        <div class="col-span-12 mt-5">
            <div class="intro-y flex items-center h-10">
                <h2 class="text-lg truncate mr-5">Staff Attendance Report</h2>
            </div>
            <div class="grid grid-cols-12 col-span-12 gap-6 mt-2">
                <div class="col-span-12 sm:col-span-3 intro-y">
                    <select wire:model="staffdesignation_id" class="form-select w-full mt-5">
                        <option value="0">Select Designation </option>
                        @foreach ($staffdesignation as $eachstaffdesignation)
                            <option value="{{ $eachstaffdesignation->id }}">
                                {{ $eachstaffdesignation->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-span-12 sm:col-span-3 intro-y mt-5">
                    <input type="month" wire:model="attendancemonth" class="form-control" placeholder="MMM-YYY">
                </div>
                @if ($staffattendance->count() && $stafflist->count())
                    <div class="col-span-12 sm:col-span-3 intro-y">
                        <select wire:model="downloadtype" class="form-select mt-5">
                            <option value="0">Export</option>
                            <option value="1">
                                XLSX
                            </option>
                            <option value="2">
                                XLS
                            </option>
                            <option value="3">
                                CSV
                            </option>
                            <option value="4">
                                PDF
                            </option>
                        </select>
                    </div>
                    <button wire:click="downloadattendance"
                        class="btn btn-primary col-span-12 sm:col-span-2 intro-y mt-5">Download</button>
                @endif
            </div>
        </div>
        @if ($staffattendance->count() && $stafflist->count())
            <div class="flex flex-col mt-8 intro-y">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full">
                        <div class="overflow-hidden">
                            <table class="table table-report">
                                <thead>
                                    <tr class="intro-x">
                                        <th scope="col"
                                            class="whitespace-wrap text-xs text-center font-semibold uppercase ">
                                            Name
                                        </th>
                                        <th scope="col"
                                            class="whitespace-wrap text-xs text-center font-semibold uppercase ">
                                            Staff ID
                                        </th>
                                        <th scope="col"
                                            class="whitespace-wrap text-xs text-center font-semibold uppercase ">
                                            PR
                                        </th>
                                        <th scope="col"
                                            class="whitespace-wrap text-xs text-center font-semibold uppercase ">
                                            L
                                        </th>
                                        <th scope="col"
                                            class="whitespace-wrap text-xs text-center font-semibold uppercase ">
                                            P
                                        </th>
                                        <th scope="col"
                                            class="whitespace-wrap text-xs text-center font-semibold uppercase ">
                                            %
                                        </th>
                                        @foreach ($staffattendance as $eachstaffattendance)
                                            <th scope="col"
                                                class="whitespace-wrap text-xs text-center font-semibold uppercase ">
                                                {{ \Carbon\Carbon::parse($eachstaffattendance->attendance_date)->format('d D') }}
                                            </th>
                                        @endforeach
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
                                            <td class="text-xs text-center whitespace-wrap">
                                                {{ $eachstafflist->attendancecount('present') }}
                                            </td>
                                            <td class="text-xs text-center whitespace-wrap">
                                                {{ $eachstafflist->attendancecount('absent') }}
                                            </td>
                                            <td class="text-xs text-center whitespace-wrap">
                                                {{ $eachstafflist->attendancecount('late') }}
                                            </td>
                                            <td class="text-xs text-center whitespace-wrap">
                                                {{ $eachstafflist->totalpresentdaysinthismonth($month_string, $academicyear_id) }}
                                                %
                                            </td>
                                            @foreach ($staffattendance as $eachstaffattendance)
                                                <td class="text-xs text-center font-semibold whitespace-wrap">
                                                    @foreach ($eachstafflist->staffattendancelist as $eachstaffattendancelist)
                                                        @if ($eachstaffattendancelist->staffattendance_id == $eachstaffattendance->id)
                                                            @if ($eachstaffattendancelist->present)
                                                                <span class="text-green-600">P</span>
                                                            @elseif($eachstaffattendancelist->absent)
                                                                <span class="text-red-600">A </span>
                                                            @elseif($eachstaffattendancelist->late)
                                                                <span class="text-blue-600">L </span>
                                                            @elseif($eachstaffattendancelist->halfday)
                                                                <span class="text-yellow-600">HD </span>
                                                            @elseif($eachstaffattendancelist->is_holiday)
                                                                <span class="text-red-600">H </span>
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
                    </div>
                </div>
            </div>
        @elseif($staffdesignation_id && $attendancemonth && $staffattendance && $stafflist)
            @include('helper.datatable.norecordfound')
        @else
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center p-10 box mt-4 bg-blue-100 leading-6">
            <div class="mx-auto flex flex-row items-center">
                <div>
                    <p class="text-2xl font-bold text-gray-900 dark:text-gray-100 dark:text-white mr-5">Kindly Select</p>
                    <p class="text-2xl mt-2 font-bold"> <span class="text-green-500">Designation and Month</span></p>
                    <p class="text-2xl mt-2 font-bold text-gray-900 dark:text-gray-100 dark:text-white mr-5">to view attendance report</p>
                </div>
                <div>
                    <img class="w-40 h-64" src="{{ asset('/image/emptyfilter/edfish_character1.png') }}"
                            alt="ppl">
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
