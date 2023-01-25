@extends('../layout/staff/' . $layout)

@section('subhead')
    <title>Edfish - Student</title>
@endsection

@section('breadcrumb')
    <i data-feather="chevron-right" class="breadcrumb__icon"></i>
    <p class="breadcrumb--active">Student</p>
@endsection

@section('subcontent')
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
                                Today's <br> Birthday
                            </div>
                            <div class="ml-auto text-4xl">
                                9
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
                                Today's <br> Attendance
                            </div>
                            <div class="ml-auto text-4xl">
                                80%
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
                                Today's <br> Complaints
                            </div>
                            <div class="ml-auto text-4xl">
                                2
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                <a class="zoom-in btn rounded-lg btn-outline-primary hover:text-white dark:text-white w-5/6 mx-8">Add
                    Student</a>
                <a href="{{ route('staffstudentleaveindex') }}" type="button"
                    class="zoom-in btn rounded-lg btn-outline-primary hover:text-white dark:text-white w-5/6 mx-8 mt-3">Attendance
                    & Leaves</a>
                <a href="{{ route('staffstudentcomplaintspending') }}" type="button"
                    class="zoom-in btn rounded-lg btn-outline-primary hover:text-white dark:text-white w-5/6 mx-8 mt-3">Complaints</a>
            </div>
        </div>
    </div>
    <div class="col-span-12 mt-8">
        <div class="intro-y flex items-center h-10">
            <h2 class="text-lg font-medium truncate mr-5">Search Student</h2>
        </div>
        <div class="grid grid-cols-12 gap-6 mt-2">
            <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                <select data-placeholder="Select your favorite actors" class="tom-select w-full">
                    <option value="1">Class 10th</option>
                    <option value="2">Class 9th</option>
                    <option value="3">Class 8th</option>
                    <option value="4">Class 7th</option>
                    <option value="5">Class 6th</option>
                </select>
            </div>
            <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                <select data-placeholder="Select your favorite actors" class="tom-select w-full">
                    <option value="1">Section A</option>
                    <option value="2">Section A</option>
                    <option value="3">Section A</option>
                    <option value="4">Section A</option>
                    <option value="5">Section A</option>
                </select>
            </div>
            <div class="col-span-12 sm:col-span-6 xl:col-span-4 intro-y">
                <select data-placeholder="Select your favorite actors" class="tom-select w-full">
                    <option>Select By Name, Roll No, Id</option>
                </select>
            </div>
            <div class="col-span-12 sm:col-span-6 xl:col-span-2 intro-y">
                <button type="button" class="btn btn-primary rounded-lg w-full ">Search</button>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-12 gap-1 mt-5">
        <!-- BEGIN: Data List -->
        <div class="intro-y col-span-12 overflow-auto lg:overflow-visible">
            <table class="table table-report -mt-2">
                <thead class="bg-primary">
                    <tr class="intro-x">
                        <th class="text-center font-semibold text-white uppercase whitespace-nowrap">
                            <div class="flex">
                                Admission Number
                        </th>
                        <th class="text-center font-semibold text-white uppercase whitespace-nowrap">
                            <div class="flex">
                                Role Number
                        </th>
                        <th class="text-center font-semibold text-white uppercase whitespace-nowrap">
                            <div class="flex">
                                Student Name
                                <span wire:click="sortBy('name')">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="feather feather-arrow-down">
                                        <line x1="12" y1="5" x2="12" y2="19"></line>
                                        <polyline points="19 12 12 19 5 12"></polyline>
                                    </svg>
                                </span>
                            </div>
                        </th>
                        <th class="text-center font-semibold text-white uppercase whitespace-nowrap">
                            <div class="flex">
                                Gender
                        </th>
                        <th class="text-center font-semibold text-white uppercase whitespace-nowrap">
                            <div class="flex">
                                Contact Number
                        </th>
                        <th class="text-center font-semibold text-white uppercase whitespace-nowrap">
                            <div class="flex">
                                Father Name
                        </th>
                        <th class="text-center font-semibold text-white uppercase whitespace-nowrap">
                            <div class="flex">
                                Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="intro-x">
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                212416104030
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                1
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                Hiran Kalyan
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                MALE
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                +91 1234567890
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                Elangovan
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('staffstudentinfo') }}"
                                class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300"
                                style="color:rgb(0, 221, 0)">
                                View Data
                            </a>
                        </td>
                    </tr>
                    <tr class="intro-x">
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                212416104012
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                1
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                Ananthi Elangovan
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                FEMALE
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                +91 1234567890
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                Elangovan
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('staffstudentinfo') }}"
                                class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300"
                                style="color:rgb(0, 221, 0)">
                                View Data
                            </a>
                        </td>
                    </tr>
                    <tr class="intro-x">
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                212416104011
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                11
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                Sabari Vijayarani
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                MALE
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                +91 1234567890
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                dsdvsdv
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('staffstudentinfo') }}"
                                class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300"
                                style="color:rgb(0, 221, 0)">
                                View Data
                            </a>
                        </td>
                    </tr>
                    <tr class="intro-x">
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                212416104029
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                29
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                Muhundhan Elangovan
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                MALE
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                +91 7395944079
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                Elangovan
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('staffstudentinfo') }}"
                                class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300"
                                style="color:rgb(0, 221, 0)">
                                View Data
                            </a>
                        </td>
                    </tr>
                    <tr class="intro-x">
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                212416104030
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                30
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                Mukhilan Elangovan
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                MALE
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                +91 7395944078
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                Elangovan
                            </span>
                        </td>
                        <td>
                            <a href="{{ route('staffstudentinfo') }}"
                                class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300"
                                style="color:rgb(0, 221, 0)">
                                View Data
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <div>
            </div>

            <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto">
                <select wire:click="updatepagination" wire:model="paginationlength"
                    class="w-20 form-select box mt-3 sm:mt-0 hidden md:block text-gray-600 mx-0">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                </select>
            </div>
        </div>

    </div>
@endsection

@section('script')
    <script>
        $('#staffstudentindex').addClass("side-menu--active");

    </script>
@endsection
