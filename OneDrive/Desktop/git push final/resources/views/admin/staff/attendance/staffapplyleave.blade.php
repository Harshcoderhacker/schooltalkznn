@extends('../layout/admin/' . $layout)

@section('subhead')
    <title>Edfish - Staff</title>
@endsection

@section('breadcrumb')
    @include('helper.breadcrumb.breadcrumb', ['flag'=> 'inactive', 'url'=> 'adminstaff','name' => 'Staff'])
    @include('helper.breadcrumb.breadcrumb', ['flag'=> 'inactive', 'url'=> 'staffattendanceindex','name' => 'Attendance'])
    @include('helper.breadcrumb.breadcrumb', ['flag'=> 'active', 'name' => 'Leave Approved'])
@endsection

@section('subcontent')
    <div class=" col-span-12 xl:col-span-12 ">
        <div class="p-2">
            <div class="grid grid-cols-12 gap-3 ">
                <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center mt-2">
                    <h2 class="text-lg font-bold text-theme-1 mr-5">Leave Request</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="intro-y chat grid grid-cols-12 gap-5 mt-5 mb-5">
        @include('admin.staff.attendance.helper.staffleavemenu', ['active' => 'applyleave'])
    </div>
    <div class="flex flex-col mt-8 intro-y">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="table table-report -mt-2">
                        <thead class="bg-primary">
                            <tr class="intro-x">
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                    Staff Id
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                    Staff Name
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                    Staff Number
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                    Reason
                                </th>
                                <th scope="col"
                                    class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                    Status
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="intro-x">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        621
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        Mukhilan E
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        SCH 1234
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        Sick Leave
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex text-xs leading-5 font-semibold rounded-full text-theme-9">
                                        Approved
                                    </span>
                                </td>
                            </tr>
                            <tr class="intro-x">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        621
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        Muhundhan E
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        SCH 1234
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        Holiday
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex text-xs leading-5 font-semibold rounded-full text-theme-6">
                                        Disapproved
                                    </span>
                                </td>
                            </tr>
                            <tr class="intro-x">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        621
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        Ananthi E
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        SCH 1234
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        Sick Leave
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex text-xs leading-5 font-semibold rounded-full text-theme-9">
                                        Approved
                                    </span>
                                </td>
                            </tr>
                            <tr class="intro-x">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        621
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        Sabari S
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        SCH 1234
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        Personal
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex text-xs leading-5 font-semibold rounded-full text-theme-9">
                                        Approved
                                    </span>
                                </td>
                            </tr>
                            <tr class="intro-x">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        621
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        Sowmiya A
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        SCH 1234
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span
                                        class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                        Sick Leave
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="inline-flex text-xs leading-5 font-semibold rounded-full text-theme-9">
                                        Approved
                                    </span>
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
        $('#adminstaff').addClass("side-menu--active");
    </script>
@endsection
