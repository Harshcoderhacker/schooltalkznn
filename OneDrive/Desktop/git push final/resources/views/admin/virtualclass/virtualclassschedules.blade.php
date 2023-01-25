@extends('../layout/admin/' . $layout)

@section('subhead')
    <title>Edfish - Virtual Class</title>
@endsection

@section('breadcrumb')
    @include('helper.breadcrumb.breadcrumb', [
        'flag' => 'inactive',
        'url' => 'adminvirtualclass',
        'name' => 'Virtual Class',
    ])
    @include('helper.breadcrumb.breadcrumb', [
        'flag' => 'active',
        'name' => 'Class Schedules',
    ])
@endsection

@section('subcontent')
    <div class="col-span-12 mt-3">
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
    <div class="flex flex-col mt-8 intro-y">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="table table-report -mt-2">
                        <thead class="bg-primary">
                            <tr class="intro-x">
                                <th scope="col"
                                    class="px-6 py-3 text-left text-sm font-semibold text-white uppercase tracking-wider">
                                    Title
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-sm font-semibold text-white uppercase tracking-wider">
                                    Date
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-sm font-semibold text-white uppercase tracking-wider">
                                    Start Time
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-sm font-semibold text-white uppercase tracking-wider">
                                    End Time
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-sm font-semibold text-white uppercase tracking-wider">
                                    Class
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-sm font-semibold text-white uppercase tracking-wider">
                                    Section
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-sm font-semibold text-white uppercase tracking-wider">
                                    Host
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-sm font-semibold text-white uppercase tracking-wider">
                                    REcurring
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-sm font-semibold text-white uppercase tracking-wider">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="intro-x">
                                <td>
                                    <span
                                        class="inline-flex text-sm leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        English
                                    </span>
                                </td>
                                <td>
                                    <span
                                        class="inline-flex text-sm leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        Sept 30, 2021
                                    </span>
                                </td>
                                <td>
                                    <span
                                        class="inline-flex text-sm leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        10.00 AM
                                    </span>
                                </td>
                                <td>
                                    <span
                                        class="inline-flex text-sm leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        11.00 PM
                                    </span>
                                </td>
                                <td>
                                    <span
                                        class="inline-flex text-sm leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        VI
                                    </span>
                                </td>
                                <td>
                                    <span
                                        class="inline-flex text-sm leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        A
                                    </span>
                                </td>
                                <td>
                                    <span
                                        class="inline-flex text-sm leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        Mr. Mukhilan
                                    </span>
                                </td>
                                <td>
                                    <span
                                        class="inline-flex text-sm leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
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
                            <tr class="intro-x">
                                <td>
                                    <span
                                        class="inline-flex text-sm leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        Computer
                                    </span>
                                </td>
                                <td>
                                    <span
                                        class="inline-flex text-sm leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        Sept 30, 2021
                                    </span>
                                </td>
                                <td>
                                    <span
                                        class="inline-flex text-sm leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        10.00 AM
                                    </span>
                                </td>
                                <td>
                                    <span
                                        class="inline-flex text-sm leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        11.00 PM
                                    </span>
                                </td>
                                <td>
                                    <span
                                        class="inline-flex text-sm leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        VI
                                    </span>
                                </td>
                                <td>
                                    <span
                                        class="inline-flex text-sm leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        A
                                    </span>
                                </td>
                                <td>
                                    <span
                                        class="inline-flex text-sm leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        Mr. Mukhilan
                                    </span>
                                </td>
                                <td>
                                    <span
                                        class="inline-flex text-sm leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
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
                                    <span
                                        class="inline-flex text-sm leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        Computer
                                    </span>
                                </td>
                                <td>
                                    <span
                                        class="inline-flex text-sm leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        Sept 30, 2021
                                    </span>
                                </td>
                                <td>
                                    <span
                                        class="inline-flex text-sm leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        10.00 AM
                                    </span>
                                </td>
                                <td>
                                    <span
                                        class="inline-flex text-sm leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        11.00 PM
                                    </span>
                                </td>
                                <td>
                                    <span
                                        class="inline-flex text-sm leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        VI
                                    </span>
                                </td>
                                <td>
                                    <span
                                        class="inline-flex text-sm leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        A
                                    </span>
                                </td>
                                <td>
                                    <span
                                        class="inline-flex text-sm leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        Mr. Mukhilan
                                    </span>
                                </td>
                                <td>
                                    <span
                                        class="inline-flex text-sm leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
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
                                    <span
                                        class="inline-flex text-sm leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        Computer
                                    </span>
                                </td>
                                <td>
                                    <span
                                        class="inline-flex text-sm leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        Sept 30, 2021
                                    </span>
                                </td>
                                <td>
                                    <span
                                        class="inline-flex text-sm leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        10.00 AM
                                    </span>
                                </td>
                                <td>
                                    <span
                                        class="inline-flex text-sm leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        11.00 PM
                                    </span>
                                </td>
                                <td>
                                    <span
                                        class="inline-flex text-sm leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        VI
                                    </span>
                                </td>
                                <td>
                                    <span
                                        class="inline-flex text-sm leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        A
                                    </span>
                                </td>
                                <td>
                                    <span
                                        class="inline-flex text-sm leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        Mr. Mukhilan
                                    </span>
                                </td>
                                <td>
                                    <span
                                        class="inline-flex text-sm leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
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
                                    <span
                                        class="inline-flex text-sm leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        Computer
                                    </span>
                                </td>
                                <td>
                                    <span
                                        class="inline-flex text-sm leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        Sept 30, 2021
                                    </span>
                                </td>
                                <td>
                                    <span
                                        class="inline-flex text-sm leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        10.00 AM
                                    </span>
                                </td>
                                <td>
                                    <span
                                        class="inline-flex text-sm leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        11.00 PM
                                    </span>
                                </td>
                                <td>
                                    <span
                                        class="inline-flex text-sm leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        VI
                                    </span>
                                </td>
                                <td>
                                    <span
                                        class="inline-flex text-sm leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        A
                                    </span>
                                </td>
                                <td>
                                    <span
                                        class="inline-flex text-sm leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        Mr. Mukhilan
                                    </span>
                                </td>
                                <td>
                                    <span
                                        class="inline-flex text-sm leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
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
                                    <span
                                        class="inline-flex text-sm leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        Computer
                                    </span>
                                </td>
                                <td>
                                    <span
                                        class="inline-flex text-sm leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        Sept 30, 2021
                                    </span>
                                </td>
                                <td>
                                    <span
                                        class="inline-flex text-sm leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        10.00 AM
                                    </span>
                                </td>
                                <td>
                                    <span
                                        class="inline-flex text-sm leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        11.00 PM
                                    </span>
                                </td>
                                <td>
                                    <span
                                        class="inline-flex text-sm leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        VI
                                    </span>
                                </td>
                                <td>
                                    <span
                                        class="inline-flex text-sm leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        A
                                    </span>
                                </td>
                                <td>
                                    <span
                                        class="inline-flex text-sm leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        Mr. Mukhilan
                                    </span>
                                </td>
                                <td>
                                    <span
                                        class="inline-flex text-sm leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
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
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $('#adminvirtualclass').addClass("side-menu--active");
    </script>
@endsection
