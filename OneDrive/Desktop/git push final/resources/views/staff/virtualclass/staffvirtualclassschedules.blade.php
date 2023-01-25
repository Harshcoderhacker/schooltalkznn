@extends('../layout/staff/' . $layout)

@section('subhead')
    <title>Edfish - Virtual Class</title>
@endsection

@section('breadcrumb')
@include('helper.breadcrumb.breadcrumb', [
        'flag' => 'inactive',
        'url' => 'staffvirtualclass',
        'name' => 'Virtual Class',
    ])
    @include('helper.breadcrumb.breadcrumb', [
        'flag' => 'active',
        'name' => 'Class Schedules',
    ])
@endsection


@section('subcontent')
    <div class="col-span-12 mt-8">
        <div class="intro-y flex items-center h-10">
            <h2 class="text-lg font-medium truncate mr-5">Class Schedules</h2>
        </div>
        <div class="w-full mx-auto sm:w-5/6 sm:mx-32">
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
                <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                    <input id="input-wizard-2" type="date" class="form-control">
                </div>
                <div class="col-span-12 sm:col-span-6 xl:col-span-2 intro-y">
                    <button type="button" class="btn btn-primary rounded-lg w-full ">Search</button>
                </div>
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
                                Title
                        </th>
                        <th class="font-semibold text-white uppercase whitespace-nowrap">
                            <div class="flex">
                                Date
                        </th>
                        <th class="font-semibold text-white uppercase whitespace-nowrap">
                            <div class="flex">
                                Start Time
                            </div>
                        </th>
                        <th class="font-semibold text-white uppercase whitespace-nowrap">
                            <div class="flex">
                                End Date
                        </th>
                        <th class="font-semibold text-white uppercase whitespace-nowrap">
                            <div class="flex">
                                Class
                        </th>
                        <th class="font-semibold text-white uppercase whitespace-nowrap">
                            <div class="flex">
                                Section
                        </th>
                        <th class="font-semibold text-white uppercase whitespace-nowrap">
                            <div class="flex">
                                Host
                        </th>
                        <th class="font-semibold text-white uppercase whitespace-nowrap">
                            <div class="flex">
                                Recurring
                        </th>
                        <th class="font-semibold text-white uppercase whitespace-nowrap">
                            <div class="flex">
                                Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="intro-x">
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                English
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                November 7, 2021
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                10 AM
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                10.45 PM
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                VI
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                A
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                Mr. Sabari Raj
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                Yes
                            </span>
                        </td>
                        <td>
                            <div class="text-sm font-medium whitespace-nowrap flex flex-row">
                                <button type="button" class="btn btn-warning w-24">Ended</button>
                                <i data-feather="layers" class="mb-auto mt-auto mx-3"></i>
                                <i data-feather="bell" class="mb-auto mt-auto"></i>
                            </div>
                        </td>
                    </tr>
                    <tr class="intro-x">
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                Laravel
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                November 7, 2021
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                10 AM
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                10.45 PM
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                VI
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                A
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                Mr. Sabari Raj
                            </span>
                        </td>
                        <td>
                            <span class="text-sm font-medium whitespace-nowrap">
                                Yes
                            </span>
                        </td>
                        <td>
                            <div class="text-sm font-medium whitespace-nowrap flex flex-row">
                                <button type="button" class="btn btn-primary w-24">Join</button>
                                <i data-feather="layers" class="mb-auto mt-auto mx-3"></i>
                                <i data-feather="bell" class="mb-auto mt-auto"></i>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
            <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto">
                <select class="w-20 form-select box mt-3 sm:mt-0 hidden md:block text-gray-600 mx-0">
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
        $('#staffvirtualclass').addClass("side-menu--active");
    </script>
@endsection
