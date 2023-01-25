<div>
    <div class="w-full mx-auto sm:w-11/12">
        <div class="col-span-12 mt-5">
            <div class="intro-y flex items-center h-10">
                <h2 class="text-lg truncate mr-5">Class Overall Attendance Report</h2>
            </div>
            <div class="grid grid-cols-12 gap-6 mt-2">
                <div class="col-span-12 sm:col-span-3 intro-y">
                    <select wire:model="classmasterid" class="form-select w-full mt-5">
                        <option value="0">Select Class </option>
                        @foreach ($classmaster as $eachclassmaster)
                        <option value="{{ $eachclassmaster->id }}">
                            {{ $eachclassmaster->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-span-12 sm:col-span-3 intro-y">
                    <select wire:model="sectionid" class="form-select w-full mt-5">
                        <option value="0">Select a Section</option>
                        @foreach ($section as $eachsection)
                        <option value="{{ $eachsection->id }}">
                            {{ $eachsection->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                @if ($studentattendance->count() && $studentlist->count())
                <div class="col-span-12 sm:col-span-3 intro-y">
                    <div>
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
                </div>
                <div class="col-span-12 sm:col-span-3 intro-y mt-5">
                    <button wire:click="downloadattendance" class="btn btn-primary">Download</button>
                </div>
                @endif
            </div>
        </div>
        @if ($studentattendance->isNotEmpty())
        <div class="flex flex-col mt-2 intro-y">
            <div class="-my-2 overflow-x-auto sm:-mx-6 ">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-0">
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
                                        Role No
                                    </th>
                                    @foreach ($academicyearmonthlist as $value)
                                    <th scope="col"
                                        class="whitespace-wrap text-xs text-center font-semibold uppercase ">
                                        {{ $value->month_string }}
                                    </th>
                                    @endforeach
                                    <th scope="col"
                                        class="whitespace-wrap text-xs text-center font-semibold uppercase ">
                                        Overall %
                                    </th>
                                    <th scope="col"
                                        class="whitespace-wrap text-xs text-center font-semibold uppercase ">
                                        No. of Days Present
                                    </th>
                                    <th scope="col"
                                        class="whitespace-wrap text-xs text-center font-semibold uppercase ">
                                        No. of Days Absent
                                    </th>
                                    <th scope="col"
                                        class="whitespace-wrap text-xs text-center font-semibold uppercase ">
                                        No. of Days Half Day
                                    </th>
                                    <th scope="col"
                                        class="whitespace-wrap text-center text-xs font-semibold uppercase ">
                                        No. of Days Late
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($studentlist as $eachstudentlist)
                                <tr class="intro-x">
                                    <td class="text-xs text-center whitespace-wrap">
                                        {{ $eachstudentlist->name }}
                                    </td>
                                    <td class="text-xs text-center whitespace-wrap">
                                        {{ $eachstudentlist->roll_no }}
                                    </td>
                                    @foreach ($academicyearmonthlist as $value)
                                    <td class="text-xs text-center whitespace-wrap">
                                        {{ $eachstudentlist->totalpresentdaysinthismonth($value->month_string,
                                        $academicyear_id) }}
                                        %
                                    </td>
                                    @endforeach
                                    <td class="text-xs text-center text-blue-600 whitespace-wrap">
                                        {{ $eachstudentlist->overallattendancepercentage($academicyear_id) }} %
                                    </td>
                                    <td class="text-xs text-center text-green-600 whitespace-wrap">
                                        {{ $eachstudentlist->attendancecount('present') }}
                                    </td>
                                    <td class="text-xs text-center text-red-600 whitespace-wrap">
                                        {{ $eachstudentlist->attendancecount('absent') }}
                                    </td>
                                    <td class="text-xs text-center whitespace-wrap">
                                        {{ $eachstudentlist->attendancecount('halfday') }}
                                    </td>
                                    <td class="text-xs text-center whitespace-wrap">
                                        {{ $eachstudentlist->attendancecount('late') }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @elseif($classmasterid && $sectionid && $studentattendance->isEmpty())
        @include('helper.datatable.norecordfound')
        @else
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center p-10 box mt-4 bg-blue-100 leading-6">
            <div class="mx-auto flex flex-row items-center">
                <div>
                    <p class="text-2xl font-bold text-gray-900 dark:text-gray-100 dark:text-white mr-5">Kindly Select</p>
                    <p class="text-2xl mt-2 font-bold"> <span class="text-green-500">Designation</span></p>
                    <p class="text-2xl mt-2 font-bold text-gray-900 dark:text-gray-100 dark:text-white mr-5">to view overall attendance report</p>
                </div>
                <div>
                    <img class="w-40 h-64" src="{{ asset('/image/emptyfilter/edfish_character2.png') }}"
                            alt="ppl">
                </div>
            </div>
        </div>
        @endif
    </div>
</div>