<div>
    <div class="col-span-12">
        <div class="intro-y flex items-center h-10">
            <a href="" class="ml-auto flex items-center text-theme-1 dark:text-theme-10">
                <i data-feather="refresh-ccw" class="w-4 h-4 mr-3"></i> Reload Data
            </a>
        </div>
        <div class="grid grid-cols-12 gap-6 mt-2">
            <div class="col-span-12 sm:col-span-3 intro-y">
                <div class="report-box zoom-in">
                    <div class=" box p-5 rounded-lg" style="background-color: #44BD32">
                        <div class="flex flex-col text-white font-bold">
                            <div class="text-xl">
                                Overall Attendance
                            </div>
                            <div class="ml-auto text-4xl">
                                {{ round($student->overallattendancepercentage($academicyear_id)) }} %
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-12 sm:col-span-3 intro-y">
                <div class="report-box zoom-in">
                    <div class=" box p-5 rounded-lg" style="background-color: #E1B12C">
                        <div class="flex flex-col text-white font-bold">
                            <div class="text-xl">
                                Leave Taken
                            </div>
                            <div class="ml-auto text-4xl">
                                {{ $student->attendancecount('absent') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-12 sm:col-span-3 intro-y">
                <div class="report-box zoom-in">
                    <div class=" box p-5 rounded-lg bg-primary">
                        <div class="flex flex-col text-white font-bold">
                            <div class="text-xl">
                                Holidays This Month
                            </div>
                            <div class="ml-auto text-4xl">
                                {{ $student->totalholidaydayscountinthismonth($month_string, $academicyear_id) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-12 sm:col-span-3 intro-y">
                <button wire:click="openapplyleavemodel"
                    class="zoom-in btn rounded-lg btn-outline-primary dark:text-white w-5/6 mx-8">Apply
                    Leave</button>
                <button wire:click="openappliedleavemodel"
                    class="zoom-in btn rounded-lg btn-outline-primary dark:text-white w-5/6 mx-8 mt-3">Applied
                    Leaves</button>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-12 gap-1 mt-8">
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead class="bg-primary">
                    <tr class="intro-x">
                        <th class="font-semibold text-white uppercase whitespace-nowrap">
                            <div class="flex">
                                Month
                        </th>
                        <th class="font-semibold text-white uppercase whitespace-nowrap">
                            <div class="flex">
                                Attendance Percentage
                        </th>
                        <th class="font-semibold text-white uppercase whitespace-nowrap">
                            <div class="flex">
                                Total Days
                            </div>
                        </th>
                        <th class="font-semibold text-white uppercase whitespace-nowrap">
                            <div class="flex">
                                Absent Days
                        </th>
                        <th class="font-semibold text-white uppercase whitespace-nowrap">
                            <div class="flex">
                                Present Days
                        </th>
                        <th class="font-semibold text-white uppercase whitespace-nowrap">
                            <div class="flex">
                                Download Report
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($academicyearmonthlist as $value)
                        <tr class="intro-x">
                            <td>
                                <span class="text-sm font-medium whitespace-nowrap">
                                    {{ $value->month_string }}
                                </span>
                            </td>
                            <td class="text-xs text-center whitespace-wrap">
                                {{ $student->totalpresentdaysinthismonth($value->month_string, $academicyear_id) }}
                                %
                            </td>
                            <td>
                                <span class="text-sm font-medium whitespace-nowrap">
                                    {{ $student->totalworkingdayscountinthismonth($value->month_string, $academicyear_id) }}
                                </span>
                            </td>
                            <td>
                                <span class="text-sm font-medium whitespace-nowrap">
                                    {{ $student->totalabsentdayscountinthismonth($value->month_string, $academicyear_id) }}
                                </span>
                            </td>
                            <td>
                                <span class="text-sm font-medium whitespace-nowrap">
                                    {{ $student->totalpresentdayscountinthismonth($value->month_string, $academicyear_id) }}
                                </span>
                            </td>
                            <td>
                                <a class="btn border border-none"
                                    wire:click="downloadattendacereport('{{ $value->id }}')"><span
                                        class="text-sm font-medium text-center" style="color:rgb(0, 221, 0)">
                                        Download Report
                                    </span></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @if ($applyleavemodel)
        <div class="fixed inset-0  z-50 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <div
            class="mt-10 right-0 left-0 z-50 justify-center items-start h-modal md:h-full inset-0 fixed pin overflow-auto bg-smoke-dark flex">
            <div class="bg-white rounded-lg dark:bg-gray-700 w-full lg:w-1/3 shadow-2xl">
                <div class="flex justify-between items-center p-2 rounded-t border-b dark:border-gray-600 bg-primary">
                    <h3 class="text-lg font-semibold text-white">
                        Apply Leave
                    </h3>
                    <button wire:click="closeapplyleavemodel"
                        class="text-white bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="defaultModal">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <form wire:submit.prevent="applyleave">
                    <div class="p-6 space-y-6">
                        <div class="grid grid-cols-12 gap-4 gap-y-3">
                            <div class="col-span-12 sm:col-span-6">
                                <label for="from_date" class="form-label font-medium">From Date</label>
                                <input autocomplete="off" wire:model.lazy="from_date" id="from_date" type="date"
                                    class="form-control">
                                @error('from_date')
                                    <span class="font-semibold text-red-600 mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-span-12 sm:col-span-6">
                                <label for="to_date" class="form-label font-medium">To Date</label>
                                <input autocomplete="off" wire:model.lazy="to_date" id="to_date" type="date"
                                    class="form-control">
                                @error('to_date')
                                    <span class="font-semibold text-red-600 mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-span-12">
                                <label for="reason" class="form-label font-medium">Reason</label>
                                <textarea autocomplete="off" wire:model.lazy="reason" name="reason" id="reason"
                                    type="text" class="form-control"></textarea>
                                @error('reason')
                                    <span class="font-semibold text-red-600 mt-2">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div
                        class="flex flex-row-reverse items-center p-3 gap-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                        <button type="button" wire:click="closeapplyleavemodel"
                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:ring-gray-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600">Cancel</button>
                        <button type="submit" class="btn btn-primary">Apply</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
    @if ($appliedleavemodel)
        <div class="fixed inset-0  z-50 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <div
            class="mt-10 right-0 left-0 z-50 justify-center items-start h-modal md:h-full inset-0 fixed pin overflow-auto bg-smoke-dark flex">
            <div class="bg-white rounded-lg dark:bg-gray-700 lg:w-4/5 shadow-2xl">
                <div class="flex justify-between items-center p-2 rounded-t border-b dark:border-gray-600 bg-primary">
                    <h3 class="text-lg font-semibold text-white">
                        Applied Leaves
                    </h3>
                    <button wire:click="closeappliedleavemodel"
                        class="text-white bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-toggle="defaultModal">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <div class="p-6 space-y-6">
                    <div class=" col-span-12 xl:col-span-8 ">
                        <div class="p-2">
                            <div class="grid grid-cols-12 gap-1">
                                @if ($appliedleaves->isNotEmpty())
                                    <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
                                        <table class="table table-report">
                                            <thead>
                                                <tr>
                                                    <th class="whitespace-nowrap text-lg">From Date</th>
                                                    <th class="whitespace-nowrap text-lg">To Date</th>
                                                    <th class="whitespace-nowrap text-lg">Reason</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($appliedleaves as $key => $value)
                                                    <tr class="intro-x">
                                                        <td class="font-medium whitespace-nowrap">
                                                            {{ \Carbon\Carbon::parse($value->from_date)->format('d, M Y') }}
                                                        </td>
                                                        <td class="font-medium whitespace-nowrap">
                                                            {{ \Carbon\Carbon::parse($value->to_date)->format('d, M Y') }}
                                                        </td>
                                                        <td class="font-medium break-words whitespace-wrap">
                                                            {{ $value->reason }}
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="intro-y col-span-12">
                                        {{ $appliedleaves->links('vendor.livewire.tailwind') }}
                                    </div>
                                @else
                                    @include('helper.datatable.norecordfound')
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
