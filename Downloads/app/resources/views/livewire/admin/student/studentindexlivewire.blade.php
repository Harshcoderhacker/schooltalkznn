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
                                Total <br>Students
                            </div>
                            <div class="ml-auto text-4xl">
                                {{ $totalstudents }}
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
                                Today's <br> Birthday
                            </div>
                            <div class="ml-auto text-4xl">
                                {{ $birthdaycount }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if (env('SCHOOLTALKZ') == false)
           {{--  <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                <div class="report-box zoom-in">
                    <div class="box p-5 rounded-lg bg-primary">
                        <div class="flex flex-col text-white font-bold">
                            <div class="text-xl">
                                Today's <br> Complaints
                            </div>
                            <div class="ml-auto text-4xl">
                                2
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            @endif
            <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                <a type="button" data-tw-toggle="modal" data-tw-target="#delete-modal-preview" class="zoom-in btn btn-outline-primary inline-block mr-1 mb-2 w-5/6 mx-8">Add
                    Student</a>
                @if (env('SCHOOLTALKZ') == false)
                {{-- <a type="button" data-tw-toggle="modal" data-tw-target="#promote-modal-preview" class="zoom-in btn btn-outline-primary inline-block mr-1 mb-2 w-5/6 mx-8 mt-3">Promote
                    Student</a> --}}
                {{-- <a href="{{ route('studentcomplaints') }}" type="button"
                class="zoom-in btn btn-outline-primary inline-block mr-1 mb-2 w-5/6 mx-8 mt-3">Complaints</a> --}}
                @endif
            </div>
        </div>
    </div>
    <div class="col-span-12 mt-5">
        <div class="intro-y flex items-center h-10">
            <h2 class="text-lg font-medium truncate mr-5">Search Student</h2>
        </div>
        <div class="grid grid-cols-12 gap-6 mt-2 w-full sm:w-11/12 mx-auto">
            <div class="col-span-12 sm:col-span-4 intro-y">
                <select wire:model="classmasterid" class="form-select w-full mt-5">
                    <option value="0">Select Class </option>
                    @foreach ($classmaster as $eachclassmaster)
                    <option value="{{ $eachclassmaster->id }}">
                        {{ $eachclassmaster->name }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div class="col-span-12 sm:col-span-4 intro-y">
                <select wire:model="sectionid" class="form-select w-full mt-5">
                    <option value="0">Select Section </option>
                    @foreach ($section as $eachsection)
                    <option value="{{ $eachsection->id }}">
                        {{ $eachsection->name }}
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
        @if ($student->isNotEmpty())
        <div class="flex flex-col mt-8 intro-y">
            <div class="mx-5">
                <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                        <div class="overflow-hidden">
                            <table class="table table-report -mt-2">
                                <thead class="bg-primary">
                                    <tr class="intro-x">
                                        <!-- <th
                                                class="whitespace-nowrap text-xs font-semibold text-white uppercase tracking-wider">
                                                <div class="flex">
                                                    Admission Number
                                                    @include('helper.datatable.sorting', [
                                                        'method' => 'sortBy',
                                                        'value' => 'addmission_number',
                                                    ])
                                                </div>
                                            </th> -->
                                        <th scope="col" class="whitespace-nowrap text-xs font-semibold text-white uppercase tracking-wider">
                                            <div class="flex">
                                                Role Number
                                                @include('helper.datatable.sorting', [
                                                'method' => 'sortBy',
                                                'value' => 'roll_no',
                                                ])
                                            </div>
                                        </th>
                                        <th scope="col" class="text-center whitespace-nowrap text-xs font-semibold text-white uppercase tracking-wider">
                                            <div class="flex">
                                                Student Name
                                                @include('helper.datatable.sorting', [
                                                'method' => 'sortBy',
                                                'value' => 'name',
                                                ])
                                            </div>
                                        </th>
                                        <th scope="col" class="whitespace-nowrap text-xs font-semibold text-white uppercase tracking-wider">
                                            Gender
                                        </th>
                                        <th scope="col" class="whitespace-nowrap text-xs font-semibold text-white uppercase tracking-wider">
                                            Contact Number
                                        </th>
                                        <th scope="col" class="whitespace-nowrap text-xs font-semibold text-white uppercase tracking-wider">
                                            Father Name
                                        </th>
                                        <th scope="col" class="whitespace-nowrap text-xs text-center font-semibold text-white uppercase tracking-wider">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($student as $index => $value)
                                    <tr class="intro-x">
                                        <!-- <td class="px-6 py-4 whitespace-nowrap">
                                                    <span
                                                        class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                                        {{ $value->addmission_number }}
                                                    </span>
                                                </td> -->
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                                {{ $value->roll_no }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                                {{ $value->name }} {{ $value->last_name }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                                {{ config('archive.gender')[$value->gender] }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                                +91 {{ $value->phone_no }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                                {{ $value->aparent?->father_name }}
                                            </span>
                                        </td>
                                        <td class="py-4 whitespace-nowrap text-center">
                                            <div class="flex justify-center gap-2 items-center">
                                                <a class="text-green-600" href="{{ route('adminstudentdetails', ['student' => $value->id]) }}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="green" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye">
                                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z">
                                                        </path>
                                                        <circle cx="12" cy="12" r="3">
                                                        </circle>
                                                    </svg></a>


                                                <a href="{{ route('addstudent.createoreditstudent', ['student' => $value->id, 'show' => 1]) }}">
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
                @include('helper.datatable.pagination', ['pagination' => $student])
            </div>
        </div>
        @else
        @include('helper.datatable.norecordfound')
        @endif
        {{-- After clicking add student modal --}}
        <div id="delete-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="modal-header bg-primary text-white font-semibold">
                            <h2 class="font-medium text-base mx-auto">Add Student</h2>
                            <button data-tw-dismiss="modal">
                                <i data-feather="x-circle" class="w-6 h-6 mr-2"></i>
                            </button>
                        </div>
                        <div class="p-5 grid grid-cols-2 gap-5">
                            <a href="{{ route('addstudent') }}" class=" p-3 rounded-lg text-center bg-green-400 w-auto font-semibold mr-1 text-white" style="background-color: rgba(16, 185, 129)">Add 1
                                Student</a>
                            <a href="{{ route('studentbulkupload') }}" class="p-3 rounded-lg text-center bg-purple-600 w-auto font-semibold mr-1 text-white" style="background-color: rgb(128, 0, 117)">Bulk Upload
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        @include('livewire.admin.student.studentshow')
    </div>