@extends('../layout/admin/' . $layout)

@section('subhead')
<title>Edfish - Staff</title>
@endsection

@section('breadcrumb')
@include('helper.breadcrumb.breadcrumb', ['flag'=> 'inactive', 'url'=> 'adminstaff','name' => 'Staff'])
@include('helper.breadcrumb.breadcrumb', ['flag'=> 'inactive','url'=> 'payroll', 'name' => 'Payroll'])
@include('helper.breadcrumb.breadcrumb', ['flag'=> 'active', 'name' => 'Staff List'])
@endsection

@section('subcontent')
<div class="col-span-12 mt-8">
    <div class="intro-y flex items-center h-10">
        <h2 class="text-lg font-medium truncate mr-5">Search Teacher</h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-2">
        <div class="col-span-12 sm:col-span-3 intro-y">
            <select data-placeholder="Select your favorite actors" class="tom-select w-full">
                <option>Department</option>
            </select>
        </div>
        <div class="col-span-12 sm:col-span-3 intro-y">
            <select data-placeholder="Select your favorite actors" class="tom-select w-full">
                <option>Designation</option>
            </select>
        </div>
        <div class="col-span-12 sm:col-span-3 intro-y">
            <select data-placeholder="Select your favorite actors" class="tom-select w-full">
                <option>Searcg By Name</option>
            </select>
        </div>
        <div class="col-span-12 sm:col-span-3 intro-y">
            <button type="button" class="btn btn-primary rounded-lg w-full ">Search</button>
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
                                class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                Staff ID
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                Staff Name
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                Department
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                Designation
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                Contact Number
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">
                                Status
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-xs font-semibold text-white uppercase tracking-wider text-center">
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="intro-x">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                    SCH121
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
                                    Teaaching
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                    Sr. Teacher
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                    +91 7395944078
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300"
                                    style="color:rgb(0, 221, 0)">
                                    Generated
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <a href="javascript:;" data-toggle="modal" data-target="#superlarge-modal-size-preview"
                                    class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300"
                                    style="color:rgb(0, 221, 0)">
                                    Pay Salary
                                </a>
                            </td>
                        </tr>
                        <tr class="intro-x">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                    SCH121
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
                                    Teaaching
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                    Sr. Teacher
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                    +91 7395944078
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300"
                                    style="color:rgb(228, 21, 21)">
                                    Not Generated
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <a href="{{route('generatepayroll')}}" class=" inline-flex text-xs leading-5 text-theme-3 font-semibold rounded-full
                                    dark:text-gray-300">
                                    Generated Payroll
                                </a>
                            </td>
                        </tr>
                        <tr class="intro-x">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                    SCH121
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
                                    Teaaching
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                    Sr. Teacher
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300 text-gray-600">
                                    +91 7395944078
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="inline-flex text-xs leading-5 font-semibold rounded-full dark:text-gray-300"
                                    style="color:rgb(0, 221, 0)">
                                    Generated
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <a href="javascript:;" data-toggle="modal"
                                    data-target="#superlarge-modal-size-preview-payslip" class=" inline-flex text-xs leading-5 text-theme-3 font-semibold rounded-full
                                    dark:text-gray-300">
                                    View/Download Payslip
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div id="superlarge-modal-size-preview" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white font-semibold">
                <h2 class="font-medium text-base mx-auto">Pay Salary</h2>
                <button data-dismiss="modal">
                    <i data-feather="x-circle" class="w-6 h-6 mr-2"></i>
                </button>
            </div>
            <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                <div class="col-span-12 sm:col-span-4">
                    <label for="modal-form-1" class="form-label font-bold">Staff Name</label>
                    <input id="modal-form-1" type="text" class="form-control font-bold">
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <label for="modal-form-2" class="form-label font-bold">Expense Head</label>
                    <input id="modal-form-2" type="text" class="form-control font-bold">
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <label for="modal-form-3" class="form-label font-bold">Month Year</label>
                    <input id="modal-form-3" type="text" class="form-control font-bold">
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <label for="modal-form-4" class="form-label font-bold">Payment Date</label>
                    <input id="modal-form-4" type="Date" class="form-control font-bold">
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <label for="modal-form-5" class="form-label font-bold">Payment Amount</label>
                    <input id="modal-form-5" type="text" class="form-control font-bold">
                </div>
                <div class="col-span-12 sm:col-span-4">
                    <label for="modal-form-6" class="form-label font-bold">Payroll Method</label>
                    <input id="modal-form-6" type="text" class="form-control font-bold">
                </div>
                <div class="col-span-12 sm:col-span-12">
                    <label for="modal-form-6" class="form-label font-bold">Description</label>
                    <textarea rows="4" id="modal-form-6" type="text" class="form-control font-bold"></textarea>
                </div>
            </div>
            <!-- END: Modal Body -->
            <!-- BEGIN: Modal Footer -->
            <div class="modal-footer text-right">
                <button type="button" data-dismiss="modal" class="btn btn-primary w-auto">Pay Salary</button>
            </div>
        </div>
    </div>
