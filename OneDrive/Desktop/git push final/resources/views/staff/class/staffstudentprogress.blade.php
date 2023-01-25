@extends('../layout/staff/' . $layout)

@section('subhead')
    <title>Edfish - Class</title>
@endsection

@section('breadcrumb')
@include('helper.breadcrumb.breadcrumb', [
    'flag' => 'inactive',
    'url' => 'staffclass',
    'name' => 'Exam',
])
@include('helper.breadcrumb.breadcrumb', [
    'flag' => 'active',
    'name' => 'Student Progress',
])
@endsection

@section('subcontent')
    <div class="col-span-12 mt-3">
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
                    <option>Today</option>
                </select>
            </div>
            <div class="col-span-12 sm:col-span-6 xl:col-span-2 intro-y">
                <button type="button" class="btn btn-primary rounded-lg w-full ">Search</button>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-12 mt-10">
        @include('staff.class.helper.staffclasssidemenuhelper', ['active' =>'studentprogress'])
        <div class="col-span-12 sm:col-span-10 box w-full sm:w-11/12 p-10 intro-y">
            <div class="intro-y col-span-12 overflow-auto">
                <table class="table table-report -mt-2 table-auto">
                    <thead class="bg-primary">
                        <tr class="intro-x">
                            <th class="font-semibold text-white uppercase whitespace-nowrap">
                                <div class="flex">
                                    Roll Number
                            </th>
                            <th class="font-semibold text-white uppercase whitespace-nowrap">
                                <div class="flex">
                                    Student Name
                            </th>
                            <th class="font-semibold text-white uppercase whitespace-nowrap">
                                <div class="flex">
                                    Overall Rank
                                </div>
                            </th>
                            <th class="font-semibold text-white uppercase whitespace-nowrap">
                                <div class="flex">
                                    Tamil
                            </th>
                            <th class="font-semibold text-white uppercase whitespace-nowrap">
                                <div class="flex">
                                    Computer
                            </th>
                            <th class="font-semibold text-white uppercase whitespace-nowrap">
                                <div class="flex">
                                    English
                            </th>
                            <th class="font-semibold text-white uppercase whitespace-nowrap">
                                <div class="flex">
                                    Maths
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="intro-x">
                            <td>
                                <span class="text-sm font-medium whitespace-nowrap">
                                    128
                                </span>
                            </td>
                            <td>
                                <span class="text-sm font-medium whitespace-nowrap">
                                    Mukhilan E
                                </span>
                            </td>
                            <td>
                                <span class="text-sm font-medium whitespace-nowrap">
                                    12
                                </span>
                            </td>
                            <td>
                                <span class="text-sm font-medium whitespace-nowrap flex">
                                    8% <i data-feather="arrow-up" class="text-theme-9 mx-1 w-5 h-5"></i>
                                </span>
                            </td>
                            <td>
                                <span class="text-sm font-medium whitespace-nowrap flex">
                                    3% <i data-feather="arrow-up" class="text-theme-9 mx-1 w-5 h-5"></i>
                                </span>
                            </td>
                            <td>
                                <span class="text-sm font-medium whitespace-nowrap flex">
                                    1% <i data-feather="arrow-up" class="text-theme-9 mx-1 w-5 h-5"></i>
                                </span>
                            </td>
                            <td>
                                <span class="text-sm font-medium whitespace-nowrap flex">
                                    6% <i data-feather="arrow-up" class="text-theme-9 mx-1 w-5 h-5"></i>
                                </span>
                            </td>
                        </tr>
                        <tr class="intro-x">
                            <td>
                                <span class="text-sm font-medium whitespace-nowrap">
                                    678
                                </span>
                            </td>
                            <td>
                                <span class="text-sm font-medium whitespace-nowrap">
                                    Sabari S
                                </span>
                            </td>
                            <td>
                                <span class="text-sm font-medium whitespace-nowrap">
                                    12
                                </span>
                            </td>
                            <td>
                                <span class="text-sm font-medium whitespace-nowrap flex">
                                    8% <i data-feather="arrow-up" class="text-theme-9 mx-1 w-5 h-5"></i>
                                </span>
                            </td>
                            <td>
                                <span class="text-sm font-medium whitespace-nowrap flex">
                                    3% <i data-feather="arrow-up" class="text-theme-9 mx-1 w-5 h-5"></i>
                                </span>
                            </td>
                            <td>
                                <span class="text-sm font-medium whitespace-nowrap flex">
                                    1% <i data-feather="arrow-down" class="text-theme-6 mx-1 w-5 h-5"></i>
                                </span>
                            </td>
                            <td>
                                <span class="text-sm font-medium whitespace-nowrap flex">
                                    6% <i data-feather="arrow-up" class="text-theme-9 mx-1 w-5 h-5"></i>
                                </span>
                            </td>
                        </tr>
                        <tr class="intro-x">
                            <td>
                                <span class="text-sm font-medium whitespace-nowrap">
                                    980
                                </span>
                            </td>
                            <td>
                                <span class="text-sm font-medium whitespace-nowrap">
                                    Muhundhan E
                                </span>
                            </td>
                            <td>
                                <span class="text-sm font-medium whitespace-nowrap">
                                    12
                                </span>
                            </td>
                            <td>
                                <span class="text-sm font-medium whitespace-nowrap flex">
                                    8% <i data-feather="arrow-up" class="text-theme-9 mx-1 w-5 h-5"></i>
                                </span>
                            </td>
                            <td>
                                <span class="text-sm font-medium whitespace-nowrap flex">
                                    3% <i data-feather="arrow-up" class="text-theme-9 mx-1 w-5 h-5"></i>
                                </span>
                            </td>
                            <td>
                                <span class="text-sm font-medium whitespace-nowrap flex">
                                    1% <i data-feather="arrow-up" class="text-theme-9 mx-1 w-5 h-5"></i>
                                </span>
                            </td>
                            <td>
                                <span class="text-sm font-medium whitespace-nowrap flex">
                                    6% <i data-feather="arrow-up" class="text-theme-9 mx-1 w-5 h-5"></i>
                                </span>
                            </td>
                        </tr>
                        <tr class="intro-x">
                            <td>
                                <span class="text-sm font-medium whitespace-nowrap">
                                    111
                                </span>
                            </td>
                            <td>
                                <span class="text-sm font-medium whitespace-nowrap">
                                    Vignesh
                                </span>
                            </td>
                            <td>
                                <span class="text-sm font-medium whitespace-nowrap">
                                    12
                                </span>
                            </td>
                            <td>
                                <span class="text-sm font-medium whitespace-nowrap flex">
                                    8% <i data-feather="arrow-up" class="text-theme-9 mx-1 w-5 h-5"></i>
                                </span>
                            </td>
                            <td>
                                <span class="text-sm font-medium whitespace-nowrap flex">
                                    3% <i data-feather="arrow-up" class="text-theme-9 mx-1 w-5 h-5"></i>
                                </span>
                            </td>
                            <td>
                                <span class="text-sm font-medium whitespace-nowrap flex">
                                    1% <i data-feather="arrow-up" class="text-theme-9 mx-1 w-5 h-5"></i>
                                </span>
                            </td>
                            <td>
                                <span class="text-sm font-medium whitespace-nowrap flex">
                                    6% <i data-feather="arrow-up" class="text-theme-9 mx-1 w-5 h-5"></i>
                                </span>
                            </td>
                        </tr>
                        <tr class="intro-x">
                            <td>
                                <span class="text-sm font-medium whitespace-nowrap">
                                    128
                                </span>
                            </td>
                            <td>
                                <span class="text-sm font-medium whitespace-nowrap">
                                    Rahul
                                </span>
                            </td>
                            <td>
                                <span class="text-sm font-medium whitespace-nowrap">
                                    12
                                </span>
                            </td>
                            <td>
                                <span class="text-sm font-medium whitespace-nowrap flex">
                                    8% <i data-feather="arrow-up" class="text-theme-9 mx-1 w-5 h-5"></i>
                                </span>
                            </td>
                            <td>
                                <span class="text-sm font-medium whitespace-nowrap flex">
                                    3% <i data-feather="arrow-up" class="text-theme-9 mx-1 w-5 h-5"></i>
                                </span>
                            </td>
                            <td>
                                <span class="text-sm font-medium whitespace-nowrap flex">
                                    1% <i data-feather="arrow-up" class="text-theme-9 mx-1 w-5 h-5"></i>
                                </span>
                            </td>
                            <td>
                                <span class="text-sm font-medium whitespace-nowrap flex">
                                    6% <i data-feather="arrow-up" class="text-theme-9 mx-1 w-5 h-5"></i>
                                </span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('#staffclass').addClass("side-menu--active");
    </script>
@endsection
