<div>
    <div class="box intro-y col-span-6 sm:col-span-12 overflow-auto lg:overflow-visible p-2 mt-5">
        <div class=" mt-5">
            <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                <table class="table table-report -mt-2">
                    <thead class="bg-primary">
                        <tr class="intro-x">
                            <th class="font-semibold text-white text-xs text-center uppercase whitespace-nowrap">
                                <div class="flex">
                                    Month
                            </th>
                            <th class="font-semibold text-white text-xs text-center uppercase whitespace-nowrap">
                                <div class="flex">
                                    Attendance %
                            </th>
                            <th class="font-semibold text-white text-xs text-center uppercase whitespace-nowrap">
                                <div class="flex">
                                    Total Days
                                </div>
                            </th>
                            <th class="font-semibold text-white text-xs text-center uppercase whitespace-nowrap">
                                <div class="flex">
                                    Absent Days
                            </th>
                            <th class="font-semibold text-white text-xs text-center uppercase whitespace-nowrap">
                                <div class="flex">
                                    Present Days
                            </th>
                            <th class="font-semibold text-white text-xs text-center uppercase whitespace-nowrap">
                                <div class="flex">
                                    Report
                                </div>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($academicyearmonthlist as $value)
                            <tr class="intro-x">
                                <td class="text-xs text-center whitespace-wrap">
                                    <span class="text-sm font-medium whitespace-nowrap">
                                        {{ $value->month_string }}
                                    </span>
                                </td>
                                <td class="text-xs text-center whitespace-wrap">
                                    {{ $student->totalpresentdaysinthismonth($value->month_string, $academicyear_id) }}
                                    %
                                </td>
                                <td>
                                    <span class="text-sm text-center font-medium whitespace-nowrap">
                                        {{ $student->totalworkingdayscountinthismonth($value->month_string, $academicyear_id) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="text-sm text-center font-medium whitespace-nowrap">
                                        {{ $student->totalabsentdayscountinthismonth($value->month_string, $academicyear_id) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="text-sm text-center font-medium whitespace-nowrap">
                                        {{ $student->totalpresentdayscountinthismonth($value->month_string, $academicyear_id) }}
                                    </span>
                                </td>
                                <td>
                                    <a class="btn border border-none text-center"
                                        wire:click="downloadattendacereport('{{ $value->id }}')">
                                        <div class="flex gap-2">
                                            <div
                                                class="text-sm font-medium text-center mt-1" style="color:rgb(0, 221, 0)">
                                                Download 
                                            </div>
                                            <div>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-download"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
                                            </div>
                                        </div>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