</div>
<div id="superlarge-modal-size-preview-payslip" class="modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white font-semibold">
                <h2 class="font-medium text-base mx-auto">Pay Slip</h2>
                <button data-dismiss="modal">
                    <i data-feather="x-circle" class="w-6 h-6 mr-2"></i>
                </button>
            </div>
            <div class="modal-body p-0 sm:p-10">
                <div class="text-center">
                    <p class="text-theme-1 font-semibold text-lg">Edfish School</p>
                    <p class="text-theme-7 font-semibold text-lg mt-3">1/169, Anna Nagar, Tuticorin - 628102</p>
                    <p class="text-theme-1 font-semibold text-lg mt-3">Payslip for the period of August 2021</p>
                </div>
                <div class="grid grid-cols-12 gap-1 mt-4 w-full sm:w-11/12 mx-auto">
                    <div class="intro-y col-span-12 flex flex-wrap sm:flex-nowrap items-center">
                        <p class="text-theme-7 font-semibold text-lg">Payslip #113</p>
                        <div class="w-full sm:w-auto mt-3 sm:mt-0 sm:ml-auto md:float-right">
                            <p class="text-theme-7 font-semibold text-lg">Payment Date: September 1, 2021</p>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-12 gap-6 mt-4 w-full sm:w-11/12 mx-auto">
                    <div class="col-span-12 sm:col-span-6 intro-y">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th class="text-theme-1 font-semibold text-lg">
                                        Staff ID
                                    </th>
                                    <td class="text-base">
                                        621
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-theme-1 font-semibold text-lg">
                                        Mobil
                                    </th>
                                    <td class="text-base">
                                        +91 12345 67890
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-theme-1 font-semibold text-lg">
                                        Role
                                    </th>
                                    <td class="text-base">
                                        Teaching
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-theme-1 font-semibold text-lg">
                                        Designation
                                    </th>
                                    <td class="text-base">
                                        Sr. Teacher
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-span-12 sm:col-span-6 intro-y">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <th class="text-theme-1 font-semibold text-lg">
                                        Staff Name
                                    </th>
                                    <td class="text-base">
                                        J. Sabari Raj
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-theme-1 font-semibold text-lg">
                                        E-Mail
                                    </th>
                                    <td class="text-base">
                                        j.sabariraj@gmail.com
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-theme-1 font-semibold text-lg">
                                        Department
                                    </th>
                                    <td class="text-base">
                                        Computer Science
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-theme-1 font-semibold text-lg">
                                        Date of Joining
                                    </th>
                                    <td class="text-base">
                                        29, Nov 2021
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer text-center">
                <button type="button" data-dismiss="modal" class="btn btn-primary w-auto">Download Payslip</button>
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