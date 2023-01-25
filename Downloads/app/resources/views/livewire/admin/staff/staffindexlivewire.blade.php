<div>
    <div class="col-span-12">
        <div class="intro-y flex items-center h-10">
            <a href="" class="ml-auto flex items-center text-theme-1 dark:text-theme-10">
                <i data-feather="refresh-ccw" class="w-4 h-4 mr-3"></i> Reload Data
            </a>
        </div>
        <div class="grid grid-cols-12 gap-6 mt-2">
            <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                <div class="report-box zoom-in">
                    <div class="box p-5 rounded-lg bg-primary">
                        <div class="flex flex-col text-white font-bold">
                            <div class="text-xl">
                                Number of <br>
                                Teachers
                            </div>
                            <div class="ml-auto text-4xl">
                                {{ $staffcount }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if (env('SCHOOLTALKZ') == false)
            <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                <div class="report-box zoom-in">
                    <div class="box p-5 rounded-lg bg-primary">
                        <div class="flex flex-col text-white font-bold">
                            <div class="text-xl">
                                Today's <br>
                                Attendance
                            </div>
                            <div class="ml-auto text-4xl">
                                {{ $todayattendancepercentage }} %
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                <div class="report-box zoom-in">
                    <div class="box p-5 rounded-lg bg-primary">
                        <div class="flex flex-col text-white font-bold">
                            <div class="text-xl">
                                Today's <br>
                                Complaints
                            </div>
                            <div class="ml-auto text-4xl">
                                12
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                <a type="button" data-tw-toggle="modal" data-tw-target="#add-staff-preview" class="zoom-in btn btn-outline-primary inline-block mr-1 mb-2 w-5/6 mx-8 ">Add Teacher</a>
                @if (env('SCHOOLTALKZ') == false)
                <a href="{{ route('staffattendanceindex') }}" class="zoom-in btn btn-outline-primary inline-block mr-1 mb-2 w-5/6 mx-8 ">Attendance</a>
                <a href="{{ route('payroll') }}" class="zoom-in btn btn-outline-primary inline-block mr-1 mb-2 w-5/6 mx-8 ">Payroll</a>
                <a href="{{ route('adminstaffclassroutineindex') }}" class="zoom-in btn btn-outline-primary inline-block mr-1 mb-2 w-5/6 mx-8 ">Class Routine</a>
                @endif
            </div>
        </div>
    </div>
    <div class="col-span-12 mt-5">
        <div class="intro-y flex items-center h-10">
            <h2 class="text-lg font-medium truncate mr-5">Search Teacher</h2>
        </div>
        <div class="grid grid-cols-12 gap-6 mt-2 w-full sm:w-11/12 mx-auto">
            <div class="col-span-12 sm:col-span-4 intro-y">
                <select wire:model="departmentid" class="form-select w-full mt-5">
                    <option value="0">Select A Department</option>
                    @foreach ($department as $eachdepartment)
                    <option value="{{ $eachdepartment->id }}">
                        {{ $eachdepartment->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-span-12 sm:col-span-4 intro-y">
                <select wire:model="designationid" class="form-select w-full mt-5">
                    <option value="0">Select designation </option>
                    @foreach ($designation as $eachdesignation)
                    <option value="{{ $eachdesignation->id }}">
                        {{ $eachdesignation->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="intro-y col-span-12 sm:col-span-4 flex flex-wrap sm:flex-nowrap items-center mt-5 w-full">
                <div class="mt-3 sm:mt-0">
                    <div class="relative text-gray-700 dark:text-gray-300">
                        <input wire:model="searchTerm" type="text" class="form-control pr-10 placeholder-theme-13" placeholder="Search...">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search w-4 h-4 absolute my-auto inset-y-0 mr-3 right-0">
                            <circle cx="11" cy="11" r="8"></circle>
                            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if ($staff->isNotEmpty())
    <div class="flex flex-col mt-8 intro-y">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="overflow-hidden">
                    <table class="table table-report -mt-2">
                        <thead class="bg-primary">
                            <tr class="intro-x">
                                <th scope="col" class="whitespace-nowrap text-xs font-semibold text-white uppercase tracking-wider">
                                    Staff ID
                                </th>
                                <th scope="col" class="whitespace-nowrap text-xs font-semibold text-white uppercase tracking-wider">
                                    Role
                                </th>
                                <th scope="col" class="whitespace-nowrap text-xs font-semibold text-white uppercase tracking-wider">
                                    <div class="flex">
                                        Teacher Name
                                        @include('helper.datatable.sorting', [
                                        'method' => 'sortBy',
                                        'value' => 'name',
                                        ])
                                    </div>
                                </th>
                                <th scope="col" class="whitespace-nowrap text-xs font-semibold text-white uppercase tracking-wider">
                                    Department
                                </th>
                                <th scope="col" class="whitespace-nowrap text-xs font-semibold text-white uppercase tracking-wider">
                                    Designation
                                </th>
                                <th scope="col" class="whitespace-nowrap text-xs font-semibold text-white uppercase tracking-wider">
                                    Contact Number
                                </th>
                                <th scope="col" class="whitespace-nowrap text-center text-xs font-semibold text-white uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($staff as $index => $value)
                            <tr class="intro-x">
                                <td class="font-medium whitespace-nowrap">
                                    {{ $value->staff_roll_id }}
                                </td>
                                <td class="font-medium whitespace-nowrap">
                                    {{ \Spatie\Permission\Models\Role::find($value->role)?->name }}
                                </td>
                                <td class="font-medium whitespace-nowrap">
                                    {{ $value->name }}
                                </td>
                                <td class="font-medium whitespace-nowrap">
                                    {{ $value->staffdepartment?->name }}
                                </td>
                                <td class="font-medium whitespace-nowrap">
                                    {{ $value->staffdesignation?->name }}
                                </td>
                                <td class="font-medium whitespace-nowrap">
                                    {{ $value->phone }}
                                </td>
                                <td class="font-medium whitespace-nowrap">
                                    <div class="flex justify-center gap-1 items-center">
                                        <a class="text-green-600" href="{{ route('adminstaffprofileinfo', ['staff' => $value->id]) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="green" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye">
                                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z">
                                                </path>
                                                <circle cx="12" cy="12" r="3">
                                                </circle>
                                            </svg></a>
                                        <a href="{{ route('adminstaff.createoreditstaff', ['staff' => $value->id, 'show' => 1]) }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7">
                                                </path>
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z">
                                                </path>
                                            </svg></a>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @include('helper.datatable.pagination', ['pagination' => $staff])
    </div>
    @else
    @include('helper.datatable.norecordfound')

    @endif
    @include('livewire.admin.staff.staffshow')
</div>

<div id="add-staff-preview" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="modal-header bg-primary text-white font-semibold">
                    <h2 class="font-medium text-base mx-auto">Add Staff</h2>
                    <button data-tw-dismiss="modal">
                        <i data-feather="x-circle" class="w-6 h-6 mr-2"></i>
                    </button>
                </div>
                <div class="p-5 grid grid-cols-2 gap-5">
                    <a href="{{ route('addstaffinfromation') }}" class=" p-3 rounded-lg text-center bg-green-400 w-auto font-semibold mr-1 text-white" style="background-color: rgba(16, 185, 129)">Add 1
                        Staff</a>
                    <a href="{{route('staffbulkupload')}}" class="p-3 rounded-lg text-center bg-purple-600 w-auto font-semibold mr-1 text-white" style="background-color: rgb(128, 0, 117)">Bulk Upload
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>