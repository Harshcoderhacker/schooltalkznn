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
                    <div class=" box p-5 rounded-lg bg-primary">
                        <div class="flex flex-col text-white font-bold">
                            <div class="text-xl">
                                Today's <br> Attendance
                            </div>
                            <div class="ml-auto text-4xl">
                                {{ $todayattendancepercentage }} %
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
                                Leave <br> Approvals
                            </div>
                            <div class="ml-auto text-4xl">
                                7
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
                                Todays's Pending <br> Attendance
                            </div>
                            <div class="ml-auto text-4xl">
                                12
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-12 sm:col-span-3 intro-y">
                <a href="{{ route('staffleaverequest') }}" type="button"
                    class="zoom-in btn rounded-lg btn-outline-primary dark:text-white w-5/6 mx-8 mt-3">Leave
                    Request</a>
                <a href="{{ route('staffapprovedleave') }}" type="button"
                    class="zoom-in btn rounded-lg btn-outline-primary dark:text-white w-5/6 mx-8 mt-3">Apply
                    Leave</a>
                <a href="{{ route('smartattendanceindex') }}" type="button"
                    class="zoom-in btn rounded-lg btn-outline-primary dark:text-white w-5/6 mx-8 mt-3">Smart
                    Attendance</a>
            </div>
        </div>
    </div>
    <div class="col-span-12 mt-8">
        <div class="intro-y flex items-center h-10">
            <h2 class="text-lg font-medium truncate mr-5">Search Staff</h2>
        </div>
        <div class="w-full mx-auto sm:w-2/3 sm:mx-auto">
            <div class="grid grid-cols-8 gap-6 mt-2">
                <div class="col-span-4 intro-y">
                    <select wire:model="designationid" class="form-select w-full">
                        <option value="0">Select Designation</option>
                        @foreach ($designation as $eachdesignation)
                            <option value="{{ $eachdesignation->id }}">
                                {{ $eachdesignation->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-span-4 intro-y">
                    <input wire:model="attendance_date" type="date" class="form-control">
                </div>
            </div>
        </div>
    </div>
    @if ($staffattendance->isNotEmpty())
        <div class="flex flex-col mt-8 intro-y">
            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                    <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                        <table class="table table-report -mt-2">
                            <thead class="bg-primary">
                                <tr class="intro-x">
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                        DESIGNATION
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                        ATTENDANCE PERCENTAGE
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                        ATTENDANCE DATE
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                        Marked By
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                        Attendance Status
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-xs font-semibold text-white uppercase tracking-wider text-center">
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($staffattendance as $eachstaffattendance)
                                    <tr class="intro-x">
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                                {{ $eachstaffattendance->staffdesignation->name }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                                {{ $eachstaffattendance->attendance_percentage ? $eachstaffattendance->attendance_percentage : 'Not Taken Yet' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                                {{ \Carbon\Carbon::parse($eachstaffattendance->attendance_date)->format('F, d Y') }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                                @if ($eachstaffattendance->usertype)
                                                    {{ App\Models\Admin\Auth\User::find($eachstaffattendance->marked_id)->name }}
                                                @else
                                                    Not Taken Yet
                                                @endif
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="inline-flex text-xs leading-5 font-semibold rounded-full {{ $eachstaffattendance->attendance_status ? 'text-green-600' : 'text-red-600' }}">
                                                {{ $eachstaffattendance->attendance_status ? 'Marked' : 'Unmarked' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-center">
                                            <button wire:click="showattendancemodel({{ $eachstaffattendance->id }})"
                                                class="btn btn-outline-warning zoom-in inline-block mr-1 mb-2">View
                                                Attendance</button>
                                            @if ($eachstaffattendance->attendance_status)
                                                <a href="{{ route('adminstaffmarkattendance', $eachstaffattendance->id) }}"
                                                    type="button"
                                                    class="btn btn-outline-danger zoom-in inline-block mr-1 mb-2">Retake
                                                    Attendance</a>
                                            @else
                                                <a href="{{ route('adminstaffmarkattendance', $eachstaffattendance->id) }}"
                                                    type="button"
                                                    class="btn btn-outline-success zoom-in inline-block mr-1 mb-2">Take
                                                    Attendance</a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @include('helper.datatable.pagination', ['pagination' => $staffattendance])
    @else
        @include('helper.datatable.norecordfound')
    @endif
    {{-- Attendance Details --}}
    @if ($openattendance)
        <div class="fixed inset-0  z-50 transition-opacity">
            <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
        </div>
        <div
            class="mt-10 right-0 left-0 z-50 justify-center items-start h-modal md:h-full inset-0 fixed pin overflow-auto bg-smoke-dark flex">
            <div class="bg-white rounded-lg dark:bg-gray-700 lg:w-4/5 shadow-2xl">
                <div class="flex justify-between items-center p-2 rounded-t border-b dark:border-gray-600 bg-primary">
                    <h3 class="text-lg font-semibold text-white">
                        Attendance Details
                    </h3>
                    <button wire:click="closeattendancemodal"
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
                    <div class="text-center">
                        <p class="text-theme-1 font-medium text-lg">Staff Attendance of <span
                                class="font-semibold underline decoration-sky-500">{{ $showstaffattendance->staffdesignation->name }}</span>
                            Department -
                            {{ \Carbon\Carbon::parse($showstaffattendance->attendance_date)->format('F, d Y') }}
                        </p>
                    </div>
                    <div class="grid grid-cols-12 gap-6 mt-5">
                        <div class="col-span-12 sm:col-span-3 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-5 rounded-lg bg-primary">
                                    <div class="flex flex-col text-white font-bold">
                                        <div class="text-base">
                                            Number of Staff
                                        </div>
                                        <div class="ml-auto text-2xl">
                                            {{ $showstaffattendance->staffattendancelist->count() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-3 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-5 rounded-lg" style="background-color: #F39C12">
                                    <div class="flex flex-col text-white font-bold">
                                        <div class="text-base">
                                            Present
                                        </div>
                                        <div class="ml-auto text-2xl">
                                            {{ $showstaffattendance->presentstaff->count() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-3 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-5 rounded-lg" style="background-color: #8E44AD">
                                    <div class="flex flex-col text-white font-bold">
                                        <div class="text-base">
                                            Leave
                                        </div>
                                        <div class="ml-auto text-2xl">
                                            {{ $showstaffattendance->absentstaff->count() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-3 intro-y">
                            <div class="report-box zoom-in">
                                <div class="box p-5 rounded-lg" style="background-color: #2ECC71">
                                    <div class="flex flex-col text-white font-bold">
                                        <div class="text-base">
                                            Late
                                        </div>
                                        <div class="ml-auto text-2xl">
                                            {{ $showstaffattendance->latestaff->count() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-span-12 sm:col-span-4 intro-y">
                            <h1 class="text-2xl font-semibold">List of Absentees</h1>
                            <ol class="list-decimal list-inside mt-3">
                                @foreach ($showstaffattendance->absentstaff as $eachstaff)
                                    <li>{{ $eachstaff->staff->name }}</li>
                                @endforeach
                            </ol>
                        </div>
                    </div>
                </div>
                <div
                    class="flex justify-center items-center p-3 gap-2 rounded-b border-t border-gray-200 dark:border-gray-600">
                    <button wire:click="sendnotification" class="btn btn-primary">Send Notification</button>
                </div>
            </div>
        </div>
    @endif
</div>
