@extends('../layout/staff/' . $layout)

@section('subhead')
    <title>Edfish - Virtual Class</title>
@endsection

@section('breadcrumb')
    @include('helper.breadcrumb.breadcrumb', [
        'flag' => 'active',
        'name' => 'Virtual Class',
    ])
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
                    <div class="box p-5 rounded-lg bg-primary h-24">
                        <div class="flex flex-col text-white font-bold">
                            <div class="text-xl">
                                Today Classes
                            </div>
                            <div class="ml-auto text-4xl">
                                9
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                <a href="{{ route('staffcreatevirutalmeeting') }}"
                    class="zoom-in btn btn-outline-primary inline-block mr-1 mb-2 w-5/6 mx-8">Create
                    Meeting</a>
            </div>
            <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                <a class="zoom-in btn btn-outline-primary inline-block mr-1 mb-2 w-5/6 mx-8">Join
                    Meeting</a>
            </div>
            <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                <a href="{{ route('staffvirtualclassschedules') }}"
                    class="zoom-in btn btn-outline-primary inline-block mr-1 mb-2 w-5/6 mx-8">View
                    Class Schedules</a>
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
